@extends('admin.layouts.master')
@section('title', 'Update Sub Category')

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card shadow-sm">

                    <!-- Header -->
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ti ti-edit me-2 text-primary"></i>
                            {{ __('Update Sub Category') }}
                        </h3>
                        <div class="card-actions">
                            <x-admin.back-button :href="route('admin.sub-categories.index')" />
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="card-body">
                        <form action="{{ route('admin.sub-categories.update', $subCategory->id) }}" method="POST"
                            class="x-form">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">

                                <!-- Parent Category -->
                                <div class="col-md-12">
                                    <x-admin.input-select name="category" class="select_2" :label="__('Parent Category')">

                                        <option value="" disabled>
                                            -- Select Parent Category --
                                        </option>

                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @selected($subCategory->category_id == $category->id)>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach

                                    </x-admin.input-select>

                                    <small class="text-muted">
                                        You can move this sub-category to another parent category.
                                    </small>
                                </div>

                                <!-- Sub Category Name -->
                                <div class="col-md-12">
                                    <x-admin.input-text name="name" :value="$subCategory->name" :label="__('Sub Category Name')"
                                        placeholder="Enter sub category name" />
                                    <small class="text-muted">
                                        Updating this name will reflect across the system.
                                    </small>
                                </div>

                            </div>
                        </form>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer text-end">
                        <x-admin.submit-button :label="__('Update')" onclick="submitSubCategoryUpdate(this)" />
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        function submitSubCategoryUpdate(btn) {
            btn.disabled = true;
            btn.innerHTML = '<i class="ti ti-loader ti-spin me-1"></i> Updating...';
            document.querySelector('.x-form').submit();
        }
    </script>
@endpush
