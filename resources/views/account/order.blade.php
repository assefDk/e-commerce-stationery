@extends('user.layouts.app')


 
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css2/slick.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css2/slick-theme.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css2/ion.rangeSlider.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css2/style.css')}}" />


@section('content')


@php $excludeSection = 'footer'; @endphp

<section class=" section-11 ">
    <div class="container  mt-5">
        <div class="row">
            <div class="col-md-3">
                @include('account.common.sidebar')
            </div>
            <div class="col-md-9">
                <div class="card">

                    <div class="card-header">
                        <h2 class="h5 mb-0 pt-2 pb-2">My Order</h2>
                    </div>

                    <div class="card-body p-4">
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead> 
                                        <tr>
                                            <th>Orders #</th>
                                            <th>Date Purchased</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                        
                                        @if($orders->isNotEmpty())
                                                @foreach ($orders as $order)
                                                <tr>

                                                    <td>
                                                        <a href="{{ route('account.orderDetail',$order->id) }}">{{ $order->id }}</a>
                                                    </td>
                                                    <td> {{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y') }}</td>
                                                    
                                                    <td>${{ number_format($order->subTotal,2)}}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                <td colspan="3">Orders Not Found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>




<br>
<br>

@endsection



@section('customJs')

<script src="{{ asset('assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
 



<script>






</script>

@endsection
