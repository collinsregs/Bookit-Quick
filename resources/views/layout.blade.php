<!DOCTYPE html>
<html lang="en">
<head>
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>




    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <title>BookItQuick</title>
</head>
<body>
    {{-- @dump(auth()->user()) --}}
    <nav id="navbar" class="nav-div-wrapper">

        <div class="nav-div">
            <div class="search">
                <form class="search-form" action="/search" method="GET" class="search"onsubmit="console.log('Form submitted')">
                <input type="search"name="search"  autocomplete="off" required/>

                <svg class="search-svg"xmlns="http://www.w3.org/2000/svg"
                viewBox="0 -20 1000 150
                ">
                  <path class="path" fill="none" d="m 75.6 85.2 c 19.5 19.5 50.8 19.7 70.3 0 c 19.3 -19.4 19.3 -51 -0.3 -70.6 c -19.5 -19.5 -51 -19.4 -70.6 0 c -19.3 19.7 -19.3 50.8 0.5 70.6 l -35.4 35.3 h 959.9"

                  />
                </svg>
            </form>
            <script>
                // Use JavaScript to submit the form when the enter key is pressed
                document.getElementById('search-input').addEventListener('keydown', function(event) {
                    if (event.key === 'Enter') {
                        event.preventDefault();  // Prevent the default form submission which refreshes the page
                        document.getElementById('search-form').submit();  // Submit the form manually
                    }
                });
            </script>
              </div>

        </div>
        <div class="nav-div">

            <a href="/events">Events</a>
            <a class=" nav_heading" href="\">BookItQuick</a>
            <a href="#">Support</a>
        </div>
        <div class="nav-div">
            @guest

    @if (Route::has('login'))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
    </li>
@endif
<hr class="nav-hr">
@if (Route::has('register'))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
    </li>
@endif


        @else
        <li class="nav-item">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/tickets">
                    Tickets
                </a>

                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>

        @endguest
        </div>

      </nav>

@yield('content')

    <!-- footer -->
<footer class="footer new_footer_area bg_color">
    <div class="new_footer_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="f_widget company_widget wow fadeInLeft" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInLeft;">
                        <h3 class="f-title f_600 t_color f_size_18">Get in Touch</h3>
                        <p>Don’t miss any updates of our new events, meetups and discounts.!</p>
                        <form action="#" class="f_subscribe_two mailchimp" method="post" novalidate="true" _lpchecked="1">
                            <input type="text" name="EMAIL" class="form-control memail" placeholder="Email">
                            <button class="hero-button" type="submit">Subscribe</button>
                            <p class="mchimp-errmessage" style="display: none;"></p>
                            <p class="mchimp-sucmessage" style="display: none;"></p>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="f_widget about-widget pl_70 wow fadeInLeft" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInLeft;">
                        <h3 class="f-title f_600 t_color f_size_18">Events</h3>
                        <ul class="list-unstyled f_list">
                            <li><a href="#">Conference</a></li>
                            <li><a href="#">Music</a></li>
                            <li><a href="#">Trade Show</a></li>
                            <li><a href="#">Sports & Fitness</a></li>
                            <li><a href="#">Food & Drink</a></li>
                            <li><a href="#">Seminar</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="f_widget about-widget pl_70 wow fadeInLeft" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInLeft;">
                        <h3 class="f-title f_600 t_color f_size_18">Help</h3>
                        <ul class="list-unstyled f_list">
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Terms &amp; conditions</a></li>
                            <li><a href="#">Reporting</a></li>
                            <li><a href="#">Refunds</a></li>
                            <li><a href="#">Support Policy</a></li>
                            <li><a href="#">Privacy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="f_widget social-widget pl_70 wow fadeInLeft" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInLeft;">
                        <h3 class="f-title f_600 t_color f_size_18">Team Solutions</h3>
                        <div class="f_social_icon">
                            <a href="#" class="fab fa-facebook"></a>
                            <a href="#" class="fab fa-twitter"></a>
                            <a href="#" class="fab fa-linkedin"></a>
                            <a href="#" class="fab fa-pinterest"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer_bg">
            <div class="footer_bg_one"></div>
            <div class="footer_bg_two"></div>
        </div>
    </div>
    <div class="footer_bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-sm-7">
                    <p class="mb-0 f_400">© BookItQuick.com... 2019 All rights reserved.</p>
                </div>

            </div>
        </div>
    </div>
</footer>
<script  src="{{asset('js/script.js')}}"></script>
</body>
</html>
