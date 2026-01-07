<div id="sidebar" class="p-3 sidebar">
    <div class="d-flex align-items-center mb-4 sidebar-title">
        <i class="fa fa-car-side fa-2x me-2"></i>
        <span class="fw-bold fs-3">DriveRent</span>
    </div>

    <ul class="nav flex-column sidebar-menu">
        <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                <span class="icon">
                    <i class="fa-solid fa-grip"></i>
                </span>
                <span class="text">Panel Kontrol</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('mobil.index') }}" class="nav-link {{ request()->routeIs('mobil.*') ? 'active' : '' }}">
                <span class="icon">
                    <i class="fa fa-car"></i>
                </span>
                <span class="text">Mobil</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('transaksi.index') }}"
                class="nav-link {{ request()->routeIs('transaksi.*') ? 'active' : '' }}">
                <span class="icon">
                    <i class="fa fa-receipt"></i>
                </span>
                <span class="text">Transaksi</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <span class="icon">
                    <i class="fa fa-file-lines"></i>
                </span>
                <span class="text">Laporan Transaksi</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('pelanggan.index') }}"
                class="nav-link {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">
                <span class="icon">
                    <i class="fa fa-users"></i>
                </span>
                <span class="text">Pelanggan</span>
            </a>
        </li>
    </ul>
</div>
