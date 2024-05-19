<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calon extends Model
{
    protected $table = 'calon';
    protected $primaryKey = 'ID_CALON';
    public $timestamps = false;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'ID_CALON',
        'KETUA_CALON',
        'WAKIL_CALON',
        'VISI_CALON',
        'MISI_CALON',
        'GAMBAR_CALON',
    ];

    public function votes()
    {
        return $this->hasMany(Vote::class, 'ID_CALON', 'ID_CALON');
    }

    public function calonVotings()
    {
        return $this->hasMany(CalonVoting::class, 'ID_CALON', 'ID_CALON');
    }
}
