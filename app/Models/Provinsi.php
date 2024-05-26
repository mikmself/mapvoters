<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    use HasFactory;
    protected $table = 'provinsi';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id', 'nama'];
    public $timestamps = false;

    public function kabupaten()
    {
        return $this->hasMany(Kabupaten::class);
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
