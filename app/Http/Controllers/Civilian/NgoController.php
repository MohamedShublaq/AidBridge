<?php

namespace App\Http\Controllers\Civilian;

use App\Http\Controllers\Controller;
use App\Models\NgosUsers;
use Illuminate\Http\Request;

class NgoController extends Controller
{
    public function index(Request $request,$status)
    {
        $civId = auth()->user()->id;
        $query = NgosUsers::with('ngo')
            ->where('user_id', $civId)
            ->where('status', $status);

        // Apply filters
        if ($request->filled('name')) {
            $query->whereHas('ngo', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            });
        }

        if ($request->filled('description')) {
            $query->whereHas('ngo', function ($q) use ($request) {
                $q->where('description', 'like', '%' . $request->description . '%');
            });
        }

        $ngos = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return response()->json(view('Civilian.Ngos.list', compact('ngos'))->render());
        }
        return view('Civilian.Ngos.index', compact('ngos','status'));
    }
}