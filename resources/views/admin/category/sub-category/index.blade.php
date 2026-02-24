@extends('admin.layouts.master')
@section('title', 'All SubCategories')
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('All Sub Categories') }}</h3>
                        <div class="card-actions">
                            @can('add new sub-category')
                                <a href="{{ route('admin.sub-categories.create') }}" class="btn btn-primary">
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
                                            <th>{{ __('Category') }}</th>
                                            <th>{{ __('Parent Category') }}</th>
                                            <th>{{ __('Date') }}</th>
                                            <th class="w-8"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($subCategories as $subCategory)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    {{ $subCategory->name }}
                                                </td>
                                                <td>
                                                    {{ $subCategory->category->name }}
                                                </td>

                                                <td class="text-muted">
                                                    {{ formatDate($subCategory->created_at, true) }}
                                                </td>
                                                <td>
                                                    @can('edit sub-category')
                                                        <a href="{{ route('admin.sub-categories.edit', $subCategory->id) }}"
                                                            class="btn btn-sm btn-outline-primary"><i
                                                                class="ti ti-edit"></i></a>
                                                    @endcan
                                                    @can('delete sub-category')
                                                        <a class="delete-item btn btn-sm btn-outline-danger"
                                                            href="{{ route('admin.sub-categories.destroy', $subCategory->id) }}"><i
                                                                class="ti ti-trash"></i></a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @empty
                                            <td colspan="5" class="text-center text-secondary">
                                                {{ __('No Sub categories found') }}</td>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        {{ $subCategories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
