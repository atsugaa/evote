<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\User;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {   
        return new User([
            'NISN' => $row['nisn'],
            'NAMA' => strtoupper($row['nama']),
            'STATUS' => 0,
        ]);
    }
}
