@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h1>403</h1>
    <h3>Unauthorized Access</h3>
    <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">
        Go Back
    </a>
</div>
@endsection