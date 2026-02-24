@extends('admin.layouts.master')

@section('title', 'KYC Details')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('KYC Details') }}</h3>
                        <div class="card-actions">
                            <x-admin.back-button :href="route('admin.kyc.index')" />
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-striped">
                                <tbody>
                                    <!-- Name + Avatar + Email -->
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $kyc->user->avatar ? asset($kyc->user->avatar) : asset('default-avatar.png') }}"
                                                    alt="{{ $kyc->user->name }}" class="avatar me-2 rounded-circle"
                                                    style="width:36px;height:36px;object-fit:cover;">
                                                <div class="text-truncate">
                                                    <div class="fw-medium">{{ $kyc->user->name }}</div>
                                                    <div class="text-muted text-truncate" title="{{ $kyc->user->email }}">
                                                        {{ $kyc->user->email }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Document Type -->
                                    <tr>
                                        <th>{{ __('Document Type') }}</th>
                                        <td>
                                            <span
                                                class="badge bg-gray-lt text-gray">{{ ucfirst($kyc->document_type) }}</span>
                                        </td>
                                    </tr>

                                    <!-- Document Number -->
                                    <tr>
                                        <th>{{ __('Document Number') }}</th>
                                        <td class="fw-medium">{{ $kyc->document_number }}</td>
                                    </tr>

                                    <!-- Document Attachments -->
                                    <tr>
                                        <th>{{ __('Document Attachments') }}</th>
                                        <td>
                                            @php
                                                $attachments = json_decode($kyc->documents);
                                            @endphp
                                            @foreach ($attachments as $index => $attachment)
                                                <a href="{{ route('admin.kyc.download-document', ['kyc' => $kyc->id, 'attachment_id' => $index]) }}"
                                                    class="btn btn-sm btn-outline-primary me-1 mb-1"
                                                    title="Download Attachment {{ $index + 1 }}">
                                                    <i class="ti ti-download me-1"></i> {{ __('Attachment') }}
                                                    {{ $index + 1 }}
                                                </a>
                                            @endforeach
                                        </td>
                                    </tr>

                                    <!-- Status -->
                                    <tr>
                                        <th>{{ __('Status') }}</th>
                                        <td>
                                            @switch($kyc->status)
                                                @case('pending')
                                                    <span class="badge bg-yellow-lt text-yellow">{{ ucfirst($kyc->status) }}</span>
                                                @break

                                                @case('approved')
                                                    <span class="badge bg-green-lt text-green">{{ ucfirst($kyc->status) }}</span>
                                                @break

                                                @default
                                                    <span class="badge bg-red-lt text-red">{{ ucfirst($kyc->status) }}</span>
                                            @endswitch
                                        </td>
                                    </tr>

                                    <!-- Action / Update Status -->
                                    <tr>
                                        <th>{{ __('Action') }}</th>
                                        <td>
                                            <form action="{{ route('admin.kyc.status', $kyc->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="mb-2">
                                                    <select name="status" id="status"
                                                        class="form-select form-select-sm">
                                                        <option value="pending" @selected($kyc->status == 'pending')>
                                                            {{ __('Pending') }}</option>
                                                        <option value="approved" @selected($kyc->status == 'approved')>
                                                            {{ __('Approved') }}</option>
                                                        <option value="rejected" @selected($kyc->status == 'rejected')>
                                                            {{ __('Rejected') }}</option>
                                                    </select>
                                                </div>

                                                <div id="reason"
                                                    class="{{ $kyc->status == 'rejected' ? '' : 'd-none' }} mb-2">
                                                    <textarea name="reason" class="form-control form-control-sm" placeholder="{{ __('Reason') }}">{{ $kyc->reject_reason }}</textarea>
                                                </div>

                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    <i class="ti ti-refresh me-1"></i> {{ __('Update') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
                let status = $(this).val();
                if (status === 'rejected') {
                    $('#reason').removeClass('d-none');
                } else {
                    $('#reason').addClass('d-none');
                }
            });
        });
    </script>
@endpush
