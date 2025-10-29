@extends('frontend.layout.app')
@section('content')
  <!-- Breadcrumb -->


  <div class="container pb-5 mb-2 mb-sm-3 mb-lg-4 mb-xl-5">

    <!-- Breadcrumb -->
    <nav class="position-relative pt-3 my-3 my-md-4" aria-label="breadcrumb" style="z-index: 1021">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Catalog with filters on top</li>
      </ol>
    </nav>


    <!-- Page title -->
    <h1 class="h3 position-relative pb-sm-2 pb-md-3" style="z-index: 1021">Shop catalog</h1>


    <!-- Filters -->
    <div class="sticky-top bg-body mb-3 mb-sm-4 d-none" style="margin-top: -4.5rem">
      <div class="row align-items-center pt-5">
        <div class="col-5 col-sm-8 col-md-9 d-flex gap-2 pb-3 mt-4">
          <div class="d-none d-sm-block w-100 me-1">
            <select class="form-select rounded-pill" data-select="{
                                                &quot;classNames&quot;: {
                                                  &quot;containerInner&quot;: &quot;form-select filter-select rounded-pill&quot;
                                                }
                                              }" aria-label="Sorting">
              <option value="">Sort by</option>
              <option value="popular" selected="">Most popular</option>
              <option value="match">Best match</option>
              <option value="new">New arrivals</option>
              <option value="price-asc">Price ascending</option>
              <option value="price-desc">Price descending</option>
            </select>
          </div>
          <div class="dropdown w-100 d-none d-md-block me-1">
            <button type="button"
              class="btn btn-outline-secondary dropdown-toggle filter-select justify-content-between w-100 text-body fw-normal rounded-pill px-3"
              data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">Category
              <span class="ms-1 me-auto" id="categoryCount"></span></button>
            <div class="dropdown-menu w-100 p-3">
              <div class="d-flex flex-column gap-2">
                <div class="form-check m-0">
                  <input type="checkbox" class="form-check-input fs-base" id="living-room" checked=""
                    onclick="updateFilterCount('categoryCount')" data-count-id="categoryCount">
                  <label for="living-room" class="form-check-label d-flex align-items-end">
                    Living room
                    <span class="fs-xs text-body-secondary ps-2 ms-auto">657</span>
                  </label>
                </div>
                <div class="form-check m-0">
                  <input type="checkbox" class="form-check-input fs-base" id="bedroom" checked=""
                    onclick="updateFilterCount('categoryCount')" data-count-id="categoryCount">
                  <label for="bedroom" class="form-check-label d-flex align-items-end">
                    Bedroom
                    <span class="fs-xs text-body-secondary ps-2 ms-auto">528</span>
                  </label>
                </div>
                <div class="form-check m-0">
                  <input type="checkbox" class="form-check-input fs-base" id="kitchen"
                    onclick="updateFilterCount('categoryCount')" data-count-id="categoryCount">
                  <label for="kitchen" class="form-check-label d-flex align-items-end">
                    Kitchen
                    <span class="fs-xs text-body-secondary ps-2 ms-auto">342</span>
                  </label>
                </div>
                <div class="form-check m-0">
                  <input type="checkbox" class="form-check-input fs-base" id="office"
                    onclick="updateFilterCount('categoryCount')" data-count-id="categoryCount">
                  <label for="office" class="form-check-label d-flex align-items-end">
                    Office
                    <span class="fs-xs text-body-secondary ps-2 ms-auto">283</span>
                  </label>
                </div>
                <div class="form-check m-0">
                  <input type="checkbox" class="form-check-input fs-base" id="lighting" checked=""
                    onclick="updateFilterCount('categoryCount')" data-count-id="categoryCount">
                  <label for="lighting" class="form-check-label d-flex align-items-end">
                    Lighting
                    <span class="fs-xs text-body-secondary ps-2 ms-auto">395</span>
                  </label>
                </div>
                <div class="form-check m-0">
                  <input type="checkbox" class="form-check-input fs-base" id="decoration"
                    onclick="updateFilterCount('categoryCount')" data-count-id="categoryCount">
                  <label for="decoration" class="form-check-labe d-flex align-items-endl">
                    Decoration
                    <span class="fs-xs text-body-secondary ps-2 ms-auto">204</span>
                  </label>
                </div>
                <div class="form-check m-0">
                  <input type="checkbox" class="form-check-input fs-base" id="accessories" checked=""
                    onclick="updateFilterCount('categoryCount')" data-count-id="categoryCount">
                  <label for="accessories" class="form-check-label d-flex align-items-end">
                    Accessories
                    <span class="fs-xs text-body-secondary ps-2 ms-auto">190</span>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="dropdown w-100 d-none d-lg-block me-1">
            <button type="button"
              class="btn btn-outline-secondary dropdown-toggle filter-select justify-content-between w-100 text-body fw-normal rounded-pill px-3"
              data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">Type <span
                class="ms-1 me-auto" id="typeCount"></span></button>
            <div class="dropdown-menu w-100 p-3">
              <div class="d-flex flex-column gap-2">
                <div class="form-check m-0">
                  <input type="checkbox" class="form-check-input fs-base" id="armchair"
                    onclick="updateFilterCount('typeCount')" data-count-id="typeCount">
                  <label for="armchair" class="form-check-label d-flex align-items-end">
                    Armchair
                    <span class="fs-xs text-body-secondary ps-2 ms-auto">324</span>
                  </label>
                </div>
                <div class="form-check m-0">
                  <input type="checkbox" class="form-check-input fs-base" id="sofa"
                    onclick="updateFilterCount('typeCount')" data-count-id="typeCount">
                  <label for="sofa" class="form-check-label d-flex align-items-end">
                    Sofa
                    <span class="fs-xs text-body-secondary ps-2 ms-auto">275</span>
                  </label>
                </div>
                <div class="form-check m-0">
                  <input type="checkbox" class="form-check-input fs-base" id="ottoman"
                    onclick="updateFilterCount('typeCount')" data-count-id="typeCount">
                  <label for="ottoman" class="form-check-label d-flex align-items-end">
                    Ottoman
                    <span class="fs-xs text-body-secondary ps-2 ms-auto">117</span>
                  </label>
                </div>
                <div class="form-check m-0">
                  <input type="checkbox" class="form-check-input fs-base" id="bench"
                    onclick="updateFilterCount('typeCount')" data-count-id="typeCount">
                  <label for="bench" class="form-check-label d-flex align-items-end">
                    Bench
                    <span class="fs-xs text-body-secondary ps-2 ms-auto">86</span>
                  </label>
                </div>
                <div class="form-check m-0">
                  <input type="checkbox" class="form-check-input fs-base" id="bed"
                    onclick="updateFilterCount('typeCount')" data-count-id="typeCount">
                  <label for="bed" class="form-check-label d-flex align-items-end">
                    Bed frame
                    <span class="fs-xs text-body-secondary ps-2 ms-auto">263</span>
                  </label>
                </div>
                <div class="form-check m-0">
                  <input type="checkbox" class="form-check-input fs-base" id="lamp"
                    onclick="updateFilterCount('typeCount')" data-count-id="typeCount">
                  <label for="lamp" class="form-check-label d-flex align-items-end">
                    Lamp
                    <span class="fs-xs text-body-secondary ps-2 ms-auto">415</span>
                  </label>
                </div>
                <div class="form-check m-0">
                  <input type="checkbox" class="form-check-input fs-base" id="stool"
                    onclick="updateFilterCount('typeCount')" data-count-id="typeCount">
                  <label for="stool" class="form-check-labe d-flex align-items-end">
                    Stool
                    <span class="fs-xs text-body-secondary ps-2 ms-auto">104</span>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="dropdown w-100 d-none d-xl-block me-1">
            <button type="button"
              class="btn btn-outline-secondary dropdown-toggle filter-select justify-content-between w-100 text-body fw-normal rounded-pill px-3"
              data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">Color
              <span class="ms-1 me-auto" id="colorCount"></span></button>
            <div class="dropdown-menu w-100 p-3">
              <div class="d-flex flex-column gap-2">
                <div class="form-check m-0">
                  <input type="checkbox" class="form-check-input fs-base" id="emerald"
                    onclick="updateFilterCount('colorCount')" data-count-id="colorCount">
                  <label for="emerald" class="form-check-label d-flex align-items-end">
                    <span class="align-self-center rounded-circle border border-2 p-1 me-2"
                      style="--cz-border-color: #32808e; background-color: #32808e"></span>
                    Emerald
                    <span class="fs-xs text-body-secondary ps-2 ms-auto">97</span>
                  </label>
                </div>
                <div class="form-check m-0">
                  <input type="checkbox" class="form-check-input fs-base" id="dark-gray"
                    onclick="updateFilterCount('colorCount')" data-count-id="colorCount">
                  <label for="dark-gray" class="form-check-label d-flex align-items-end">
                    <span class="align-self-center rounded-circle border border-2 p-1 me-2"
                      style="--cz-border-color: #6a6f7b; background-color: #6a6f7b"></span>
                    Dark gray
                    <span class="fs-xs text-body-secondary ps-2 ms-auto">346</span>
                  </label>
                </div>
                <div class="form-check m-0">
                  <input type="checkbox" class="form-check-input fs-base" id="light-gray"
                    onclick="updateFilterCount('colorCount')" data-count-id="colorCount">
                  <label for="light-gray" class="form-check-label d-flex align-items-end">
                    <span class="align-self-center rounded-circle border border-2 p-1 me-2"
                      style="--cz-border-color: #bdc5da; background-color: #bdc5da"></span>
                    Light gray
                    <span class="fs-xs text-body-secondary ps-2 ms-auto">291</span>
                  </label>
                </div>
                <div class="form-check m-0">
                  <input type="checkbox" class="form-check-input fs-base" id="brown"
                    onclick="updateFilterCount('colorCount')" data-count-id="colorCount">
                  <label for="brown" class="form-check-label d-flex align-items-end">
                    <span class="align-self-center rounded-circle border border-2 p-1 me-2"
                      style="--cz-border-color: #af8d6a; background-color: #af8d6a"></span>
                    Brown
                    <span class="fs-xs text-body-secondary ps-2 ms-auto">105</span>
                  </label>
                </div>
                <div class="form-check m-0">
                  <input type="checkbox" class="form-check-input fs-base" id="blue"
                    onclick="updateFilterCount('colorCount')" data-count-id="colorCount">
                  <label for="blue" class="form-check-label d-flex align-items-end">
                    <span class="align-self-center rounded-circle border border-2 p-1 me-2"
                      style="--cz-border-color: #216aae; background-color: #216aae"></span>
                    Blue
                    <span class="fs-xs text-body-secondary ps-2 ms-auto">84</span>
                  </label>
                </div>
                <div class="form-check m-0">
                  <input type="checkbox" class="form-check-input fs-base" id="green"
                    onclick="updateFilterCount('colorCount')" data-count-id="colorCount">
                  <label for="green" class="form-check-label d-flex align-items-end">
                    <span class="align-self-center rounded-circle border border-2 p-1 me-2"
                      style="--cz-border-color: #187c1c; background-color: #187c1c"></span>
                    Green
                    <span class="fs-xs text-body-secondary ps-2 ms-auto">69</span>
                  </label>
                </div>
                <div class="form-check m-0">
                  <input type="checkbox" class="form-check-input fs-base" id="beige"
                    onclick="updateFilterCount('colorCount')" data-count-id="colorCount">
                  <label for="beige" class="form-check-label d-flex align-items-end">
                    <span class="align-self-center rounded-circle border border-2 p-1 me-2"
                      style="--cz-border-color: #bdaB9e; background-color: #bdaB9e"></span>
                    Beige
                    <span class="fs-xs text-body-secondary ps-2 ms-auto">173</span>
                  </label>
                </div>
              </div>
            </div>
          </div>

          <!-- All filters offcanvas toggle -->
          <nav class="nav">
            <a class="nav-link animate-underline px-2" href="#shopFilters" data-bs-toggle="offcanvas"
              aria-controls="shopFilters">
              <i class="ci-filter me-1"></i>
              <span class="animate-target text-nowrap">All filters</span>
            </a>
          </nav>
        </div>

        <!-- Product / room view switcher -->
        <div class="col-7 col-sm-4 col-md-3">
          <ul class="nav nav-underline flex-nowrap justify-content-end" id="viewShwitcher">
            <li class="nav-item" role="presentation">
              <button type="button" class="nav-link active" id="showProduct" role="tab" aria-selected="true">
                Product
              </button>
            </li>

            {{--
            <li class="nav-item" role="presentation">
              <button type="button" class="nav-link" id="showRoom" role="tab" aria-selected="false">
                Room
              </button>
            </li>
            --}}
          </ul>
        </div>
      </div>
    </div>


    <!-- Selected filters -->
    <div class="d-flex flex-wrap align-items-center gap-2 text-nowrap mt-n3 mb-3 mb-lg-4 d-none ">
      <button type="button" class="btn btn-sm btn-secondary rounded-pill me-1">
        <i class="ci-close fs-sm me-1 ms-n1"></i>
        Living room
      </button>
      <button type="button" class="btn btn-sm btn-secondary rounded-pill me-1">
        <i class="ci-close fs-sm me-1 ms-n1"></i>
        Bedroom
      </button>
      <button type="button" class="btn btn-sm btn-secondary rounded-pill me-1">
        <i class="ci-close fs-sm me-1 ms-n1"></i>
        Lighting
      </button>
      <button type="button" class="btn btn-sm btn-secondary rounded-pill me-1">
        <i class="ci-close fs-sm me-1 ms-n1"></i>
        Accessories
      </button>
      <div class="nav ps-1">
        <a class="nav-link fs-xs text-decoration-underline px-0" href="#!">Clear all</a>
      </div>
    </div>




    @foreach($categories as $category)
      @if($category->products->count() > 0)
        <!-- Category Header -->
        <div class="mb-4 ">
          <h4 class="fw-bold border-bottom pb-2 mb-4 text-secondary-emphasis">{{ $category->catName }}</h2>
        </div>

        <!-- Product Grid -->
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 gy-5 mb-4" id="productGrid">
          @foreach($category->products as $product)
            <div class="col">
              <div class="animate-underline mb-sm-2">
                <a class="ratio ratio-1x1 d-block mb-3" href="{{ route('product.details', ['id' => $product->productId]) }}">
                  <img src="{{ asset($product->thumbnail ?? 'frontend/assets/img/shop/placeholder.png') }}"
                    class="hover-effect-target rounded-4 w-100" alt="{{ $product->productName }}">
                </a>

                <h3 class="mb-2">
                  <a class="d-block fs-sm fw-medium text-truncate"
                    href="{{ route('product.details', ['id' => $product->productId]) }}">
                    {{ $product->productName }}
                  </a>
                </h3>

                <div class="h6 mb-3">
                  ₹{{ number_format($product->price, 2) }}
                  @if($product->cuttedPrice)
                    <del class="text-muted fs-sm">₹{{ number_format($product->cuttedPrice, 2) }}</del>
                  @endif
                </div>

                <div class="d-flex gap-2">
                  <button type="button" class="btn btn-dark w-100 rounded-pill px-3">Add to cart</button>
                  <button type="button" class="btn btn-icon btn-secondary rounded-circle" aria-label="Add to wishlist">
                    <i class="ci-heart fs-base"></i>
                  </button>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @endif
    @endforeach

    <!-- Pagination (optional) -->
    <div class="text-center pt-5 mt-md-2 mt-lg-3 mt-xl-4 mb-xxl-3 mx-auto" style="max-width: 306px">
      <p class="fs-sm">Showing {{ $categories->sum(fn($cat) => $cat->products->count()) }} products</p>
      <div class="progress mb-3" role="progressbar" aria-label="Items shown" aria-valuenow="100" aria-valuemin="0"
        aria-valuemax="100" style="height: 4px">
        <div class="progress-bar bg-dark rounded-pill d-none-dark" style="width: 100%"></div>
        <div class="progress-bar bg-light rounded-pill d-none d-block-dark" style="width: 100%"></div>
      </div>
    </div>


    <!-- Product grid -->
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 gy-5 d-none" id="productGrid">

      <!-- Item -->
      <div class="col">
        <div class="animate-underline mb-sm-2">
          <a class="hover-effect-opacity ratio ratio-1x1 d-block mb-3" href="3">
            <img src="{{ asset('frontend/assets/img/shop/furniture/01.png')}}" class="hover-effect-target opacity-100"
              alt="Product">
            <img src="{{ asset('frontend/assets/img/shop/furniture/01-hover.jpg')}}"
              class="position-absolute top-0 start-0 hover-effect-target opacity-0 rounded-4" alt="Room">
          </a>
          <div class="d-flex gap-2 mb-3">
            <input type="radio" class="btn-check" name="colors-1" id="color-1-1" checked="">
            <label for="color-1-1" class="btn btn-color fs-base" style="color: #32808e">
              <span class="visually-hidden">Emerald</span>
              </la bel>
              <input ty pe="radio" class="btn-check" name="colors-1" id="color-1-2">
              <l abel for="color-1-2" class="btn btn-color fs-base" style="color: #767e93">
                <span class="visually-hidden">Bluish gray</span>
                </ label>
                <inp ut type="radio" class="btn-check" name="colors-1" id="color-1-3">
                  <la for="color-1-3" class="btn btn-color fs-base" style="color: #cd8d01">
                    <span class="visually-hidden">Mustard</span>
                  </la bel>
                  </di v>
                  <h3 class="mb-2">
                    <a class="d-block fs-sm fw-medium text-truncate" href="#">
                      <s pan class="animate-target">Soft chair with cushion and wooden legs</s>
                    </a>
                  </h3>
                  <div c lass="h6">$245.00</div>
                  <div class="d-flex gap-2">
                    <button type="button" class="btn btn-dark w-100 rounded-pill px-3">Add to cart</button>
                    <b utton type="button" class="btn btn-icon btn-secondary rounded-circle animate-pulse" ar
                      ia-label="Add to wishlist">
                      <i class="ci-heart fs-base animate-target"></i>
                    </b>
                  </div>
          </div>
        </div>

        <!--   Item -->
        <d iv class="col">
          <div class="animate-underline mb-sm-2">
            <a class="hover-effect-opacity ratio ratio-1x1 d-block mb-3" href="#">
              <img src="{{ asset('frontend/assets/img/shop/furniture/02.png')}}" class="hover-effect-target opacity-100"
                alt="Product">
              <img src="{{ asset('frontend/assets/img/shop/furniture/02-hover.jpg')}}"
                class="position-absolute top-0 start-0 hover-effect-target opacity-0 rounded-4" alt="Room">
            </a>
            <div class="d-flex gap-2 mb-3">
              <input type="radio" class="btn-check" name="colors-2" id="color-2-1" checked="">
              <label for="color-2-1" class="btn btn-color fs-base" style="color: #6a6f7b">
                <span class="visually-hidden">Gray</span>
              </label>
              <input type="radio" class="btn-check" name="colors-2" id="color-2-2">
              <label for="color-2-2" class="btn btn-color fs-base" style="color: #373b42">
                <span class="visually-hidden">Dark gray</span>
              </label>
              <input type="radio" class="btn-check" name="colors-2" id="color-2-3">
              <label for="color-2-3" class="btn btn-color fs-base" style="color: #216aae">
                <span class="visually-hidden">Blue</span>
              </label>
              <input type="radio" class="btn-check" name="colors-2" id="color-2-4">
              <label for="color-2-4" class="btn btn-color fs-base" style="color: #187c1c">
                <span class="visually-hidden">Green</span>
              </label>
            </div>
            <h3 class="mb-2">
              <a class="d-block fs-sm fw-medium text-truncate" href="#">
                <span class="animate-target">Decorative flowerpot with a plant</span>
              </a>
            </h3>
            <div class="h6">$107.50</div>
            <div class="d-flex gap-2">
              <button type="button" class="btn btn-dark w-100 rounded-pill px-3">Add to cart</button>
              <button type="button" class="btn btn-icon btn-secondary rounded-circle animate-pulse"
                aria-label="Add to wishlist">
                <i class="ci-heart fs-base animate-target"></i>
              </button>
            </div>
          </div>
        </d>

        <!-- Item -->
        <div class="col">
          <div class="animate-underline mb-sm-2">
            <a class="hover-effect-opacity ratio ratio-1x1 d-block mb-3" href="#">
              <img src="{{ asset('frontend/assets/img/shop/furniture/03.png')}}" class="hover-effect-target opacity-100"
                alt="Product">
              <img src="{{ asset('frontend/assets/img/shop/furniture/03-hover.jpg')}}"
                class="position-absolute top-0 start-0 hover-effect-target opacity-0 rounded-4" alt="Room">
            </a>
            <div class="d-flex gap-2 mb-3">
              <input type="radio" class="btn-check" name="colors-3" id="color-3-1" checked="">
              <label for="color-3-1" class="btn btn-color fs-base" style="color: #a36540">
                <span class="visually-hidden">Brown</span>
              </label>
              <input type="radio" class="btn-check" name="colors-3" id="color-3-2">
              <label for="color-3-2" class="btn btn-color fs-base" style="color: #f8d7b5">
                <span class="visually-hidden">Beige</span>
              </label>
              <input type="radio" class="btn-check" name="colors-3" id="color-3-3">
              <label for="color-3-3" class="btn btn-color fs-base" style="color: #e0e5eb">
                <span class="visually-hidden">White</span>
              </label>
            </div>
            <h3 class="mb-2">
              <a class="d-block fs-sm fw-medium text-truncate" href="#">
                <span class="animate-target">Home fragrance with the aroma of spices</span>
              </a>
            </h3>
            <div class="h6">$24.00</div>
            <div class="d-flex gap-2">
              <button type="button" class="btn btn-dark w-100 rounded-pill px-3">Add to cart</button>
              <button type="button" class="btn btn-icon btn-secondary rounded-circle animate-pulse"
                aria-label="Add to wishlist">
                <i class="ci-heart fs-base animate-target"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Item -->
        <div class="col">
          <div class="animate-underline mb-sm-2">
            <a class="hover-effect-opacity ratio ratio-1x1 d-block mb-3" href="#">
              <img src="{{ asset('frontend/assets/img/shop/furniture/04.png')}}" class="hover-effect-target opacity-100"
                alt="Product">
              <img src="{{ asset('frontend/assets/img/shop/furniture/04-hover.jpg')}}"
                class="position-absolute top-0 start-0 hover-effect-target opacity-0 rounded-4" alt="Room">
            </a>
            <div class="d-flex gap-2 mb-3">
              <input type="radio" class="btn-check" name="colors-4" id="color-4-1" checked="">
              <label for="color-4-1" class="btn btn-color fs-base" style="color: #384043">
                <span class="visually-hidden">Dark gray</span>
              </label>
              <input type="radio" class="btn-check" name="colors-4" id="color-4-2">
              <label for="color-4-2" class="btn btn-color fs-base" style="color: #bdc5da">
                <span class="visually-hidden">Light gray</span>
              </label>
              <input type="radio" class="btn-check" name="colors-4" id="color-4-3">
              <label for="color-4-3" class="btn btn-color fs-base" style="color: #526f99">
                <span class="visually-hidden">Bluish gray</span>
              </label>
            </div>
            <h3 class="mb-2">
              <a class="d-block fs-sm fw-medium text-truncate" href="#">
                <span class="animate-target">Bed frame light gray 140x200 cm</span>
              </a>
            </h3>
            <div class="h6">$760.00</div>
            <div class="d-flex gap-2">
              <button type="button" class="btn btn-dark w-100 rounded-pill px-3">Add to cart</button>
              <button type="button" class="btn btn-icon btn-secondary rounded-circle animate-pulse"
                aria-label="Add to wishlist">
                <i class="ci-heart fs-base animate-target"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Item -->
        <div class="col">
          <div class="animate-underline mb-sm-2">
            <a class="hover-effect-opacity ratio ratio-1x1 d-block mb-3" href="#">
              <img src="{{ asset('frontend/assets/img/shop/furniture/05.png')}}" class="hover-effect-target opacity-100"
                alt="Product">
              <img src="{{ asset('frontend/assets/img/shop/furniture/05-hover.jpg')}}"
                class="position-absolute top-0 start-0 hover-effect-target opacity-0 rounded-4" alt="Room">
            </a>
            <div class="d-flex gap-2 mb-3">
              <input type="radio" class="btn-check" name="colors-5" id="color-5-1" checked="">
              <label for="color-5-1" class="btn btn-color fs-base" style="color: #3a94b5">
                <span class="visually-hidden">Blue</span>
              </label>
              <input type="radio" class="btn-check" name="colors-5" id="color-5-2">
              <label for="color-5-2" class="btn btn-color fs-base" style="color: #777d7E">
                <span class="visually-hidden">Gray</span>
              </label>
            </div>
            <h3 class="mb-2">
              <a class="d-block fs-sm fw-medium text-truncate" href="#">
                <span class="animate-target">Blue armchair with iron legs</span>
              </a>
            </h3>
            <div class="h6">$220.00</div>
            <div class="d-flex gap-2">
              <button type="button" class="btn btn-dark w-100 rounded-pill px-3">Add to cart</button>
              <button type="button" class="btn btn-icon btn-secondary rounded-circle animate-pulse"
                aria-label="Add to wishlist">
                <i class="ci-heart fs-base animate-target"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Item (sale) -->
        <div class="col">
          <div class="animate-underline mb-sm-2">
            <a class="hover-effect-opacity ratio ratio-1x1 d-block mb-3" href="#">
              <div class="position-absolute top-0 start-0 z-2 mt-2 mt-sm-3 ms-2 ms-sm-3">
                <span class="badge text-bg-danger">-13%</span>
              </div>
              <img src="{{ asset('frontend/assets/img/shop/furniture/06.png')}}" class="hover-effect-target opacity-100"
                alt="Product">
              <img src="{{ asset('frontend/assets/img/shop/furniture/06-hover.jpg')}}"
                class="position-absolute top-0 start-0 hover-effect-target opacity-0 rounded-4" alt="Room">
            </a>
            <div class="d-flex gap-2 mb-3">
              <input type="radio" class="btn-check" name="colors-6" id="color-6-1" checked="">
              <label for="color-6-1" class="btn btn-color fs-base" style="color: #bdaB9e">
                <span class="visually-hidden">Beige</span>
              </label>
              <input type="radio" class="btn-check" name="colors-6" id="color-6-2">
              <label for="color-6-2" class="btn btn-color fs-base" style="color: #d65c46">
                <span class="visually-hidden">Terracotta</span>
              </label>
              <input type="radio" class="btn-check" name="colors-6" id="color-6-3">
              <label for="color-6-3" class="btn btn-color fs-base" style="color: #e0e5eb">
                <span class="visually-hidden">White</span>
              </label>
            </div>
            <h3 class="mb-2">
              <a class="d-block fs-sm fw-medium text-truncate" href="#">
                <span class="animate-target">Loft-style lamp 120x80 cm</span>
              </a>
            </h3>
            <div class="h6">$140.00 <del class="fs-sm fw-normal text-body-tertiary">$160.00</del></div>
            <div class="d-flex gap-2">
              <button type="button" class="btn btn-dark w-100 rounded-pill px-3">Add to cart</button>
              <button type="button" class="btn btn-icon btn-secondary rounded-circle animate-pulse"
                aria-label="Add to wishlist">
                <i class="ci-heart fs-base animate-target"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Item -->
        <div class="col">
          <div class="animate-underline mb-sm-2">
            <a class="hover-effect-opacity ratio ratio-1x1 d-block mb-3" href="#">
              <img src="{{ asset('frontend/assets/img/shop/furniture/07.png')}}" class="hover-effect-target opacity-100"
                alt="Product">
              <img src="{{ asset('frontend/assets/img/shop/furniture/07-hover.jpg')}}"
                class="position-absolute top-0 start-0 hover-effect-target opacity-0 rounded-4" alt="Room">
            </a>
            <div class="d-flex gap-2 mb-3">
              <input type="radio" class="btn-check" name="colors-7" id="color-7-1" checked="">
              <label for="color-7-1" class="btn btn-color fs-base" style="color: #71706c">
                <span class="visually-hidden">Dark gray</span>
              </label>
              <input type="radio" class="btn-check" name="colors-7" id="color-7-2">
              <label for="color-7-2" class="btn btn-color fs-base" style="color: #c1c3b8">
                <span class="visually-hidden">Light gray</span>
              </label>
            </div>
            <h3 class="mb-2">
              <a class="d-block fs-sm fw-medium text-truncate" href="#">
                <span class="animate-target">Chair with a cushion for the legs</span>
              </a>
            </h3>
            <div class="h6">$435.00</div>
            <div class="d-flex gap-2">
              <button type="button" class="btn btn-dark w-100 rounded-pill px-3">Add to cart</button>
              <button type="button" class="btn btn-icon btn-secondary rounded-circle animate-pulse"
                aria-label="Add to wishlist">
                <i class="ci-heart fs-base animate-target"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Item -->
        <div class="col">
          <div class="animate-underline mb-sm-2">
            <a class="hover-effect-opacity ratio ratio-1x1 d-block mb-3" href="#">
              <img src="{{ asset('frontend/assets/img/shop/furniture/08.png')}}" class="hover-effect-target opacity-100"
                alt="Product">
              <img src="{{ asset('frontend/assets/img/shop/furniture/08-hover.jpg')}}"
                class="position-absolute top-0 start-0 hover-effect-target opacity-0 rounded-4" alt="Room">
            </a>
            <div class="d-flex gap-2 mb-3">
              <input type="radio" class="btn-check" name="colors-8" id="color-8-1" checked="">
              <label for="color-8-1" class="btn btn-color fs-base" style="color: #305853">
                <span class="visually-hidden">Green</span>
              </label>
              <input type="radio" class="btn-check" name="colors-8" id="color-8-2">
              <label for="color-8-2" class="btn btn-color fs-base" style="color: #34598f">
                <span class="visually-hidden">Blue</span>
              </label>
            </div>
            <h3 class="mb-2">
              <a class="d-block fs-sm fw-medium text-truncate" href="#">
                <span class="animate-target">Armchair with wooden legs 60x100 cm</span>
              </a>
            </h3>
            <div class="h6">$320.50</div>
            <div class="d-flex gap-2">
              <button type="button" class="btn btn-dark w-100 rounded-pill px-3">Add to cart</button>
              <button type="button" class="btn btn-icon btn-secondary rounded-circle animate-pulse"
                aria-label="Add to wishlist">
                <i class="ci-heart fs-base animate-target"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Item (new) -->
        <div class="col">
          <div class="animate-underline mb-sm-2">
            <a class="hover-effect-opacity ratio ratio-1x1 d-block mb-3" href="#">
              <div class="position-absolute top-0 start-0 z-2 mt-2 mt-sm-3 ms-2 ms-sm-3">
                <span class="badge text-bg-info">New</span>
              </div>
              <img src="{{ asset('frontend/assets/img/shop/furniture/09.png')}}" class="hover-effect-target opacity-100"
                alt="Product">
              <img src="{{ asset('frontend/assets/img/shop/furniture/09-hover.jpg')}}"
                class="position-absolute top-0 start-0 hover-effect-target opacity-0 rounded-4" alt="Room">
            </a>
            <div class="d-flex gap-2 mb-3">
              <input type="radio" class="btn-check" name="colors-9" id="color-9-1" checked="">
              <label for="color-9-1" class="btn btn-color fs-base" style="color: #d8a87c">
                <span class="visually-hidden">Brown</span>
              </label>
              <input type="radio" class="btn-check" name="colors-9" id="color-9-2">
              <label for="color-9-2" class="btn btn-color fs-base" style="color: #373b42">
                <span class="visually-hidden">Dark gray</span>
              </label>
            </div>
            <h3 class="mb-2">
              <a class="d-block fs-sm fw-medium text-truncate" href="#">
                <span class="animate-target">Leather office chair with one leg</span>
              </a>
            </h3>
            <div class="h6">$345.50</div>
            <div class="d-flex gap-2">
              <button type="button" class="btn btn-dark w-100 rounded-pill px-3">Add to cart</button>
              <button type="button" class="btn btn-icon btn-secondary rounded-circle animate-pulse"
                aria-label="Add to wishlist">
                <i class="ci-heart fs-base animate-target"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Item -->
        <div class="col">
          <div class="animate-underline mb-sm-2">
            <a class="hover-effect-opacity ratio ratio-1x1 d-block mb-3" href="#">
              <img src="{{ asset('frontend/assets/img/shop/furniture/10.png')}}" class="hover-effect-target opacity-100"
                alt="Product">
              <img src="{{ asset('frontend/assets/img/shop/furniture/10-hover.jpg')}}"
                class="position-absolute top-0 start-0 hover-effect-target opacity-0 rounded-4" alt="Room">
            </a>
            <div class="d-flex gap-2 mb-3">
              <input type="radio" class="btn-check" name="colors-10" id="color-10-1" checked="">
              <label for="color-10-1" class="btn btn-color fs-base" style="color: #677382">
                <span class="visually-hidden">Navy blue</span>
              </label>
              <input type="radio" class="btn-check" name="colors-10" id="color-10-2">
              <label for="color-10-2" class="btn btn-color fs-base" style="color: #919384">
                <span class="visually-hidden">Gray</span>
              </label>
              <input type="radio" class="btn-check" name="colors-10" id="color-10-3">
              <label for="color-10-3" class="btn btn-color fs-base" style="color: #b2b8c0">
                <span class="visually-hidden">Light gray</span>
              </label>
            </div>
            <h3 class="mb-2">
              <a class="d-block fs-sm fw-medium text-truncate" href="#">
                <span class="animate-target">Navy blue low sofa for relaxation</span>
              </a>
            </h3>
            <div class="h6">$1,250.00</div>
            <div class="d-flex gap-2">
              <button type="button" class="btn btn-dark w-100 rounded-pill px-3">Add to cart</button>
              <button type="button" class="btn btn-icon btn-secondary rounded-circle animate-pulse"
                aria-label="Add to wishlist">
                <i class="ci-heart fs-base animate-target"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Item -->
        <div class="col">
          <div class="animate-underline mb-sm-2">
            <a class="hover-effect-opacity ratio ratio-1x1 d-block mb-3" href="#">
              <img src="{{ asset('frontend/assets/img/shop/furniture/11.png')}}" class="hover-effect-target opacity-100"
                alt="Product">
              <img src="{{ asset('frontend/assets/img/shop/furniture/11-hover.jpg')}}"
                class="position-absolute top-0 start-0 hover-effect-target opacity-0 rounded-4" alt="Room">
            </a>
            <div class="d-flex gap-2 mb-3">
              <input type="radio" class="btn-check" name="colors-11" id="color-11-1" checked="">
              <label for="color-11-1" class="btn btn-color fs-base" style="color: #677382">
                <span class="visually-hidden">Green</span>
              </label>
              <input type="radio" class="btn-check" name="colors-11" id="color-11-2">
              <label for="color-11-2" class="btn btn-color fs-base" style="color: #548294">
                <span class="visually-hidden">Blue</span>
              </label>
            </div>
            <h3 class="mb-2">
              <a class="d-block fs-sm fw-medium text-truncate" href="#">
                <span class="animate-target">Armchair with wooden legs 70x120 cm</span>
              </a>
            </h3>
            <div class="h6">$269.99</div>
            <div class="d-flex gap-2">
              <button type="button" class="btn btn-dark w-100 rounded-pill px-3">Add to cart</button>
              <button type="button" class="btn btn-icon btn-secondary rounded-circle animate-pulse"
                aria-label="Add to wishlist">
                <i class="ci-heart fs-base animate-target"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Item (out of stock) -->
        <div class="col">
          <div class="animate-underline mb-sm-2">
            <a class="hover-effect-opacity ratio ratio-1x1 d-block mb-3 opacity-50 pe-none" href="#">
              <img src="{{ asset('frontend/assets/img/shop/furniture/12.png')}}" class="hover-effect-target opacity-100"
                alt="Product">
              <img src="{{ asset('frontend/assets/img/shop/furniture/12-hover.jpg')}}"
                class="position-absolute top-0 start-0 hover-effect-target opacity-0 rounded-4" alt="Room">
            </a>
            <div class="d-flex gap-2 mb-3">
              <input type="radio" class="btn-check" name="colors-12" id="color-12-1" checked="">
              <label for="color-12-1" class="btn btn-color fs-base" style="color: #af8d6a">
                <span class="visually-hidden">Wooden</span>
              </label>
            </div>
            <h3 class="mb-2">
              <a class="d-block fs-sm fw-medium text-truncate" href="#">
                <span class="animate-target">Wooden shelf for decor elements</span>
              </a>
            </h3>
            <div class="h6">$278.00</div>
            <div class="d-flex gap-2">
              <button type="button" class="btn btn-secondary min-w-0 w-100 rounded-pill px-3">
                <span class="text-truncate">Notify of availability</span>
              </button>
              <button type="button" class="btn btn-icon btn-secondary rounded-circle animate-pulse"
                aria-label="Add to wishlist">
                <i class="ci-heart fs-base animate-target"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Item -->
        <div class="col">
          <div class="animate-underline mb-sm-2">
            <a class="hover-effect-opacity ratio ratio-1x1 d-block mb-3" href="#">
              <img src="{{ asset('frontend/assets/img/shop/furniture/13.png')}}" class="hover-effect-target opacity-100"
                alt="Product">
              <img src="{{ asset('frontend/assets/img/shop/furniture/13-hover.jpg')}}"
                class="position-absolute top-0 start-0 hover-effect-target opacity-0 rounded-4" alt="Room">
            </a>
            <div class="d-flex gap-2 mb-3">
              <input type="radio" class="btn-check" name="colors-13" id="color-13-1" checked="">
              <label for="color-13-1" class="btn btn-color fs-base" style="color: #5b92b0">
                <span class="visually-hidden">Blue</span>
              </label>
              <input type="radio" class="btn-check" name="colors-13" id="color-13-2">
              <label for="color-13-2" class="btn btn-color fs-base" style="color: #e0e5eb">
                <span class="visually-hidden">White</span>
              </label>
              <input type="radio" class="btn-check" name="colors-13" id="color-13-3">
              <label for="color-13-3" class="btn btn-color fs-base" style="color: #373b42">
                <span class="visually-hidden">Black</span>
              </label>
            </div>
            <h3 class="mb-2">
              <a class="d-block fs-sm fw-medium text-truncate" href="#">
                <span class="animate-target">Aluminium foldable desk lamp</span>
              </a>
            </h3>
            <div class="h6">$89.99</div>
            <div class="d-flex gap-2">
              <button type="button" class="btn btn-dark w-100 rounded-pill px-3">Add to cart</button>
              <button type="button" class="btn btn-icon btn-secondary rounded-circle animate-pulse"
                aria-label="Add to wishlist">
                <i class="ci-heart fs-base animate-target"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Item -->
        <div class="col">
          <div class="animate-underline mb-sm-2">
            <a class="hover-effect-opacity ratio ratio-1x1 d-block mb-3" href="#">
              <img src="{{ asset('frontend/assets/img/shop/furniture/14.png')}}" class="hover-effect-target opacity-100"
                alt="Product">
              <img src="{{ asset('frontend/assets/img/shop/furniture/14-hover.jpg')}}"
                class="position-absolute top-0 start-0 hover-effect-target opacity-0 rounded-4" alt="Room">
            </a>
            <div class="d-flex gap-2 mb-3">
              <input type="radio" class="btn-check" name="colors-14" id="color-14-1" checked="">
              <label for="color-14-1" class="btn btn-color fs-base" style="color: #6a6662">
                <span class="visually-hidden">Dark gray</span>
              </label>
              <input type="radio" class="btn-check" name="colors-14" id="color-14-2">
              <label for="color-14-2" class="btn btn-color fs-base" style="color: #b2b8c0">
                <span class="visually-hidden">Light gray</span>
              </label>
            </div>
            <h3 class="mb-2">
              <a class="d-block fs-sm fw-medium text-truncate" href="#">
                <span class="animate-target">Modern lounge couch on wooden frame</span>
              </a>
            </h3>
            <div class="h6">$638.00</div>
            <div class="d-flex gap-2">
              <button type="button" class="btn btn-dark w-100 rounded-pill px-3">Add to cart</button>
              <button type="button" class="btn btn-icon btn-secondary rounded-circle animate-pulse"
                aria-label="Add to wishlist">
                <i class="ci-heart fs-base animate-target"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Item -->
        <div class="col">
          <div class="animate-underline mb-sm-2">
            <a class="hover-effect-opacity ratio ratio-1x1 d-block mb-3" href="#">
              <img src="{{ asset('frontend/assets/img/shop/furniture/15.png')}}" class="hover-effect-target opacity-100"
                alt="Product">
              <img src="{{ asset('frontend/assets/img/shop/furniture/15-hover.jpg')}}"
                class="position-absolute top-0 start-0 hover-effect-target opacity-0 rounded-4" alt="Room">
            </a>
            <div class="d-flex gap-2 mb-3">
              <input type="radio" class="btn-check" name="colors-15" id="color-15-1" checked="">
              <label for="color-15-1" class="btn btn-color fs-base" style="color: #e0e5eb">
                <span class="visually-hidden">White</span>
              </label>
            </div>
            <h3 class="mb-2">
              <a class="d-block fs-sm fw-medium text-truncate" href="#">
                <span class="animate-target">Adjustable hardwire wall sconce</span>
              </a>
            </h3>
            <div class="h6">$74.00</div>
            <div class="d-flex gap-2">
              <button type="button" class="btn btn-dark w-100 rounded-pill px-3">Add to cart</button>
              <button type="button" class="btn btn-icon btn-secondary rounded-circle animate-pulse"
                aria-label="Add to wishlist">
                <i class="ci-heart fs-base animate-target"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Item -->
        <div class="col">
          <div class="animate-underline mb-sm-2">
            <a class="hover-effect-opacity ratio ratio-1x1 d-block mb-3" href="#">
              <img src="{{ asset('frontend/assets/img/shop/furniture/16.png')}}" class="hover-effect-target opacity-100"
                alt="Product">
              <img src="{{ asset('frontend/assets/img/shop/furniture/16-hover.jpg')}}"
                class="position-absolute top-0 start-0 hover-effect-target opacity-0 rounded-4" alt="Room">
            </a>
            <div class="d-flex gap-2 mb-3">
              <input type="radio" class="btn-check" name="colors-16" id="color-16-1" checked="">
              <label for="color-16-1" class="btn btn-color fs-base" style="color: #b2b8c0">
                <span class="visually-hidden">Light gray</span>
              </label>
              <input type="radio" class="btn-check" name="colors-16" id="color-16-2">
              <label for="color-16-2" class="btn btn-color fs-base" style="color: #6a6662">
                <span class="visually-hidden">Dark gray</span>
              </label>
            </div>
            <h3 class="mb-2">
              <a class="d-block fs-sm fw-medium text-truncate" href="#">
                <span class="animate-target">Soft armchair with wooden legs</span>
              </a>
            </h3>
            <div class="h6">$215.00</div>
            <div class="d-flex gap-2">
              <button type="button" class="btn btn-dark w-100 rounded-pill px-3">Add to cart</button>
              <button type="button" class="btn btn-icon btn-secondary rounded-circle animate-pulse"
                aria-label="Add to wishlist">
                <i class="ci-heart fs-base animate-target"></i>
              </button>
            </div>
          </div>
        </div>
      </div>


      <!-- Pagination -->
      <div class="text-center pt-5 mt-md-2 mt-lg-3 mt-xl-4 mb-xxl-3 mx-auto" style="max-width: 306px">
        <p class="fs-sm">Showing 16 from 64</p>
        <div class="progress mb-3" role="progressbar" aria-label="Items shown" aria-valuenow="25" aria-valuemin="0"
          aria-valuemax="100" style="height: 4px">
          <div class="progress-bar bg-dark rounded-pill d-none-dark" style="width: 25%"></div>
          <div class="progress-bar bg-light rounded-pill d-none d-block-dark" style="width: 25%"></div>
        </div>
        <div class="nav justify-content-center">
          <a class="nav-link animate-underline fs-base pt-2 pb-0 px-0" href="#!">
            <span class="animate-target my-1 me-2">Show more</span>
            <i class="ci-chevron-down fs-lg"></i>
          </a>
        </div>
      </div>
    </div>
@endsection