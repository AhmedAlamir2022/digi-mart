<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ItemStatusUpdateRequest;
use App\Models\Category;
use App\Models\Item;
use App\Models\ItemHistory;
use App\Services\MailSenderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;

class ItemReviewController extends Controller implements HasMiddleware
{
    static function Middleware(): array
    {
        return [
            // Index pages
            new Middleware('permission:show all pending items', only: ['pendingIndex']),
            new Middleware('permission:show all approved items', only: ['approveIndex']),
            new Middleware('permission:show all resubmitted item', only: ['resubmittedIndex']),
            new Middleware('permission:show all soft-rejected items', only: ['softRejectedIndex']),
            new Middleware('permission:show all hard-rejected items', only: ['hardRejectedIndex']),

            // Show
            new Middleware(
                'permission:show pending item info|show resubmitted item info|show soft-rejected item info|show hard-rejected item info|show approved item info',
                only: ['show', 'updateStatus']
            ),

            // Download
            new Middleware(
                'permission:download pending item|download resubmitted item|download soft-rejected item|download hard-rejected item|download approved item',
                only: ['itemDownload']
            ),
        ];
    }

    public function pendingIndex(Request $request)
    {
        $categories = Category::all();

        $query = Item::with(['author', 'category', 'subCategory'])
            ->where('status', 'pending');

        // 🔍 Search by name or author
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhereHas('author', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%{$search}%");
                    });
            });
        }

        // 📂 Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $items = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.item-review.pending-index', compact('items', 'categories'));
    }

    public function approveIndex(Request $request)
    {
        $query = Item::with('author', 'category', 'subCategory')
            ->where('status', 'approved');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhereHas('author', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%$search%");
                    });
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $items = $query->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('admin.item-review.approved-index', compact('items', 'categories'));
    }

    public function hardRejectedIndex(Request $request)
    {
        $query = Item::with('author', 'category', 'subCategory')
            ->where('status', 'hard_rejected');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhereHas('author', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%$search%");
                    });
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $items = $query->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('admin.item-review.hard-rejected-index', compact('items', 'categories'));
    }

    public function softRejectedIndex(Request $request)
    {
        $query = Item::with('author', 'category', 'subCategory')
            ->where('status', 'soft_rejected');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhereHas('author', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%$search%");
                    });
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $items = $query->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('admin.item-review.soft-rejected-index', compact('items', 'categories'));
    }

    public function resubmittedIndex(Request $request)
    {
        $query = Item::with('author', 'category', 'subCategory')
            ->where('status', 'resubmitted');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhereHas('author', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%$search%");
                    });
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $items = $query->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('admin.item-review.resubmitted-index', compact('items', 'categories'));
    }


    function show(string $id)
    {
        $item = Item::with('histories')->findOrFail($id);
        return view('admin.item-review.show', compact('item'));
    }

    function updateStatus(ItemStatusUpdateRequest $request, string $id): RedirectResponse
    {
        $item = Item::findOrFail($id);
        $item->status = $request->status;
        $item->save();

        $history = new ItemHistory();
        $history->item_id = $item->id;
        $history->status = $request->status;
        $history->author_id = $item->author_id;
        $history->reviewer_id = admin()->id;
        switch ($request->status) {
            case 'approved':
                $history->title = 'Item Approved';
                $history->body = 'Congratulations! Your item has been approved.';
                break;

            case 'soft_rejected':
                $history->title = 'Item Soft Rejected';
                $history->body = $request->reason;
                break;

            case 'hard_rejected':
                $history->title = 'Item Hard Rejected';
                $history->body = $request->reason;
                break;
        }


        $history->save();

        // send mail
        MailSenderService::sendMail(
            name: $item->author->name,
            subject: "$history->title | $item->name",
            content: $history->body,
            toMail: $item->author->email
        );

        notyf()->info('Item status updated successfully.');
        return redirect()->back();
    }

    public function itemDownload(string $id)
    {
        $item = Item::findOrFail($id);

        $filePath = public_path($item->main_file); // public/uploads/items/filename

        if (file_exists($filePath)) {
            return response()->download($filePath);
        }

        abort(404, 'File not found');
    }
}
