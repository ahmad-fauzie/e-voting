<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';

    protected $fillable = [
        'id_user',
        'login',
        'daftar',
        'reset',
        'dashboard',
        'siswa',
        'kandidat',
        'voting',
        'qna',
        'hasil',
        'jadwal',
        'rating',
        'profile',
        'feedback'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
