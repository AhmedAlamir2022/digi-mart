<div class="dashboard-sidebar">
    <button type="button" class="dashboard-sidebar__close d-lg-none d-flex"><i class="las la-times"></i></button>
    <div class="dashboard-sidebar__inner">
        <a href="{{ url('/') }}" class="logo mb-48">
            <img src="{{ asset(config('settings.logo')) }}" alt="" class="white-version">
        </a>
        <a href="{{ url('/') }}" class="logo logo_icon favicon mb-48">
            <img src="assets/images/thumbs/dashboard_sidebar_icon.png" alt="">
        </a>

        <!-- Sidebar List Start -->
        <ul class="sidebar-list">
            <li class="sidebar-list__item">
                <a href="{{ route('dashboard') }}" class="sidebar-list__link">
                    <span class="sidebar-list__icon">
                        <i class="ti ti-device-heart-monitor"></i>
                    </span>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-list__item">
                <a href="{{ route('profile') }}" class="sidebar-list__link">
                    <span class="sidebar-list__icon">
                        <i class="ti ti-user"></i>
                    </span>
                    <span class="text">Profile</span>
                </a>
            </li>
            {{-- @if (isAuthor())
                <li class="sidebar-list__item">
                    <a href="{{ route('user.items.index') }}" class="sidebar-list__link">
                        <span class="sidebar-list__icon">
                            <i class="ti ti-clipboard-list"></i>
                        </span>
                        <span class="text">My Items</span>
                    </a>
                </li>
            @endif --}}
            {{-- <li class="sidebar-list__item">
                <a href="{{ route('orders.index') }}" class="sidebar-list__link">
                    <span class="sidebar-list__icon">
                        <i class="ti ti-basket-check"></i>
                    </span>
                    <span class="text">Purchases</span>
                </a>
            </li> --}}

            {{-- <li class="sidebar-list__item">
                <a href="{{ route('transactions.index') }}" class="sidebar-list__link">
                    <span class="sidebar-list__icon">
                        <i class="ti ti-transaction-dollar"></i>
                    </span>
                    <span class="text">Transactions</span>
                </a>
            </li> --}}
            {{-- @if (isAuthor())
                <li class="sidebar-list__item">
                    <a href="{{ route('sales.index') }}" class="sidebar-list__link">
                        <span class="sidebar-list__icon">
                            <i class="ti ti-discount"></i>
                        </span>
                        <span class="text">Sales</span>
                    </a>
                </li>
                <li class="sidebar-list__item">
                    <a href="{{ route('withdraws.index') }}" class="sidebar-list__link">
                        <span class="sidebar-list__icon">
                            <i class="ti ti-receipt-dollar"></i>
                        </span>
                        <span class="text">Withdraws</span>
                    </a>
                </li>
            @endif --}}

            {{-- <li class="sidebar-list__item">
                <a href="{{ route('reviews.index') }}" class="sidebar-list__link">
                    <span class="sidebar-list__icon">
                        <i class="ti ti-stars"></i>
                    </span>
                    <span class="text">Reviews</span>
                </a>
            </li> --}}

            <li class="sidebar-list__item">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="javascript:;" class="sidebar-list__link"
                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        <span class="sidebar-list__icon">
                            <i class="ti ti-logout"></i>
                        </span>
                        <span class="text">{{ __('Logout') }}</span>
                    </a>
                </form>
            </li>
        </ul>
        <!-- Sidebar List End -->

    </div>
</div>
