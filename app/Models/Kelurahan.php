<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    use HasFactory;
    public $table = 'kelurahan';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['nama_kelurahan', 'kecamatan_id'];
    public $timestamps = false;

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
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
