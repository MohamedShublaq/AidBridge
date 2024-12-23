<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeletionResponseRequest;
use App\Models\Admin;
use App\Models\Aid;
use App\Models\Authorization;
use App\Models\Contact;
use App\Models\DeletionRequest;
use App\Models\DeletionResponse;
use App\Models\Donor;
use App\Models\Ngo;
use App\Models\Provider;
use App\Models\User;
use App\Notifications\DeletionResponseNotification;
use Illuminate\Support\Facades\Auth;

class DeletionResponseController extends Controller
{
    public function response(DeletionResponseRequest $request)
    {
        $request->validated();
        $admin = Auth::guard('admin')->user();
        $notification = $admin->unreadNotifications()->findOrFail($request->notification_id);
        $deletionRequest = DeletionRequest::findOrFail($request->deletion_request_id);
        $response = $request->response;

        $deletionRequest->responses()->create([
            'admin_id' => $admin->id,
            'status' => $response
        ]);

        $notification->markAsRead();

        if ($deletionRequest->deletable_type == User::class) {
            $rolesIds = Authorization::whereJsonContains('permissions', 'civilians')->pluck('id');
        } elseif ($deletionRequest->deletable_type == Donor::class) {
            $rolesIds = Authorization::whereJsonContains('permissions', 'donors')->pluck('id');
        } elseif ($deletionRequest->deletable_type == Ngo::class) {
            $rolesIds = Authorization::whereJsonContains('permissions', 'ngos')->pluck('id');
        } elseif ($deletionRequest->deletable_type == Provider::class) {
            $rolesIds = Authorization::whereJsonContains('permissions', 'providers')->pluck('id');
        } elseif ($deletionRequest->deletable_type == Aid::class) {
            $rolesIds = Authorization::whereJsonContains('permissions', 'aids')->pluck('id');
        } elseif ($deletionRequest->deletable_type == Contact::class) {
            $rolesIds = Authorization::whereJsonContains('permissions', 'contacts')->pluck('id');
        }

        $totalAdmins = Admin::where('id', '!=', $deletionRequest->requester)->whereIn('role_id', $rolesIds)->count();
        $majority = ceil($totalAdmins / 2);

        $approvals = $deletionRequest->responses()->where('status', DeletionResponse::APPROVED)->count();
        $rejections = $deletionRequest->responses()->where('status', DeletionResponse::REJECTED)->count();

        if ($approvals >= $majority) {
            if ($deletionRequest->status !== DeletionRequest::APPROVED) {
                $deletionRequest->update(['status' => DeletionRequest::APPROVED]);
                $deletionRequest->deletable->delete();
                $deletionRequest->admin->notify(new DeletionResponseNotification($deletionRequest, DeletionResponse::APPROVED));
            }
        } elseif ($rejections >= $majority) {
            if ($deletionRequest->status !== DeletionRequest::REJECTED) {
                $deletionRequest->update(['status' => DeletionRequest::REJECTED]);
                $deletionRequest->admin->notify(new DeletionResponseNotification($deletionRequest, DeletionResponse::REJECTED));
            }
        }

        return redirect()->back()->with('success', 'Response Submitted Successfully');
    }

    public function showResponses($id)
    {
        $deletionRequest = DeletionRequest::findOrFail($id);

        $notification = auth('admin')->user()->unreadNotifications()
            ->where('type','DeletionResponseNotification')
            ->where('data->showResponsesLink', route('admin.showResponses', $id))
            ->first();

        if ($notification) {
            $notification->markAsRead();
        }

        $responses = $deletionRequest->responses()->latest()->paginate(10);
        return view('Admin.DeletionResponses.index', compact('responses'));
    }
}