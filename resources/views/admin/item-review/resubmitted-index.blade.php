@extends('admin.layouts.master')
@section('title', 'Resubmitted Items')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">

                    {{-- Filter/Search --}}
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Resubmitted Items</h3>
                        <form method="GET" class="d-flex gap-2">
                            <input type="text" name="search" class="form-control" placeholder="Search by name or author"
                                value="{{ request('search') }}">
                            <select name="category" class="form-select">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary">Filter</button>
                        </form>
                    </div>

                    {{-- Table --}}
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-vcenter table-striped card-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Details</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Publish Date</th>
                                        <th class="w-1"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($items as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="me-3">
                                                        @if ($item->preview_type == 'image')
                                                            <img src="{{ asset($item->preview_image) }}"
                                                                style="width:50px; height:50px; object-fit:cover;">
                                                        @elseif($item->preview_type == 'video')
                                                            <img src="{{ asset('defaults/video.webp') }}"
                                                                style="width:50px; height:50px; object-fit:cover;">
                                                        @elseif($item->preview_type == 'audio')
                                                            <img src="{{ asset('defaults/audio.webp') }}"
                                                                style="width:50px; height:50px; object-fit:cover;">
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <div><b>{{ $item->name }}</b></div>
                                                        <div><span>Author:</span> <span
                                                                class="text-primary">{{ $item->author->name }}</span></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $item->category->name }} / {{ $item->subCategory->name }}</td>
                                            <td>
                                                <span
                                                    class="badge rounded-pill bg-info text-white px-3 py-1">Resubmitted</span>
                                            </td>
                                            <td>{{ formatDate($item->created_at, true) }}</td>
                                            <td>
                                                @can('show resubmitted item info')
                                                    <a href="{{ route('admin.item-reviews.show', $item->id) }}"
                                                        class="btn btn-sm btn-outline-primary"><i class="ti ti-eye"></i></a>
                                                @endcan
                                                @can('download resubmitted item')
                                                    @if ($item->is_main_file_external == 1)
                                                        <a href="{{ $item->main_file }}" class="btn btn-sm btn-outline-primary"
                                                            target="_blank">Open</a>
                                                    @else
                                                        <a href="{{ route('admin.item.download', $item->id) }}"
                                                            class="btn btn-sm btn-outline-primary"><i
                                                                class="ti ti-download"></i></a>
                                                    @endif
                                                @endcan
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No Resubmitted Items Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer text-end">
                            {{ $items->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
