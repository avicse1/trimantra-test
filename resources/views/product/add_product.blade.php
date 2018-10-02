@extends('layout')
@section('content')
<div class="container">
    <h2>
        Add Product
    </h2>
    <form action="{{route('store_product')}}"  method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6 form-group">
            <label>Name</label>
            @if ($errors->has('name'))
            <span class="has-error error-position">{{ $errors->first('name') }}</span>
            @endif
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter category name" value="{{old('name')}}">
        </div>
        <div class="col-md-6 form-group">
            <label>Category</label>
            @if ($errors->has('category'))
            <span class="has-error error-position">{{ $errors->first('category') }}</span>
            @endif
            <select class="form-control" name="category" id="category">
                <option value="0">Select category</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div> 
        <div class="col-md-6 form-group">
            <label>Description</label>
            @if ($errors->has('description'))
            <span class="has-error error-position">{{ $errors->first('description') }}</span>
            @endif
            <textarea class="form-control" name="description"cols="30" rows="10"></textarea>
        </div>
        <div class="form-group col-md-6">
            <label>Image</label>
            @if ($errors->has('image'))
            <span class="has-error error-position">{{ $errors->first('image') }}</span>
            @endif
            <input class="form-control" type="file" name="image" />
        </div>
        <div class="col-md-12">      
            <button type="submit" class="btn btn-primary">Add Product</button>
        </div>
    </form>
</div>
@endsection