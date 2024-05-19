<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\User;

class UsersImport implements ToModel
{
    public function model(array $row)
    {
        return new User([
            'NISN' => $row[1],
            'NAMA' => strtoupper($row[0]),
        ]);
    }
}
