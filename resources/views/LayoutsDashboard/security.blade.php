@extends('LayoutsDashboard.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Security</div>
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
                                <form method="POST" action="{{ route('savedSecurity') }}">
                                    @csrf
                                    <div class="form-row">          
                                        <div class="form-group col-md-12">
                                            <label>Password:</label>
                                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" value="{{ $user->password ?? '' }}" onclick="init()" onfocusout="inita()">
                                            @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>                                            
                                        <div class="form-group col-md-12">
                                            <label>Confirm Password:</label>
                                            <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" id="password_confirmation" name="password_confirmation" value="{{ $user->password ?? '' }}" onclick="initb()" onfocusout="initc()">
                                            @if ($errors->has('password_confirmation'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                            @endif
                                        </div>                                            
                                        <div class="form-group col-md-12">                
                                            <input type="hidden" name="id" value="{{ $user->id ?? '' }}">
                                            <input type="hidden" name="pass" id="pass" value="{{ $user->password ?? '' }}">
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
<script> 
    function init(){
        let m1 = document.getElementById("password").value;
        if(m1.length > 0) {
            document.getElementById("password").value = '';          
        }
    }
    function inita(){
        let m1 = document.getElementById("password").value;
        if(m1.length == 0) {
            let pass = document.getElementById("pass").value;
            document.getElementById("password").value = pass;            
        }        
    }   
    function initb(){
        let m2 = document.getElementById("password_confirmation").value;
        if(m2.length > 0) {
            document.getElementById("password_confirmation").value = '';            
        }        
    }  
    function initc(){
        let m2 = document.getElementById("password_confirmation").value;
        if(m2.length == 0) {
            let pass = document.getElementById("pass").value;
            document.getElementById("password_confirmation").value = pass;            
        }        
    }            
</script>