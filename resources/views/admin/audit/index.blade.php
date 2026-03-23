@extends('layouts.app')

@section('content')
<div class="container">
    <div class="position-relative mt-4 mb-4">

        <a href="{{ route('admin.home') }}" 
            class="btn btn-secondary position-absolute start-0">
            Back to AMP
        </a>

        <h2 class="text-center">Audit Logs</h2>
        <search></search>
    </div>


    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Date</th>
                <th>Staff</th>
                <th>Action</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log->created_at }}</td>
                <td>{{ $log->user->name }}</td>
                <td>{{ $log->action }}</td>
                <td>{{ $log->product_name }}</td>
                <td>{{ $log->quantity }}</td>
                <td>{{ $log->amount }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $logs->links() }}
</div>
@endsection