<h2>Hasil Quiz</h2>

<p>Benar: {{ $hasil->benar }}</p>
<p>Nilai: {{ round($hasil->nilai) }}</p>

<a href="{{ route('pengguna.quiz.index') }}" class="btn btn-primary">
    Kembali ke Quiz Interaktif
</a>
