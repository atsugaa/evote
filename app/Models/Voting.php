<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    protected $table = 'VOTING';
    protected $primaryKey = 'ID_VOTING';

    protected $keyType = 'string';

    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'ID_VOTING',
        'NAMA_VOTING',
        'DESKRIPSI_VOTING',
        'MULAI_VOTING',
        'SELESAI_VOTING',
    ];

    public function createCalonVotings(array $calonIds)
    {
        foreach ($calonIds as $calonId) {
            CalonVoting::create([
                'ID_VOTING' => $this->ID_VOTING,
                'ID_CALON' => $calonId,
            ]);
        }
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'ID_VOTING', 'ID_VOTING');
    }

    public function calonVotings()
    {
        return $this->hasMany(CalonVoting::class, 'ID_VOTING', 'ID_VOTING');
    }
}