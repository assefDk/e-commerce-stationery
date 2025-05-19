<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> Register </title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- Google Fonts -->
  {{-- <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> --}}

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet"> 


    {{-- api --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Register to Your Account</h5>
                    <p class="text-center small">Enter your email & password to register</p>
                  </div>


                  @include('message')

                  <form action=" {{ route('processRegister') }}" method="POST" class="row g-3 needs-validation" id="registrationForm" name="registrationForm" >
                    {{-- @csrf --}}

                    <div class="col-12">
                        <label for="yourUsername" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control " id="name">
                        <p></p>
                     
                    </div>


                    <div class="col-12">
                        <label for="yourUsername" class="form-label">Email</label>
                        <input type="text" name="email" class="form-control " id="email">
                        <p></p>
                       
                    </div>


                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control " id="password" >
                      <p></p>
                       
                    </div>

                    <div class="col-12">
                        <label for="yourPassword" class="form-label">Password Confirmed</label>
                        <input type="password" name="password_confirmation" class="form-control " id="password_confirmation" >
                        
                    </div>

                    
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Register</button>
                    </div>
                    <div class="col-12">
                        <p class="small mb-0">I have account? <a href="{{ route('login') }}">Login now</a></p>
                    </div>
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main>




    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script> --}}

    
  <script>
    // api
	$.ajaxSetup({
	headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

    $('#registrationForm').submit(function(event){
            event.preventDefault();

            $("button[type='submit']").prop('disabled',true);


            $.ajax({
                url: '{{ route("processRegister") }}',
                type: 'post',
                data: $(this).serializeArray(),
                dataType: 'json',
                success:function(response){

                    $("button[type='submit']").prop('disabled',false);


                    var errors = response.errors;
                    // console.log(errors);

                    
                    if(response.status == false){

                        if(errors.name){
                            $('#name').siblings("p").addClass('invalid-feedback').html(errors.name);
                            $('#name').addClass('is-invalid');
                        } else{
                            $('#name').siblings("p").removeClass('invalid-feedback').html('');
                            $('#name').removeClass('is-invalid');
                        }



                        if(errors.email){
                            $('#email').siblings("p").addClass('invalid-feedback').html(errors.email);
                            $('#email').addClass('is-invalid');
                        } else{
                            $('#email').siblings("p").removeClass('invalid-feedback').html('');
                            $('#email').removeClass('is-invalid');
                        }

                        
                        if(errors.password){
                            $('#password').siblings("p").addClass('invalid-feedback').html(errors.password);
                            $('#password').addClass('is-invalid');
                        } else{
                            $('#password').siblings("p").removeClass('invalid-feedback').html('');
                            $('#password').removeClass('is-invalid');
                        }


                    } else {
                        $('#name').siblings("p").removeClass('invalid-feedback').html('');
                        $('#name').removeClass('is-invalid');

                        $('#email').siblings("p").removeClass('invalid-feedback').html('');
                        $('#email').removeClass('is-invalid');

                        $('#password').siblings("p").removeClass('invalid-feedback').html('');
                        $('#password').removeClass('is-invalid');


                        window.location.href = '{{ route("login") }}';
                        
                    }



                    
                },
                error: function(JQXHR,exeption){
                    console.log("Something went wrong");
                }

            })


        });


  </script>

</body>
</html>