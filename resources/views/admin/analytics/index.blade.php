@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold mb-2">Analytics Dashboard</h2>
            <p class="text-muted">Statistik pengunjung website</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon bg-primary">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ number_format($todayVisitors) }}</h3>
                    <p>Hari Ini</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon bg-success">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ number_format($weekVisitors) }}</h3>
                    <p>Minggu Ini</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon bg-warning">
                    <i class="fas fa-calendar-week"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ number_format($monthVisitors) }}</h3>
                    <p>Bulan Ini</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="stat-card">
                <div class="stat-icon bg-info">
                    <i class="fas fa-globe"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ number_format($totalVisitors) }}</h3>
                    <p>Total Pengunjung</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Visitor Chart -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Grafik Pengunjung (30 Hari Terakhir)</h5>
                </div>
                <div class="card-body">
                    <canvas id="visitorChart" height="80"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Pages -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Halaman Paling Banyak Dikunjungi</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Halaman</th>
                                    <th>Jumlah Kunjungan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($topPages as $index => $page)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <code>{{ $page->page_visited }}</code>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">
                                                {{ number_format($page->visits) }} kunjungan
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4">
                                            <i class="fas fa-chart-bar fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">Belum ada data kunjungan</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        display: flex;
        align-items: center;
        gap: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
    }

    .stat-content h3 {
        font-size: 28px;
        font-weight: 700;
        margin: 0;
        color: #2d3748;
    }

    .stat-content p {
        font-size: 14px;
        color: #a0aec0;
        margin: 0;
    }

    .card {
        border-radius: 12px;
        border: none;
    }

    .table th {
        font-weight: 600;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const visitorData = @json($visitorData);
        
        const labels = visitorData.map(item => {
            const date = new Date(item.date);
            return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
        });
        
        const uniqueVisitors = visitorData.map(item => item.unique_visitors);
        const totalVisits = visitorData.map(item => item.total_visits);
        
        const ctx = document.getElementById('visitorChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Unique Visitors',
                    data: uniqueVisitors,
                    borderColor: '#95ddda',
                    backgroundColor: 'rgba(149, 221, 218, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointBackgroundColor: '#95ddda',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }, {
                    label: 'Total Visits',
                    data: totalVisits,
                    borderColor: '#7ec5c2',
                    backgroundColor: 'rgba(126, 197, 194, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointBackgroundColor: '#7ec5c2',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            padding: 15,
                            font: {
                                size: 13,
                                family: "'Inter', sans-serif"
                            }
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: 'rgba(45, 55, 72, 0.95)',
                        padding: 12,
                        titleFont: {
                            size: 14,
                            family: "'Inter', sans-serif"
                        },
                        bodyFont: {
                            size: 13,
                            family: "'Inter', sans-serif"
                        },
                        borderColor: '#95ddda',
                        borderWidth: 1
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            font: {
                                size: 12,
                                family: "'Inter', sans-serif"
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 12,
                                family: "'Inter', sans-serif"
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
