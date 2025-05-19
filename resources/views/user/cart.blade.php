@extends('user.layouts.app')




@section('link')
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet" />
   <link href="{{ asset('assets/css/cartStyle.css') }}" rel="stylesheet">


@endsection
    

@section('content')




<section>
    <div class="container">

      

       <div class="cart">


         <center>
            @if (Session::has('success'))
                  <div class="col-md-8 " style="">
                     <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {!! Session::get('success') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>
                  </div>
            @endif



            @if (Session::has('error'))
                  <div class="col-md-8 ">
                     <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ Session::get('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>
                  </div>
            @endif
         </center>





         <div class="col-md-12 col-lg-10 mx-auto">


            @if (Cart::count() > 0)

            @foreach ($cartContant as $item)
                  <div class="cart-item">
                     <div class="row">
                        <div class="col-md-7 center-item">
                           @if (!empty($item->options->productImage->image))
                              <img src="{{ asset('uploads/product/'.$item->options->productImage->image)}}"  >
                              @else   
                              <img src="{{ asset('assets/img/default-150x150.png') }}" alt="">
                              @endif
                           {{-- <img src="{{ asset('assets/img/product-1.png') }}" alt=""> --}}
                           <a href="{{ route('user.shop',$item->name) }}" style="text-decoration: none; color: #000"><h5>{{ $item->name }}</h5></a>
                        </div>

                        <div class="col-md-5 center-item">
                           <div class="input-group number-spinner">

                              <div class="p-1">
                                 <button id="phone-minus" class="btn btn-default sub" data-id="{{ $item->rowId }}"><i class="fas fa-minus"></i></button>
                              </div>

                               <input type="text" readonly class="form-control text-center" value="{{ $item->qty }}">

                              <div class="p-1">
                                 <button id="phone-plus" class="btn btn-default add" data-id="{{ $item->rowId }}"><i class="fas fa-plus"></i></button>
                              </div>

                           </div>
                           <h5>$ <span id="phone-total">{{ $item->price }}</span> </h5>

                              <img onclick="deleteItem('{{ $item->rowId }}');" src="{{ asset('assets/img/remove.png') }}" alt="" class="remove-item" style="cursor: pointer">

                        </div>
                     </div>
                  </div>
            @endforeach







               <div class="cart-item">
                  <div class="row g-2">

                     <div class="col-6">
                        @foreach ($cartContant as $item)
                           <h5>{{ $item->name }}: x{{ $item->qty }}</h5>
                        @endforeach
                        <h5>Total:</h5>
                     </div>

                     <div class="col-6 status">
                        @foreach ($cartContant as $item)
                           <h5>${{ number_format($item->price * $item->qty,2) }}</h5>
                        @endforeach
                        <h5>$<span id="sub-total">{{ Cart::subtotal()}}</span></h5>
                     </div>
                     
                  </div>
               </div>
               <div class="col-md-12 pt-4 pb-4">   
                     <a href="{{ route('user.checkout') }}" class="btn btn-success check-out">
                        Check Out
                     </a>
               </div>
            </div>
         </div>


         @else

         <div class="col-md-12">
            <div class="card" style="background: #E3E6F3">
                  <div class="card-body d-flex justify-content-center align-items-center">
                     <h4>Your Cart is empty!</h4>
                  </div>
            </div>
         </div>

      @endif

    </div>

 </section>
 
 @endsection
 
 
 
 
 
@section('customJs')
    <script src="{{ asset('assets/js/cart.js') }}"></script>
    <script>


      function deleteItem(rowId){
         if(confirm("Are you sure you want to delete?")){
               $.ajax({
                  url: '{{ route("front.deleteItem.cart") }}',
                  type: 'post',
                  data: {rowId:rowId},
                  dataType: 'json',
                  success: function(response) {
                           // console.log('hi');
                           window.location.href = "{{ route('front.cart') }}";
                  }
               });
         }
      }


      
      // +1
      function updateCart(rowId,qty){
         $.ajax({
               url: '{{ route("front.updateCart") }}',
               type: 'post',
               data: {rowId:rowId , qty:qty},
               dataType: 'json',
               success: function(response) {
                     // console.log('hi');
                  window.location.href = "{{ route('front.cart') }}";

               }
         });
      }
      // +1
      $('.add').click(function(){
         var qtyElement = $(this).parent().prev(); // Qty Input
         var qtyValue = parseInt(qtyElement.val());
         qtyElement.val(qtyValue+1);
         

         var rowId = $(this).data('id');
         var newQty =  qtyElement.val();

         // console.log(qtyValue); 

         updateCart(rowId,newQty)
      });


      // -1
      $('.sub').click(function(){
         var qtyElement = $(this).parent().next(); 
         var qtyValue = parseInt(qtyElement.val());
         if (qtyValue > 1) {
               qtyElement.val(qtyValue-1);

               var rowId = $(this).data('id');
               var newQty =  qtyElement.val();

               updateCart(rowId,newQty)
         }        
      });




    </script>
@endsection


