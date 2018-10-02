@extends('layout')
@section('content')
<div class="container">
    <a href="{{route('create_product')}}">Add new Product</a><br>
    <label for="">Search</label>
    <div class="col-md-12" style="padding:0">        
        <div class="col-md-3" style="padding:0">
            <input class="form-control" type="text" name="name" id="product_name">
        </div>
        <div class="col-md-3">            
            <select class="form-control" name="category_id" id="category_id">
                <option value="0">Select category</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>            
        </div>
        <div class="col-md-3"><button class="search btn btn-primary">Search</button></div>
        <div class="col-md-3" style="padding:0">
            <button class="btn btn-danger pull-right delete_all" data-url="{{ url('delete-selected-product') }}">Delete</button>
        </div>
    </div>
    
    <br><br><br>
    <table class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th><input type="checkbox" id="master"></th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr class="table-row">
                    <td><input type="checkbox" class="sub_chk" data-id="{{$product->id}}"></td>
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
<script>
$(document).ready(function () {
    $('#master').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $(".sub_chk").prop('checked', true);  
         } else {  
            $(".sub_chk").prop('checked',false);  
         }  
    });

    $('.delete_all').on('click', function(e) {

        var allVals = [];  
        $(".sub_chk:checked").each(function() {  
            allVals.push($(this).attr('data-id'));
        });  


        if(allVals.length <=0)  
        {  
            alert("Please select row.");  
        }  
        else 
        {
            var check = confirm("Are you sure you want to delete this row?");  
            if(check == true)
            {  
                var join_selected_values = allVals.join(","); 
                $.ajax({
                    url: $(this).data('url'),
                    type: 'DELETE',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: 'ids='+join_selected_values,
                    success: function (data) {
                        if (data['success']) {
                            $(".sub_chk:checked").each(function() {  
                                $(this).parents("tr").remove();
                            });
                            alert(data['success']);
                        } else if (data['error']) {
                            alert(data['error']);
                        } else {
                            alert('Whoops Something went wrong!!');
                        }
                    },
                    error: function (data) {
                        alert(data.responseText);
                    }
                });

                $.each(allVals, function( index, value ) {
                    $('table tr').filter("[data-row-id='" + value + "']").remove();
                });
            }
        }  
    });
});

$('.search').click(function(){
    var name = $('#product_name').val();
    var category_id = $('#category_id').val();
    window.location = '/product-list?name=' + name + '&category_id=' + category_id;
})
</script>
@endsection