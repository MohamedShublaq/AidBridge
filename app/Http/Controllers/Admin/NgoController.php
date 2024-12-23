<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NgoRequest;
use App\Models\Aid;
use App\Models\Country;
use App\Models\Ngo;
use App\Models\NgosDonors;
use App\Models\NgosUsers;
use App\Models\Provider;
use App\Traits\DeletionRequest;
use App\Traits\FilesManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NgoController extends Controller
{
    use FilesManager , DeletionRequest;

    public function __construct()
    {
        $this->middleware('can:ngos')->except('showCivilians','showDonors','showAids','deleteAid');
        $this->middleware('can:civilians')->only('showCivilians');
        $this->middleware('can:donors')->only('showDonors');
        $this->middleware('can:aids')->only('showAids','deleteAid');
    }

    public function index(Request $request)
    {
        $query = Ngo::withCount('aids');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        $ngos = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return response()->json(view('Admin.Ngos.listIndex', compact('ngos'))->render());
        }

        return view('Admin.Ngos.index', compact('ngos'));
    }

    public function create()
    {
        return view('Admin.Ngos.create');
    }

    public function store(NgoRequest $request)
    {
        $request->validated();

        $ngo = Ngo::create(array_merge(
            $request->only(['name', 'description', 'email', 'address', 'phone']),
            [
                'password' => Hash::make($request->password),
            ]
        ));

        $this->uploadFile($request, $ngo, 'logo', 'Ngos', 'uploads');

        return redirect()->route('admin.ngos.index')->with('success', 'Ngo Created Successfully');
    }

    public function show($id)
    {
        $ngo = Ngo::findOrFail($id);
        return view('Admin.Ngos.show', compact('ngo'));
    }

    public function destroy(Request $request)
    {
        return $this->deletionRequest($request, 'ngo_id', Ngo::class);
    }

    public function showCivilians(Request $request, $id)
    {
        $ngo = Ngo::findOrFail($id);

        $query = NgosUsers::where('ngo_id', $ngo->id)
            ->where('status', NgosUsers::APPROVED)
            ->with(['user', 'user.country']);

        // Apply filters
        if ($request->filled('name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            });
        }

        if ($request->filled('email')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->email . '%');
            });
        }

        if ($request->filled('id_number')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('id_number', 'like', '%' . $request->id_number . '%');
            });
        }

        if ($request->filled('marital_status')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('marital_status', $request->marital_status);
            });
        }

        if ($request->filled('childrens')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('childrens', $request->childrens);
            });
        }

        if ($request->filled('country_id')) {
            $query->whereHas('user.country', function ($q) use ($request) {
                $q->where('id', $request->country_id);
            });
        }

        if ($request->filled('age')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('age', $request->age);
            });
        }

        if ($request->filled('gender')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('gender', $request->gender);
            });
        }

        if ($request->filled('joining_way')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('joining_way', $request->joining_way);
            });
        }

        $civilians = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return response()->json(view('Admin.Ngos.listCivilians', compact('civilians'))->render());
        }

        $countries = Country::select('id','name')->get();
        return view('Admin.Ngos.civilians', compact('ngo', 'civilians', 'countries'));
    }

    public function showDonors(Request $request, $id)
    {
        $ngo = Ngo::findOrFail($id);

        $query = NgosDonors::where('ngo_id', $ngo->id)
            ->where('status', NgosDonors::APPROVED)
            ->with(['donor', 'donor.country']);

        // Apply filters
        if ($request->filled('name')) {
            $query->whereHas('donor', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            });
        }

        if ($request->filled('email')) {
            $query->whereHas('donor', function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->email . '%');
            });
        }

        if ($request->filled('country_id')) {
            $query->whereHas('donor.country', function ($q) use ($request) {
                $q->where('id', $request->country_id);
            });
        }

        $donors = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return response()->json(view('Admin.Ngos.listDonors', compact('donors'))->render());
        }

        $countries = Country::select('id','name')->get();
        return view('Admin.Ngos.donors', compact('ngo', 'donors', 'countries'));
    }

    public function showProviders(Request $request,$id)
    {
        $ngo = Ngo::findOrFail($id);
        $query = Provider::withCount('users')->where('ngo_id', $ngo->id);

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        $providers = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return response()->json(view('Admin.Ngos.listProviders', compact('providers'))->render());
        }
        return view('Admin.Ngos.providers', compact('ngo', 'providers'));
    }

    public function showAids(Request $request,$id)
    {
        $ngo = Ngo::findOrFail($id);
        $query = Aid::where('ngo_id', $ngo->id);

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('description')) {
            $query->where('description', 'like', '%' . $request->description . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $aids = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return response()->json(view('Admin.Ngos.listAids', compact('aids'))->render());
        }
        return view('Admin.Ngos.aids', compact('ngo', 'aids'));
    }

    public function deleteAid(Request $request)
    {
        return $this->deletionRequest($request, 'aid_id', Aid::class);
    }
}