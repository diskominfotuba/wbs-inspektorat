<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo mt-3 mb-3">
        <a href="#" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('img') }}/favicon/favicon.png" alt="">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">WBS</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        <!-- Dashboard -->

        @if (Auth::user()->role == 'admin')
            <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Analytics">Dashboard</div>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('admin.pengaduan.pending') || request()->routeIs('admin.pengaduan.diterima') || request()->routeIs('admin.pengaduan.diproses') || request()->routeIs('admin.pengaduan.close') ? 'active open' : '' }}"
                style="">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-spreadsheet"></i>
                    <div class="text-truncate" data-i18n="Dashboards">Master Dokumen</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->routeIs('admin.pengaduan.pending') ? 'active' : '' }}">
                        <a href="{{ route('admin.pengaduan.pending') }}" class="menu-link">
                            <div class="text-truncate" data-i18n="CRM">Pending</div>
                            {{-- <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto">0</div> --}}
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('admin.pengaduan.diterima') ? 'active' : '' }}">
                        <a href="{{ route('admin.pengaduan.diterima') }}" class="menu-link">
                            <div class="text-truncate" data-i18n="eCommerce">Diterima</div>
                            {{-- <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto">0</div> --}}
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('admin.pengaduan.diproses') ? 'active' : '' }}">
                        <a href="{{ route('admin.pengaduan.diproses') }}" class="menu-link">
                            <div class="text-truncate" data-i18n="Logistics">Diproses</div>
                            {{-- <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto">0</div> --}}
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('admin.pengaduan.close') ? 'active' : '' }}">
                        <a href="{{ route('admin.pengaduan.close') }}" class="menu-link">
                            <div class="text-truncate" data-i18n="Academy">Selesai</div>
                            {{-- <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto">0</div> --}}
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        @if (Auth::user()->role == 'user')
            <li class="menu-item {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <a href="{{ route('user.dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div data-i18n="Analytics">Dashboard</div>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('user.pengaduan.pending') || request()->routeIs('user.pengaduan.diterima') || request()->routeIs('user.pengaduan.diproses') || request()->routeIs('user.pengaduan.close') ? 'active open' : '' }}"
                style="">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-spreadsheet"></i>
                    <div class="text-truncate" data-i18n="Dashboards">Master Dokumen</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->routeIs('user.pengaduan.pending') ? 'active' : '' }}">
                        <a href="{{ route('user.pengaduan.pending') }}" class="menu-link">
                            <div class="text-truncate" data-i18n="CRM">Pending</div>
                            {{-- <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto">0</div> --}}
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('user.pengaduan.diterima') ? 'active' : '' }}">
                        <a href="{{ route('user.pengaduan.diterima') }}" class="menu-link">
                            <div class="text-truncate" data-i18n="eCommerce">Diterima</div>
                            {{-- <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto">0</div> --}}
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('user.pengaduan.diproses') ? 'active' : '' }}">
                        <a href="{{ route('user.pengaduan.diproses') }}" class="menu-link">
                            <div class="text-truncate" data-i18n="Logistics">Diproses</div>
                            {{-- <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto">0</div> --}}
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('user.pengaduan.close') ? 'active' : '' }}">
                        <a href="{{ route('user.pengaduan.close') }}" class="menu-link">
                            <div class="text-truncate" data-i18n="Academy">Selesai</div>
                            {{-- <div class="badge rounded-pill bg-label-primary text-uppercase fs-tiny ms-auto">0</div> --}}
                        </a>
                    </li>
                </ul>
            </li>
        @endif

    </ul>
</aside>
