@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>Welcome to LaraCats!</h2>
                    <h3>Home of the cats without a home.</h3>

                    <hr>

                    <p>
                        <a href="{{ route('shelter.register') }}" class="btn btn-primary btn-sm">Register Cat for Adoption</a>
                        <a href="{{ route('shelter.adoptable') }}" class="btn btn-secondary btn-sm">View Adoptable Cats</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
