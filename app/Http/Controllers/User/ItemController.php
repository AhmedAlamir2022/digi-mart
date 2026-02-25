<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ItemStoreRequest;
use App\Http\Requests\Frontend\ItemUpdateRequest;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemChangelog;
use App\Models\ItemHistory;
use App\Models\UploadedFiles;
use App\Traits\FileUpload;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ItemController extends Controller
{
    use FileUpload;

    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Item::with(['category', 'subCategory'])
            ->where('author_id', user()->id);

        // 🔎 Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('version', 'like', "%{$search}%")
                    ->orWhere('tags', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('subCategory', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // 🎯 Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $items = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return view('frontend.dashboard.item.index', compact('categories', 'items'));
    }

    function create(Request $request)
    {
        $categories = Category::all();
        $selectedCategory = Category::with('subCategories')->whereSlug($request->category)->firstOrFail();
        // put category id on session
        session()->put('selected_category', $selectedCategory->id);

        $uploadedItems = UploadedFiles::where('author_id', user()->id)->where('category_id', session()->get('selected_category'))->get();
        return view('frontend.dashboard.item.create', compact('selectedCategory', 'categories', 'uploadedItems'));
    }

    function itemUploads(Request $request)
    {
        // dd($request->all());
        $categorySupportedExtensions = Category::find(session()->get('selected_category'))->file_types;
        $extensions = Str::lower(implode(',', $categorySupportedExtensions));
        $request->validate([
            'file.*' => ['required', 'mimes:' . $extensions],
        ]);

        foreach ($request->file('file') as $file) {
            if (!in_array($file->getClientOriginalExtension(), explode(',', $extensions))) {
                throw ValidationException::withMessages(['file' => __('Invalid file type')]);
            }
        }

        foreach ($request->file('file') as $file) {
            $fileInfo = $this->uploadFile($file);

            if ($fileInfo) {
                $uploadedFile = new UploadedFiles();
                $uploadedFile->category_id = session()->get('selected_category');
                $uploadedFile->author_id = user()->id;
                $uploadedFile->name = $fileInfo['name'];
                $uploadedFile->extension = $fileInfo['extension'];
                $uploadedFile->mime_type = $fileInfo['mimeType'];
                $uploadedFile->path = $fileInfo['path'];
                $uploadedFile->size = $fileInfo['size'];
                $uploadedFile->save();
            }
        }

        $uploadedFiles = UploadedFiles::where('author_id', user()->id)->where('category_id', session()->get('selected_category'))->get();
        $html = view('frontend.dashboard.layouts.partials.file-list-item', compact('uploadedFiles'))->render();
        return response()->json([
            'files' => $uploadedFiles,
            'html' => $html
        ], 200);
    }

    function uploadFile(UploadedFile $file, string $dir = "uploads/items", string $disk = "local"): ?array
    {
        // Validate disk type
        if (!in_array($disk, ['public', 'local'])) {
            throw new Exception("Invalid disk type. Must be either 'public' or 'local'");
        }

        // Handel file upload
        try {
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs($dir, $fileName, $disk);

            return [
                'name' => $file->getClientOriginalName(),
                'extension' => $file->getClientOriginalExtension(),
                'path' => "/$dir/$fileName",
                'size' => $file->getSize(),
                'mimeType' => $file->getMimeType()
            ];
        } catch (\Throwable $th) {
            throw $th;
        }

        return null;
    }


    public function itemDestroy(string $id)
    {
        $item = Item::whereId($id)->where('author_id', auth()->id())->first();

        if (!$item) {
            return response()->json([
                'status' => 'error',
                'message' => __('Item not found')
            ], 200);
        }

        try {
            // احذف كل الـ histories المرتبطة بالعنصر
            $item->histories()->delete();

            // دلوقتي احذف العنصر نفسه
            $item->delete();

            return response()->json([
                'status' => 'success',
                'message' => __('Item removed successfully')
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 200);
        }
    }

    function storeItem(ItemStoreRequest $request): JsonResponse
    {

        $item = new Item();
        $item->author_id = user()->id;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->category_id = $request->category;
        $item->sub_category_id = $request->sub_category;
        $item->version = $request->version;
        $item->demo_link = $request->demo_link;
        $item->tags = explode(',', $request->tags);
        $item->preview_type = $request->preview_type;
        $item->preview_image = $request->preview_file;
        $item->preview_video = $request->preview_file;
        $item->preview_audio = $request->preview_file;
        $item->main_file = $request->source_type == 'upload' ? $request->upload_source : $request->link_source;
        $item->is_main_file_external = $request->source_type == 'upload' ? 0 : 1;
        $item->screenshots = $request->screenshots;
        $item->price = $request->price;
        $item->discount_price  = $request->discount_price;
        $item->is_supported = $request->support;
        $item->support_instruction = $request->support_instruction;
        $item->status = 'pending';
        $item->is_free = $request->is_free;
        $item->save();

        /** Move public files files in public folder */
        $publicFiles = $request->screenshots ?? [];
        $publicFiles[] = $request->preview_file;

        foreach ($publicFiles as $file) {

            $file = ltrim($file, '/');

            $from = storage_path('app/private/' . $file);
            $to = public_path($file);

            if (!File::exists(dirname($to))) {
                File::makeDirectory(dirname($to), 0755, true, true);
            }

            if (File::exists($from)) {
                File::move($from, $to);
            }
        }

        // store initial history
        $itemHistory = new ItemHistory();
        $itemHistory->author_id = user()->id;
        $itemHistory->item_id = $item->id;
        $itemHistory->title = 'Initial Submission';
        $itemHistory->body = $request->message_for_reviewer;
        $itemHistory->status = 'pending';
        $itemHistory->save();

        UploadedFiles::where('category_id', $item->category_id)->where('author_id', user()->id)?->delete();

        notyf()->success('Item submitted successfully');
        return response()->json(['status' => 'success', 'redirect' => route('user.items.index')], 200);
    }

    function itemEdit(string $id)
    {
        $categories = Category::all();
        $item = Item::with(['category', 'subCategory'])->where('id', $id)->where('author_id', user()->id)->firstOrFail();
        $uploadedItems = UploadedFiles::where('author_id', user()->id)->where('category_id', $item->category_id)->get();
        // put category id on session
        session()->put('selected_category', $item->category->id);


        return view('frontend.dashboard.item.edit', compact('categories', 'item', 'uploadedItems'));
    }

    function itemUpdate(ItemUpdateRequest $request, string $id)
    {
        $item = Item::where('id', $id)->where('author_id', user()->id)->firstOrFail();
        // dd($item);

        if ($item->status == 'pending' || $item->status == 'hard_rejected') return response()->json(['status' => 'error', 'message' => __('Item not approved yet')], 402);

        $item->name = $request->name;
        $item->description = $request->description;
        $item->version = $request->version;
        $item->demo_link = $request->demo_link;
        $item->tags = explode(',', $request->tags);
        if ($request->filled('preview_type')) $item->preview_type = $request->preview_type;
        if ($request->filled('preview_file')) $item->preview_image = $request->preview_file;
        if ($request->filled('preview_file')) $item->preview_video = $request->preview_file;
        if ($request->filled('preview_file')) $item->preview_audio = $request->preview_file;
        if ($request->filled('source_type')) $item->main_file = $request->source_type == 'upload' ? $request->upload_source : $request->link_source;
        if ($request->filled('source_type')) $item->is_main_file_external = $request->source_type == 'upload' ? 0 : 1;
        if ($request->filled('screenshots')) $item->screenshots = $request->screenshots;
        $item->price = $request->price;
        $item->discount_price  = $request->discount_price;
        $item->is_supported = $request->support;
        $item->support_instruction = $request->support_instruction;
        $item->status = 'resubmitted';
        $item->is_free = $request->is_free;
        $item->save();

        /** Move public files files in public folder */
        $publicFiles = $request->screenshots ?? [];
        if ($request->filled('preview_file')) $publicFiles[] = $request->preview_file;

        foreach ($publicFiles as $file) {
            if (File::exists(storage_path('app/private/' . $file))) {
                File::move(storage_path('app/private/' . $file), public_path($file));
            }
        }

        UploadedFiles::where('category_id', $item->category_id)->where('author_id', user()->id)?->delete();

        notyf()->info('Item updated successfully');
        return response()->json(['status' => 'success', 'redirect' => route('user.items.index')], 200);
    }

    function itemDownload(string $id)
    {
        $item = Item::where('id', $id)->where('author_id', user()->id)->firstOrFail();

        $filePath = public_path($item->main_file); // public/uploads/items/filename

        if (file_exists($filePath)) {
            return response()->download($filePath);
        }

        abort(404, 'File not found');
    }

    function itemChangeLog(string $id)
    {
        $item = Item::where('id', $id)->where('author_id', user()->id)->firstOrFail();

        return view('frontend.dashboard.item.changelog', compact('item'));
    }

    function itemHistory(string $id)
    {
        $histories = ItemHistory::where('item_id', $id)->latest()->get();
        $item = Item::where('id', $id)->where('author_id', user()->id)->firstOrFail();
        return view('frontend.dashboard.item.history', compact('item', 'histories'));
    }

    function storeChangeLog(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'version' => ['required', 'string', 'max: 30'],
            'description' => ['required', 'string', 'max:1000']
        ]);

        $item = Item::where('id', $id)->where('author_id', user()->id)->firstOrFail();

        if ($item->status != 'approved') return abort(404);

        $changeLog = new ItemChangelog();
        $changeLog->version = $request->version;
        $changeLog->description = $request->description;
        $changeLog->item_id = $item->id;
        $changeLog->save();

        notyf()->success('Change log added successfully.');
        return redirect()->back();
    }


    function itemChangeLogSore(Request $request, string $id): RedirectResponse
    {
        $request->validate([
            'version' => ['required', 'string', 'max:30'],
            'description' => ['required', 'string', 'max:1000']
        ]);

        $item = Item::where('id', $id)->where('author_id', user()->id)->firstOrFail();
        $item->changeLogs()->create([
            'version' => $request->version,
            'description' => $request->description
        ]);

        notyf()->success('item Change log added successfully.');
        return redirect()->back();
    }
}
