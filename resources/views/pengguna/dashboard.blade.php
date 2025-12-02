@extends('layouts.pengguna')

@section('title', 'Dashboard Pengguna')

@section('content')
<div class="info-cards d-flex gap-5 mt-515 justify-content-center">
  <!-- Kartu Ranking -->
  <div class="card-box flex-fill d-flex align-items-center justify-content-between p-4 rounded shadow-sm"
    style="background-color:#ffd6e6; height:160px; border-radius:20px;">
    <div class="d-flex align-items-center">
      <img src="https://img.icons8.com/fluency/64/trophy.png" width="70" class="me-30">
      <div class="text-start">
        <h4 style="font-family:'Poppins', sans-serif; font-weight:600; font-size:1.8rem; color:#4a0d2e; margin:0;">
          Ranking
        </h4>
        <p class="fw-bold" style="font-family:'Playfair Display', serif; font-size:2.2rem; color:#4a0d2e; margin:0;">
          #{{ $peringkat ?? '-' }}
        </p>
      </div>
    </div>
  </div>

  <!-- Kartu Poin -->
  <div class="card-box flex-fill d-flex align-items-center justify-content-between p-4 rounded shadow-sm"
    style="background-color:#ffd6e6; height:160px; border-radius:20px;">
    <div class="d-flex align-items-center">
      <img src="https://img.icons8.com/fluency/64/coins.png" width="70" class="me-4">
      <div class="text-start">
        <h4 style="font-family:'Poppins', sans-serif; font-weight:600; font-size:1.8rem; color:#4a0d2e; margin:0;">
          Poin
        </h4>
        <p class="fw-bold" style="font-family:'Playfair Display', serif; font-size:2.2rem; color:#4a0d2e; margin:0;">
          {{ $totalPoin }}
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Bagian Aktivitas Terbaru -->
<div class="activity-section mt-5">
  
  <div class="activity-box p-3 rounded-4 shadow-sm"
    style="background-color:#ffd6e6; border-radius:18px; max-width:750px; margin:0 auto;">

    <!-- Aktivitas Box 1 -->
    <div class="activity-item p-3 mb-3 rounded-4 shadow-sm d-flex align-items-start gap-3"
      style="background-color:#fff0f6; border-radius:15px;">

      <div>
        <h5 style="font-family:'Poppins', sans-serif; font-weight:600; color:#4a0d2e; margin-bottom:8px;">
          Materi Dipelajari
        </h5>

        <!-- Ikon Catatan & Teks -->
        <div class="d-flex align-items-center gap-2" style="color:#6b4c5a;">
          <img src="https://img.icons8.com/fluency/28/note.png" width="24" height="24">
          <p style="font-family:'Playfair Display', serif; font-size:1.2rem; margin:0;">
            {{ $jumlahQuiz }} kuis dikerjakan
          </p>
        </div>

        <!-- Ikon Jam & Waktu -->
        <div class="d-flex align-items-center gap-2 mt-2" style="color:#8a6076;">
          <img src="https://img.icons8.com/fluency/28/clock.png" width="22" height="22">
          <small>
            {{ optional($aktivitasTerbaru->first())->created_at?->diffForHumans() ?? 'Belum ada aktivitas' }}
          </small>
        </div>
      </div>
    </div>

    <!-- Aktivitas Box 2 -->
    <div class="activity-item p-4 mb-3 rounded-4 shadow-sm d-flex align-items-start gap-3"
      style="background-color:#fff0f6; border-radius:20px;">

      <div>
        <h5 style="font-family:'Poppins', sans-serif; font-weight:600; color:#4a0d2e; margin-bottom:8px;">
          Aktivitas Terbaru :
        </h5>

        @forelse($aktivitasTerbaru as $a)
        <div class="d-flex align-items-center gap-2 mb-1" style="color:#6b4c5a;">
          <img src="https://img.icons8.com/fluency/28/trophy.png" width="24">
          <p style="font-family:'Playfair Display', serif; font-size:1.1rem; margin:0;">
            Quiz {{ $a->no }} — Skor {{ $a->skor }}
          </p>
        </div>
        @empty
        <p class="text-muted">Belum ada aktivitas</p>
        @endforelse

      </div>
    </div>

  </div>
</div>
@endsection
