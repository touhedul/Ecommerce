<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="/admin/images/faces/face1.jpg" alt="profile image">
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">{{Auth::user()->name}}</p>
                  <div>
                    <small class="designation text-muted">Manager</small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
              
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('admin_page.index')}}">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-content-copy"></i>
              <span class="menu-title">Manage Product</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic1">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('admin_page.products')}}">Products</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('admin_page.create')}}">Add Product</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-content-copy"></i>
              <span class="menu-title">Manage Category</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic2">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('categories.index')}}">Categories</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('categories.create')}}">Add Category</a>
                </li>
              </ul>
            </div>
            
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-content-copy"></i>
              <span class="menu-title">Manage Brand</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic3">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('brands.index')}}">Brands</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('brands.create')}}">Add Brand</a>
                </li>
              </ul>
            </div>
            
          </li>


          <li class="nav-item">
            <form class="form-inline" method="POST" action="{{route('admin.logout')}}">
              @csrf
              <button type="submit" class="btn btn-success">Logout</button>
            </form>
          </li>

        </ul>
      </nav>