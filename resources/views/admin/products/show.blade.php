@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <h2>{{ $product->name }}</h2>
    <dl class="row">
      <dt class="col-sm-3">SKU</dt>
      <dd class="col-sm-9">{{ $product->sku }}</dd>
      
      <dt class="col-sm-3">Category</dt>
      <dd class="col-sm-9">{{ $product->category }}</dd>
      
      <dt class="col-sm-3">Unit</dt>
      <dd class="col-sm-9">{{ $product->unit }}</dd>
      
      <dt class="col-sm-3">Price</dt>
      <dd class="col-sm-9">₱{{ $product->selling_price }}</dd>
      
      <dt class="col-sm-3">Current Stock</dt>
      <dd class="col-sm-9"><span class="badge bg-info">{{ $product->current_stock }}</span></dd>
      
      <dt class="col-sm-3">Safety Stock</dt>
      <dd class="col-sm-9">{{ $product->safety_stock }}</dd>
    </dl>
    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-success">Edit</a>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Back</a>
  </div>
</div>
@endsection