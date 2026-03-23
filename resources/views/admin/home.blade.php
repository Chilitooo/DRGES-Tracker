@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <div class="text-center mb-5">
        
            <h1 class="fw-bold">DRGES Sales Management</h1>
            <p class="text-muted mb-0">Admin Management Panel</p>
       
    </div>

    <div class="row g-4">

        <!-- Dashboard -->
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Dashboard</h5>
                    <p class="card-text">View system overview and statistics.</p>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-success">
                        Go to Dashboard
                    </a>
                </div>
            </div>
        </div>

        <!-- Manage Products -->
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Manage Products</h5>
                    <p class="card-text">Add, edit, delete and monitor products.</p>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-success">
                        Manage Products
                    </a>
                </div>
            </div>
        </div>

        <!-- Financial Reports -->
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Financial Reports</h5>
                    <p class="card-text">View all sales and financial summaries.</p>
                    <a href="{{ route('admin.reports') }}" class="btn btn-success">
                        View Reports
                    </a>
                </div>
            </div>
        </div>

        <!-- Audit Transactions -->
        <div class="col-md-6">
            <div class="card shadow h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Audit Transaction History</h5>
                    <p class="card-text">Review all transaction logs and changes.</p>
                    <a href="{{ route('admin.audit') }}" class="btn btn-success">
                        View Audit Logs
                    </a>
                </div>
            </div>
        </div>

        <!-- Manage Staff -->
        <div class="col-md-6">
            <div class="card shadow h-100 text-center">
                <div class="card-body">
                    <h5 class="card-title">Manage Staff Accounts</h5>
                    <p class="card-text">Create, activate or deactivate staff users.</p>
                    <a href="{{ route('admin.users') }}" class="btn btn-success">
                        Manage Staff
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection