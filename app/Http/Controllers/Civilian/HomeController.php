<?php

namespace App\Http\Controllers\Civilian;

use App\Http\Controllers\Controller;
use App\Models\Ngo;
use App\Models\NgosUsers;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $ngos = Ngo::whereHas('users', function ($query) {
            $query->where('users.id', auth()->user()->id)
                ->whereNull('ngos_users.deleted_at');
        })
        ->orWhereDoesntHave('users', function ($query) {
            $query->where('users.id', auth()->user()->id);
        })
        ->select('id', 'name', 'logo')
        ->latest()
        ->get();

        return view('Civilian.dashboard', compact('ngos'));
    }

    public function apply(Request $request)
    {
        $civ = User::findOrFail(auth()->user()->id);
        $rejectedBefore = NgosUsers::where('user_id', $civ->id)->where('ngo_id', $request->ngo_id)->where('rejected_at', '!=', null)->first();
        if ($rejectedBefore) {
            $rejectedBefore->update([
                'status' => NgosUsers::PENDING,
                'rejected_at' => null,
            ]);
        } else {
            $civ->ngos()->attach($request->ngo_id, ['status' => NgosUsers::PENDING]);
        }
        return redirect()->back()->with('success', 'Wait For Approval');
    }
}