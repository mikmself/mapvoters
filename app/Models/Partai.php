<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partai extends Model
{
    use HasFactory;
    protected $table = 'partai';
    protected $fillable = ['nama', 'nomor_urut', 'logo'];

    public function paslon()
    {
        return $this->hasMany(Paslon::class);
    }
}
