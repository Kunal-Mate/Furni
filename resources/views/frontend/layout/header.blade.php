<header class="navbar-sticky sticky-top container z-fixed px-2 mt-4" data-sticky-element="">
  <!-- Top Header Row (Logo + Togglers) -->
  <div class="navbar navbar-expand-lg flex-nowrap bg-body rounded-pill shadow ps-0 mx-1 main-header justify-content-between">
    <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark rounded-pill z-0 d-none d-block-dark"></div>

    <!-- Mobile toggler -->
    <button type="button" class="navbar-toggler ms-3" data-bs-toggle="offcanvas" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Logo -->
    <a class="navbar-brand position-relative z-1 ms-4 ms-sm-5 ms-lg-4 me-2 me-sm-0 me-lg-3"
      href="{{ route('index') }}">Sitwell Chairs</a>

    <!-- Icons / Cart / Account -->
    <div class="d-flex gap-sm-1 position-relative z-1">
      <!-- Theme switcher (light/dark/auto) -->
      <div class="dropdown">
        <button type="button"
          class="theme-switcher btn btn-icon btn-outline-secondary fs-lg border-0 rounded-circle animate-scale"
          data-bs-toggle="dropdown" data-bs-display="dynamic" aria-expanded="false" aria-label="Toggle theme (light)">
          <span class="theme-icon-active d-flex animate-target">
            <i class="ci-sun"></i>
          </span>
        </button>
        <ul class="dropdown-menu start-50 translate-middle-x"
          style="--cz-dropdown-min-width: 9rem; --cz-dropdown-spacer: 1rem">
          <li>
            <button type="button" class="dropdown-item active" data-bs-theme-value="light" aria-pressed="true">
              <span class="theme-icon d-flex fs-base me-2">
                <i class="ci-sun"></i>
              </span>
              <span class="theme-label">Light</span>
              <i class="item-active-indicator ci-check ms-auto"></i>
            </button>
          </li>
          <li>
            <button type="button" class="dropdown-item" data-bs-theme-value="dark" aria-pressed="false">
              <span class="theme-icon d-flex fs-base me-2">
                <i class="ci-moon"></i>
              </span>
              <span class="theme-label">Dark</span>
              <i class="item-active-indicator ci-check ms-auto"></i>
            </button>
          </li>
          <li>
            <button type="button" class="dropdown-item" data-bs-theme-value="auto" aria-pressed="false">
              <span class="theme-icon d-flex fs-base me-2">
                <i class="ci-auto"></i>
              </span>
              <span class="theme-label">Auto</span>
              <i class="item-active-indicator ci-check ms-auto"></i>
            </button>
          </li>
        </ul>
      </div>

      <!-- Cart button -->
      <button type="button" class="btn btn-icon fs-lg btn-outline-secondary border-0 rounded-circle animate-scale me-2"
        data-bs-toggle="offcanvas" data-bs-target="#shoppingCart" aria-controls="shoppingCart"
        aria-label="Shopping cart">
        <i class="ci-shopping-cart animate-target"></i>
      </button>

      <!-- Search -->
      <div class="dropdown">
        <button type="button" class="btn btn-icon fs-lg btn-secondary rounded-circle animate-scale"
          data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-label="Toggle search bar">
          <i class="ci-search animate-target"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-end p-3"
          style="--cz-dropdown-min-width: 20rem; --cz-dropdown-spacer: 1rem">
          <form class="position-relative">
            <input type="search" class="form-control rounded-pill" placeholder="Search..." data-autofocus="dropdown">
            <button type="submit"
              class="btn btn-icon btn-sm fs-lg btn-secondary rounded-circle position-absolute top-0 end-0 mt-1 me-1"
              aria-label="Search">
              <i class="ci-arrow-right"></i>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- SECOND ROW: Desktop Navigation Row -->
  <div class="desktop-nav-row-container d-none d-lg-flex justify-content-center mt-2">
    <div class="desktop-nav-row bg-body shadow-sm rounded-pill py-2 px-4">
      <ul class="navbar-nav flex-row gap-4">

        <li class="nav-item">
          <a class="nav-link fs-sm" href="{{ url('/') }}">Home</a>
        </li>
        @foreach($categories as $cat)
          <li class="nav-item me-lg-n2 me-xl-0">
            <a class="nav-link fs-sm" href="{{ url('category/' . $cat->catName) }}">
              {{ $cat->catName }}
            </a>
          </li>
        @endforeach

        <li class="nav-item">
          <a class="nav-link fs-sm" href="{{ url('/contact') }}">Contact Us</a>
        </li>

      </ul>
    </div>
  </div>

  <!-- MOBILE OFFCANVAS (unchanged) -->
  <nav class="offcanvas offcanvas-start" id="navbarNav" tabindex="-1">
    <div class="offcanvas-header py-3">
      <h5 class="offcanvas-title">Sitwell Chairs</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body pt-3 pb-4 mx-lg-auto">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link fs-sm" href="{{ url('/') }}">Home</a></li>

        @foreach($categories as $cat)
          <li class="nav-item me-lg-n2 me-xl-0">
            <a class="nav-link fs-sm" href="{{ url('category/' . $cat->catName) }}">
              {{ $cat->catName }}
            </a>
          </li>
        @endforeach



        <li class="nav-item"><a class="nav-link fs-sm" href="{{ url('/contact') }}">Contact Us</a></li>
      </ul>
    </div>
  </nav>
</header>