<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

    <title>Chain App Dev - App Landing Page HTML5 Template</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/assets/css/templatemo-chain-app-dev.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/assets/css/animated.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/assets/css/owl.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @stack('styles')
    @livewireStyles

</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">
                            <img src="{{ asset('assets/assets/images/logo.png') }}" alt="Chain App Dev">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="/" {{ $menu=='home' ? 'class="active"' : '' }}>Home</a></li>
                            @if(auth()->check())
                                <li class="scroll-to-section"><a href="{{ route('dashboard') }}" {{ $menu=='dashboard' ? 'class="active"' : '' }}>Dashboard</a></li>
                                <li>
                                    <div class="gradient-button"><a id="modal_trigger" href="#modal"><i class="fas fa-user-astronaut"></i> Hi, {{ auth()->user()->name }}</a></div>
                                </li>
                            @else
                                <li>
                                    <div class="gradient-button"><a id="modal_trigger" href="#modal"><i class="fa fa-sign-in-alt"></i> Sign In</a></div>
                                </li>
                            @endif
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- Modal -->
    <div id="modal" class="popupContainer" style="display:none;">
        <div class="popupHeader">
            <span class="header_title">Antrian Cuci</span>
            <span class="modal_close"><i class="fa fa-times"></i></span>
        </div>

        <section class="popupBody">
            <!-- Username & Password Login form -->
            <div class="user_login">
                <livewire:auth-user />
            </div>
        </section>
    </div>

    @yield('content')

    <!-- Scripts -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('assets/assets/js/animation.js') }}"></script>
    <script src="{{ asset('assets/assets/js/imagesloaded.js') }}"></script>
    <script src="{{ asset('assets/assets/js/popup.js') }}"></script>
    <script src="{{ asset('assets/assets/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @stack('scripts')
    @livewireScripts

</body>

</html>
