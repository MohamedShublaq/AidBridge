<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class CiviliansExport implements FromArray
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        $headers = [
            'Name',
            'Email',
            'ID Number',
            'Phone',
            'Gender',
            'Age',
            'Marital Status',
            'Children',
            'Country',
            'City',
            'Street',
        ];

        return array_merge([$headers], $this->data);
    }
}
