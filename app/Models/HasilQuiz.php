<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilQuiz extends Model
{
    protected $table = 'hasil_quiz';

    protected $fillable = [
        'no',
        'nama',
        'durasi',
        'skor',
        'status'
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Quiz
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
