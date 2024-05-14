<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;
    protected $table = 'kabupaten';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id', 'nama', 'provinsi_id'];
    public $timestamps = false;

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }
    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class);
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
