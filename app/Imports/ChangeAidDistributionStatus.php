<?php

namespace App\Imports;

use App\Models\AidDistribution;
use App\Models\Request;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ChangeAidDistributionStatus implements ToModel, WithHeadingRow
{
    private $aidId;

    public function __construct($aidId)
    {
        $this->aidId = $aidId;
    }

    public function model(array $row)
    {
        $civilian = User::where('id_number', $row['id_number'])->first();
        if (!$civilian) return;
        $request = Request::where('aid_id', $this->aidId)->where('user_id', $civilian->id)->first();
        if (!$request) return;
        $aidDistribution = AidDistribution::where('request_id', $request->id)->first();
        if ($aidDistribution) {
            $aidDistribution->update(['status' => AidDistribution::RECEIVED]);
        }
    }
}