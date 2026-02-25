@extends('admin.layouts.master')
@section('title', 'Item Review')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">

                <div class="card shadow-sm">

                    {{-- ================= HEADER ================= --}}
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="card-title mb-1">{{ $item->name }}</h3>
                            <div class="text-muted small">
                                Item #{{ $item->id }} •
                                {{ $item->category->name }} /
                                {{ $item->subCategory->name }}
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            @if ($item->status == 'approved')
                                <span class="badge rounded-pill bg-success text-white px-3 py-1">Approved</span>
                            @elseif ($item->status == 'pending')
                                <span class="badge rounded-pill bg-warning text-dark px-3 py-1">Pending</span>
                            @elseif ($item->status == 'resubmitted')
                                <span class="badge rounded-pill bg-info text-white px-3 py-1">Resubmitted</span>
                            @elseif ($item->status == 'soft_rejected')
                                <span class="badge rounded-pill bg-secondary text-white px-3 py-1">Soft Rejected</span>
                            @elseif ($item->status == 'hard_rejected')
                                <span class="badge rounded-pill bg-danger text-white px-3 py-1">Hard Rejected</span>
                            @endif

                            <x-admin.back-button :href="route('admin.item-reviews.pending.index')" />
                        </div>
                    </div>

                    {{-- ================= BODY ================= --}}
                    <div class="card-body">
                        <div class="row">

                            {{-- ================= LEFT SIDE ================= --}}
                            <div class="col-md-8">

                                <ul class="nav nav-pills mb-3">
                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#details">
                                            Details
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#history">
                                            History
                                        </button>
                                    </li>
                                    @if ($item->status == 'pending' || $item->status == 'resubmitted' || admin()->hasRole('super admin'))
                                        <li class="nav-item">
                                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#statusTab">
                                                Update Status
                                            </button>
                                        </li>
                                    @endif
                                </ul>

                                <div class="tab-content">

                                    {{-- ================= DETAILS TAB ================= --}}
                                    <div class="tab-pane fade show active" id="details">

                                        {{-- Preview --}}
                                        <div class="card mb-3 shadow-sm">
                                            <div class="card-header fw-bold">Preview</div>
                                            <div class="card-body text-center">

                                                @if ($item->preview_type == 'image')
                                                    <img class="img-fluid rounded-3 shadow-sm border"
                                                        style="max-height:600px; object-fit:contain"
                                                        src="{{ asset($item->preview_image) }}">
                                                @elseif($item->preview_type == 'video')
                                                    <video controls class="w-100 rounded-3 shadow-sm">
                                                        <source src="{{ asset($item->preview_video) }}">
                                                    </video>
                                                @elseif($item->preview_type == 'audio')
                                                    <audio controls class="w-100">
                                                        <source src="{{ asset($item->preview_audio) }}">
                                                    </audio>
                                                @endif

                                            </div>
                                        </div>

                                        {{-- Screenshots --}}
                                        @if (count($item->screenshots))
                                            <div class="card mb-3 shadow-sm">
                                                <div class="card-header fw-bold">Screenshots</div>
                                                <div class="card-body">
                                                    <div class="row g-2">
                                                        @foreach ($item->screenshots as $shot)
                                                            <div class="col-4">
                                                                <img src="{{ asset($shot) }}"
                                                                    class="img-fluid rounded shadow-sm border">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        {{-- Description --}}
                                        <div class="card mb-3 shadow-sm">
                                            <div class="card-header fw-bold">Description</div>
                                            <div class="card-body">
                                                {!! $item->description !!}
                                            </div>
                                        </div>

                                        {{-- Support --}}
                                        <div class="card mb-3 shadow-sm">
                                            <div class="card-header fw-bold">Support</div>
                                            <div class="card-body">
                                                @if ($item->is_supported)
                                                    <span class="badge bg-success">Supported</span>
                                                @else
                                                    <span class="badge bg-danger">Not Supported</span>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Price --}}
                                        <div class="card mb-3 shadow-sm">
                                            <div class="card-header fw-bold">Price</div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <b>Regular Price:</b>
                                                        <div class="text-muted">
                                                            ${{ $item->price }}
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <b>Discount Price:</b>
                                                        <div class="text-muted">
                                                            ${{ $item->discount_price ?? '—' }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Free Item --}}
                                        <div class="card mb-3 shadow-sm">
                                            <div class="card-header fw-bold">Free Item</div>
                                            <div class="card-body">
                                                @if ($item->is_free)
                                                    <span class="badge bg-success">Free Item</span>
                                                @else
                                                    <span class="badge bg-secondary">Paid Item</span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                    {{-- ================= HISTORY TAB ================= --}}
                                    <div class="tab-pane fade" id="history">

                                        @forelse($item->histories as $history)
                                            <div class="card mb-3 shadow-sm">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <h5>{{ $history->title }}</h5>
                                                        <span class="badge bg-light text-dark">
                                                            {{ Str::replace('_', ' ', $history->status) }}
                                                        </span>
                                                    </div>
                                                    <p class="text-muted mb-2">
                                                        {{ $history->body }}
                                                    </p>
                                                    <small class="text-muted">
                                                        {{ formatDate($history->created_at) }}
                                                    </small>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="text-center text-muted mt-4">
                                                No History Found
                                            </div>
                                        @endforelse

                                    </div>

                                    {{-- ================= STATUS TAB ================= --}}
                                    @if ($item->status == 'pending' || $item->status == 'resubmitted' || admin()->hasRole('super admin'))
                                        <div class="tab-pane fade" id="statusTab">

                                            <form action="{{ route('admin.item-reviews.status', $item->id) }}"
                                                method="POST">
                                                @csrf

                                                <x-admin.input-select name="status" label="Status" id="status">
                                                    <option value="approved">Approve</option>
                                                    <option value="soft_rejected">Soft Reject</option>
                                                    <option value="hard_rejected">Hard Reject</option>
                                                </x-admin.input-select>

                                                <div class="d-none mt-2" id="reasonBox">
                                                    <x-admin.input-textarea name="reason" label="Reject Reason"
                                                        :value="$item->reject_reason" />
                                                </div>

                                                <div class="alert alert-warning small mt-3">
                                                    Changing status will notify the author.
                                                </div>

                                                <button class="btn btn-primary w-100 mt-2">
                                                    Update Status
                                                </button>
                                            </form>

                                        </div>
                                    @endif

                                </div>
                            </div>

                            {{-- ================= RIGHT SIDE (STICKY PANEL) ================= --}}
                            <div class="col-md-4">
                                <div class="card shadow-sm position-sticky" style="top:20px">
                                    <div class="card-body">

                                        <h5 class="mb-3">Quick Actions</h5>

                                        @if ($item->status == 'pending' || $item->status == 'resubmitted')
                                            <form action="{{ route('admin.item-reviews.status', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="approved">
                                                <button class="btn btn-success w-100 mb-2">
                                                    Approve Now
                                                </button>
                                            </form>
                                        @endif

                                        <hr>

                                        <div class="mb-3">
                                            <b>Author</b>
                                            <div class="text-muted">{{ $item->author->name }}</div>
                                        </div>

                                        <div class="mb-3">
                                            <b>Publish Date</b>
                                            <div class="text-muted">{{ formatDate($item->created_at) }}</div>
                                        </div>

                                        @if ($item->demo_link)
                                            <a href="{{ $item->demo_link }}" target="_blank"
                                                class="btn btn-warning w-100 mb-2">
                                                Open Demo
                                            </a>
                                        @endif

                                        @if ($item->is_main_file_external)
                                            <a href="{{ $item->main_file }}" target="_blank"
                                                class="btn btn-primary w-100">
                                                Open Main File
                                            </a>
                                        @else
                                            <a href="{{ route('admin.item.download', $item->id) }}"
                                                class="btn btn-primary w-100">
                                                Download File
                                            </a>
                                        @endif

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        'use strict';
        $(function() {
            $('#status').on('change', function() {
                let val = $(this).val();
                if (val === 'soft_rejected' || val === 'hard_rejected') {
                    $('#reasonBox').removeClass('d-none');
                } else {
                    $('#reasonBox').addClass('d-none');
                }
            });
        });
    </script>

    <style>
        .card {
            transition: .2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        img:hover {
            transform: scale(1.02);
            transition: .2s ease-in-out;
        }
    </style>
@endpush
