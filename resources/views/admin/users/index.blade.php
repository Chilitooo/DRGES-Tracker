@extends('layouts.app')

@section('content')

<div class="container mt-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    <div class="position-relative mb-4">

        <a href="{{ route('admin.home') }}" 
            class="btn btn-secondary position-absolute start-0">
            Back to AMP
        </a>
        <!-- Add New Staff Button -->
         <button class="btn btn-success position-absolute end-0" data-bs-toggle="modal" data-bs-target="#createStaffModal">
            + Add Staff
        </button>
        <h2 class="text-center mb-4">Staff Accounts</h2>

        
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                @if($user->role == 'staff')
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>
                        @if($user->status == 'active')
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <!-- Toggle Status -->
                        <form method="POST" action="{{ route('admin.users.toggle', $user->id) }}" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-sm {{ $user->status == 'active' ? 'btn-warning' : 'btn-success' }}">
                                {{ $user->status == 'active' ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>

                        <!-- Delete Button -->
                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" style="display:inline;"  
                           onsubmit="return confirm('Are you sure you want to delete this staff account?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>

</div>
<!-- Create Staff Modal -->
<div class="modal fade" id="createStaffModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Create Staff Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-success">Create</button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection