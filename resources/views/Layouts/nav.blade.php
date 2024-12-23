<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                            aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <!-- Admin Notifications -->
        @if (Auth::guard('admin')->check())
            @include('Layouts\notifications\admin-notifications')
        @endif
        <!-- Civilian Notifications -->
        @if (Auth::guard('web')->check())
            @include('Layouts\notifications\civilian-notifications')
        @endif

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                    @if (Auth::guard('web')->check())
                        {{ Auth::guard('web')->user()->name }}
                    @endif
                    @if (Auth::guard('donor')->check())
                        {{ Auth::guard('donor')->user()->name }}
                    @endif
                    @if (Auth::guard('admin')->check())
                        {{ Auth::guard('admin')->user()->name }}
                    @endif
                    @if (Auth::guard('ngo')->check())
                        {{ Auth::guard('ngo')->user()->name }}
                    @endif
                </span>
                <img class="img-profile rounded-circle" src="{{ asset('assets/dashboard/img/undraw_profile.svg') }}">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                @if (Auth::guard('web')->check())
                    <a class="dropdown-item" href="{{ route('civilian.showProfile') }}">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="{{ route('civilian.showChangePassword') }}">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Change Password
                    </a>
                @endif
                @if (Auth::guard('donor')->check())
                    <a class="dropdown-item" href="{{ route('donor.showProfile') }}">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="{{ route('donor.showChangePassword') }}">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Change Password
                    </a>
                @endif
                @if (Auth::guard('admin')->check())
                    <a class="dropdown-item" href="{{ route('admin.showProfile') }}">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="{{ route('admin.showChangePassword') }}">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Change Password
                    </a>
                @endif
                @if (Auth::guard('ngo')->check())
                    <a class="dropdown-item" href="{{ route('ngo.showProfile') }}">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="{{ route('ngo.showChangePassword') }}">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Change Password
                    </a>
                @endif
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0)"
                    onclick="document.getElementById('logoutForm').submit();">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
                <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                    @csrf
                </form>
            </div>
        </li>

    </ul>
    <style>
        .notification-scroll {
            max-height: 150px;
            overflow-y: auto;
            background-color: #f9f9f9;
            border-radius: 8px;
        }

        .notification-scroll::-webkit-scrollbar {
            width: 8px;
            background-color: transparent;
        }

        .notification-scroll::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #007bff, #00bfff);
            border-radius: 10px;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
            transition: background 0.3s ease;
        }

        .notification-scroll::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #0056b3, #007bff);
        }

        .notification-scroll::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
    </style>
</nav>
<!-- End of Topbar -->
