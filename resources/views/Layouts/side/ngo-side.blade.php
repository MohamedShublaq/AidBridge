<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="{{ route('ngo.home') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Nav Item - Civilians Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Civilians"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-users"></i>
        <span>Civilians</span>
    </a>
    <div id="Civilians" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('ngo.civilians.index' , App\Models\NgosUsers::PENDING) }}">Pending</a>
            <a class="collapse-item" href="{{ route('ngo.civilians.index' , App\Models\NgosUsers::APPROVED) }}">Approved</a>
            <a class="collapse-item" href="{{ route('ngo.civilians.index' , App\Models\NgosUsers::REJECTED) }}">Rejected</a>
            <a class="collapse-item" href="{{ route('ngo.civilians.showTrashed') }}">Deleted</a>
            <a class="collapse-item" href="{{ route('ngo.civilians.showImportFile') }}">Import Civilians</a>
        </div>
    </div>
</li>

<!-- Nav Item - Donors Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Donors"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-users"></i>
        <span>Donors</span>
    </a>
    <div id="Donors" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('ngo.donors.index' , App\Models\NgosUsers::PENDING) }}">Pending</a>
            <a class="collapse-item" href="{{ route('ngo.donors.index' , App\Models\NgosUsers::APPROVED) }}">Approved</a>
            <a class="collapse-item" href="{{ route('ngo.donors.index' , App\Models\NgosUsers::REJECTED) }}">Rejected</a>
            <a class="collapse-item" href="{{ route('ngo.donors.showTrashed') }}">Deleted</a>
            <a class="collapse-item" href="{{ route('ngo.donors.create') }}">Add Donor</a>
        </div>
    </div>
</li>

<!-- Nav Item - Providers Menu -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('ngo.providers.index') }}">
        <i class="fas fa-users"></i>
        <span>Providers</span></a>
</li>

<!-- Nav Item - Locations Menu -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('ngo.locations.index') }}">
        <i class="fas fa-map-marker-alt"></i>
        <span>Locations</span></a>
</li>

<!-- Nav Item - Aids Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Aids"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-medkit"></i>
        <span>Aids</span>
    </a>
    <div id="Aids" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('ngo.aids.index') }}">Index</a>
            <a class="collapse-item" href="{{ route('ngo.aids.create') }}">Add Aid</a>
        </div>
    </div>
</li>

