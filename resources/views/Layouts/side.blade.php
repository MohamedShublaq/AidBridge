<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/logo.jpg') }}" class="professional-logo" alt="Logo">
        </div>
        <div class="sidebar-brand-text mx-3">Aid Bridge</div>
        <style>
            .sidebar-brand-icon {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .professional-logo {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.06);
                border: 2px solid #007BFF;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .professional-logo:hover {
                transform: scale(1.1);
                box-shadow: 0 8px 10px rgba(0, 0, 0, 0.15), 0 4px 6px rgba(0, 0, 0, 0.1);
            }
        </style>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @if (Auth::guard('web')->check())
        @include('Layouts.side.civilian-side')
    @endif

    @if (Auth::guard('donor')->check())
        @include('Layouts.side.donor-side')
    @endif

    @if (Auth::guard('admin')->check())
        @include('Layouts.side.admin-side')
    @endif

    @if (Auth::guard('ngo')->check())
        @include('Layouts.side.ngo-side')
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
