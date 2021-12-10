@extends('LayoutsDashboard.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Completed Form</div>
                <div class="card-body">
                    <div class="container-fluid">
                    <div class="row">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-5">
                            </div>
                            <div class="col-md-1">
                                <a href="{{ route('listProducts') }}" class="btn btn-info">
                                    <i class="fas fa-plus"></i> Back
                                </a>
                            </div>                            
                        </div>                         
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">                                
                                @if (session('message') !== null)                                
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('message') }}
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('formProducts') }}">
                                    @csrf
                                    <div class="form-row">                                           
                                        <div class="form-group col-md-12">
                                            <label>Product Name:</label>
                                            <input type="text" class="form-control{{ $errors->has('product_name') ? ' is-invalid' : '' }}" name="product_name" 
                                            value="{{ $errors->has('product_name') ? old('product_name') :'' }}{{ $r->product_name ?? '' }}" >
                                            @if ($errors->has('product_name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('product_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>                                         
                                        <div class="form-group col-md-12">
                                            <label>Product Type:</label>
                                            <select name="product_type" class="form-control">
                                                <option value="1" {{ (isset($r->product_type) && $r->product_type==1) ? 'selected="selected"' : '' }}>Home</option>
                                                <option value="0" {{ (isset($r->product_type) && $r->product_type==0) ? 'selected="selected"' : '' }}>Business</option>
                                            </select>                                            
                                        </div>                                            
                                        <div class="form-group col-md-12">
                                            <label>Product Quantity:</label>
                                            <input type="text" class="form-control{{ $errors->has('product_quantity') ? ' is-invalid' : '' }}" name="product_quantity" 
                                            value="{{ $errors->has('product_quantity') ? old('product_quantity') :'' }}{{ $r->product_quantity ?? '' }}" id="product_quantity" onkeyup="calculate()">
                                            @if ($errors->has('product_quantity'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('product_quantity') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Product Price:</label>
                                            <input type="text" class="form-control{{ $errors->has('product_price') ? ' is-invalid' : '' }}" name="product_price" 
                                            value="{{ $errors->has('product_price') ? old('product_price') :'' }}{{ $r->product_price ?? '' }}" id="product_price" onkeyup="calculate()">
                                            @if ($errors->has('product_price'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('product_price') }}</strong>
                                            </span>
                                            @endif
                                        </div>    
                                        <div class="form-group col-md-12">
                                            <label>Total Product Value:</label>
                                            <input type="text" class="form-control" name="price" 
                                            value="{{ $errors->has('price') ? old('price') :'' }}{{ $r->price ?? '' }}" id="price">                                       
                                        </div>                                                                                    
                                        <div class="form-group col-md-12">
                                            <label>Status:</label>
                                            <select name="status" class="form-control">
                                                <option value="1" {{ (isset($r->status) && $r->status==1) ? 'selected="selected"' : '' }}>Active</option>
                                                <option value="0" {{ (isset($r->status) && $r->status==0) ? 'selected="selected"' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">                
                                            <input type="hidden" name="user_id" value="{{ $user->id ?? '' }}">
                                            <input type="hidden" name="id" value="{{ $r->id ?? '' }}">
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
    window.onload = function() {
        init();
    }
    function init(){
        let m1 = document.getElementById("product_quantity").value;
        let m2 = document.getElementById("product_price").value;
        if(m1.length == 0) {
            document.getElementById("product_quantity").value = 0;          
        }
        if(m2.length == 0) {
            document.getElementById("product_price").value = 0;            
        }        
    }    
    function calculate(){
        let m1 = document.getElementById("product_quantity").value;
        let m2 = document.getElementById("product_price").value;   
        let multi = (m1 * m2); 
        if(isNaN(multi)){
            alert('the product quantity and product price must contain numbers')        
        } else {
            document.getElementById("price").value = multi;
        }
    }
</script>