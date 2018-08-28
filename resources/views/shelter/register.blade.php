@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register Cat</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form action="{{ route('shelter.register_action') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="field-name">Name</label>
                            <input type="string" class="form-control" id="field-name" placeholder="" name="name">
                        </div>
                        <div class="form-group">
                            <label for="field-gender">Gender</label>
                            <select class="form-control" id="field-gender" name="gender">
                                @foreach(CatInformation::GENDERS as $gender)
                                    <option>{{ $gender }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="field-color">Color</label>
                            <select class="form-control" id="field-color" name="color">
                                @foreach(CatInformation::COLORS as $color)
                                    <option>{{ $color }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="field-breed">Color</label>
                            <select class="form-control" id="field-breed" name="breed">
                                @foreach(CatInformation::BREEDS as $breed)
                                    <option>{{ $breed }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="field-date-of-birth">Date of birth</label>
                            <input type="date" name="date_of_birth" class="form-control" id="field-date-of-birth" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mb-2">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
