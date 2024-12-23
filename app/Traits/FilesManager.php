<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FilesManager
{
    public function uploadFile($request, $object, $attribute, $folder, $disk)
    {
        if($request->hasFile($attribute)){
            $file = $request->file($attribute);
            $fileName = Str::slug($object->name).'.'.$file->getClientOriginalExtension();
            $file->storeAs($folder , $fileName , $disk);
            $object->update([$attribute => $fileName]);
        }
    }

    public function deleteFile($request, $object, $attribute, $folder, $disk)
    {
        if($request->hasFile($attribute)){
            Storage::disk($disk)->delete($folder.'/'.$object->$attribute);
        }
    }
}
