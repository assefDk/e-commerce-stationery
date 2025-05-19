@extends('user.layouts.app')






@section('content')


<section class="section-p1" id="prodetails">
    <div class="single-pro-image">


        @php
            $proImageAll = $product->product_images->all();
            $proImage = $proImageAll[0];
        @endphp
                    

        <img src="{{ asset('uploads/product/'.$proImage->image) }}" width="100%" id="MainImg" alt="">

        <div class="small-img-group">

            @if(!empty($proImageAll[1]))
                @foreach ($proImageAll as $img)
                    <div class="small-img-col">
                        <img src="{{ asset('uploads/product/'.$img->image) }}" width="100%" class="small-img" alt="">
                    </div>
                @endforeach
            @endif
        </div>
    </div>


    <div class="single-pro-details">
        <h6><a href="{{route('user.home')}}" style="text-decoration: none;color:#000;cursor: pointer;">Home</a> / Shop</h6>
        <h4>{{ $product->title }}</h4>

        <h2>${{ number_format($product->price,2)}}</h2>

        {{-- <input type="number" value="1"> --}}


        <a href="javascript:void(0);" onclick="addToCart({{ $product->id }});">
            <button class="normal">Add To Cart</button>
        </a>

        <h4>Product Details</h4>
        <span>{{ $product->description }}</span>
    </div>
</section>




    <!-- Featured Products -->
    <section id="product1" class="section-p1">
        <h2>Featured Products</h2>
        <p>summer Collection New Morden Design</p>
        <div class="pro-container">

            @if ($featuredProducts->isNotEmpty())
                @foreach ($featuredProducts as $product)
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
  


        </div>
    </section>




@endsection




@section('customJs')
    <script>

        var MainImg = document.getElementById('MainImg');
        var smallimg = document.getElementsByClassName('small-img');


        smallimg[0].onclick = function(){
            MainImg.src = smallimg[0].src;
        }
        smallimg[1].onclick = function(){
            MainImg.src = smallimg[1].src;
        }
        smallimg[2].onclick = function(){
            MainImg.src = smallimg[2].src;
        }
        smallimg[3].onclick = function(){
            MainImg.src = smallimg[3].src;
        }
        smallimg[4].onclick = function(){
            MainImg.src = smallimg[4].src;
        }

    </script>
@endsection


