<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_quiz', function (Blueprint $table) {
            $table->id();
            $table->string('no');
            $table->string('nama');
            $table->string('durasi'); // contoh: 05:00
            $table->string('skor');   // contoh: 80/100
            $table->enum('status', ['Lulus', 'Tidak Lulus']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_quiz');
    }
};
