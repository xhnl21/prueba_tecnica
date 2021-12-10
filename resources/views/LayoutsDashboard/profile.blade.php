@extends('LayoutsDashboard.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">                                
                                @if (session('message') !== null)                                
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('message') }}
                                    </div>
                                @endif
                                @if (session('msj') !== null)                                
                                    <div class="alert alert-info" role="alert">
                                        {{ session('msj') }}
                                    </div>
                                @endif                                
                                <form method="POST" action="{{ route('form') }}">
                                    @csrf
                                    <div class="form-row">          
                                        <div class="form-group col-md-12">
                                            <label>DNI:</label>
                                            <input type="text" class="form-control{{ $errors->has('dni') ? ' is-invalid' : '' }}" name="dni" value="{{ $user->dni ?? '' }}" >
                                            @if ($errors->has('dni'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('dni') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>First Name:</label>
                                            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name ?? '' }}" >
                                            @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>                                            
                                        <div class="form-group col-md-12">
                                            <label>Last Name:</label>
                                            <input type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ $user->last_name ?? '' }}" >
                                            @if ($errors->has('lastname'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('lastname') }}</strong>
                                            </span>
                                            @endif
                                        </div>                                            
                                        <div class="form-group col-md-12">
                                            <label>Surname:</label>
                                            <input type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ $user->surname ?? '' }}" >
                                            @if ($errors->has('surname'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('surname') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Second Surname:</label>
                                            <input type="text" class="form-control{{ $errors->has('second_surname') ? ' is-invalid' : '' }}" name="second_surname" value="{{ $user->second_surname ?? '' }}" >
                                            @if ($errors->has('second_surname'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('second_surname') }}</strong>
                                            </span>
                                            @endif
                                        </div>        
                                        <div class="form-group col-md-12">
                                            <label>Age:</label>
                                            <input type="text" class="form-control{{ $errors->has('age') ? ' is-invalid' : '' }}" name="age" value="{{ $user->age ?? '' }}" >
                                            @if ($errors->has('age'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('age') }}</strong>
                                            </span>
                                            @endif
                                        </div> 
                                        <div class="form-group col-md-12">
                                            <label>Birth Date:</label>
                                            <input type="date" class="form-control{{ $errors->has('birth_date') ? ' is-invalid' : '' }}" name="birth_date" value="{{ $user->birth_date ?? '' }}" >
                                            @if ($errors->has('birth_date'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('birth_date') }}</strong>
                                            </span>
                                            @endif
                                        </div>                                                   
                                        <div class="form-group col-md-12">
                                            <label>Address:</label>
                                            <input type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $user->address ?? '' }}" >
                                            @if ($errors->has('address'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label>Telephone:</label>
                                            <input type="text" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" autocomplete="off" name="telephone" value="{{ $user->telephone ?? '' }}">
                                            @if ($errors->has('telephone'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('telephone') }}</strong>
                                            </span>
                                            @endif
                                        </div>    

                                        <div class="form-group col-md-12">                
                                            <input type="hidden" name="id" value="{{ $user->id ?? '' }}">
                                            <button type="submit" class="btn btn-success btn-lg float-left">
                                                <i class="fas fa-angle-right"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
@endsection