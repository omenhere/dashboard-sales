<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('home') }}" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">Telkom</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Home -->
        <li class="menu-item {{ request()->routeIs('home') ? 'active' : '' }}">
            <a href="{{ route('home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Home">Home</div>
            </a>
        </li>

        <li class="menu-item {{ request()->routeIs('profit.index') ? 'active' : '' }}">
            <a href="{{ route('profit.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-dollar-circle"></i>
                <div data-i18n="Profit">Profit</div>
            </a>
        </li> 

        <!-- Sales -->
        <li class="menu-item {{ request()->routeIs('sales.index') ? 'active' : '' }}">
            <a href="{{ route('sales.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-line-chart"></i>
                <div data-i18n="Sales">Rekap Penjualan</div>
            </a>
        </li>

        <!-- Pricing -->
        <li class="menu-item {{ request()->routeIs('product-prices.index') ? 'active' : '' }}">
            <a href="{{ route('product-prices.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Pricing">Pricing</div>
            </a>
        </li>

    </ul>
</aside>
