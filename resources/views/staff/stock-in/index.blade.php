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
  <h2>Stock Ins</h2>
  <a href="{{ route('staff.stock-in.create') }}" class="btn btn-success">+ Record Stock In</a>
</div>

<table class="table table-striped">
  <thead class="table-dark">
    <tr><th>Product</th><th>Batch #</th><th>Qty</th><th>Expiry</th><th>User</th><th>Date</th></tr>
  </thead>
  <tbody>
    @forelse($stockIns as $s)
    <tr>
      <td>{{ $s->product->name }}</td>
      <td>{{ $s->batch_number ?? '-' }}</td>
      <td>{{ $s->quantity }}</td>
      <td>{{ optional($s->expiry_date)->toDateString() ?? '-' }}</td>
      <td>{{ optional($s->user)->name }}</td>
      <td>{{ $s->created_at->format('Y-m-d H:i') }}</td>
    </tr>
    @empty
    <tr><td colspan="6" class="text-center text-muted">No stock ins recorded</td></tr>
    @endforelse
  </tbody>
</table>
@endsection

