@extends('layouts.app')

@section('content')

<div class="container mb-4">
    <div class="position-relative mt-4 mb-4">

        <a href="{{ route('admin.home') }}" 
            class="btn btn-secondary position-absolute start-0">
            Back to AMP
        </a>

        <h2 class="text-center">Financial Reports</h2>
    </div>

    <h4>Total Revenue: ₱ {{ number_format($totalRevenue, 2) }}</h4>

    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales as $sale)
            <tr>
                <td>{{ $sale->product->name }}</td>
                <td>{{ $sale->quantity }}</td>
                <td>{{ $sale->subtotal }}</td>
                <td>{{ $sale->created_at->format('m-d-Y h:i A') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection