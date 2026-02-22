@extends('admin.layouts.master')
@section('title', 'Roles')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold">{{ __('Roles Management') }}</h2>
                    @can('create roles')
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-primary d-flex align-items-center gap-1">
                            <i class="ti ti-plus"></i> {{ __('Add Role') }}
                        </a>
                    @endcan
                </div>

                <div class="row g-4">
                    @forelse($roles as $role)
                        <div class="col-md-6 col-lg-4">
                            <div class="card shadow-sm h-100">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <h5 class="card-title mb-0">{{ ucfirst($role->name) }}</h5>
                                        @if ($role->name != 'super admin')
                                            <div class="d-flex gap-1">
                                                @can('edit roles')
                                                    <a class="text-info" href="{{ route('admin.roles.edit', $role->id) }}"><i
                                                            class="ti ti-edit"></i></a>
                                                @endcan
                                                @can('delete roles')
                                                    <a class="delete-item text-danger"
                                                        href="{{ route('admin.roles.destroy', $role->id) }}"><i
                                                            class="ti ti-trash"></i></a>
                                                @endcan
                                            </div>
                                        @else
                                            <span class="badge bg-blue-lt text-blue">{{ __('Protected') }}</span>
                                        @endif
                                    </div>

                                    <p class="text-muted mb-2 fw-semibold">{{ __('Permissions') }}:</p>
                                    <div class="d-flex flex-wrap gap-1">
                                        @if ($role->name == 'super admin')
                                            <span class="badge bg-blue-lt text-blue">{{ __('All Permissions') }}</span>
                                        @else
                                            @forelse($role->permissions as $permission)
                                                <span class="badge bg-gray-lt text-dark" data-bs-toggle="tooltip"
                                                    title="{{ $permission->name }}">
                                                    {{ Str::limit($permission->name, 15) }}
                                                </span>
                                            @empty
                                                <span class="text-muted">{{ __('No permissions') }}</span>
                                            @endforelse
                                        @endif
                                    </div>

                                    <div class="mt-auto pt-3">
                                        <span
                                            class="text-muted font-small">{{ formatDate($role->created_at, true) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center">{{ __('No roles found') }}</div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        </script>
    @endpush
@endsection
