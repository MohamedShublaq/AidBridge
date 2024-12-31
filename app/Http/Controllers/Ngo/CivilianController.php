<?php

namespace App\Http\Controllers\Ngo;

use App\Exports\CiviliansExport;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\NgosUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CiviliansImport;
use App\Models\Provider;

class CivilianController extends Controller
{
    public function index(Request $request, $status)
    {
        $query = NgosUsers::with(['user', 'user.country', 'user.provider'])
            ->where('ngo_id', Auth::guard('ngo')->user()->id)
            ->where('status', $status);

        $civilians = $this->filter($request, $query)->latest()->paginate(10);

        if ($request->ajax()) {
            return response()->json(view('Ngo.Civilians.list', compact('civilians'))->render());
        }

        $countries = Country::select('id', 'name')->get();
        $providers = Provider::where('ngo_id', Auth::guard('ngo')->user()->id)->select('id', 'name')->get();

        return view('Ngo.Civilians.index', compact('civilians', 'countries', 'providers', 'status'));
    }

    public function approve(Request $request)
    {
        $row = NgosUsers::where('ngo_id', Auth::guard('ngo')->user()->id)->where('user_id', $request->civ_id)->first();
        $row->update(['status' => NgosUsers::APPROVED]);
        return redirect()->back()->with('success', 'Civilian Approved Successfully');
    }

    public function reject(Request $request)
    {
        $row = NgosUsers::where('ngo_id', Auth::guard('ngo')->user()->id)->where('user_id', $request->civ_id)->first();
        $row->update([
            'status' => NgosUsers::REJECTED,
            'rejected_at' => now(),
        ]);
        return redirect()->back()->with('success', 'Civilian Rejected Successfully');
    }

    public function show($id)
    {
        $civ = User::findOrFail($id);
        $countries = Country::select('id', 'name')->get();
        return view('Ngo.Civilians.show', compact('civ', 'countries'));
    }

    public function delete(Request $request)
    {
        NgosUsers::findOrFail($request->civ_id)->delete();
        return redirect()->back()->with('success', 'Civilian Deleted Successfully');
    }

    public function showTrashed(Request $request)
    {
        $query = NgosUsers::onlyTrashed()->with(['user', 'user.country'])->where('ngo_id', Auth::guard('ngo')->user()->id);
        $civilians = $this->filter($request, $query)->latest()->paginate(10);

        if ($request->ajax()) {
            return response()->json(view('Ngo.Civilians.listTrashed', compact('civilians'))->render());
        }

        $countries = Country::select('id', 'name')->get();
        $providers = Provider::where('ngo_id', Auth::guard('ngo')->user()->id)->select('id', 'name')->get();
        return view('Ngo.Civilians.trashed', compact('civilians', 'countries', 'providers'));
    }

    public function restore(Request $request)
    {
        NgosUsers::onlyTrashed()->findOrFail($request->civ_id)->restore();
        $civ = NgosUsers::findOrFail($request->civ_id);
        $civ->update(['status' => NgosUsers::PENDING]);
        return redirect()->back()->with('success', 'Civilian Restored Successfully');
    }

    public function showImportFile()
    {
        $providers = Provider::where('ngo_id', Auth::guard('ngo')->user()->id)->select('id', 'name')->get();
        return view('Ngo.Civilians.importFile', compact('providers'));
    }

    public function importFile(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
            'provider_id' => 'required|exists:providers,id',
        ]);

        $file = $request->file('file');
        $providerId = $request->input('provider_id');

        Excel::import(new CiviliansImport($providerId), $file);
        return redirect()->back()->with('success', 'Civilians Imported Successfully');
    }

    public function downloadTemplate()
    {
        $filePath = public_path('templates/ImportCiviliansTemplate.xlsx');

        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
        return redirect()->back()->with('error', 'File Not Found');
    }

    public function exportFile(Request $request, $status)
    {
        $query = NgosUsers::with(['user', 'user.country', 'user.provider'])
            ->where('ngo_id', Auth::guard('ngo')->user()->id)
            ->where('status', $status);

        $civilians = $this->filter($request, $query)->get();

        $exportData = $this->formatExportData($civilians)->toArray();

        return Excel::download(
            new CiviliansExport($exportData),
            'civilians.xlsx'
        );
    }

    /**
     * Build the query for fetching civilians with filters.
     */
    private function filter(Request $request, $query)
    {
        $filters = [
            'name' => ['relation' => 'user', 'column' => 'name', 'operator' => 'like', 'value' => fn($value) => "%$value%"],
            'email' => ['relation' => 'user', 'column' => 'email', 'operator' => 'like', 'value' => fn($value) => "%$value%"],
            'id_number' => ['relation' => 'user', 'column' => 'id_number', 'operator' => 'like', 'value' => fn($value) => "%$value%"],
            'age' => ['relation' => 'user', 'column' => 'age', 'operator' => '=', 'value' => fn($value) => $value],
            'gender' => ['relation' => 'user', 'column' => 'gender', 'operator' => '=', 'value' => fn($value) => $value],
            'marital_status' => ['relation' => 'user', 'column' => 'marital_status', 'operator' => '=', 'value' => fn($value) => $value],
            'childrens' => ['relation' => 'user', 'column' => 'childrens', 'operator' => '=', 'value' => fn($value) => $value],
            'country_id' => ['relation' => 'user.country', 'column' => 'id', 'operator' => '=', 'value' => fn($value) => $value],
            'provider_id' => ['relation' => 'user.provider', 'column' => 'id', 'operator' => '=', 'value' => fn($value) => $value],
        ];

        foreach ($filters as $key => $filter) {
            if ($request->filled($key)) {
                $query->whereHas($filter['relation'], function ($q) use ($filter, $request, $key) {
                    $q->where(
                        $filter['column'],
                        $filter['operator'],
                        $filter['value']($request->$key)
                    );
                });
            }
        }

        return $query;
    }


    /**
     * Format data for export.
     */
    private function formatExportData($civilians)
    {
        return $civilians->map(function ($civ) {
            return [
                'Name' => $civ->user->name,
                'Email' => $civ->user->email,
                'ID Number' => $civ->user->id_number,
                'Phone' => $civ->user->phone,
                'Gender' => $civ->user->gender == User::MALE ? 'Male' : 'Female',
                'Age' => $civ->user->age,
                'Marital Status' => $this->getMaritalStatus($civ->user->marital_status),
                'Children' => $civ->user->childrens,
                'Country' => $civ->user->country->name,
                'City' => $civ->user->city,
                'Street' => $civ->user->street,
            ];
        });
    }

    private function getMaritalStatus($status)
    {
        if ($status === User::SINGLE) {
            return 'Single';
        } elseif ($status === User::MARRIED) {
            return 'Married';
        } elseif ($status === User::DIVORCED) {
            return 'Divorced';
        } else {
            return 'Widowed';
        }
    }
}