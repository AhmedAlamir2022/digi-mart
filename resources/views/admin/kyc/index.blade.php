@extends('admin.layouts.master')
@section('title', 'KYC Requests')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('KYC Requests') }}</h3>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Document Type') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th class="w-8"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kycRequests as $request)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <!-- Avatar حقيقي إذا موجود -->
                                                    @if ($request->user->avatar)
                                                        <img src="{{ asset($request->user->avatar) }}"
                                                            alt="{{ $request->user->name }}"
                                                            class="avatar me-2 rounded-circle"
                                                            style="width: 36px; height: 36px; object-fit: cover;">
                                                    @else
                                                        <!-- fallback: أول حرف من الاسم -->
                                                        <span class="avatar me-2 rounded-circle bg-gray text-white"
                                                            style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                                            {{ strtoupper(substr($request->user->name, 0, 1)) }}
                                                        </span>
                                                    @endif

                                                    <div class="text-truncate">
                                                        <div class="fw-medium">{{ $request->user->name }}</div>
                                                        <div class="text-muted text-truncate"
                                                            title="{{ $request->user->email }}">
                                                            {{ $request->user->email }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <span
                                                    class="badge bg-gray-lt">{{ ucfirst($request->document_type) }}</span>
                                            </td>

                                            <td>
                                                @switch($request->status)
                                                    @case('pending')
                                                        <span
                                                            class="badge bg-yellow-lt text-yellow">{{ ucfirst($request->status) }}</span>
                                                    @break

                                                    @case('approved')
                                                        <span
                                                            class="badge bg-green-lt text-green">{{ ucfirst($request->status) }}</span>
                                                    @break

                                                    @default
                                                        <span
                                                            class="badge bg-red-lt text-red">{{ ucfirst($request->status) }}</span>
                                                @endswitch
                                            </td>

                                            <td class="text-muted">
                                                {{ formatDate($request->created_at) }}
                                            </td>

                                            <td class="text-end">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <!-- زر عرض التفاصيل -->
                                                    <a href="{{ route('admin.kyc.show', $request->id) }}"
                                                        class="btn btn-sm btn-outline-primary" title="View KYC">
                                                        <i class="ti ti-eye"></i>
                                                    </a>

                                                    <!-- زر تحميل المستند -->
                                                    @foreach (json_decode($request->documents) as $index => $document)
                                                        <a href="{{ route('admin.kyc.download-document', ['kyc' => $request->id, 'attachment_id' => $index]) }}"
                                                            class="btn btn-sm btn-outline-primary"
                                                            title="Download Document {{ $index + 1 }}">
                                                            <i class="ti ti-download"></i>
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                            <td colspan="3" class="text-center">{{ __('No roles found') }}</td>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="card-footer text-end">
                            {{ $kycRequests->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
