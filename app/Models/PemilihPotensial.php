<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemilihPotensial extends Model
{
    use HasFactory;
    public $table = 'pemilih_potensial';
    protected $fillable = [
        'nama',
        'nik',
        'foto_ktp',
        'telephone',
        'tps',
        'provinsi_id',
        'kabupaten_id',
        'kecamatan_id',
        'kelurahan_id',
        'koordinator_id',
    ];
    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class);
    }
    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }
    public function koordinator()
    {
        return $this->belongsTo(Koordinator::class);
    }
}
