<?php

namespace App\Http\Controllers\Ngo;

use App\Http\Controllers\Controller;
use App\Models\Aid;
use App\Models\AidDistribution;
use App\Models\Request as ModelsRequest;
use App\Models\User;
use App\Notifications\ApproveAidRequestNotification;
use App\Notifications\RejectAidRequestNotification;
use App\Notifications\UnvailableAidRequestNotification;
use App\Exports\CiviliansExport;
use App\Models\Country;
use App\Models\Provider;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public function show(Request $request, $aid_id, $status)
    {
        $aid = Aid::findOrFail($aid_id);
        $query = ModelsRequest::with(['user', 'user.country', 'user.provider', 'aidDistributions'])
            ->where('aid_id', $aid_id)
            ->where('status', $status);

        $requests = $this->filter($request, $query)->latest()->paginate(10);

        if ($request->ajax()) {
            return response()->json(view('Ngo.Requests.list', compact('requests','status'))->render());
        }

        $countries = Country::select('id', 'name')->get();
        $providers = Provider::where('ngo_id', Auth::guard('ngo')->user()->id)->select('id', 'name')->get();
        return view('Ngo.Requests.index', compact('requests', 'aid', 'status', 'countries', 'providers'));
    }


    public function exportFile(Request $request, $aid_id, $status)
    {
        $query = ModelsRequest::with(['user', 'user.country', 'user.provider', 'aidDistributions'])
            ->where('aid_id', $aid_id)
            ->where('status', $status);

        $requests = $this->filter($request, $query)->get();

        $exportData = $this->formatExportData($requests)->toArray();

        return Excel::download(
            new CiviliansExport($exportData),
            'civilians.xlsx'
        );
    }


    /**
     * Build the query for fetching requests with filters.
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
            'status' => ['relation' => 'aidDistributions', 'column' => 'status', 'operator' => '=', 'value' => fn($value) => $value],
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
    private function formatExportData($requests)
    {
        return $requests->map(function ($req) {
            return [
                'Name' => $req->user->name,
                'Email' => $req->user->email,
                'ID Number' => $req->user->id_number,
                'Phone' => $req->user->phone,
                'Gender' => $req->user->gender == User::MALE ? 'Male' : 'Female',
                'Age' => $req->user->age,
                'Marital Status' => $this->getMaritalStatus($req->user->marital_status),
                'Children' => $req->user->childrens,
                'Country' => $req->user->country->name,
                'City' => $req->user->city,
                'Street' => $req->user->street,
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


    public function approve(Request $request)
    {
        $request->validate([
            'request_id' => ['required','exists:requests,id'],
            'location_id' => ['required','exists:locations,id'],
            'distribution_date' => ['required','date'],
        ]);

        $req = ModelsRequest::findOrFail($request->request_id);
        $aidQuantity = $req->aid->quantity;
        $req->update([
            'status' => ModelsRequest::APPROVED,
        ]);

        $aidDistribution = AidDistribution::create($request->only(
            ['request_id', 'location_id', 'distribution_date']
        ));

        //Send Approve Notification
        $civId = $req->user->id;
        $civilian = User::findOrFail($civId);
        $civilian->notify(new ApproveAidRequestNotification($aidDistribution));

        //Change Pending Requests to Unavaliable
        $approvedRequestsCount = ModelsRequest::where('aid_id', $req->aid_id)->where('status', ModelsRequest::APPROVED)->count();
        if ($aidQuantity == $approvedRequestsCount) {
            $unavailables = ModelsRequest::where('aid_id', $req->aid_id)->where('status', ModelsRequest::PENDING)->get();
            if ($unavailables) {
                foreach ($unavailables as $unavailable) {
                    $unavailable->update([
                        'status' => ModelsRequest::UNAVAILABLE,
                    ]);
                    //Send Unavailable Notification
                    $civId = $unavailable->user->id;
                    $civilian = User::findOrFail($civId);
                    $civilian->notify(new UnvailableAidRequestNotification($unavailable));
                }
            }
            return redirect()->back()->with('success', 'Request Approved Successfully, Quantity Was Exhausted!');
        }
        return redirect()->back()->with('success', 'Request Approved Successfully. Remaining quantity: ' . ($aidQuantity - $approvedRequestsCount));
    }


    public function multiApprove(Request $request)
    {
        $request->validate([
            'request_ids' => ['required','string'],
            'aid_id' => ['required','exists:aids,id'],
            'location_id' => ['required','exists:locations,id'],
            'distribution_date' => ['required','date'],
        ]);

        $requestIds = explode(',', $request->request_ids);

        $aid = Aid::findOrFail($request->aid_id);

        $aidQuantity = $aid->quantity;

        $approvedRequestsCountBefore = ModelsRequest::where('aid_id', $aid->id)
            ->where('status', ModelsRequest::APPROVED)
            ->count();

        if (count($requestIds) + $approvedRequestsCountBefore > $aidQuantity) {
            return redirect()->back()->with('error', 'The number of selected requests exceeds the available quantity for this aid. Remaining quantity: ' . ($aidQuantity - $approvedRequestsCountBefore));
        }

        foreach ($requestIds as $requestId) {
            $req = ModelsRequest::findOrFail($requestId);

            $req->update(
                ['status' => ModelsRequest::APPROVED],
            );

            $aidDistribution = AidDistribution::create([
                'request_id' => $req->id,
                'location_id' => $request->location_id,
                'distribution_date' => $request->distribution_date,
            ]);

            //Send Approve Notification
            $civId = $req->user->id;
            $civilian = User::findOrFail($civId);
            $civilian->notify(new ApproveAidRequestNotification($aidDistribution));
        }

        $approvedRequestsCountAfter = ModelsRequest::where('aid_id', $aid->id)
            ->where('status', ModelsRequest::APPROVED)
            ->count();

        if ($aidQuantity == $approvedRequestsCountAfter) {
            $unavailables = ModelsRequest::where('aid_id', $aid->id)->where('status', ModelsRequest::PENDING)->get();
            if ($unavailables) {
                foreach ($unavailables as $unavailable) {
                    $unavailable->update([
                        'status' => ModelsRequest::UNAVAILABLE,
                    ]);
                    //Send Unavailable Notification
                    $civId = $unavailable->user->id;
                    $civilian = User::findOrFail($civId);
                    $civilian->notify(new UnvailableAidRequestNotification($unavailable));
                }
            }
            return redirect()->back()->with('success', 'Selected Requests Approved Successfully, Quantity Was Exhausted!');
        }
        return redirect()->back()->with('success', 'Selected Requests Approved Successfully. Remaining Quantity: ' . ($aidQuantity - $approvedRequestsCountAfter));
    }


    public function reject(Request $request)
    {
        $request->validate([
            'req_id' => ['required','exists:requests,id'],
        ]);

        $req = ModelsRequest::findOrFail($request->req_id);
        $req->update([
            'status' => ModelsRequest::REJECTED,
        ]);

        //Send Reject Notification
        $civId = $req->user->id;
        $civilian = User::findOrFail($civId);
        $civilian->notify(new RejectAidRequestNotification($req));

        return redirect()->back()->with('success', 'Request Was Rejected Successfully');
    }
}