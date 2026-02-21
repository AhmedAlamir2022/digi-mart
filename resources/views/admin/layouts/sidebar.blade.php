<div class="main-sidebar sidebar-style-3">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">CodiePie</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">CP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown {{ setSidebarActive(['admin.dashboard']) }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                        class="fa fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>
            @if (canAccess(['access management']))
                @php
                    $accessActive = setSidebarActive(['admin.role-users.*', 'admin.roles.*']);
                @endphp

                <li class="dropdown {{ $accessActive }}">
                    <a href="#" class="nav-link has-dropdown">
                        <i class="fas fa-user-shield"></i>
                        <span>Access Management</span>
                    </a>

                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.role-users.index']) }}">
                            <a class="nav-link" href="{{ route('admin.role-users.index') }}">
                                Role Users
                            </a>
                        </li>

                        <li class="{{ setSidebarActive(['admin.roles.index']) }}">
                            <a class="nav-link" href="{{ route('admin.roles.index') }}">
                                Role & Permissions
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            <li class="menu-header">Settings</li>
            @if (canAccess(['manage setting']))
                <li class="dropdown {{ setSidebarActive(['admin.settings.index']) }}">
                    <a href="{{ route('admin.settings.index') }}" class="nav-link">
                        <i class="fa fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
            @endif
        </ul>
        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <a href="javascript:;" onclick="event.preventDefault(); this.closest('form').submit();"
                    class="btn btn-primary btn-lg btn-block btn-icon-split"><i class="fas fa-sign-out-alt"></i>
                    Logout</a>
            </form>

        </div>
    </aside>
</div>
