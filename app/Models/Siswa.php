<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'name',
        'email',
        'nis',
        'status'
    ];

    public function hasil() {
        return $this->hasOne(Hasil::class, 'id_user', 'id_user');
    }
}
