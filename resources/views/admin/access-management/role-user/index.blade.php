@extends('admin.layouts.master')
@section('title', 'All Roles')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>All Roles Users</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Access Management</a></div>
                    <div class="breadcrumb-item active">All roles users</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">All Roles Users</h4>

                                <a href="{{ route('admin.role-users.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Add New
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle" id="table-1">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="50">#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th class="text-center">Role</th>
                                                <th>Created</th>
                                                <th>Updated</th>
                                                <th class="text-center" width="120">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @forelse ($admins as $admin)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>

                                                    <td>
                                                        <div class="fw-semibold text-dark">
                                                            {{ ucfirst($admin->name) }}
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <span class="text-muted">
                                                            {{ $admin->email }}
                                                        </span>
                                                    </td>

                                                    <td class="text-center">
                                                        @foreach ($admin->getRoleNames() as $role)
                                                            <span
                                                                class="badge {{ strtolower($role) == 'super admin' ? 'badge-success' : 'badge-info' }} px-3">
                                                                {{ ucfirst($role) }}
                                                            </span>
                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        <span class="badge bg-light text-dark border">
                                                            {{ $admin->created_at->format('Y-m-d') }}
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <span class="text-muted small">
                                                            {{ $admin->updated_at->diffForHumans() }}
                                                        </span>
                                                    </td>

                                                    <td class="text-center">
                                                        @if ($admin->roles->first()?->name != 'super admin')
                                                            <div class="btn-group">
                                                                <a href="{{ route('admin.role-users.edit', $admin->id) }}"
                                                                    class="btn btn-sm btn-outline-primary" title="Edit">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                    data-url="{{ route('admin.role-users.destroy', $admin->id) }}"
                                                                    class="btn btn-sm btn-outline-danger delete-btn">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center py-5">
                                                        <div class="text-muted">
                                                            <i class="fas fa-user-slash fa-2x mb-3"></i>
                                                            <p class="mb-0">No role users found</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
