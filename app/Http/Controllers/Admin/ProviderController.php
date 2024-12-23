<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ngo;
use App\Models\Provider;
use App\Traits\DeletionRequest;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    use DeletionRequest;

    public function __construct()
    {
        $this->middleware('can:providers');
    }

    public function index(Request $request)
    {
        $query = Provider::with('ngo')->withCount('users');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        if ($request->filled('ngo_id')) {
            $query->where('ngo_id', $request->ngo_id);
        }

        $providers = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return response()->json(view('Admin.Providers.list', compact('providers'))->render());
        }

        $ngos = Ngo::select('id','name')->get();
        return view('Admin.Providers.index' , compact('providers','ngos'));
    }


    public function destroy(Request $request)
    {
        return $this->deletionRequest($request, 'provider_id', Provider::class);
    }
}