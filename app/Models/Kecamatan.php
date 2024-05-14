<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'kecamatan';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id', 'nama', 'kabupaten_id'];
    public $timestamps = false;

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }
    public function kelurahan()
    {
        return $this->hasMany(Kelurahan::class);
    }

    public function saksi()
    {
        return $this->hasMany(Saksi::class);
    }
    public function pemilihPotensial()
    {
        return $this->hasMany(PemilihPotensial::class);
    }
}
