<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/libs/sweet-alert/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/alert/alert.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('customCss')
    @stack('componentStyle')

</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div id="pageMessages"></div>
        <!-- Sidebar Start -->
        @include('layouts.sidebar')
        <!--  Sidebar End -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('layouts.header')
            <!--  Header End -->
            <div class="body-wrapper-inner">
                @yield('content')
            </div>
            <script>
                function handleColorTheme(e) {
                    document.documentElement.setAttribute("data-color-theme", e);
                }
            </script>
        </div>
    </div>
    <!-- Import Js Files -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('assets/libs/sweet-alert/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweet-alert/sweet-alert.init.js') }}"></script>
    <script src="{{ asset('assets/libs/alert/alert.js') }}"></script>

    <!-- <script src="{{ asset('assets/js/theme/sidebarmenu.js') }}"></script> -->
    <!--
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme/app.minisidebar.init.js') }}"></script>
    <script src="{{ asset('assets/js/theme/theme.js') }}"></script>
    <script src="{{ asset('assets/js/theme/app.min.js') }}"></script>
  -->
    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        document.addEventListener("DOMContentLoaded", function () {
            const currentURL = window.location.href;

            const settingsKeywords = [
                "organisation", "branding", "profile", "work-locations",
                "departments", "designations", "subscriptions", "roles", "users"
            ];

            const isSettingsPage = settingsKeywords.some(keyword => currentURL.includes(keyword));

            if (isSettingsPage) {
                const sidebarLinks = document.querySelectorAll(".sidebar-link");

                sidebarLinks.forEach(link => {
                    const linkHref = link.getAttribute("href");

                    // Skip if href is not a real path
                    if (!linkHref || linkHref === "javascript:void(0)" || linkHref === "#") return;

                    // Use full match if possible
                    const absoluteHref = new URL(linkHref, window.location.origin).href;

                    if (currentURL.includes(absoluteHref)) {
                        link.classList.add("active");

                        let li = link.closest("li.sidebar-item");
                        if (li) li.classList.add("active");

                        // Traverse up and expand only needed parents
                        while (li) {
                            const parentUl = li.closest("ul.two-level");
                            if (parentUl) {
                                parentUl.classList.add("in");
                                parentUl.setAttribute("aria-expanded", "true");

                                const parentLi = parentUl.closest("li.sidebar-item");
                                if (parentLi) {
                                    parentLi.classList.add("active");

                                    const parentLink = parentLi.querySelector("a.sidebar-link");
                                    if (parentLink) {
                                        parentLink.classList.add("active");
                                        parentLink.setAttribute("aria-expanded", "true");
                                    }

                                    li = parentLi;
                                } else {
                                    break;
                                }
                            } else {
                                break;
                            }
                        }
                    }
                });
            }
        });
        function alertFun(link) {
            if (link.getAttribute('href') === 'javascript:void(0)') {
                createAlert('', 'Alert!', 'Please complete the setup before accessing this page.', 'warning', false, true, 'pageMessages');
                return false;
            }
            return true;

        }

    </script>
    @yield('customJs')
    @stack('componentScript')
</body>

</html>