<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Koordinator extends Model
{
    use HasFactory;
    protected $table = 'koordinator';
    protected $fillable = ['nik', 'foto', 'paslon_id', 'user_id'];
    protected static $allowedFilters = [
        'paslon_id',
    ];
    public function paslon()
    {
        return $this->belongsTo(Paslon::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function pemilihPotensial()
    {
        return $this->hasMany(PemilihPotensial::class);
    }
}
