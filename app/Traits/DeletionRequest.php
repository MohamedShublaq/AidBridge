<?php

namespace App\Traits;

use App\Models\Admin;
use App\Models\Authorization;
use App\Models\DeletionRequest as ModelsDeletionRequest;
use App\Notifications\DeletionRequestNotification;
use Illuminate\Support\Facades\Notification;

trait DeletionRequest
{
    public function deletionRequest($request, $objectId, $model)
    {
        $object = $model::findOrFail($request->$objectId);

        $requester = auth('admin')->user()->id;

        if($objectId == 'civ_id'){
            $rolesIds = Authorization::whereJsonContains('permissions' , 'civilians')->pluck('id');
        }
        elseif($objectId == 'donor_id'){
            $rolesIds = Authorization::whereJsonContains('permissions' , 'donors')->pluck('id');
        }
        elseif($objectId == 'ngo_id'){
            $rolesIds = Authorization::whereJsonContains('permissions' , 'ngos')->pluck('id');
        }
        elseif($objectId == 'provider_id'){
            $rolesIds = Authorization::whereJsonContains('permissions' , 'providers')->pluck('id');
        }
        elseif($objectId == 'aid_id'){
            $rolesIds = Authorization::whereJsonContains('permissions' , 'aids')->pluck('id');
        }
        elseif($objectId == 'contact_id'){
            $rolesIds = Authorization::whereJsonContains('permissions' , 'contacts')->pluck('id');
        }

        $admins = Admin::where('id','!=',$requester)->whereIn('role_id',$rolesIds)->get();

        if($admins->count() == 0){
            $object->delete();
            return redirect()->back()->with('success', 'The Deletion Process Was Completed Successfully');
        }

        $deletionRequest = ModelsDeletionRequest::create([
            'deletable_type' => $model,
            'deletable_id' => $object->id,
            'requester' => $requester,
        ]);

        Notification::send($admins , new DeletionRequestNotification($deletionRequest));
        return redirect()->back()->with('warning', 'Wait for Admin Approvals');
    }
}