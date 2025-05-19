@extends('user.layouts.app')


@section('link')





@endsection

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css2/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css2/slick-theme.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css2/ion.rangeSlider.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css2/style.css')}}" />

@section('content')


 

<section class=" section-11 ">
    <div class="container  mt-5">
        <div class="row">
            <div class="col-md-3">
                @include('account.common.sidebar')
            </div>
            <div class="col-md-9">
                <div class="card">

                    <div class="card-header">
                        <h2 class="h5 mb-0 pt-2 pb-2">My Wishlist</h2>
                    </div>
 

                    <div class="card-body p-4">

                        @if ($wishlists->isNotEmpty())
                            @foreach ($wishlists as $wishlist)
                                <div class="d-sm-flex justify-content-between mt-lg-4 mb-4 pb-3 pb-sm-2 border-bottom">
                                    <div class="d-block d-sm-flex align-items-start text-center text-sm-start">
                                        <a class="d-block flex-shrink-0 mx-auto me-sm-4" href="{{ route('user.shop',$wishlist->product->slug) }}" style="width: 10rem;">
                                            @php
                                                $productImage = getProductImage($wishlist->product_id)
                                            @endphp
                                            @if (!empty($productImage))
                                                <img class="card-img-top" src="{{ asset('uploads/product/'.$productImage->image)}}"  >
                                                @else
                                                <img src="{{ asset('admin-assets/img/default-150x150.png')}}"  >
                                            @endif
                                            {{--  --}}
                                            {{-- <img src="images/product-1.jpg" alt="Product"> --}}
                                        </a>
                                        <div class="pt-2">
                                            <h3 class="product-title fs-base mb-2"><a href="{{ route('user.shop',$wishlist->product->slug) }}">{{ $wishlist->product->title }}</a></h3>                                        
                                            <div class="fs-lg text-accent pt-2">
                                                <span class="h5"><strong>${{ $wishlist->product->price}}</strong></span>
                                                @if ( $wishlist->product->compare_prose > 0)
                                                    <span class="h6 text-underline"><del>${{ $wishlist->product->compare_prose}}</del></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                                        <button onclick="removeProduct({{ $wishlist->product_id }})" class="btn btn-outline-danger btn-sm" type="button"><i class="fas fa-trash-alt me-2"></i>Remove</button>
                                    </div>
                                </div>  
                            @endforeach
                            @else
                            <div >
                                <h3 class="h5">Your wishlist is empty!!</h3>
                            </div>
                        @endif


                    </div>

                </div>
            </div>
        </div>
    </div>
</section>



@php $excludeSection = 'footer'; @endphp


@endsection



@section('customJs')

<script src="{{ asset('assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
 



<script>


function removeProduct(id){
    $.ajax({
        url: '{{ route("account.removeProductFromWishlists") }}', 
        type: 'post',
        data: {id:id},
        datatype: 'json',
        success: function(response){
            if(response.status == true){
                window.location.href = "{{ route('account.wishlist') }}";
            }
            console.log('hrllo .pprrroop');
        }
    });
}



</script>

@endsection
