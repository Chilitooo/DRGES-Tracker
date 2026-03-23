@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-5">

        <a href="{{ route('admin.home') }}" 
                class="btn btn-secondary">
                Back to AMP
        </a>
        
        <h1 class="fw-bold text-center">Admin Dashboard</h1>

        <a href="{{ route('admin.export.sales') }}"
        class="btn btn-success shadow">
            Export Sales (Excel)
        </a>
    </div>

    <div class="row mb-4 g-4">

        <!-- Daily Revenue -->
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body">
                    <h6 class="text-muted">Daily Revenue</h6>
                    <h3 class="text-success">
                        ₱ {{ number_format($dailyRevenue, 2) }}
                    </h3>
                </div>
            </div>
        </div>

        <!-- Monthly Growth -->
         <div class="col-md-4">
            <div class="card shadow h-100 rounded p-3">
                <h4 class="text-gray-500">Monthly Growth</h4>
                <h2 class="text-2xl font-bold 
                    {{ $monthlyGrowth >= 0 ? 'text-green-600' : 'text-red-600' }}">
                    {{ number_format($monthlyGrowth, 2) }}%
                </h2>
            </div>
        </div>

        <!-- Inventory Value -->
         <div class="col-md-4">
            <div class="card shadow h-100 rounded p-3">
                <h4 class="text-gray-500">Inventory Value</h4>
                <h2 class="text-2xl font-bold text-blue-600">
                    ₱ {{ number_format($inventoryValue, 2) }}
                </h2>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="bg-white p-2 rounded shadow">
        <canvas id="revenueChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('revenueChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($last7Days->pluck('date')) !!},
                datasets: [{
                    label: 'Revenue',
                    data: {!! json_encode($last7Days->pluck('total')) !!},
                    borderWidth: 2,
                }]
            }
        });
    </script>

    <div class="bg-white p-2 rounded shadow mt-3">
        <h3 class="font-bold mb-4 p-2">Top Selling Products</h3>

        <table class="table table-striped table-borderless">
            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Qty Sold</th>
                    <th>Revenue</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topProducts as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'Deleted Product' }}</td>
                    <td>{{ $item->total_qty }}</td>
                    <td>₱ {{ number_format($item->total_revenue, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection