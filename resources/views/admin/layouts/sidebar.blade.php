<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="javascript:;">
                <img src="{{ asset(config('settings.logo')) }}" width="110" height="32"
                    alt="{{ config('setting.site_name') }}" class="navbar-brand-image">
            </a>
        </h1>
        <div class="navbar-nav flex-row d-lg-none">

            <div class="d-none d-lg-flex">
                <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                    data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                    </svg>
                </a>
                <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                    data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path
                            d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                    </svg>
                </a>

            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <span class="avatar avatar-sm" style="background-image: url({{ asset(admin()->avatar) }})"></span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ admin()->name }}</div>
                        <div class="mt-1 small text-secondary">Admin</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">

                    <a href="" class="dropdown-item">{{ __('Profile') }}</a>
                    <div class="dropdown-divider"></div>
                    <a href="" class="dropdown-item">{{ __('Settings') }}</a>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <a href="javascript:;" onclick="event.preventDefault(); this.closest('form').submit();"
                            class="dropdown-item">{{ __('Logout') }}</a>
                    </form>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item">
                    <a class="nav-link {{ setSidebarActive(['admin.dashboard']) }}"
                        href="{{ route('admin.dashboard') }}">
                        <span
                            class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <i class="ti ti-home sidebar-icon"></i>
                        </span>
                        <span class="nav-link-title">
                            Home
                        </span>
                    </a>
                </li>

                @if (canAccess(['show roles', 'user roles']))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ setSidebarActive(['admin.role-users.*', 'admin.roles.*']) == 'active' ? 'show' : '' }}"
                            href="#access-management" data-bs-toggle="dropdown" data-bs-auto-close="false"
                            role="button"
                            aria-expanded="{{ setSidebarActive(['admin.role-users.*', 'admin.roles.*']) == 'active' ? 'true' : 'false' }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-shield-cog sidebar-icon"></i>
                            </span>
                            <span class="nav-link-title">Access Management</span>
                        </a>

                        <div
                            class="dropdown-menu {{ setSidebarActive(['admin.role-users.*', 'admin.roles.*']) == 'active' ? 'show' : '' }}">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">

                                    @can('show user roles')
                                        <a class="dropdown-item {{ setSidebarActive(['admin.role-users.index']) }}"
                                            href="{{ route('admin.role-users.index') }}">
                                            Role Users
                                        </a>
                                    @endcan

                                    @can('show roles')
                                        <a class="dropdown-item {{ setSidebarActive(['admin.roles.index']) }}"
                                            href="{{ route('admin.roles.index') }}">
                                            Role & Permissions
                                        </a>
                                    @endcan

                                </div>
                            </div>
                        </div>
                    </li>
                @endif
                {{-- Divider --}}
                {{-- <li class="nav-item mt-auto">
                    <hr class="dropdown-divider">
                </li> --}}

                {{-- Profile --}}
                <li class="nav-item">
                    <a class="nav-link {{ setSidebarActive(['admin.profile.index']) }}"
                        href="{{ route('admin.profile.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-user sidebar-icon"></i>
                        </span>
                        <span class="nav-link-title">
                            Profile
                        </span>
                    </a>
                </li>

                {{-- Settings --}}
                <li class="nav-item">
                    <a class="nav-link {{ setSidebarActive(['admin.settings.*']) }}"
                        href="{{ route('admin.settings.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-settings sidebar-icon"></i>
                        </span>
                        <span class="nav-link-title">
                            Settings
                        </span>
                    </a>
                </li>

                {{-- Logout --}}
                <li class="nav-item">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <a href="javascript:;" onclick="event.preventDefault(); this.closest('form').submit();"
                            class="nav-link text-danger">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-logout sidebar-icon"></i>
                            </span>
                            <span class="nav-link-title">
                                Logout
                            </span>
                        </a>
                    </form>
                </li>

            </ul>
        </div>
    </div>
</aside>

<!-- Navbar -->
