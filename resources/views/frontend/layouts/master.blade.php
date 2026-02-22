<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title -->
    <title>@yield('title') -- {{ config('settings.site_name') }}</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset(config('settings.favicon')) }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/fontawesome-all.min.css') }}">
    <!-- Slick -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/slick.css') }}">
    <!-- magnific popup -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/magnific-popup.css') }}">
    <!-- line awesome -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/line-awesome.min.css') }}">
    <!-- Select 2 -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/select2.min.css') }}">
    <!-- plyr css -->
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />

    <!-- notyf css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

    <!-- Tabler Icons CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.21.0/tabler-icons.min.css"
        integrity="sha512-XrgoTBs7P5YtpkeKqKOKkruURsawIaRrhe8QrcWeMnFeyRZiOcRNjBAX+AQeXOvx9/9fSY32dVct1PccRoCICQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Main css -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/main.css') }}">

    {{-- @routes --}}
</head>

<body>

    <!--==================== Preloader Start ====================-->
    <div class="preloader_area">
        <div class="preloader_img">
            <img src="{{ asset('assets/frontend/images/thumbs/preloader.gif') }}" alt="Preloader">
        </div>
    </div>
    <!--==================== Preloader End ====================-->

    <!--==================== Overlay Start ====================-->
    <div class="overlay"></div>
    <!--==================== Overlay End ====================-->

    <!--==================== Sidebar Overlay End ====================-->
    <div class="side-overlay"></div>
    <!--==================== Sidebar Overlay End ====================-->

    <!-- ==================== Scroll to Top End Here ==================== -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- ==================== Scroll to Top End Here ==================== -->

    <!-- ==================== Mobile Menu Start Here ==================== -->
    <div class="mobile-menu d-lg-none d-block">
        <button type="button" class="close-button"> <i class="las la-times"></i> </button>
        <div class="mobile-menu__inner">
            <a href="index.html" class="mobile-menu__logo">
                <img src="{{ asset(config('settings.logo')) }}" alt="Logo" class="white-version">
            </a>
            <div class="mobile-menu__menu">
                <div class="header-right__inner d-lg-none my-3 gap-1 d-flex flx-align">

                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{ asset('assets/frontend/images/icons/user.svg') }}" alt="">
                        </button>
                        <ul class="dropdown-menu">
                            @guest
                                <li><a class="dropdown-item" href="{{ route('login') }}">Sign In</a></li>
                                <li><a class="dropdown-item" href="{{ route('register') }}">Sign Up</a></li>
                            @endguest
                            @auth
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                            @endauth
                        </ul>
                    </div>
                </div>

                <ul class="nav-menu flx-align nav-menu--mobile">

                    <li class="nav-menu__item">
                        <a href="{{ url('/') }}" class="nav-menu__link">Home</a>
                    </li>
                    {{-- <li class="nav-menu__item">
                        <a href="{{ route('products') }}" class="nav-menu__link">Products</a>
                    </li>
                    <li class="nav-menu__item">
                        <a href="{{ route('contact') }}" class="nav-menu__link">Contact</a>
                    </li>
                    @php
                        $customPages = App\Models\CustomPage::where(['status' => 1, 'show_at_nav' => 1])->get();
                    @endphp
                    @foreach ($customPages as $page)
                        <li class="nav-menu__item">
                            <a href="{{ route('page', $page->slug) }}" class="nav-menu__link">{{ $page->name }}</a>
                        </li>
                    @endforeach
                    <li class="nav-menu__item">
                        <a href="{{ route('kyc.index') }}" class="nav-menu__link">Start Selling</a>
                    </li> --}}

                    {{-- <li class="nav-menu__item">
                        <a href="contact.html" class="nav-menu__link">Contact</a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>
    <!-- ==================== Mobile Menu End Here ==================== -->

    <main class="change-gradient">
        <!-- ==================== Header ==================== -->
        @include('frontend.layouts.header')
        <!-- ==================== Header End ==================== -->

        <!-- ==================== Dynamic Content ==================== -->
        @yield('content')
        <!-- ==================== Dynamic Content End ==================== -->


        <!-- ==================== Footer Start Here ==================== -->
        @include('frontend.layouts.footer')
        <!-- ==================== Footer End Here ==================== -->

    </main>

    <!-- Jquery js -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Bootstrap Bundle Js -->
    <script src="{{ asset('assets/frontend/js/boostrap.bundle.min.js') }}"></script>

    <!-- counter up -->
    <script src="{{ asset('assets/frontend/js/counterup.min.js') }}"></script>
    <!-- Slick js -->
    <script src="{{ asset('assets/frontend/js/slick.min.js') }}"></script>
    <!-- magnific popup -->
    <script src="{{ asset('assets/frontend/js/jquery.magnific-popup.js') }}"></script>
    <!-- apex chart -->
    <script src="{{ asset('assets/frontend/js/apexchart.js') }}"></script>
    <!-- marquee -->
    <script src="{{ asset('assets/frontend/js/marquee.min.js') }}"></script>
    <!-- infinite slide  -->
    <script src="{{ asset('assets/frontend/js/infiniteslidev2.js') }}"></script>
    <!-- select 2  -->
    <script src="{{ asset('assets/frontend/js/select2.min.js') }}"></script>

    <!-- plyr js  -->
    <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>

    <!-- notyf js  -->
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

    <!-- main js -->
    <script src="{{ asset('assets/frontend/js/main.js') }}"></script>

    <!-- dynamic js -->

    <!-- global js variables -->
    <script src="{{ asset('assets/frontend/js/default/default-variables.js') }}"></script>

    <!-- cart js -->
    <script src="{{ asset('assets/frontend/js/default/cart.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script>
        var notyf = new Notyf({
            duration: 5000,
            dismissible: true
        });

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                notyf.error("{{ $error }}");
            @endforeach
        @endif
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const players = new Map();
            const hoverTimers = new Map(); // Store timeout IDs for each video

            document.querySelectorAll(".player").forEach((el) => {
                const source = el.querySelector("source");
                if (source) {
                    source.dataset.src = source.src; // Store actual source
                    source.removeAttribute("src"); // Prevent preloading
                }

                const player = new Plyr(el, {
                    controls: []
                });
                players.set(el, player);
            });

            $(function() {
                $(".product-video").on("mouseover", function() {
                    const videoElement = $(this).find(".player")[0];
                    if (videoElement && players.has(videoElement)) {
                        // Set a delay before loading the video
                        const timeoutId = setTimeout(() => {
                            const player = players.get(videoElement);
                            const source = videoElement.querySelector("source");
                            if (source && !videoElement.getAttribute("src")) {
                                source.setAttribute("src", source.dataset.src);
                                videoElement.load();
                            }
                            player.muted = true;
                            player.play();
                        }, 500); // Delay of 500ms

                        hoverTimers.set(videoElement, timeoutId);
                    }
                });

                $(".product-video").on("mouseout", function() {
                    const videoElement = $(this).find(".player")[0];
                    if (videoElement && players.has(videoElement)) {
                        const player = players.get(videoElement);
                        player.pause();

                        // Clear the timeout if the user moves away before loading
                        if (hoverTimers.has(videoElement)) {
                            clearTimeout(hoverTimers.get(videoElement));
                            hoverTimers.delete(videoElement);
                        }
                    }
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            let currentPlayer = null; // Store reference to the currently playing player

            // Initialize audio players with play, mute, and progress controls
            document.querySelectorAll(".audio-player").forEach((el) => {
                const player = new Plyr(el, {
                    controls: ['play', 'progress', 'mute']
                });

                // Listen for play event and pause other audio if it's playing
                player.on('play', () => {
                    if (currentPlayer && currentPlayer !== player) {
                        currentPlayer.pause(); // Pause the currently playing audio
                    }
                    currentPlayer = player; // Update the currentPlayer to the newly playing one
                });
            });
        });
    </script>

    @stack('scripts')

</body>

</html>
