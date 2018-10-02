@extends('layout')
@section('content')
<div class="container">
    <h2>
        Edit Category
    </h2>
    <form action="{{route('edit_category', $category->id)}}"  method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6 form-group">
            <label>Name</label>
            @if ($errors->has('name'))
            <span class="has-error error-position">{{ $errors->first('name') }}</span>
            @endif
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter category name" value="{{$category->name}}">
        </div>
        <div class="form-group col-md-6">
            <label>Image</label>
            <div class="img-box" style="padding-bottom:40px;">
                <img width="100%" src="{{asset('images/'.$category->image)}}" alt="">
            </div>
            @if ($errors->has('image'))
            <span class="has-error error-position">{{ $errors->first('image') }}</span>
            @endif
            <input class="form-control" type="file" name="image" />
        </div>
        
        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>
@endsection