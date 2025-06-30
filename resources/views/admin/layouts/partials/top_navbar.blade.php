<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="index3.html" class="nav-link">{{trans('Home')}}</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">{{trans('Contact')}}</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
    <li class="nav-item">
      <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search"></i>
      </a>
      <div class="navbar-search-block">
        <form class="form-inline">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li>
    {{-- Component Language Switcher --}}
    <li class="nav-item mt-1">
      @include('components.language-switcher')
    </li>
    <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
          <!-- User Image -->
            @if (auth()->user()->profile_image)
                <img src="{{asset(assetUrl().'uploads/user/'.auth()->user()->profile_image)}}" alt="image"
                    class="user-image img-circle elevation-2" width="50" height="50" onerror="this.onerror=null;this.src='{{ assetUrl() }}assets/backend/dist/img/user2-160x160.jpg';">
            @else
                <img src="{{ assetUrl() }}assets/backend/dist/img/user2-160x160.jpg" alt="image"
                    class="user-image img-circle elevation-2" width="50" height="50">
            @endif

          <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
          <!-- User image -->
          <li class="user-header bg-primary">
            @if (auth()->user()->profile_image)
                <img src="{{asset(assetUrl().'uploads/user/'.auth()->user()->profile_image)}}" alt="image"
                    class="img-circle elevation-2" width="160" height="160" onerror="this.onerror=null;this.src='{{ assetUrl() }}assets/backend/dist/img/user2-160x160.jpg';">
            @else
                <img src="{{ assetUrl() }}assets/backend/dist/img/user2-160x160.jpg" alt="image"
                    class="img-circle elevation-2" width="160" height="160">
            @endif

            <p>
              {{ auth()->user()->name }} - {{ auth()->user()->roles->first()->title ?? '' }}
              <small>Member since {{ optional(auth()->user())->created_at?->format('M. Y') }}</small>
            </p>
          </li>
          <!-- Menu Body -->

          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="#" class="btn btn-default btn-flat">Profile</a>
            <!-- <a href="#" class="btn btn-default btn-flat float-right">Sign out</a> -->

                <a href="#" class="btn btn-default btn-flat float-right"
                    onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <!-- <i class="nav-icon fas fa-fw fa-sign-out-alt"></i> -->
                    <p>
                        {{ trans('Logout') }}
                    </p>
                </a>
                <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
          </li>
        </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
        <i class="fas fa-th-large"></i>
      </a>
    </li>
  </ul>
</nav>
