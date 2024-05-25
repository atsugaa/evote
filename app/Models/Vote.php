<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $table = 'VOTE';
    protected $primaryKey = 'ID_VOTE';
    public $timestamps = false;

    protected $fillable = [
        'ID_VOTE',
        'ID_CALON',
        'ID_VOTING',
        'NISN',
        'WAKTU_VOTE',
    ];

    

    public function voting()
    {
        return $this->belongsTo(Voting::class, 'ID_VOTING', 'ID_VOTING');
    }

    public function calon()
    {
        return $this->belongsTo(Calon::class, 'ID_CALON', 'ID_CALON');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'NISN', 'NISN');
    }
}
