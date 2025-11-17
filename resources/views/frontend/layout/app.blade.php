<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-pwa="true">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">

    <!-- SEO Meta Tags -->
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="Chairs">
    <meta name="keywords"
        content="online shop, e-commerce, online store, market, multipurpose, product landing, cart, checkout, ui kit, light and dark mode, bootstrap, html5, css3, javascript, gallery, slider, mobile, pwa">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="manifest" href="{{ asset('frontend/assets/manifest.json') }}">
    <link rel="icon" type="image/png" href="{{ asset('frontend/assets/app-icons/icon-32x32.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" href="{{ asset('frontend/assets/app-icons/icon-180x180.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Theme switcher (color modes) -->
    <script src="{{ asset('frontend/assets/js/theme-switcher.js') }}"></script>

    <!-- Preloaded local web font (Inter) -->
    <link rel="preload" href="{{ asset('frontend/assets/fonts/inter-variable-latin.woff2') }}" as="font"
        type="font/woff2" crossorigin="">

    <!-- Font icons -->
    <link rel="preload" href="{{ asset('frontend/assets/icons/cartzilla-icons.woff2') }}" as="font" type="font/woff2"
        crossorigin="">
    <link rel="stylesheet" href="{{ asset('frontend/assets/icons/cartzilla-icons.min.css') }}">

    <!-- Vendor styles -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.css') }}">

    <!-- Bootstrap + Theme styles -->
    <link rel="preload" href="{{ asset('frontend/assets/css/theme.min.css') }}" as="style">
    <link rel="preload" href="{{ asset('frontend/assets/css/theme.rtl.min.css') }}" as="style">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/theme.min.css') }}" id="theme-styles">

    <!-- Customizer -->
    <script src="{{ asset('frontend/assets/js/customizer.min.js') }}"></script>

    @yield('customCss')
    @stack('componentStyle')
    <style>
        /* Desktop: show two rows */
.desktop-nav-row {
    transition: opacity 0.3s ease, transform 0.3s ease;
}

/* Hide second row when header sticks after scroll */
.navbar-sticky.is-sticky .desktop-nav-row {
    opacity: 0;
    transform: translateY(-15px);
    pointer-events: none;
}

/* Mobile: keep as offcanvas only */
@media (max-width: 991px) {
    .desktop-nav-row {
        display: none !important;
    }
}

    </style>
</head>


<!-- Body -->

