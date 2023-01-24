<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'pesan'
    ];

    public function siswas() {
        return $this->belongsTo(Siswa::class, 'id_user', 'id_user');
    }
}
