

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="#" class="app-brand-link">
            <span class="footer-link me-4 fw-bold ms-2">{{ env('APP_NAME') }}</span>
        </a>


        <a href="javascript:void(0);"
            class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
        </a>
    </div>
    <div class="app-brand demo">
        <a href="#" class="app-brand-link">
            <span class="app-brand-logo demo">
                <a class="nav-link dropdown-toggle hide-arrow p-0" href="#" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="{{ asset('img/avatar.jpg') }}" alt class="w-px-40 h-auto rounded-circle"/>
                    </div>
                </a>
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">{{ Auth::user()->name }}</span>
        </a>


        <a href="javascript:void(0);"
            class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item active">
            <a href="{{ route('users.list') }}" class="menu-link">
                <div class="text-truncate" data-i18n="users">Users</div>
            </a>
        </li>
        <li class="menu-item active open">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div class="text-truncate" data-i18n="product">Products</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item active">
                    <a href="{{ route('products.create') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="create">Create</div>
                    </a>
                </li>
                <li class="menu-item active">
                    <a href="{{ route('products.list') }}" class="menu-link">
                        <div class="text-truncate" data-i18n="list">List</div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
