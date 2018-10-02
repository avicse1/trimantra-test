@extends('layout')
@section('content')
<div class="container">
    <a href="{{route('create_product')}}">Add new Category</a>
    <button class="btn btn-danger pull-right">Delete</button>
    <br><br>
    <table class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Serial Number</th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach($products as $product)
                <tr class="table-row">
                    <td>{{$i++}}</td>
                    <td>{{$product->name}}</td>
                    <td><img src="{{asset('images/'.$product->image)}}" width="80"></td>
                    <td>{{$product->category->name}}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('show_product', $product->id)}}" type="button" class="btn btn-primary">Edit</a>
                            <a href="{{route('delete_product', $product->id)}}" type="button" class="btn btn-danger">Delete</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        
    </table>
</div>
@endsection