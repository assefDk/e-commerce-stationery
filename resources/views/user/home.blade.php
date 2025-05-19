@extends('user.layouts.app')

 

@section('content')

    
    <!-- Hero -->
    <section id="hero">
        <h4>Teade-in-offer</h4>
        <h2>Super Value deals</h2>
        <h1>On all products</h1>
        <p>Save move with coupons & up to 70% off!</p>
        <button>Shop Now</button>
    </section>


    <!-- Feature -->
    <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src="{{ asset('assets/img/features/f1.png') }}" alt="">
            <h6>Free Shipping</h6>
        </div>
        <div class="fe-box">
            <img src="{{ asset('assets/img/features/f2.png') }}" alt="">
            <h6>Online Order</h6>
        </div>
        <div class="fe-box">
            <img src="{{ asset('assets/img/features/f3.png') }}" alt="">
            <h6>Save Morey</h6>
        </div>
        <div class="fe-box">
            <img src="{{ asset('assets/img/features/f4.png') }}" alt="">
            <h6>Promotions</h6>
        </div>
        <div class="fe-box">
            <img src="{{ asset('assets/img/features/f5.png') }}" alt="">
            <h6>Happy Sell</h6>
        </div>
        <div class="fe-box">
            <img src="{{ asset('assets/img/features/f6.png') }}" alt="">
            <h6>F24/7 Support</h6>
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
                                    <img src="{{ asset(path: 'assets/img/default-150x150.png') }}" alt="">
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

 

    <!-- New Arrivals -->
    <section id="product1" class="section-p1">
        <h2>New Arrivals</h2>
        <p>summer Collection New Morden Design</p>
        <div class="pro-container">

            @if ($latesProducts->isNotEmpty())
                @foreach ($latesProducts as $product)

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
                            <h5>{{ $product->title }}</h5>
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


                @endforeach
            @endif

        </div>
    </section>

@endsection



@section('customJs')

    <script>
        

        






    </script>
@endsection





