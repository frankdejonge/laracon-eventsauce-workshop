@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Adoptable Cat(s)</h3>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if(count($cats) === 0)
                    <div class="alert alert-primary" role="alert">
                        <h3>No adoptable cats... :(</h3>
                    </div>
                    @else
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Breed</th>
                            <th scope="col">Color</th>
                            <th scope="col">Gender</th>
                            <th scope="col">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cats as $cat)
                        <tr>
                            <th scope="row">{{ $cat->name() ?: 'Unknown Name' }}</th>
                            <th scope="row">{{ $cat->breed() }}</th>
                            <td>{{ $cat->color() }}</td>
                            <td>{{ $cat->gender() }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm">Adopt!</button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
