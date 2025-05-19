@extends('user.layouts.app')




@section('link')


<style>
    
button,
button:focus {
  font-size: 17px;
  padding: 10px 25px;
  border-radius: 0.7rem;
  border: 2px solid rgb(50, 50, 50);
  border-bottom: 5px solid rgb(50, 50, 50);
  box-shadow: 0px 1px 6px 0px rgb(35, 112, 88);
  transform: translate(0, -3px);
  cursor: pointer;
  transition: 0.2s;
  transition-timing-function: linear;
}

 
</style>


@endsection
 

@section('content')
 
 







 <!-- Featured Products -->
 <section id="product1" class="section-p1">




    <a href="{{ route('user.categorie') }}"><button>All</button></a>
    @foreach ($categories as $categorie)
         <a href="{{ route('user.categorie',$categorie->slug) }}"><button> {{ $categorie->name }}</button></a>
    @endforeach

    <div class="pro-container">

        @if ($products->isNotEmpty())
            @foreach ($products as $product)
                @if($product->qty > 0)

                @php
                    $productImage = $product->product_images->first();
                @endphp
                
                    <div class="pro">


                        <a href="{{ route('user.shop',$product->slug) }}" class="product-img">
                            @if (!empty($productImage->image))
                                <img src="{{ asset('uploads/product/'.$productImage->image) }}" alt="">
                                @else
                                <img src="{{ asset('assets/img/default-150x150.png') }}" alt="">
                            @endif
                        </a>
                        

                        <div class="des">
                            <span>{{ $product->category->name }}</span>
                            <a href="#" style="text-decoration: none"><h5>{{ $product->title }}</h5></a>
                           
                            <h4>${{ $product->price }}</h4>
                        </div>

                         
                        <div style="position: absolute; right: 10px; bottom: 20px; display: flex; gap: 3px; align-items: center;">
                            <!-- أيقونة Wishlist -->
                            <a href="javascript:void(0);" onclick="addToWishlist({{ $product->id }});" class="icon-button love">
                                <i class="fa-solid fa-heart"></i>
                            </a>
                        
                            <!-- أيقونة السلة -->
                            <a href="javascript:void(0);" onclick="addToCart({{ $product->id }});" class="icon-button">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </a>
                        </div>
                        
                    </div>
                    @endif
            @endforeach
            @endif

    </div>
</section>


@endsection
 
 
 
 
@section('customJs')
    <script>


    </script>
@endsection


