@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Sale Details</h2>

    <div class="card">
        <div class="card-body">

            <p><strong>Sale ID:</strong> {{ $sale->id }}</p>

            <p><strong>Product:</strong> 
                {{ $sale->product->name ?? 'N/A' }}
            </p>

            <p><strong>Quantity Sold:</strong> 
                {{ $sale->quantity }}
            </p>

            <p><strong>Date:</strong> 
                {{ $sale->created_at->format('F d, Y h:i A') }}
            </p>

            <a href="{{ route('staff.sales.index') }}" class="btn btn-secondary">
                Back to Sales
            </a>

        </div>
    </div>
</div>
@endsection