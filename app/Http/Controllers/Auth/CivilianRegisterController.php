<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CivilianRegisterRequest;
use App\Models\Country;
use App\Models\User;
use App\Traits\FilesManager;
use Illuminate\Support\Facades\Hash;

class CivilianRegisterController extends Controller
{
    use FilesManager;

    public function showRegister()
    {
        $countries = Country::select('id', 'name')->get();
        return view('Auth.register', compact('countries'));
    }

    public function register(CivilianRegisterRequest $request)
    {
        $request->validated();

        $civilian = User::create(array_merge(
            $request->only([
                'name',
                'email',
                'id_number',
                'gender',
                'age',
                'marital_status',
                'childrens',
                'country_id',
                'city',
                'street',
                'phone',
            ]),
            [
                'password' => Hash::make($request->password),
            ]
        ));

        $this->uploadFile($request, $civilian, 'id_photo', 'Civilians', 'uploads');

        return redirect()->route('showLogin', 'civilian');
    }
}