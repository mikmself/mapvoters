<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    use HasFactory;
    protected $table = 'pengaturan';
    protected $fillable = ['paslon_id', 'target_suara'];

    public function paslon()
    {
        return $this->belongsTo(Paslon::class);
    }
}
