<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="{{ route('civilian.home') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Nav Item - Ngos Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Donors"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fa fa-globe "></i>
        <span>NGOs</span>
    </a>
    <div id="Donors" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('civilian.ngos.index' , App\Models\NgosUsers::PENDING) }}">Pending</a>
            <a class="collapse-item" href="{{ route('civilian.ngos.index' , App\Models\NgosUsers::APPROVED) }}">Approve</a>
            <a class="collapse-item" href="{{ route('civilian.ngos.index' , App\Models\NgosUsers::REJECTED) }}">Reject</a>
        </div>
    </div>
</li>


