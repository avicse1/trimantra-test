@extends('layout')
@section('content')
<div class="container">
    <a href="{{route('create_category')}}">Add new Category</a>
    <button class="btn btn-danger pull-right">Delete</button>
    <br><br>
    <table class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Serial Number</th>
                <th>Category Name</th>
                <th>Category Image</th>
                <th>Total Products</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach($categories as $category)
                <tr class="table-row">
                    <td>{{$i++}}</td>
                    <td>{{$category->name}}</td>
                    <td><img src="{{asset('images/'.$category->image)}}" width="80"></td>
                    <td>{{$category->products->count()}}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('show_category', $category->id)}}" type="button" class="btn btn-primary">Edit</a>
                            <a href="{{route('delete_category', $category->id)}}" type="button" class="btn btn-danger">Delete</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        
    </table>
</div>
@endsection