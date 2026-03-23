@extends('layouts.app')

@section('content')

<div class="container mt-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

<div class="d-flex justify-content-between align-items-center mb-4 mt-4">
  <a href="{{ route('staff.dashboard') }}" 
            class="btn btn-secondary">
            Back to Dashboard
        </a>
  <h2>Sales</h2>
  <a href="{{ route('staff.sales.create') }}" class="btn btn-success">+ Record Sale</a>
</div>

<table class="table table-striped">
  <thead class="table-dark">
    <tr><th>Product</th><th>Qty</th><th>Unit Price</th><th>Subtotal</th><th>Payment</th><th>User</th><th>Date</th></tr>
  </thead>
  <tbody>
    @forelse($sales as $s)
    <tr>
      <td>{{ $s->product->name }}</td>
      <td>{{ $s->quantity }}</td>
      <td>₱{{ $s->unit_price }}</td>
      <td>₱{{ $s->subtotal }}</td>
      <td>{{ $s->payment_method }}</td>
      <td>{{ optional($s->user)->name }}</td>
      <td>{{ $s->created_at->format('m-d-Y h:i A') }}</td>
    </tr>
    @empty
    <tr><td colspan="7" class="text-center text-muted">No sales recorded</td></tr>
    @endforelse
  </tbody>
</table>
@endsection