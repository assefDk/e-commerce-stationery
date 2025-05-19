<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/styleuser.css')}}">
    <title>Ecommerce</title>


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />




    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">




    <style>
        /* تأثير نبض القلب */
        .animate-heart {
            animation: heartBeat 0.5s ease-in-out;
        }

        /* نبض عند الإضافة */
        @keyframes heartBeat {
            0% { transform: scale(1); }
            50% { transform: scale(1.3); }
            100% { transform: scale(1); }
        }

        /* تأثير نبض القلب في الإشعار */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
    </style>


    @yield('link')

    {{-- api --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    @include('user.layouts.nav')


    @yield('content')
    




 

    @if(!isset($excludeSection) || $excludeSection !== 'footer')
        @include('user.layouts.footer')
    @endif

    

    



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    @yield('customJs')


    <script>



        function showSuccessMessage(text) {
            Swal.fire({
                title: 'Added!',
                text: text,
                icon: 'success',
                showConfirmButton: false,  
                timer: 2000, 
                customClass: {  
                    title: 'my-title',
                    content: 'my-content',
                    icon: 'my-icon'
                }
            });
        }



        function showErrorMessage(text) {
            Swal.fire({
                title: 'Error!',
                text: text,
                icon: 'error',
                showConfirmButton: false,  
                timer: 2000, 
                customClass: {  
                    title: 'my-title',
                    content: 'my-content',
                    icon: 'my-icon'
                }
            });
        }

 
        
        // api
        $.ajaxSetup({
        headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function addToCart(id){
		$.ajax({
                url: '{{ route("front.addToCart") }}', 
                type: 'post',
                data: {id:id},
                datatype: 'json',
                success: function(response){
                    if(response.status == true){
                        // window.location.href = "{{ route('user.home') }}";
                        showSuccessMessage('The product has been successfully added to the shopping cart.');
                        console.log("true");

                    } else {
                        // alert(response.message);
                        showErrorMessage(response.message);
                        console.log("false");
                    }
                }
            });
        }   

        function addToWishlist(id) {
            let button = $(`#wishlist-btn-${id}`); 
            button.addClass('animate-heart');  

            $.ajax({
                url: '{{ route("account.addWishlist") }}',
                type: 'post',
                data: { id: id },
                datatype: 'json',
                success: function (response) {
                    if (response.status == true) {
                        console.log('Added to wishlist');


                        Swal.fire({
                            title: '❤️ Added to Wishlist!',
                            html: `<i class="fa fa-heart" style="color: red; font-size: 50px; animation: pulse 1s infinite;"></i><br>${response.message}`,
                            showConfirmButton: false,
                            timer: 2000
                        });

                        
                        setTimeout(() => button.removeClass('animate-heart'), 1000);
                    } else {
                        window.location.href = "{{ route('login') }}";
                    }
                }
            });
        }

        
        
        
        </script>
 
</body>
</html>