@extends('layouts.app')

@section('content')
<div class="container mt-4">

  <div class="text-center mb-5">
    <h1 class="fw-bold">Staff Dashboard</h1>
    <p>Welcome, {{ auth()->user()->name }}! Use the links below to manage inventory and sales.</p>
    <a href="{{ route('staff.stock-in.index') }}" class="btn btn-success">Stock In</a>
    <a href="{{ route('staff.sales.index') }}" class="btn btn-success">Sales</a>
    <a href="{{ route('staff.sales.zread') }}" class="btn btn-success">Z-Read Report</a>
  </div>

</div>
@endsection