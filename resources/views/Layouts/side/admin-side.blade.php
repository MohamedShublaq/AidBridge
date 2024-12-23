<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="{{ route('admin.home') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Nav Item - Authorizations Collapse Menu -->
@can('authorizations')
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAuthorizations"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-user-shield"></i>
        <span>Authorizations</span>
    </a>
    <div id="collapseAuthorizations" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('admin.authorizations.index') }}">Index</a>
            <a class="collapse-item" href="{{ route('admin.authorizations.create') }}">Add role</a>
    </div>
</li>
@endcan

<!-- Nav Item - Admins Collapse Menu -->
@can('admins')
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdmins"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-user-tie"></i>
        <span>Admins</span>
    </a>
    <div id="collapseAdmins" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('admin.admins.index') }}">Index</a>
            <a class="collapse-item" href="{{ route('admin.admins.create') }}">Add Admin</a>
    </div>
</li>
@endcan

<!-- Nav Item - Civilians -->
@can('civilians')
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.civilians.index') }}">
        <i class="fas fa-users-cog"></i>
        <span>Civilians</span></a>
</li>
@endcan

<!-- Nav Item - Donors Collapse Menu -->
@can('donors')
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDonors"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-hand-holding-heart"></i>
        <span>Donors</span>
    </a>
    <div id="collapseDonors" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('admin.donors.index') }}">Index</a>
            <a class="collapse-item" href="{{ route('admin.donors.create') }}">Add Donor</a>
    </div>
</li>
@endcan

<!-- Nav Item - Ngos Collapse Menu -->
@can('ngos')
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNgos"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-handshake"></i>
        <span>NGOs</span>
    </a>
    <div id="collapseNgos" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('admin.ngos.index') }}">Index</a>
            <a class="collapse-item" href="{{ route('admin.ngos.create') }}">Add NGO</a>
    </div>
</li>
@endcan

<!-- Nav Item - Providers -->
@can('providers')
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.providers.index') }}">
        <i class="fas fa-users-cog"></i>
        <span>Providers</span></a>
</li>
@endcan

<!-- Nav Item - Contacts -->
@can('contacts')
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.contacts.index') }}">
        <i class="fas fa-address-book"></i>
        <span>Contacts</span></a>
</li>
@endcan

<!-- Nav Item - Settings -->
@can('settings')
<li class="nav-item">
    <a class="nav-link" href="{{ route('admin.showSetting') }}">
        <i class="fas fa-cog"></i>
        <span>Settings</span></a>
</li>
@endcan
