@extends('admin.layouts.master')
@section('title', 'Role Users')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Role Users') }}</h3>
                        <div class="card-actions">
                            @can('create user roles')
                                <a href="{{ route('admin.role-users.create') }}" class="btn btn-primary">
                                    <i class="ti ti-plus"></i>
                                    {{ __('Add new') }}
                                </a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Role') }}</th>
                                            <th>{{ __('Date') }}</th>
                                            <th class="w-8"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($admins as $admin)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="avatar avatar-sm"
                                                            style="background-image: url({{ $admin->avatar ?? asset('default-avatar.png') }});">
                                                        </div>
                                                        <span class="fw-semibold">{{ $admin->name }}</span>
                                                    </div>
                                                </td>
                                                <td class="text-secondary">
                                                    <i class="ti ti-mail text-muted"></i>
                                                    {{ $admin->email }}
                                                </td>
                                                <td>
                                                    @foreach ($admin->getRoleNames() as $role)
                                                        @php
                                                            $colors = [
                                                                'super admin' => 'bg-danger text-white',
                                                                'reviewer' => 'bg-warning text-dark',
                                                                'editor' => 'bg-success text-white',
                                                                'user' => 'bg-info text-white',
                                                            ];
                                                            $class = $colors[$role] ?? 'bg-secondary text-white';
                                                        @endphp
                                                        <span class="badge {{ $class }} me-1"
                                                            style="padding: 0.35em 0.65em; border-radius: 0.35rem; font-size:0.75rem;">
                                                            {{ ucfirst($role) }}
                                                        </span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {{ formatDate($admin->created_at, true) }}
                                                </td>
                                                <td>
                                                    @if ($admin->roles->first()?->name != 'super admin')
                                                        @can('edit user roles')
                                                            <a href="{{ route('admin.role-users.edit', $admin->id) }}"
                                                                class="text-primary"><i class="ti ti-edit"></i></a>
                                                        @endcan
                                                        @can('delete user roles')
                                                            <a class="delete-item text-danger"
                                                                href="{{ route('admin.role-users.destroy', $admin->id) }}"><i
                                                                    class="ti ti-trash"></i></a>
                                                        @endcan
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <td colspan="3" class="text-center">{{ __('No roles found') }}</td>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    @if ($admins->count())
                        <div class="card-footer text-end">
                            {{ $admins->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
