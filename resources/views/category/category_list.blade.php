@extends('layout')
@section('content')
<div class="container">
    <a href="{{route('create_category')}}">Add new Category</a>
    <button class="btn btn-danger pull-right delete_all" data-url="{{ url('delete-selected-category') }}">Delete</button>
    <br><br>
    <table class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th><input type="checkbox" id="master"></th>
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
                    <td><input type="checkbox" class="sub_chk" data-id="{{$category->id}}"></td>
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
<script>
    $(document).ready(function () {
        $('#master').on('click', function(e) {
            if($(this).is(':checked',true)) {
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
</script>
@endsection