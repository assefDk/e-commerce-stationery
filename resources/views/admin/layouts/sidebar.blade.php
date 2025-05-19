
<!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="{{ request()->is('admin/dashbordadmin') ? 'nav-link' : 'nav-link collapsed' }}"  href="{{ route('admin.dashbord')}}">
          <i class="bi bi-bar-chart"></i>
          <span>Dachbord</span>
        </a>
      </li>


      <li class="nav-item">
        <a class="{{ request()->is('admin/categories') ? 'nav-link' : 'nav-link collapsed' }}"  href="{{ route('category.index')}}">
          <i class="bx bx-spreadsheet"></i>
          <span>Categories</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="{{ request()->is('admin/product') ? 'nav-link' : 'nav-link collapsed' }}"  href="{{ route('product.index') }}">
          <i class="bi bi-bar-chart"></i>
          <span>Products</span>
        </a>
      </li> 
      


      <li class="nav-item">
        <a class="{{ request()->is('admin/orders') ? 'nav-link' : 'nav-link collapsed' }}"  href="{{route('orders.index')}}">
          <i class="bi bi-bar-chart"></i>
          <span>Orders</span>
        </a>
      </li>
      

 




      <li class="nav-item">
        <a class="{{ request()->is('admin/user') ? 'nav-link' : 'nav-link collapsed' }}"  href="{{ route('user.index') }}">
          <i class="bx bxs-group"></i>
          <span>Users</span>
        </a>
      </li>
      

    </ul>

  </aside>
<!-- End Sidebar-->


