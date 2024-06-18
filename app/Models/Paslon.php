<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paslon extends Model
{
    use HasFactory;
    public $table = 'paslon';
    protected $fillable = [
        'foto',
        'type',
        'nomor_urut',
        'dapil',
        'partai_id',
        'user_id'
    ];

    public function partai()
    {
        return $this->belongsTo(Partai::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function koordinator()
    {
        return $this->hasMany(Koordinator::class);
    }
    public function pengaturan()
    {
        return $this->hasOne(Pengaturan::class);
    }
}
