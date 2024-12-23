<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthorizationRequest;
use App\Models\Authorization;
use Illuminate\Http\Request;

class AuthorizationController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:authorizations');
    }

    public function index()
    {
        $authorizations = Authorization::withCount('admins')->paginate(5);
        return view('Admin.Authorizations.index', compact('authorizations'));
    }


    public function create()
    {
        return view('Admin.Authorizations.create');
    }


    public function store(AuthorizationRequest $request)
    {
        $request->validated();

        $authz = new Authorization();
        $authz->role = $request->role;
        $authz->permissions = json_encode($request->permissions);
        $authz->save();
        return redirect()->back()->with('success', 'Role Created Successfully');
    }


    public function edit($id)
    {
        $authorization = Authorization::findOrFail($id);
        return view('Admin.Authorizations.edit', compact('authorization'));
    }


    public function update(AuthorizationRequest $request, $id)
    {
        $request->validated();
        $authz = Authorization::findOrFail($id);
        $authz->role = $request->role;
        $authz->permissions = json_encode($request->permissions);
        $authz->save();
        return redirect()->route('admin.authorizations.index')->with('success', 'Role Updated Successfully');
    }

    public function destroy(Request $request)
    {
        $authz = Authorization::findOrFail($request->authorization_id);
        if ($authz->admins->count() > 0) {
            return redirect()->back()->with('error', 'Please Delete Related Admins First');
        }
        $authz->delete();
        return redirect()->back()->with('success', 'Role Deleted Successfully');
    }
}