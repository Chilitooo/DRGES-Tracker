<nav class="navbar navbar-expand-xl navbar-dark custom-navbar shadow">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="{{ auth()->user()->role === 'admin' ? route('admin.home') : route('staff.dashboard') }}">
      <img src="{{ asset('images/logo-yellow.png') }}" 
          alt="Logo" 
          width="40" 
          height="40" 
          class="me-2">
      {{ config('app.name', 'DRGES Sales Management') }}
    </a>

    <!-- Hamburger Icon -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <i class="bi bi-list text-white fs-2"></i>
    </button>

    <div class="collapse navbar-collapse overlay-menu" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        @guest
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
          @else
          @if(auth()->user()->role === 'admin')
            <!-- Dashboard - Only visible to admins -->
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <!-- Product Management - Onl visible to admins -->
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.products.index') }}">Products</a></li>
            <!-- Financial Reports - Only visible to admins -->
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.reports') }}">Financial Reports</a></li>
            <!-- Audit Transactions History - Only visible to admins -->
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.audit') }}">Audit Transactions</a></li>
            <!-- Staff Accounts - Only visible to admins -->
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.users') }}">Staff Accounts</a></li>
          @endif

          @if(auth()->user()->role === 'staff')
            <!-- Stock Ins - Only visible to staffs -->
            <li class="nav-item"><a class="nav-link" href="{{ route('staff.stock-in.index') }}">Stock In</a></li>
            <!-- Sales - Only visible to staffs -->
            <li class="nav-item"><a class="nav-link" href="{{ route('staff.sales.index') }}">Sales</a></li>
            <!-- Z-Read Reports - Only visible to staffs -->
            <li class="nav-item"><a class="nav-link" href="{{ route('staff.sales.zread') }}">Z-Read Report</a></li>
          @endif
          
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
              {{ auth()->user()->name }} </a>
            <div class="dropdown-menu dropdown-menu-end">
              <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">Logout</button>
              </form>
            </div>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>