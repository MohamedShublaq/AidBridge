<?php

namespace App\Imports;

use App\Models\Country;
use App\Models\NgosUsers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CiviliansImport implements ToModel, WithHeadingRow
{
    private $providerId;

    public function __construct($providerId)
    {
        $this->providerId = $providerId;
    }

    public function model(array $row)
    {
        if (empty($row['name'])) {
            return null;
        }

        $country_id = Country::where('name', $row['country'])->first()->id ?? null;
        $marital_status = $this->getMaritalStatus($row['marital_status']);
        $gender = $this->getGender($row['gender']);

        $user = User::create([
            'name' => $row['name'],
            'id_number' => $row['id_number'],
            'password' => Hash::make($row['password']),
            'joining_way' => User::EXCEL,
            'added_by_provider' => $this->providerId,
            'country_id' => $country_id,
            'city' => $row['city'],
            'street' => $row['street'],
            'phone' => $row['phone'],
            'gender' => $gender,
            'age' => $row['age'],
            'marital_status' => $marital_status,
            'childrens' => $row['childrens'],
        ]);

        NgosUsers::create([
            'user_id' => $user->id,
            'ngo_id' => Auth::guard('ngo')->user()->id,
            'status' => NgosUsers::PENDING,
        ]);

        return $user;
    }


    private function getMaritalStatus($status)
    {
        switch ($status) {
            case 'Single':
                return User::SINGLE;
            case 'Married':
                return User::MARRIED;
            case 'Divorced':
                return User::DIVORCED;
            case 'Widowed':
                return User::WIDOWED;
            default:
                return null;
        }
    }

    private function getGender($type)
    {
        switch ($type) {
            case 'Male':
                return User::MALE;
            case 'Female':
                return User::FEMALE;
            default:
                return null;
        }
    }
}
