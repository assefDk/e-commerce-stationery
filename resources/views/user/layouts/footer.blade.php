<footer class="section-p1">
    <div class="col">
        <img class="logo" src="{{ asset('assets/img/logo.png') }}" alt="">
        <h4>Contact</h4>
        
        <p style="color: #fff;"><strong>Address:</strong> Lorem ipsum dolor sit amet consectetur.</p>


        <div class="follow">
            <h4>Follow Us</h4>
            <div class="icon">
                <i class="fab fa-facebook-f"></i>
                <i class="fab fa-twitter"></i>
                <i class="fab fa-instagram"></i>
                <i class="fab fa-pinterest-p"></i>
                <i class="fab fa-youtube"></i>
            </div>
        </div>
    </div>

 
    <div class="col">
        <h4 style="color: #fff;">My Account</h4>
        @if (auth()->check())
            <a href="{{route('account.orders')}}">Profile</a>
            <a href="{{route('account.logout')}}">Logout</a>
        @else
            <a href="{{route('login')}}">Login</a>
            <a href="{{route('register')}}">Register</a>
        @endif
    </div>






    <div class="col install">
        <h4 style="color: #fff;">Install App</h4>
        <p style="color: #fff;">Form Store or Google Play</p>
        <div class="row">
            <img src="{{ asset('assets/img/pay/app.jpg') }}" alt="">
            <img src="{{ asset('assets/img/pay/play.jpg') }}" alt="">
        </div>
        <p style="color: #fff;">Secured Payment Gatways</p>
        <img src="{{ asset('assets/img/pay/pay.png') }}" alt="">
    </div> 
</footer>


<div class="copyright">
    <p>2025  etc -HTML CSS Ecommerce </p>
</div>

