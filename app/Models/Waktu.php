<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waktu extends Model
{
    use HasFactory;

    protected $fillable = [
        'waktu_awal',
        'waktu_akhir',
    ];
}
