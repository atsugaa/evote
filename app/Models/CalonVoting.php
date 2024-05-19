<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CalonVoting extends Model
{
    protected $table = 'calon_voting';
    protected $primaryKey = 'ID_CATING';
    public $timestamps = false;
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'ID_CALON_VOTING',
        'ID_VOTING',
        'ID_CALON',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($calonVoting) {
            $calonVoting->generateID();
        });
    }

    public function generateID()
    {
        $latestID = static::latest('ID_CATING')->value('ID_CATING');

        if (!$latestID) {
            $this->ID_CATING = 'P0001';
        } else {
            $number = intval(substr($latestID, 1)) + 1;
            $this->ID_CATING = 'P' . str_pad($number, 4, '0', STR_PAD_LEFT);
        }
    }
    
    public function voting()
    {
        return $this->belongsTo(Voting::class, 'ID_VOTING', 'ID_VOTING');
    }

    public function calon()
    {
        return $this->belongsTo(Calon::class, 'ID_CALON', 'ID_CALON');
    }
}
