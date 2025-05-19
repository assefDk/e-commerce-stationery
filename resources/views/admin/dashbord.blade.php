

@extends('admin.layouts.app')




@section('content')

 

<style>
  .card {
      border-radius: 15px;
      transition: transform 0.3s ease-in-out;
  }
  .card:hover {
      transform: scale(1.05);
  }
  .icon {
      font-size: 2rem;
  }
</style>




<div class="container py-5">
  <div class="row g-4">



      <div class="col-md-6 col-lg-4">
          <div class="card shadow-sm bg-primary text-white">
              <div class="card-body d-flex align-items-center">
                  <i class="bi bi-calendar-month icon me-3"></i>
                  <div>
                      <h5 class="card-title">Total Orders</h5>
                      <p class="card-text fs-4 fw-bold">{{ $totalOrders }}</p>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-md-6 col-lg-4">
          <div class="card shadow-sm bg-success text-white">
              <div class="card-body d-flex align-items-center">
                  <i class="bi bi-calendar-check icon me-3"></i>
                  <div>
                      <h5 class="card-title">Total Customers</h5>
                      <p class="card-text fs-4 fw-bold">{{ $totalCustomers }}</p>
                  </div>
              </div>
          </div>
      </div>

  


       <div class="col-md-6 col-lg-4">
          <div class="card shadow-sm bg-danger text-white">
              <div class="card-body d-flex align-items-center">
                  <i class="bi bi-calendar-week icon me-3"></i>
                  <div>
                      <h5 class="card-title">Revenue Last Month</h5>
                      <p class="card-text fs-4 fw-bold">${{ number_format($revenueLastMonth,2) }}</p>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-md-6 col-lg-4">
          <div class="card shadow-sm bg-info text-dark">
              <div class="card-body d-flex align-items-center">
                  <i class="bi bi-bar-chart-line icon me-3"></i>
                  <div>
                      <h5 class="card-title">Revenue This Month</h5>
                      <p class="card-text fs-4 fw-bold">${{ number_format($revenueThisMonth,2) }}</p>
                  </div>
              </div>
          </div>
      </div>



      
      <div class="col-md-6 col-lg-4">
          <div class="card shadow-sm bg-secondary text-white">
              <div class="card-body d-flex align-items-center">
                  <i class="bi bi-piggy-bank icon me-3"></i>
                  <div>
                      <h5 class="card-title">Revenue Last Thirty Days</h5>
                      <p class="card-text fs-4 fw-bold">${{ number_format($revenueLastThirtyDays,2) }}</p>
                  </div>
              </div>
          </div>
      </div>


      <div class="col-md-6 col-lg-4">
          <div class="card shadow-sm bg-warning text-dark">
              <div class="card-body d-flex align-items-center">
                  <i class="bi bi-cash-coin icon me-3"></i>
                  <div>
                      <h5 class="card-title">Total Revenue</h5>
                      <p class="card-text fs-4 fw-bold">${{ number_format($totalRevenue,2) }}</p>
                  </div>
              </div>
          </div>
      </div>




  </div>
</div>



  
@endsection





