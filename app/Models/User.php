<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $guard = 'web';

    protected $primaryKey = 'NISN';

    protected $keyType = 'string';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'NISN', 'NAMA', 'STATUS',
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class, 'NISN', 'NISN');
    }
}
