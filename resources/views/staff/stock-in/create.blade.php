@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <h1 class="mb-4">Record Stock In</h1>
    <form action="{{ route('staff.stock-in.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label class="form-label">Product</label>
        <select name="product_id" class="form-control @error('product_id') is-invalid @enderror" required>
          <option value="">-- Select Product --</option>
          @foreach($products as $p)
            <option value="{{ $p->id }}">{{ $p->name }} (Stock: {{ $p->current_stock }})</option>
          @endforeach
        </select>
        @error('product_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="mb-3">
        <label class="form-label">Batch Number</label>
        <input type="text" name="batch_number" class="form-control">
      </div>
      <div class="mb-3">
        <label class="form-label">Expiry Date</label>
        <input type="date" name="expiry_date" class="form-control">
      </div>
      <div class="mb-3">
        <label class="form-label">Quantity</label>
        <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" required>
        @error('quantity')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <button class="btn btn-primary">Record</button>
      <a href="{{ route('staff.stock-in.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</div>
@endsection