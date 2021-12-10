@extends('LayoutsDashboard.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">List Products</div>
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-2">
                                <a href="{{ route('listForm') }}" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Add New
                                </a>
                            </div>
                            <div class="col-md-5">
                            </div>
                            <div class="col-md-5">
                            </div>                            
                        </div>  
                        <div class="row">
                            <table class="table table-hover table-striped">                              
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Product Manager</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Product Type</th>
                                        <th scope="col">Product Quantity</th>
                                        <th scope="col">Product Price</th>
                                        <th scope="col">Total Product Value</th>
                                        <th scope="col">Status</th>
                                        <th scope="col" colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($count == 0)
                                        <tr colspan="9">
                                            <td>No Records</td>
                                        </tr>
                                    @else
                                        @foreach($products as $i)
                                            <tr>
                                                <td>{{ $i->id }}</td>
                                                <td>{{ $i->user_id }}</td>
                                                <td>{{ $i->product_name }}</td>
                                                <td>{{ $i->product_type }}</td>
                                                <td>{{ $i->product_quantity }}</td>
                                                <td>${{$i->product_price}} </td>
                                                <td>${{ $i->price }}</td>
                                                <td style="text-align: center;">
                                                    @if($i->status==1) 
                                                        <span class="btn btn-success">Active</span>
                                                    @else
                                                        <span class="btn btn-danger">Inactive</span>
                                                    @endif 
                                                </td>                                                
                                                <td style="text-align: center;">
                                                    <a href="{{ url('edit/' . $i->id) }}" class="btn btn-warning">Edit</a>                                                
                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="{{ url('delete/' . $i->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>                                               
                                                </td>                                                
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
@endsection