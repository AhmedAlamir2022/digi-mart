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
                @php
                    $accessActive =
                        request()->routeIs('admin.categories.*') || request()->routeIs('admin.sub-categories.*');
                @endphp
                @if (canAccess(['show all categories', 'show all sub-categories']))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ $accessActive ? 'active show' : '' }}"
                            href="#navbar-layout" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button"
                            aria-expanded="true">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/layout-2 -->
                                <i class="ti ti-list sidebar-icon"></i>
                            </span>
                            <span class="nav-link-title">
                                {{ __('Manage Categories') }}
                            </span>
                        </a>
                        <div class="dropdown-menu {{ $accessActive ? 'show' : '' }}">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    @can('show all categories')
                                        <a class="dropdown-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
                                            href="{{ route('admin.categories.index') }}">
                                            {{ __('Main Categories') }}
                                        </a>
                                    @endcan

                                    @can('show all sub-categories')
                                        <a class="dropdown-item {{ request()->routeIs('admin.sub-categories.*') ? 'active' : '' }}"
                                            href="{{ route('admin.sub-categories.index') }}">
                                            {{ __('Sub Categories') }}
                                        </a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </li>
                @endif

                @php
                    $accessActive =
                        request()->routeIs('admin.item-reviews.pending.index') ||
                        request()->routeIs('admin.item-reviews.resubmitted.*') ||
                        request()->routeIs('admin.item-reviews.softrejected.*') ||
                        request()->routeIs('admin.item-reviews.hardrejected.*') ||
                        request()->routeIs('admin.item-reviews.approved.*');
                @endphp

                @if (canAccess([
                        'show all pending items',
                        'show all resubmitted items',
                        'show all soft-rejected items',
                        'show all hard-rejected items',
                        'show all approved items',
                    ]))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ $accessActive ? 'active show' : '' }}"
                            href="#product-review" data-bs-toggle="dropdown" data-bs-auto-close="false"
                            role="button" aria-expanded="{{ $accessActive ? 'true' : 'false' }}">

                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-basket-bolt sidebar-icon"></i>
                            </span>
                            <span class="nav-link-title">
                                Product Review
                            </span>
                        </a>

                        <div class="dropdown-menu {{ $accessActive ? 'show' : '' }}">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">

                                    @can('show all pending items')
                                        <a class="dropdown-item {{ request()->routeIs('admin.item-reviews.pending.index') ? 'active' : '' }}"
                                            href="{{ route('admin.item-reviews.pending.index') }}">
                                            Pending
                                            <span
                                                class="badge badge-sm bg-yellow-lt text-uppercase ms-auto">{{ getItemStatusCount('pending') }}</span>
                                        </a>
                                    @endcan

                                    @can('show all approved items')
                                        <a class="dropdown-item {{ request()->routeIs('admin.item-reviews.approved.index') ? 'active' : '' }}"
                                            href="{{ route('admin.item-reviews.approved.index') }}">
                                            Approved
                                            <span
                                                class="badge badge-sm bg-yellow-lt text-uppercase ms-auto">{{ getItemStatusCount('approved') }}</span>
                                        </a>
                                    @endcan

                                    @can('show all resubmitted items')
                                        <a class="dropdown-item {{ request()->routeIs('admin.item-reviews.resubmitted.index') ? 'active' : '' }}"
                                            href="{{ route('admin.item-reviews.resubmitted.index') }}">
                                            Resubmitted
                                            <span
                                                class="badge badge-sm bg-yellow-lt text-uppercase ms-auto">{{ getItemStatusCount('resubmitted') }}</span>
                                        </a>
                                    @endcan

                                    @can('show all soft-rejected items')
                                        <a class="dropdown-item {{ request()->routeIs('admin.item-reviews.softrejected.index') ? 'active' : '' }}"
                                            href="{{ route('admin.item-reviews.softrejected.index') }}">
                                            Soft Rejected
                                            <span
                                                class="badge badge-sm bg-yellow-lt text-uppercase ms-auto">{{ getItemStatusCount('soft_rejected') }}</span>
                                        </a>
                                    @endcan

                                    @can('show all hard-rejected items')
                                        <a class="dropdown-item {{ request()->routeIs('admin.item-reviews.hardrejected.index') ? 'active' : '' }}"
                                            href="{{ route('admin.item-reviews.hardrejected.index') }}">
                                            Hard Rejected
                                            <span
                                                class="badge badge-sm bg-yellow-lt text-uppercase ms-auto">{{ getItemStatusCount('hard_rejected') }}</span>
                                        </a>
                                    @endcan

                                </div>
                            </div>
                        </div>
                    </li>
                @endif

                @php
                    $accessActive = request()->routeIs('admin.role-users.*') || request()->routeIs('admin.roles.*');
                @endphp
                @if (canAccess(['show roles', 'user roles']))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ $accessActive ? 'active show' : '' }}"
                            href="#access-management" data-bs-toggle="dropdown" data-bs-auto-close="false"
                            role="button" aria-expanded="{{ $accessActive ? 'true' : 'false' }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-shield-cog sidebar-icon"></i>
                            </span>
                            <span class="nav-link-title">
                                Access Management
                            </span>
                        </a>
                        <div class="dropdown-menu {{ $accessActive ? 'show' : '' }}">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">

                                    @can('show user roles')
                                        <a class="dropdown-item {{ request()->routeIs('admin.role-users.*') ? 'active' : '' }}"
                                            href="{{ route('admin.role-users.index') }}">
                                            Role Users
                                        </a>
                                    @endcan

                                    @can('show roles')
                                        <a class="dropdown-item {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}"
                                            href="{{ route('admin.roles.index') }}">
                                            Role & Permissions
                                        </a>
                                    @endcan

                                </div>
                            </div>
                        </div>
                    </li>
                @endif
                @php
                    $kycActive = request()->routeIs('admin.kyc.*') || request()->routeIs('admin.kyc-settings.*');
                @endphp

                @if (canAccess(['kyc settings', 'show kyc requests']))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ $kycActive ? 'active show' : '' }}" href="#"
                            data-bs-toggle="dropdown" data-bs-auto-close="false" role="button"
                            aria-expanded="{{ $kycActive ? 'true' : 'false' }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-user-scan sidebar-icon"></i>
                            </span>
                            <span class="nav-link-title">KYC</span>
                        </a>

                        <div class="dropdown-menu {{ $kycActive ? 'show' : '' }}">

                            @can('show kyc requests')
                                <a class="dropdown-item {{ request()->routeIs('admin.kyc.index') ? 'active' : '' }}"
                                    href="{{ route('admin.kyc.index') }}">
                                    KYC Requests <span
                                        class="badge badge-sm bg-yellow-lt text-uppercase ms-auto">{{ pendingKycCount() }}</span>
                                </a>
                            @endcan

                            @can('kyc settings')
                                <a class="dropdown-item {{ request()->routeIs('admin.kyc-settings.*') ? 'active' : '' }}"
                                    href="{{ route('admin.kyc-settings.index') }}">
                                    KYC Settings
                                </a>
                            @endcan
                        </div>
                    </li>
                @endif

                @if (canAccess(['show all orders']))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ setSidebarActive(['admin.orders.index', 'admin.kyc-settings.index']) == 'active' ? 'show' : '' }}"
                            href="#navbar-layout" data-bs-toggle="dropdown" data-bs-auto-close="false"
                            role="button" aria-expanded="true">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-truck-delivery sidebar-icon"></i>
                            </span>
                            <span class="nav-link-title">
                                Manage Orders
                            </span>
                        </a>
                        <div
                            class="dropdown-menu {{ setSidebarActive(['admin.orders.index', 'admin.kyc-settings.index']) == 'active' ? 'show' : '' }}">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item {{ setSidebarActive(['admin.orders.index']) }}"
                                        href="{{ route('admin.orders.index') }}">
                                        Orders
                                        {{-- <span class="badge badge-sm bg-yellow-lt text-uppercase ms-auto">0</span> --}}
                                    </a>

                                </div>
                            </div>
                        </div>
                    </li>
                @endif

                @if (canAccess(['show all withdraw requests']))
                    <li class="nav-item">
                        <a class="nav-link {{ setSidebarActive(['admin.withdraw-requests.index']) }}"
                            href="{{ route('admin.withdraw-requests.index') }}">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                <i class="ti ti-credit-card sidebar-icon"></i>
                            </span>
                            <span class="nav-link-title">
                                Withdraw Requests
                            </span>
                        </a>
                    </li>
                @endif

                @if (canAccess(['show withdraw methods']))
                    <li class="nav-item">
                        <a class="nav-link {{ setSidebarActive(['admin.withdrawal-methods.index']) }}"
                            href="{{ route('admin.withdrawal-methods.index') }}">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                <i class="ti ti-cash-banknote sidebar-icon"></i>
                            </span>
                            <span class="nav-link-title">
                                Withdraw Methods
                            </span>
                        </a>
                    </li>
                @endif

                @if (canAccess(['payment setting']))
                    <li class="nav-item">
                        <a class="nav-link {{ setSidebarActive(['admin.payment-settings.index']) }}"
                            href="{{ route('admin.payment-settings.index') }}">
                            <span
                                class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                <i class="ti ti-database-dollar sidebar-icon"></i>
                            </span>
                            <span class="nav-link-title">
                                Payment Setting
                            </span>
                        </a>
                    </li>
                @endif

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
