<?php

namespace App\Http\Controllers\Ngo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ngo\ProviderRequest;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{

    public function index(Request $request)
    {
        $query = Provider::withCount('users')->where('ngo_id', auth('ngo')->user()->id);

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        $providers = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return response()->json(view('Ngo.Providers.list', compact('providers'))->render());
        }

        return view('Ngo.Providers.index' , compact('providers'));
    }


    public function store(ProviderRequest $request)
    {
        $request->validated();
        $provider = Provider::create($request->only(['name','phone','ngo_id']));
        if(!$provider){
            return redirect()->back()->with('error' , 'There was a problem');
        }else{
            return redirect()->back()->with('success' , 'Provider Created Successfully');
        }
    }


    public function update(ProviderRequest $request, $id)
    {
        $request->validated();
        $provider = Provider::findOrFail($id);
        $provider->update($request->only(['name','phone','ngo_id']));
        return redirect()->back()->with('success' , 'Provider Updated Successfully');
    }


    public function destroy(Request $request)
    {
        Provider::destroy($request->provider_id);
        return redirect()->back()->with('success' , 'Provider Deleted Successfully');
    }
}