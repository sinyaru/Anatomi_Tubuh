@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')

<style>
  body {
    background-color: #fff0f6;
    /* Latar belakang lembut pink */
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    height: 100vh;
    width: 100%;
  }

  /* Statistik Cards */
  .stat-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
  }

  .stat-card {
    background-color: #f8bbd0;
    border-radius: 10px;
    padding: 20px;
    color: #4a4a4a;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: 0.3s;
  }

  .stat-card:hover {
    transform: translateY(-5px);
    background-color: #f48fb1;
    color: #fff;
  }

  .stat-card i {
    font-size: 32px;
    margin-bottom: 10px;
    color: #ec407a;
  }

  .stat-card h4 {
    margin: 0;
    font-size: 20px;
    font-weight: 600;
  }

  .stat-card p {
    margin: 0;
    font-size: 14px;
    opacity: 0.9;
  }

  /* Grafik */
  .chart-container {
    background-color: #fff;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 30px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  /* Tabel Aktivitas */
  .activity-table {
    background-color: #620d0dff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .activity-table h5 {
    font-weight: 600;
    margin-bottom: 15px;
    color: #ec407a;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .dashboard-container {
      flex-direction: column;
    }

    .sidebar {
      width: 100%;
      flex-direction: row;
      justify-content: space-around;
      padding: 10px;
    }

    .navbar {
      flex-direction: column;
      align-items: flex-start;
      gap: 10px;
    }

    .content-wrapper {
      padding: 20px;
    }
  }
</style>
<!-- Statistik Cards -->
<div class="stat-cards">
  <div class="stat-card">
    <i class="bi bi-heart-pulse"></i>
    <h4>{{ $totalOrgan }}</h4>
    <p>Total Organ Tubuh</p>
  </div>

  <div class="stat-card">
    <i class="bi bi-pencil-square"></i>
    <h4>{{ $totalQuiz }}</h4>
    <p>Total Quiz</p>
  </div>

  <div class="stat-card">
    <i class="bi bi-people"></i>
    <h4>{{ $totalPengguna }}</h4>
    <p>Total Pengguna</p>
  </div>

  <div class="stat-card">
    <i class="bi bi-bar-chart-line"></i>
    <h4>{{ $rataNilai }}%</h4>
    <p>Rata-rata Nilai Quiz</p>
  </div>
</div>


<!-- Grafik Aktivitas -->
<div class="chart-container">
  <h5>Grafik Aktivitas Pengguna</h5>
  <canvas id="activityChart"></canvas>
</div>
@endsection

@push('scripts')
<script>
  const ctx = document.getElementById('activityChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: {!! json_encode(array_keys($activity->toArray())) !!},
      datasets: [{
        label: 'Aktivitas',
        data: {!! json_encode(array_values($activity->toArray())) !!},
        backgroundColor: '#f8bbd0',
        borderColor: '#ec407a',
        borderWidth: 1,
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: { beginAtZero: true }
      }
    }
  });
</script>

@endpush