<aside class="left-sidebar">
    <!-- Sidebar scroll-->

    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('dashboard') }}" class="text-nowrap logo-img">
                <img src="{{ asset('assets/images/logos/logo.svg') }}" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                        <iconify-icon icon="solar:atom-line-duotone"></iconify-icon>
                        <span class="hide-menu">
                            {{ 'Dashboard' }}
                        </span>
                    </a>
                </li>
                <!-- ---------------------------------- -->
                <!-- Dashboard -->
                <!-- ---------------------------------- -->

                <li>
                    <span class="sidebar-divider lg"></span>
                </li>
                <li class="sidebar-item" id="">
                    <a class="sidebar-link  primary-hover-bg" href="{{ route('categ') }}" aria-expanded="false">
                        <i class="ti ti-article"></i>
                        <span class="hide-menu">Categories</span>
                    </a>

                </li>
                <li class="sidebar-item" id="">
                    <a class="sidebar-link  primary-hover-bg" href="{{ route('products.index') }}"
                        aria-expanded="false">
                        <i class="ti ti-armchair-2"></i>
                        <span class="hide-menu">Products</span>
                    </a>
                </li>

                <li class="sidebar-item" id="">
                    <a class="sidebar-link  primary-hover-bg" href="{{ route('orders') }}" aria-expanded="false">
                        <i class="ti ti-truck-delivery"></i>
                        <span class="hide-menu">Orders</span>
                    </a>

                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>