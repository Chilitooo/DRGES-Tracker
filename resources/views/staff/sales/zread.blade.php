@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Daily Z-Read Report</h4>

    <p>Date: {{ now()->format('F d, Y') }}</p>

    <table class="table table-bordered">
        <tr>
            <th>Total Transactions</th>
            <td>{{ $sales->count() }}</td>
        </tr>
        <tr>
            <th>Total Cash </th>
            <td>
                {{ '₱' . number_format($sales->where('payment_method','cash')->sum('subtotal'), 2) }}
            </td>
        </tr>
        <tr>
            <th>Total Digital</th>
            <td>
                {{ '₱' . number_format($sales->where('payment_method','!=','cash')->sum('subtotal'), 2) }}
            </td>
        </tr>
        <tr>
            <th>Grand Total</th>
            <td>{{ '₱' . number_format($sales->sum('subtotal'), 2) }}</td>
        </tr>
    </table>
</div>
@endsection