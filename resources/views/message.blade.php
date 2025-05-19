@if (!empty(session('success')))
    <div class="alert alert-success " role="alert">
        {{ session('success') }}
    </div>    
@endif

{{-- <div class="alert alert-success " role="alert">
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat, nesciunt voluptas temporibus voluptate unde dolore eum recusandae explicabo tempora alias illum veniam fuga voluptatibus, et doloribus. Ut aliquid inventore excepturi?
</div>     --}}


@if (!empty(session('error')))
    <div class="alert alert-danger " role="alert">
        {{ session('error') }}
    </div>    
@endif


   