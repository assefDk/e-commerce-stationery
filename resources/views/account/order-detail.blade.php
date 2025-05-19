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
                     

                   

                    <div class="card-footer p-3">





                        <!-- Heading -->
                        <h6 class="mb-7 h5 mt-4">Order Items ({{$orderItemsCount}})</h6>


                        <!-- Divider -->
                        <hr class="my-3">

                        <!-- List group -->
                        <ul>
                            @foreach ($orderItems as $orderItem)
                                <li class="list-group-item">
                                    <div class="row align-items-center">

                                        <div class="col-4 col-md-3 col-xl-2">
                                            @php
                                                $productImage = getProductImage($orderItem->product_id);
                                            @endphp

                                            @if (!empty($productImage->image))
                                                <img class="img-fluid" src="{{ asset('uploads/product/'.$productImage->image)}}"  >
                                            @else
                                                <img class="img-fluid" src="{{ asset('admin-assets/img/default-150x150.png')}}"  >
                                            @endif
                                        </div>

                                        <div class="col">
                                            <!-- Title -->
                                            <p class="mb-4 fs-sm fw-bold">
                                                <a class="text-body" href="product.html">{{ $orderItem->name }} x {{ $orderItem->qty  }}</a> <br>
                                                <span class="text-muted">${{ $orderItem->total }}  </span>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>                      
                </div>
                
                <div class="card card-lg mb-5 mt-3">
                    <div class="card-body">
                        <!-- Heading -->
                        <h6 class="mt-0 mb-3 h5">Order Total</h6>

                        <!-- List group -->
                        <ul>
                            <li class="list-group-item d-flex">
                                <span>Subtotal</span>
                                <span class="ms-auto">${{ number_format($order->subTotal,2)}}</span>
                            </li>
                        </ul>
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






</script>

@endsection
