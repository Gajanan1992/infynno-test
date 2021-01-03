@extends('app-layout.master')
@section('content')
<div class="container-fluid mt-3 text-center">
    <div class="jumbotron jumbotron-fluid">
        <h1 class="display-4">Simple Cell phone Inventory Management</h1>
        <p class="lead">Built with letest Laravel framework version 8.</p>
        <hr class="my-4">
        <a href="{{ route('cellphone.index') }}" class="btn btn-primary btn-lg">Go to Inventory</a>
    </div>

</div>

@endsection
