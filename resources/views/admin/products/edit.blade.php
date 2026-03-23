@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <div class="col-md-6">
    <h1 class="mb-4">Edit Product</h1>
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
      @csrf @method('PUT')
      <div class="mb-3">
        <label class="form-label">SKU</label>
        <input type="text" name="sku" value="{{ $product->sku }}" class="form-control @error('sku') is-invalid @enderror" required>
        @error('sku')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" value="{{ $product->name }}" class="form-control @error('name') is-invalid @enderror" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="mb-3">
        <label class="form-label">Category</label>
        <input type="text" name="category" value="{{ $product->category }}" class="form-control @error('category') is-invalid @enderror" required>
        @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="mb-3">
        <label class="form-label">Unit</label>
        <input type="text" name="unit" value="{{ $product->unit }}" class="form-control @error('unit') is-invalid @enderror" required>
        @error('unit')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="mb-3">
        <label class="form-label">Selling Price</label>
        <input type="number" name="selling_price" value="{{ $product->selling_price }}" step="0.01" class="form-control @error('selling_price') is-invalid @enderror" required>
        @error('selling_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <div class="mb-3">
        <label class="form-label">Safety Stock</label>
        <input type="number" name="safety_stock" value="{{ $product->safety_stock }}" class="form-control @error('safety_stock') is-invalid @enderror">
        @error('safety_stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>
      <button class="btn btn-primary">Update</button>
      <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</div>
@endsection