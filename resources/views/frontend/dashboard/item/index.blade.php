@extends('frontend.dashboard.layouts.master')
@section('title', 'My Items')

@section('content')

    <style>
        .dashboard-card {
            border-radius: 12px;
            transition: .2s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, .05);
        }

        .item-row {
            transition: .2s ease;
        }

        .item-row:hover {
            background: #f8f9fa;
            transform: scale(1.01);
        }

        .old-price {
            text-decoration: line-through;
            color: #999;
            font-size: 14px;
        }

        .new-price {
            font-weight: 600;
            font-size: 16px;
        }

        .discount-badge {
            background: #ff4d4f;
            color: #fff;
            padding: 2px 6px;
            font-size: 11px;
            border-radius: 4px;
        }

        .thumb-wrapper {
            position: relative;
        }

        .thumb-wrapper img {
            width: 85px;
            height: 85px;
            object-fit: cover;
            border-radius: 10px;
        }
    </style>

    <div class="wsus__dash_order_table">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h5>My Items</h5>
                <p class="text-muted mb-0">Manage and track your products</p>
            </div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                + Add Item
            </button>
        </div>

        <!-- Stats -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card dashboard-card p-3">
                    <small>Total Items</small>
                    <h4>{{ $items->count() }}</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card dashboard-card p-3">
                    <small>Approved</small>
                    <h4>{{ $items->where('status', 'approved')->count() }}</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card dashboard-card p-3">
                    <small>Pending</small>
                    <h4>{{ $items->where('status', 'pending')->count() }}</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card dashboard-card p-3">
                    <small>Rejected</small>
                    <h4>{{ $items->whereIn('status', ['hard_rejected', 'soft_rejected'])->count() }}</h4>
                </div>
            </div>
        </div>

        <!-- Search + Filter -->
        <div class="d-flex justify-content-between mb-3">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <form method="GET" class="row g-2 align-items-center">

                        <!-- Search -->
                        <div class="col-md-4 col-12">
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <i class="ti ti-search"></i>
                                </span>
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                    placeholder="Search items...">
                            </div>
                        </div>

                        <!-- Status Filter -->
                        <div class="col-md-3 col-12">
                            <select name="status" class="form-select">
                                <option value="">Filter by Status</option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved
                                </option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="soft_rejected" {{ request('status') == 'soft_rejected' ? 'selected' : '' }}>
                                    Soft Rejected</option>
                                <option value="hard_rejected" {{ request('status') == 'hard_rejected' ? 'selected' : '' }}>
                                    Hard Rejected</option>
                            </select>
                        </div>

                        <!-- Buttons -->
                        <div class="col-auto">
                            <button class="btn btn-primary px-4">
                                Apply
                            </button>
                        </div>

                        @if (request()->hasAny(['search', 'status']))
                            <div class="col-auto">
                                <a href="{{ route('user.items.index') }}" class="btn btn-outline-secondary px-4">
                                    Reset
                                </a>
                            </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Details</th>
                        <th>Price</th>
                        <th>Publish Date</th>
                        <th>Status</th>
                        <th width="120">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse($items as $item)
                        <tr class="item-row">

                            <!-- Details -->
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="thumb-wrapper me-3">
                                        @if ($item->preview_type == 'image')
                                            <img src="{{ asset($item->preview_image) }}">
                                        @elseif($item->preview_type == 'video')
                                            <img src="{{ asset('defaults/video.webp') }}" alt="">
                                        @elseif($item->preview_type == 'audio')
                                            <img src="{{ asset('defaults/audio.webp') }}" alt="">
                                        @endif
                                    </div>
                                    <div>
                                        <h6 class="mb-1">{{ $item->name }}</h6>
                                        <small class="text-muted">
                                            {{ $item->category->name }} /
                                            {{ $item->subCategory->name }}
                                        </small>
                                    </div>
                                </div>
                            </td>

                            <!-- Price -->
                            <td>
                                @if ($item->discount_price > 0)
                                    <div>
                                        <span class="old-price">${{ $item->price }}</span><br>
                                        <span class="new-price">${{ $item->discount_price }}</span>
                                        <span class="discount-badge">
                                            -{{ round((($item->price - $item->discount_price) / $item->price) * 100) }}%
                                        </span>
                                    </div>
                                @else
                                    <span class="new-price">${{ $item->price }}</span>
                                @endif
                            </td>

                            <!-- Date -->
                            <td>
                                <small>{{ formatDate($item->created_at) }}</small>
                            </td>

                            <!-- Status -->
                            <td>
                                @php
                                    $colors = [
                                        'pending' => 'warning',
                                        'approved' => 'success',
                                        'soft_rejected' => 'info',
                                        'hard_rejected' => 'danger',
                                        'resubmitted' => 'primary',
                                    ];
                                @endphp
                                <span class="badge bg-{{ $colors[$item->status] ?? 'secondary' }}">
                                    {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td>
                                <div class="d-flex gap-2">
                                    @if (in_array($item->status, ['approved', 'soft_rejected']))
                                        <a href="{{ route('user.items.edit', $item->id) }}" class="text-primary">
                                        <i class="ti ti-edit me-1"></i>
                                    </a>
                                    @endif

                                    <a href="{{ route('user.items.destroy', $item->id) }}" class="delete-item text-danger">
                                        <i class="ti ti-trash me-1"></i>
                                    </a>

                                </div>
                            </td>

                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <h6>No Items Yet</h6>
                                <p class="text-muted">Start by adding your first product.</p>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Add Item
                                </button>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $items->links() }}
        </div>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <form action="{{ route('user.items.create') }}" method="GET">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Select Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <x-frontend.input-select name="category" :label="__('Category')" :required="true">
                            @foreach ($categories as $category)
                                <option value="{{ $category->slug }}">{{ $category->name }}</option>
                            @endforeach
                        </x-frontend.input-select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
