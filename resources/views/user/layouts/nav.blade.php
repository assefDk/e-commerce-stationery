 
<!-- navbar -->
<section id="header">
    <a href="{{ route('user.home') }}"><img src="{{ asset('assets/img/logo.png') }}" alt=""></a>

    <div>
        <ul id="navbar">
            <li><a class="{{ request()->is('/') ? 'active' : '' }}" href="{{ route('user.home') }}">Home</a></li>
            <li><a class="{{ request()->is('shop*') ? 'active' : '' }}" href="#">Shop</a></li>

            
            <li><a class="{{ request()->is('categorie*') ? 'active' : '' }}" href="{{ route('user.categorie') }}">Categories</a></li>

            
 

            @if (auth()->check())

            
                @if(auth()->user()->role === 'admin')
                    <li><a class="{{ request()->is('orders') ? 'active' : '' }}" href="{{ route('admin.dashbord') }}" >Dashbord</a></li>
                    @else
                    <li><a class="{{ request()->is('orders') ? 'active' : '' }}" href="{{ route('account.orders') }}" >profile</a></li>
                @endif
                


            @else
                <li><a href="{{ route('login') }}">login</a></li>
            @endif
            


            {{-- here --}}
                <li id="lg-bag">
                    <a class="{{ request()->is('cart') ? 'active' : '' }}" href="{{ route('front.cart')}}">
                        <i class="fa-solid fa-cart-shopping"></i>   
                    </a>
                </li>
            {{-- EndHere --}}


            <a href="#" id="close"><i class="fa-solid fa-xmark"></i></a>

        </ul>
    </div>
    <div id="mobile">
        <a href="{{ route('front.cart')}}"><i class="fa-solid fa-cart-shopping"></i></a>
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>


<script>
    let profileDropdownList = document.querySelector(".profile-dropdown-list");
    let btn = document.querySelector(".profile-dropdown-btn");

    let classList = profileDropdownList.classList;

    const toggle = () => classList.toggle("active");

    window.addEventListener("click", function (e) {
    if (!btn.contains(e.target)) classList.remove("active");
    });

</script>


