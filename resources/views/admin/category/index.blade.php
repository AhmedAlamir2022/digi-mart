@extends('admin.layouts.master')
@section('title', __('All Categories'))
@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('All Categories') }}</h3>
                        <div class="card-actions">
                            @can('add new category')
                                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
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
                                            <th>{{ __('Icon') }}</th>
                                            <th>{{ __('Category Name') }}</th>
                                            <th>{{ __('File Types') }}</th>
                                            <th>{{ __('Show At Nav') }}</th>
                                            <th>{{ __('Show At Featured') }}</th>
                                            <th>{{ __('Date') }}</th>
                                            <th class="w-8"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($categories as $category)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <span class="avatar me-2 rounded-circle bg-gray-lt text-gray"
                                                        style="width:36px;height:36px;display:flex;align-items:center;justify-content:center;">
                                                        <i class="{{ $category->icon }}"></i>
                                                    </span>
                                                </td>
                                                <td>
                                                    {{ $category->name }}
                                                </td>
                                                <td>
                                                    @foreach ($category->file_types as $file_type)
                                                        <span class="badge bg-primary text-primary-fg me-1 mb-1"
                                                            style="cursor:default">{{ $file_type }}</span>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @if ($category->show_at_nav)
                                                        <span
                                                            class="badge bg-green-lt text-green">{{ __('Yes') }}</span>
                                                    @else
                                                        <span class="badge bg-red-lt text-red">{{ __('No') }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($category->show_at_featured)
                                                        <span
                                                            class="badge bg-green-lt text-green">{{ __('Yes') }}</span>
                                                    @else
                                                        <span class="badge bg-red-lt text-red">{{ __('No') }}</span>
                                                    @endif
                                                </td>

                                                <td class="text-muted">
                                                    {{ formatDate($category->created_at, true) }}
                                                </td>
                                                <td>
                                                    @can('edit category')
                                                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                            class="btn btn-sm btn-outline-primary"><i
                                                                class="ti ti-edit"></i></a>
                                                    @endcan
                                                    @can('delete category')
                                                        <a class="delete-item btn btn-sm btn-outline-danger"
                                                            href="{{ route('admin.categories.destroy', $category->id) }}"><i
                                                                class="ti ti-trash"></i></a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @empty
                                            <td colspan="6" class="text-center text-secondary">
                                                {{ __('No categories found') }}</td>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
