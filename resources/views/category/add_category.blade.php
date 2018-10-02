@extends('layout')
@section('content')
<div class="container">
    <h2>
        Add Category
    </h2>
    <form action="{{route('store_category')}}"  method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6 form-group">
            <label>Name</label>
            @if ($errors->has('name'))
            <span class="has-error error-position">{{ $errors->first('name') }}</span>
            @endif
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter category name" value="{{old('name')}}">
        </div>
        <div class="form-group col-md-6">
            <label>Image</label>
            @if ($errors->has('image'))
            <span class="has-error error-position">{{ $errors->first('image') }}</span>
            @endif
            <input class="form-control" type="file" name="image" />
        </div>
        
        <button type="submit" class="btn btn-primary">Add Category</button>
    </form>
</div>
@endsection