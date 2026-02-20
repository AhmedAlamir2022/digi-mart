@extends('admin.layouts.master')
@section('title', 'All Roles')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>All Roles</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Access Management</a></div>
                    <div class="breadcrumb-item active">All roles</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">All Roles</h4>

                                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus"></i> Add New
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped v_center" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Role</th>
                                                <th class="text-center">Permissions</th>
                                                <th>Created</th>
                                                <th>Updated</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @forelse ($roles as $role)
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $loop->iteration }}
                                                    </td>

                                                    <td>
                                                        <span class="font-weight-600">{{ ucfirst($role->name) }}</span>
                                                    </td>

                                                    <td class="text-center align-middle">
                                                        @if ($role->name === 'super admin')
                                                            <span class="badge badge-success px-3">
                                                                All Permissions
                                                            </span>
                                                        @else
                                                            <span class="badge badge-info px-3">
                                                                {{ $role->permissions_count }}
                                                            </span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <div class="d-flex flex-column">
                                                            <span class="badge badge-light text-dark mb-1">
                                                                {{ $role->created_at->format('Y-m-d') }}
                                                            </span>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="d-flex flex-column">
                                                            <span class="badge badge-light text-dark mb-1">
                                                                {{ $role->updated_at->diffForHumans() }}
                                                            </span>
                                                        </div>
                                                    </td>


                                                    <td class="text-center">
                                                        @if ($role->name !== 'super admin')
                                                            <div class="btn-group">
                                                                <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                                    class="btn btn-sm btn-outline-primary mr-1">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a href="javascript:void(0);"
                                                                    data-url="{{ route('admin.roles.destroy', $role->id) }}"
                                                                    class="btn btn-sm btn-outline-danger delete-btn">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </td>
                                                </tr>

                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center py-4">
                                                        <span class="text-muted">No roles found</span>
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
