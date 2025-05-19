

@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h4 class="alert-heading">Error!</h4>
        <p>{{ Session::get('error') }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif




@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <h4 class="alert-heading">Seccess!</h4>
        <p>{{ Session::get('success') }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


