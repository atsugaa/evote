<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admin';

    protected $primaryKey = 'ID_ADMIN';

    protected $username = 'ID_ADMIN';

    protected $keyType = 'string';

    protected $guard = 'admin';

    protected $hidden = ['PASSWORD_ADMIN',];

    protected $fillable = [
        'ID_ADMIN', 'PASSWORD_ADMIN',
    ];

    public $incrementing = false;

    public $password = 'PASSWORD_ADMIN';

    protected $authPasswordName = 'PASSWORD_ADMIN';

    public $timestamps = false;

    public function getAuthPassword() {
        return $this->PASSWORD_ADMIN;
    }

    protected function casts(): array
    {
        return [
            'PASSWORD_ADMIN' => 'hashed',
        ];
    }
}
