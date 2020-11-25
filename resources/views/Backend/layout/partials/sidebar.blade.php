  <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="{{ route( 'dashboard' ) }}">
              <span data-feather="home"></span>
              Home Page <span class="sr-only">(current)</span>
            </a>
          </li>

          <span>Category</span>
          <li class="nav-item">
            <a class="nav-link" href="{{ route( 'Category.index' ) }}">
              <span data-feather="file"></span>
              Show all Category
            </a>
              @if(auth()->user()->role_id == 2)
            <a class="nav-link" href="{{ route( 'category.create' ) }}">
              <span data-feather="file"></span>
              Add New Category
            </a>
              @endif
          </li>

          <span>Post</span>
          <li class="nav-item">
            <a class="nav-link" href="{{ route( 'post.index' ) }}">
              <span data-feather="file"></span>
              Show all Post
            </a>
            <a class="nav-link" href="{{ route( 'post.MyAllPostShow' , auth()->user()->user_name) }}">
              <span data-feather="file"></span>
              Show all my Post
            </a>
            <a class="nav-link" href="{{ route( 'post.create' ) }}">
              <span data-feather="file"></span>
              Add new Post
            </a>
          </li>

            @if(auth()->user()->role_id == 2)
            <span>User</span>
            <li class="nav-item">
                <a class="nav-link" href="{{ route( 'User.AllUSer' ) }}">
                    <span data-feather="file"></span>
                    Show all User
                </a>
                <a class="nav-link" href="{{ route( 'User.registration' ) }}">
                    <span data-feather="file"></span>
                     User Create
                </a>
            </li>
          @endif


            <span>Payment</span>
            <li class="nav-item">
                <a class="nav-link" href="{{ route( 'Payment.Category.index' ) }}">
                    <span data-feather="file"></span>
                    Show All Payment Category
                </a>
                @if(auth()->user()->role_id == 2)
                <a class="nav-link" href="{{ route( 'payment.category.create' ) }}">
                    <span data-feather="file"></span>
                    Payment Category Create
                </a>
                @endif
                <a class="nav-link" href="{{ route( 'pay.create' ) }}">
                    <span data-feather="file"></span>
                    Payment Pay
                </a>
            </li>


      </div>
    </nav>