<body>

    <!-- Customizer offcanvas -->
    <div class="offcanvas offcanvas-end d-none" id="customizer" tabindex="-1">
        <div class="offcanvas-header border-bottom">
            <h4 class="h5 offcanvas-title">Customize theme</h4>
            <button class="btn-close" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">

            <!-- Customizer settings -->
            <div class="customizer-collapse collapse show" id="customizerSettings">

                <!-- Colors -->
                <div class="pb-4 mb-2">
                    <div class="d-flex align-items-center mb-3">
                        <i class="ci-paint text-body-tertiary fs-5 me-2"></i>
                        <h5 class="fs-lg mb-0">Colors</h5>
                    </div>
                    <div class="row row-cols-2 g-3" id="theme-colors">
                        <div class="col">
                            <h6 class="fs-sm mb-2">Primary</h6>
                            <div class="color-swatch d-flex border rounded gap-3 p-2" id="theme-primary"
                                data-color-labels="[&quot;theme-primary&quot;, &quot;primary&quot;, &quot;primary-rgb&quot;]">
                                <input type="text" class="form-control bg-transparent border-0 rounded-0 p-1"
                                    value="#f55266">
                                <label for="primary"
                                    class="ratio ratio-1x1 flex-shrink-0 w-100 cursor-pointer rounded-circle"
                                    style="max-width: 38px; background-color: #f55266"></label>
                                <input type="color" class="visually-hidden" id="primary" value="#f55266">
                            </div>
                        </div>
                        <div class="col">
                            <h6 class="fs-sm mb-2">Success</h6>
                            <div class="color-swatch d-flex border rounded gap-3 p-2" id="theme-success"
                                data-color-labels="[&quot;theme-success&quot;, &quot;success&quot;, &quot;success-rgb&quot;]">
                                <input type="text" class="form-control bg-transparent border-0 rounded-0 p-1"
                                    value="#33b36b">
                                <label for="success"
                                    class="ratio ratio-1x1 flex-shrink-0 w-100 cursor-pointer rounded-circle"
                                    style="max-width: 38px; background-color: #33b36b"></label>
                                <input type="color" class="visually-hidden" id="success" value="#33b36b">
                            </div>
                        </div>
                        <div class="col">
                            <h6 class="fs-sm mb-2">Warning</h6>
                            <div class="color-swatch d-flex border rounded gap-3 p-2" id="theme-warning"
                                data-color-labels="[&quot;theme-warning&quot;, &quot;warning&quot;, &quot;warning-rgb&quot;]">
                                <input type="text" class="form-control bg-transparent border-0 rounded-0 p-1"
                                    value="#fc9231">
                                <label for="warning"
                                    class="ratio ratio-1x1 flex-shrink-0 w-100 cursor-pointer rounded-circle"
                                    style="max-width: 38px; background-color: #fc9231"></label>
                                <input type="color" class="visually-hidden" id="warning" value="#fc9231">
                            </div>
                        </div>
                        <div class="col">
                            <h6 class="fs-sm mb-2">Danger</h6>
                            <div class="color-swatch d-flex border rounded gap-2 p-2" id="theme-danger"
                                data-color-labels="[&quot;theme-danger&quot;, &quot;danger&quot;, &quot;danger-rgb&quot;]">
                                <input type="text" class="form-control bg-transparent border-0 rounded-0 p-1"
                                    value="#f03d3d">
                                <label for="danger"
                                    class="ratio ratio-1x1 flex-shrink-0 w-100 cursor-pointer rounded-circle"
                                    style="max-width: 38px; background-color: #f03d3d"></label>
                                <input type="color" class="visually-hidden" id="danger" value="#f03d3d">
                            </div>
                        </div>
                        <div class="col">
                            <h6 class="fs-sm mb-2">Info</h6>
                            <div class="color-swatch d-flex border rounded gap-2 p-2" id="theme-info"
                                data-color-labels="[&quot;theme-info&quot;, &quot;info&quot;, &quot;info-rgb&quot;]">
                                <input type="text" class="form-control bg-transparent border-0 rounded-0 p-1"
                                    value="#2f6ed5">
                                <label for="info"
                                    class="ratio ratio-1x1 flex-shrink-0 w-100 cursor-pointer rounded-circle"
                                    style="max-width: 38px; background-color: #2f6ed5"></label>
                                <input type="color" class="visually-hidden" id="info" value="#2f6ed5">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Direction -->
                <div class="pb-4 mb-2">
                    <div class="d-flex align-items-center pb-1 mb-2">
                        <i class="ci-sort text-body-tertiary fs-lg me-2" style="transform: rotate(90deg)"></i>
                        <h5 class="fs-lg mb-0">Direction</h5>
                    </div>
                    <div class="d-flex align-items-center justify-content-between border rounded p-3">
                        <div class="me-3">
                            <h6 class="mb-1">RTL</h6>
                            <p class="fs-sm mb-0">Change text direction</p>
                        </div>
                        <div class="form-check form-switch m-0">
                            <input type="checkbox" class="form-check-input" role="switch" id="rtl-switch">
                        </div>
                    </div>
                    <div class="alert alert-info p-2 mt-2 mb-0">
                        <div class="d-flex text-body-emphasis fs-xs py-1 pe-1">
                            <i class="ci-info text-info fs-lg mb-2 mb-sm-0" style="margin-top: .125rem"></i>
                            <div class="ps-2">To switch the text direction of your webpage from LTR to RTL, please
                                consult the detailed instructions provided in the relevant section of our documentation.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Border width -->
                <div class="pb-4 mb-2">
                    <div class="d-flex align-items-center pb-1 mb-2">
                        <i class="ci-menu text-body-tertiary fs-lg me-2"></i>
                        <h5 class="fs-lg mb-0">Border width, px</h5>
                    </div>
                    <div class="slider-input d-flex align-items-center gap-3 border rounded p-3" id="border-input">
                        <input type="range" class="form-range" min="0" max="10" step="1" value="1">
                        <input type="number" class="form-control" id="border-width" min="0" max="10" value="1"
                            style="max-width: 5.5rem">
                    </div>
                </div>

                <!-- Rounding -->
                <div class="d-flex align-items-center pb-1 mb-2">
                    <i class="ci-maximize text-body-tertiary fs-lg me-2"></i>
                    <h5 class="fs-lg mb-0">Rounding, rem</h5>
                </div>
                <div class="slider-input d-flex align-items-center gap-3 border rounded p-3">
                    <input type="range" class="form-range" min="0" max="5" step=".05" value="0.5">
                    <input type="number" class="form-control" id="border-radius" min="0" max="5" step=".05" value="0.5"
                        style="max-width: 5.5rem">
                </div>
            </div>

            <!-- Customizer code -->
            <div class="customizer-collapse collapse" id="customizerCode">
                <div class="nav mb-3">
                    <a class="nav-link animate-underline fs-base p-0" href=".html" data-bs-toggle="collapse"
                        aria-expanded="true" aria-controls="customizerSettings customizerCode">
                        <i class="ci-chevron-left fs-lg ms-n1 me-1"></i>
                        <span class="animate-target">Back to settings</span>
                    </a>
                </div>
                <p class="fs-sm pb-1">To apply the provided styles to your webpage, enclose them within a
                    <code>&lt;style&gt;</code> tag and insert this tag into the <code>&lt;head&gt;</code> section of
                    your HTML document after the following link to the main stylesheet:<br><code>&lt;link
                        href="frontend/assets/css/theme.min.css"&gt;</code>
                </p>
                <div class="position-relative bg-body-tertiary rounded overflow-hidden pt-3">
                    <div class="position-absolute top-0 start-0 w-100 p-3">
                        <button type="button" class="btn btn-sm btn-outline-dark w-100"
                            data-copy-text-from="#generated-styles" data-done-label="Code copied">
                            <i class="ci-copy fs-sm me-1"></i>
                            Copy code
                        </button>
                    </div>
                    <pre class="text-wrap bg-transparent border-0 fs-xs text-body-emphasis p-4 pt-5"
                        id="generated-styles"></pre>
                </div>
            </div>
        </div>

        <!-- Offcanvas footer (Action buttons) -->
        <div class="offcanvas-header border-top gap-3 d-none" id="customizer-btns">
            <button type="button" class="btn btn-lg btn-secondary w-100 fs-sm" id="customizer-reset">
                <i class="ci-trash fs-lg me-2 ms-n1"></i>
                Reset
            </button>
            <button class="btn btn-lg btn-primary hiding-collapse-toggle w-100 fs-sm collapsed" type="button"
                data-bs-toggle="collapse" data-bs-target=".customizer-collapse" aria-expanded="false"
                aria-controls="customizerSettings customizerCode">
                <i class="ci-code fs-lg me-2 ms-n1"></i>
                Show code
            </button>
        </div>
    </div>


    <!-- Shopping cart offcanvas -->
    <div class="offcanvas offcanvas-end pb-sm-2 px-sm-2" id="shoppingCart" tabindex="-1"
        aria-labelledby="shoppingCartLabel" style="width: 500px">
        <div class="offcanvas-header py-3 pt-lg-4">
            <h4 class="offcanvas-title" id="shoppingCartLabel">Shopping cart</h4>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body text-center">
            <svg class="d-block mx-auto mb-4" xmlns="http://www.w3.org/2000/svg" width="60" viewBox="0 0 29.5 30">
                <path class="text-body-tertiary"
                    d="M17.8 4c.4 0 .8-.3.8-.8v-2c0-.4-.3-.8-.8-.8-.4 0-.8.3-.8.8v2c0 .4.3.8.8.8zm3.2.6c.4.2.8 0 1-.4l.4-.9c.2-.4 0-.8-.4-1s-.8 0-1 .4l-.4.9c-.2.4 0 .9.4 1zm-7.5-.4c.2.4.6.6 1 .4s.6-.6.4-1l-.4-.9c-.2-.4-.6-.6-1-.4s-.6.6-.4 1l.4.9z"
                    fill="currentColor"></path>
                <path class="text-body-emphasis"
                    d="M10.7 24.5c-1.5 0-2.8 1.2-2.8 2.8S9.2 30 10.7 30s2.8-1.2 2.8-2.8-1.2-2.7-2.8-2.7zm0 4c-.7 0-1.2-.6-1.2-1.2s.6-1.2 1.2-1.2 1.2.6 1.2 1.2-.5 1.2-1.2 1.2zm11.1-4c-1.5 0-2.8 1.2-2.8 2.8a2.73 2.73 0 0 0 2.8 2.8 2.73 2.73 0 0 0 2.8-2.8c0-1.6-1.3-2.8-2.8-2.8zm0 4c-.7 0-1.2-.6-1.2-1.2s.6-1.2 1.2-1.2 1.2.6 1.2 1.2-.6 1.2-1.2 1.2zM8.7 18h16c.3 0 .6-.2.7-.5l4-10c.2-.5-.2-1-.7-1H9.3c-.4 0-.8.3-.8.8s.4.7.8.7h18.3l-3.4 8.5H9.3L5.5 1C5.4.7 5.1.5 4.8.5h-4c-.5 0-.8.3-.8.7s.3.8.8.8h3.4l3.7 14.6a3.24 3.24 0 0 0-2.3 3.1C5.5 21.5 7 23 8.7 23h16c.4 0 .8-.3.8-.8s-.3-.8-.8-.8h-16a1.79 1.79 0 0 1-1.8-1.8c0-1 .9-1.6 1.8-1.6z"
                    fill="currentColor"></path>
            </svg>
            <h6 class="mb-2">Your shopping cart is currently empty!</h6>
            <p class="fs-sm mb-4">Explore our wide range of products and add items to your cart to proceed with your
                purchase.</p>
            <a class="btn btn-dark rounded-pill" href="shop-catalog-furniture.html">Continue shopping</a>
        </div>
    </div>

    <div class="container position-relative d-flex justify-content-between z-1 py-3 d-none">
        <div class="nav animate-underline">
            <span class="text-secondary-emphasis fs-xs me-1">Contact us <span
                    class="d-none d-sm-inline">24/7</span></span>
            <a class="nav-link animate-target fs-xs fw-semibold p-0"
                href="tel:+15053753082">+1&nbsp;50&nbsp;537&nbsp;53&nbsp;082</a>
        </div>
        <a class="text-secondary-emphasis fs-xs text-decoration-none d-none d-md-inline" href="#!">🔥 The Biggest Sale
            Ever 50% Off</a>
        <ul class="nav gap-4">
            <li class="animate-underline">
                <a class="nav-link animate-target fs-xs p-0" href="#!">Wishlist</a>
            </li>
            <li class="animate-underline">
                <a class="nav-link animate-target fs-xs p-0" href="#!">Account</a>
            </li>
        </ul>
    </div>
    <!-- Navigation bar (Page header) -->
    @include('frontend.layout.header')




    <!-- Page content -->
    <main class="content-wrapper">
        @yield('content')
    </main>


    <!-- Page footer -->
    @include('frontend.layout.footer')


    <!-- Back to top button -->
    <div class="floating-buttons position-fixed top-50 end-0 z-sticky me-3 me-xl-4 pb-4">
        <a class="btn-scroll-top btn btn-sm bg-body border-0 rounded-pill shadow animate-slide-end" href="#top">
            Top
            <i class="ci-arrow-right fs-base ms-1 me-n1 animate-target"></i>
            <span class="position-absolute top-0 start-0 w-100 h-100 border rounded-pill z-0"></span>
            <svg class="position-absolute top-0 start-0 w-100 h-100 z-1" viewBox="0 0 62 32" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <rect x=".75" y=".75" width="60.5" height="30.5" rx="15.25" stroke="currentColor" stroke-width="1.5"
                    stroke-miterlimit="10"></rect>
            </svg>
        </a>
        <a class="btn btn-sm btn-outline-secondary text-uppercase bg-body rounded-pill shadow animate-rotate ms-2 me-n5 d-none"
            href="#customizer" style="font-size: .625rem; letter-spacing: .05rem;" data-bs-toggle="offcanvas"
            role="button" aria-controls="customizer">
            Customize<i class="ci-settings fs-base ms-1 me-n2 animate-target"></i>
        </a>
    </div>



    @yield('customJs')
    @stack('componentScript')
    <!-- Vendor scripts -->
    <script src="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/timezz/timezz.js') }}"></script>
    <!-- Bootstrap + Theme scripts -->
    <script src="{{ asset('frontend/assets/js/theme.min.js') }}"></script>
    <script>
        document.addEventListener("scroll", function () {
            const header = document.querySelector(".navbar-sticky");
            if (window.scrollY > 50) {
                header.classList.add("is-sticky");
            } else {
                header.classList.remove("is-sticky");
            }
        });
    </script>


</body>

</html>