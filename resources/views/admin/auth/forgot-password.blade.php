<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
    <title>Admin Forgot Password &mdash; CodiePie</title>
    <!-- Font Awesome 6 (latest) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-bx1XUOYd8r5yVhMTjQwh5xDWZ9eKQ0MzpI3Ah6J9bLV9B0iTVu6mbpWmGxDRdP6h8Cgh0kM5zRBIqXc2tf4Y5A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/fontawesome/css/all.min.css') }}" />

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/bootstrap-social/bootstrap-social.css') }}" />

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/components.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
</head>

<body class="layout-4">
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="{{ asset(config('settings.logo')) }}" alt="logo" width="100"
                                class="shadow-light rounded-circle" />
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Admin Forgot Password</h4>
                            </div>
                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.password.email') }}" class="needs-validation"
                                    novalidate="">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email"
                                            tabindex="1" required autofocus value="{{ old('email') }}" />
                                        <div class="invalid-feedback">
                                            Please fill in your email
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Email Password Reset Link
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">Copyright &copy; CodiePie 2026</div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('admin/assets/bundles/lib.vendor.bundle.js') }}"></script>
    <script src="{{ asset('admin/js/CodiePie.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('admin/js/scripts.js') }}"></script>
    <script src="{{ asset('admin/js/custom.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script>
        var notyf = new Notyf({
            duration: 5000,
            dismissible: true
        });

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                notyf.error("{{ $error }}");
            @endforeach
        @endif
    </script>
</body>

</html>
