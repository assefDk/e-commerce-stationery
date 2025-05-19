@extends('admin.layouts.app')




@section('content')
    <div class="card">
    <div class="card-body">
        <h5 class="card-title">No Labels / Placeholders as labels Form</h5>

        <!-- No Labels Form -->
        <form class="row g-3" method="POST" name="categoryForn" id="categoryForn">
            <div class="col-md-6">
                <input type="text" class="form-control" placeholder="name" name="name" id="name" value="{{ $category->name }}">
                <p></p>
            </div>
            <div class="col-md-6">
                <input readonly type="text" name="slug" id="slug" class="form-control" placeholder="slug" value="{{ $category->slug }}">
                <p></p>
            </div>
            
            <div class="col-md-4">
                <select name="status" id="status" class="form-select">
                    <option value="1"  {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0"  {{ $category->status == 0 ? 'selected' : '' }}>Block</option>
                </select>
                <p></p>
            </div>
            
            <div class="">
                <button type="submit" class="btn btn-primary">update</button>
                <a href="{{ route('category.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
        </form><!-- End No Labels Form -->

    </div>
    </div>
@endsection



@section('customJs')
    


    <script>
        
$("#categoryForn").submit(function(event) {
  event.preventDefault();

  var element = $(this);
  var formData = element.serialize();


  $("button[type=submit]").prop('disabled',true)
  $.ajax({  
    url: '{{ route("category.update",$category->id) }}',
    type: 'put',
    data: formData ,
    dataType: 'json',
    success: function(response) {
        $("button[type=submit]").prop('disabled',false)

        if(response['status'] == true){

            window.location.href= "{{route('category.index')}}";



            $("#name").removeClass('is-invalid')
            .siblings('p')
            .removeClass('invalid-feedback').html('');

            $("#slug").removeClass('is-invalid')
            .siblings('p')
            .removeClass('invalid-feedback').html('');
 
            
        }else{
            var errors = response['errors'];

            if(errors['name']){
                $("#name").addClass('is-invalid')
                .siblings('p')
                .addClass('invalid-feedback').html(errors['name']);
            }else{
                $("#name").removeClass('is-invalid')
                .siblings('p')
                .removeClass('invalid-feedback').html('');
            }

            if(errors['slug']){
                $("#slug").addClass('is-invalid')
                .siblings('p')
                .addClass('invalid-feedback').html(errors['slug']);
            }else{
                $("#slug").removeClass('is-invalid')
                .siblings('p')
                .removeClass('invalid-feedback').html('');
            }
 

            
        }

    },
    error: function(jqXHR, textStatus, errorThrown) {
      console.error("Error creating category:", textStatus, errorThrown);

    }
  });
});

        






        $("#name").change(function(){
        element = $(this);
        
        $("button[type=submit]").prop('disabled',true)
            $.ajax({
                url: '{{ route("getSlug") }}',
                type: 'get',
                data: { name : element.val() } ,
                dataType: 'json',
                success: function(response) {
                    $("button[type=submit]").prop('disabled',false)
            
                    if(response["status"] == true){
                        $("#slug").val(response["slug"]);
                    }
            
            
                }
            });
        });

        
    </script>
@endsection