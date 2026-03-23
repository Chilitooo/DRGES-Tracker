@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Stock In Details</h2>

    <div class="card">
        <div class="card-body">

            <p><strong>Stock ID:</strong> {{ $stock->id }}</p>

            <p><strong>Product:</strong> 
                {{ $stock->product->name ?? 'N/A' }}
            </p>

            <p><strong>Quantity Added:</strong> 
                {{ $stock->quantity }}
            </p>

            <p><strong>Date:</strong> 
                {{ $stock->created_at->format('F d, Y h:i A') }}
            </p>

            <a href="{{ route('staff.stock-in.index') }}" class="btn btn-secondary">
                Back to Stock List
            </a>

        </div>
    </div>
</div>
@endsection