<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;
use App\Models\Authorization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admins');
    }

    public function index(Request $request)
    {
        $query = Admin::where('id', '!=', auth()->user()->id)->with('authorization');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('role_id')) {
            $query->where('role_id', $request->role_id);
        }

        $admins = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return response()->json(view('Admin.Admins.list', compact('admins'))->render());
        }

        $roles = Authorization::where('id','!=','1')->select('id','role')->get();
        return view('Admin.Admins.index', compact('admins', 'roles'));
    }


    public function create()
    {
        $roles = Authorization::where('id', '!=', '1')->select('id', 'role')->get();
        return view('Admin.Admins.create', compact('roles'));
    }


    public function store(AdminRequest $request)
    {
        $request->validated();
        $admin = Admin::create(array_merge(
            $request->only(['name', 'email', 'role_id']),
            [
                'password' => Hash::make($request->password),
            ]
        ));
        if (!$admin) {
            return redirect()->back()->with('error', 'There was a problem');
        } else {
            return redirect()->route('admin.admins.index')->with('success', 'Admin Created Successfully');
        }
    }


    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        $roles = Authorization::where('id', '!=', '1')->select('id', 'role')->get();
        return view('Admin.Admins.edit', compact('admin','roles'));
    }


    public function update(AdminRequest $request, $id)
    {
        $request->validated();
        $admin = Admin::findOrFail($id);
        $admin->update($request->only([
            'name',
            'email',
            'role_id'
        ]));

        return redirect()->route('admin.admins.index')->with('success', 'Admin Updated Successfully');
    }


    public function destroy(Request $request)
    {
        Admin::destroy($request->admin_id);
        return redirect()->back()->with('success', 'Admin Deleted Successfully');
    }
}