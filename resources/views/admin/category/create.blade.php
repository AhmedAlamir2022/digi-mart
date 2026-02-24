@extends('admin.layouts.master')
@section('title', 'Create Category')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/ez-icon-picker.css') }}">
    <style>
        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: #fff;
            background-color: #0d6efd;
            padding: 0.2rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.85rem;
        }
    </style>
@endpush

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Create Category') }}</h3>
                        <div class="card-actions">
                            <x-admin.back-button :href="route('admin.categories.index')" />
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.categories.store') }}" method="POST" class="x-form">
                            @csrf
                            <div class="row g-3">
                                <!-- Icon Picker -->
                                <div class="col-md-12">
                                    <x-admin.input-icon name="icon" :label="__('Category Icon')" />
                                    <small class="text-muted d-block mt-1">Preview: <span
                                            class="icon-preview"></span></small>
                                    <small class="text-muted d-block">Choose an icon that will appear in the category
                                        list.</small>
                                </div>

                                <!-- Category Name -->
                                <div class="col-md-12">
                                    <x-admin.input-text name="name" :label="__('Category Name')" />
                                </div>

                                <!-- File Types -->
                                <div class="col-md-12">
                                    <x-admin.input-text name="file_types" :label="__('File Types')" data-role="tagsinput"
                                        placeholder="ZIP, MP4, MP3, PNG" :hint="__('Allowed files for upload as main file')" />
                                </div>

                                <hr class="my-3">

                                <!-- Toggles -->
                                <div class="col-md-4">
                                    <x-admin.input-toggle name="show_at_nav" :label="__('Show at Nav')" />
                                    <small class="text-muted d-block">Display this category in the main navigation
                                        menu</small>
                                </div>
                                <div class="col-md-4">
                                    <x-admin.input-toggle name="show_at_featured" :label="__('Show at Featured')" />
                                    <small class="text-muted d-block">Highlight this category in featured section</small>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Footer Submit -->
                    <div class="card-footer text-end">
                        <x-admin.submit-button :label="__('Create')" onclick="submitCategoryForm(this)" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/admin/js/ez-icon-picker.iife.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize Icon Picker
            const picker = new EzIconPicker({
                selector: '.icon-picker'
            });

            // Live preview for icon
            const preview = document.querySelector('.icon-preview');
            document.querySelector('.icon-picker').addEventListener('change', (e) => {
                preview.innerHTML = `<i class="${e.target.value}" style="font-size:24px;"></i>`;
            });
        });

        // Submit with loading state
        function submitCategoryForm(btn) {
            btn.disabled = true;
            btn.innerHTML = '<i class="ti ti-loader ti-spin me-1"></i> Creating...';
            document.querySelector('.x-form').submit();
        }
    </script>
@endpush
