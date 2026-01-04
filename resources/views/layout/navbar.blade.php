<nav class="navbar px-3 py-3 d-flex justify-content-between align-items-center" style="background-color:#1e293b">

    {{-- TOGGLE SIDEBAR --}}
    <button class="btn btn-outline-light" id="toggleSidebar">
        <i class="fa fa-bars"></i>
    </button>

    {{-- USER DROPDOWN --}}
    <div class="dropdown">
        <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" data-bs-toggle="dropdown">

            {{-- NAMA & ROLE --}}
            <div class="text-end me-2">
                <div class="fw-semibold text-white">
                    {{ auth()->guard('admin')->user()->nama_admin }}
                </div>
                <small class="text-light opacity-75">
                    Admin
                </small>
            </div>

            {{-- FOTO --}}
            <img src="{{ asset('assets/img/profile.jpg') }}" class="rounded-circle border border-2 border-light"
                width="40" height="40">
        </a>

        {{-- DROPDOWN MENU --}}
        <ul class="dropdown-menu dropdown-menu-end shadow">
            <li>
                <a class="dropdown-item" href="#">
                    <i class="fa fa-user me-2"></i> Profile
                </a>
            </li>

            <li>
                <hr class="dropdown-divider">
            </li>

            <li>
                <a class="dropdown-item text-danger" href="{{ route('login.logout') }}">
                    <i class="fa fa-right-from-bracket me-2"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</nav>
