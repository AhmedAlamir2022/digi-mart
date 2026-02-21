<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li>
                <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
            </li>
            <li>
                <a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a>
            </li>
        </ul>
        <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250" />
            <button class="btn" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset( admin()->avatar) }}" class="rounded-circle mr-1" />

                <div class="d-sm-none d-lg-inline-block">
                    Hi, {{ admin()->name }}
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Logged in 5 min ago</div>
                <a href="{{ route('admin.profile.index') }}" class="dropdown-item has-icon"><i class="far fa-user"></i>
                    Profile</a>
                <a href="{{ route('admin.settings.index') }}" class="dropdown-item has-icon"><i class="fas fa-cog"></i>
                    Settings</a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <a href="javascript:;" onclick="event.preventDefault(); this.closest('form').submit();"
                        class="dropdown-item has-icon text-danger"><i
                            class="fas fa-sign-out-alt"></i>{{ __('Logout') }}</a>
                </form>
            </div>
        </li>
    </ul>
</nav>
