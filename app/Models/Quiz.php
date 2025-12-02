<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'soal',
        'jawaban_benar',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'tipe', // pilihan_ganda / true_false
        'foto',
    ];

    public function hasilQuiz()
    {
        return $this->hasMany(HasilQuiz::class);
    }
}