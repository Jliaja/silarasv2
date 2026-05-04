@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<!-- Kartu Statistik -->
<div class="stats-row">
    <div class="stat-card">
        <div class="stat-number">{{ $totalPemohon }}</div>
        <div class="stat-label">Jumlah Pemohon</div>
        <div class="stat-sub">Total pemohon terdaftar</div>
    </div>
    <div class="stat-card">
        <div class="stat-number">{{ $totalSuratKeluar }}</div>
        <div class="stat-label">Jumlah Surat Keluar</div>
        <div class="stat-sub">Total surat yang diterbitkan</div>
        
    </div>
</div>

<!-- Grafik Surat Keluar per Bulan -->
<div class="chart-card">
    <div class="chart-title">📈 Surat Keluar</div>
    <canvas id="suratKeluarChart" style="max-height: 300px; width: 100%;"></canvas>
</div>

<!-- Grafik Kategori Surat (batang) -->
<div class="chart-card">
    <div class="chart-title">📊 Kategori Surat</div>
    <canvas id="kategoriChart" style="max-height: 300px; width: 100%;"></canvas>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Grafik Surat Keluar (garis)
        const ctxLine = document.getElementById('suratKeluarChart').getContext('2d');
        new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: {!! json_encode($bulanLabels) !!},
                datasets: [{
                    label: 'Surat Keluar',
                    data: {!! json_encode($suratKeluarData) !!},
                    borderColor: '#0f2b4d',
                    backgroundColor: 'rgba(15, 43, 77, 0.05)',
                    borderWidth: 3,
                    pointRadius: 5,
                    pointBackgroundColor: '#0f2b4d',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { position: 'top' }
                }
            }
        });

        // Grafik Kategori Surat (batang)
        const ctxBar = document.getElementById('kategoriChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: {!! json_encode($kategoriLabels) !!},
                datasets: [{
                    label: 'Jumlah Pengajuan',
                    data: {!! json_encode($kategoriData) !!},
                    backgroundColor: ['#0f2b4d', '#2c5f8a', '#4a8db7'],
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: { position: 'top' }
                }
            }
        });
    });
</script>
@endsection