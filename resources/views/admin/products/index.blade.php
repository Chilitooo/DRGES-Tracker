@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 mt-4">
  <a href="{{ route('admin.home') }}" class="btn btn-secondary">Back to AMP</a>
  <h2>Products</h2>
  <a href="{{ route('admin.products.create') }}" class="btn btn-success">+ New Product</a>
</div>

<style>
  .stock-badge{
      background-color: #198754;
      color: white;
      padding: 5px 10px;
      border-radius: 6px;
      font-weight: 500;
  }

  .btn-view{
      background-color: #198754;
      color: white;
  }

  .btn-view:hover{
      background-color: #157347;
      color: white;
  }

  .btn-edit{
      background-color: #0f5132;
      color: white;
  }

  .btn-edit:hover{
      background-color: #0c3d26;
      color: white;
  }

  .btn-delete{
      background-color: #f59e0b;
      color: black;
  }

  .btn-delete:hover{
      background-color: #d97706;
      color: black;
  }
</style>

<table class="table table-striped">
  <thead class="table-dark">
    <tr>
      <th>SKU</th>
      <th>Name</th>
      <th>Category</th>
      <th>Unit</th>
      <th>Price</th>
      <th>Stock</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @forelse($products as $p)
    <tr>
      <td>{{ $p->sku }}</td>
      <td>{{ $p->name }}</td>
      <td>{{ $p->category }}</td>
      <td>{{ $p->unit }}</td>
      <td>₱{{ number_format($p->selling_price, 2) }}</td>
      <td><span class="badge bg-success stock-badge">{{ $p->current_stock }}</span>
        @if($p->current_stock <= $p->safety_stock)
          <span class="badge bg-danger">Low Stock</span>
        @endif
      </td>
      <td>
        <a href="{{ route('admin.products.show', $p->id) }}" class="btn btn-sm btn-view">View</a>
        <a href="{{ route('admin.products.edit', $p->id) }}" class="btn btn-sm btn-edit">Edit</a>
        <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST" style="display:inline">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-delete" onclick="return confirm('Delete this Product?')">Delete</button>
        </form>
      </td>
    </tr>
      
    @empty
    <tr><td colspan="7" class="text-center text-muted">No products found</td></tr>
    @endforelse
  </tbody>
</table>
@endsection