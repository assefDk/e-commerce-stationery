@extends('user.layouts.app')




@section('link')



<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #eef2f7;
        font-size: 20px;
    }
    .ludk {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .form-container {
        background: #ffffff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
    .form-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #007bff;
        padding-bottom: 10px;
    }
    label {
        display: block;
        margin-top: 15px;
        font-size: 20px;
        text-align: left;
    }
    input, textarea {
        width: 100%;
        padding: 15px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-family: Arial, sans-serif;
        font-size: 20px;
    }
    textarea {
        resize: vertical;
        height: 150px;
    }
    button {
        margin-top: 15px;
        padding: 15px;
        width: 100%;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 20px;
    }
    button:hover {
        background-color: #0056b3;
    }

    .input-error {
        border: 2px solid red;
        background-color: #ffe6e6;
        padding: 8px;
        border-radius: 5px;
    }

    .error-message {
        color: red;
        font-size: 17px;
        margin-top: 5px;
        text-align: left; /* محاذاة النص إلى اليسار */
        display: block;
    }

</style>
 
@endsection
    

@section('content')
 
    <div class="ludk">
        <div class="form-container">
            <div class="form-title" >Please Enter Information</div>
            <form  id="orderForm" name="orderForm" method="post">

                <div>
                    <label for="phone">Phone Number:</label>
                    <input  value="{{ old('phone') }}"  type="tel" id="phone" name="phone" placeholder="Enter your phone number">
                    <p></p>
                </div>

                <div>
                    <label for="address">Address:</label>
                    <textarea value="{{ old('address') }}" id="address" name="address" placeholder="Enter your address" ></textarea>
                    <p></p>
                </div>


                <label for="notes">Notes:</label>
                <textarea id="notes" name="notes" placeholder="notes"></textarea>

                
                <button type="submit">Confirm order</button>
            </form>
        </div>
    </div>


@endsection
 
 
 
 
 
@section('customJs')
    <script>




        
$("#orderForm").submit(function(event){
            event.preventDefault();

            $.ajax({
                url: '{{ route("user.processCheckout") }}', 
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response){

                    var errors = response.errors;
                    // $('button[type="submit"]').prop('disabled',false);
                    


                    if(response.status == true){
                        showSuccessMessage('تمت إضافة الطلب بنجاح');

                        setTimeout(function() {
                            window.location.href = '{{ route("user.home") }}';
                        }, 2000);
                    }else{
                        console.log(response);
    
                        if(errors.address){
                            $("#address").addClass('input-error')
                                .siblings("p")
                                .addClass('error-message')
                                .html(errors.address);
                        }else{
                            $("#address").removeClass('input-error')
                                .siblings("p")
                                .removeClass('error-message')
                                .html('');
                        }
    
                        if(errors.phone){
                            $("#phone").addClass('input-error')
                                .siblings("p")
                                .addClass('error-message')
                                .html(errors.phone);
                        }else{
                            $("#phone").removeClass('input-error')
                                .siblings("p")
                                .removeClass('error-message')
                                .html('');
                        }

                    }

                }

            });
        });
 


    </script>
@endsection


