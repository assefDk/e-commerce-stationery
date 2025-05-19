@extends('admin.layouts.app')


 

@section('content')
 
        
        <!-- Table with stripped rows -->
        @include('admin.message')
         
        <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
            <div class="datatable-top">
            <div class="datatable-dropdown">
            </div>
            <div class="datatable-search">
                <button type="button" onclick="window.location.href='{{ route("orders.index") }}'" class="btn btn-default btn-sm btn-success">back </button>
            </div>
        </div>


        {{-- <br> --}}

 

        <div class="container my-4">
            <div class="card shadow-lg">
                <div class="card-body">
                    <!-- عنوان الفاتورة -->
                    <h2 class="text-center text-primary mb-4">Order details</h2>
        
                    <!-- بيانات العميل -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="fw-bold">Customer Information</h5>
                            <p class="mb-1"><strong>Name:</strong> {{ $order->user->name }}</p>
                            <p class="mb-1"><strong>Email:</strong> {{ $order->user->email }}</p>
                            <p class="mb-1"><strong>Phone:</strong> {{ $order->mobile }}</p>
                            <p class="mb-1"><strong>Address:</strong> {{ $order->address }}</p>
                            @if (!empty($order->notes))
                                <p class="mb-1"><strong>Notes:</strong> {{ $order->notes }}</p>
                            @endif
                        </div>
                        <div class="col-md-6 text-md-end">
                            <h5 class="fw-bold">Order Details</h5>
                            <p class="mb-1"><strong>Order ID:</strong> {{ $order->id }}</p>
                            <p class="mb-1"><strong>Date:</strong> {{ \Carbon\Carbon::parse($order->created_at)->format('d M, Y h:i A') }}</p>
                            {{-- <p class="mb-1"><strong>Status:</strong> <span class="badge bg-success">Paid</span></p> --}}
                        </div>
                    </div>
        
                    <!-- جدول المنتجات -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($orderItems as $orderItem)
                                    <tr>
                                        <td>{{ $orderItem->id }}</td>
                                        <td>{{ $orderItem->name }}</td>
                                        <td>{{ $orderItem->qty }}</td>
                                        <td>${{ $orderItem->price }}</td>
                                        <td>${{ $orderItem->total }}</td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
        
                    <!-- الإجمالي والتفاصيل -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6 text-md-end">
                            <h4 class="fw-bold text-danger">Total: ${{ number_format($order->subTotal, 2) }}</h4>
                        </div>
                    </div>
        
                     
                </div>
            </div>
        </div>



        

@endsection



@section('customJs')
<script>

</script>

@endsection

