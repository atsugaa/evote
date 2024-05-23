<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable

{
    protected $table = 'users';

    protected $fillable = [
        'NISN', 'NAMA',
    ];

    protected $hidden = [
        'remember_token',
    ];

    // Use 'nisn' as the primary key if there is no 'id' column
    protected $primaryKey = 'NISN';

    // If 'nisn' is not an auto-increment field
    public $incrementing = false;

    // If 'nisn' is a string
    protected $keyType = 'string';
}
