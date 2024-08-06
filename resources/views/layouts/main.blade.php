@php 
    $lang = LaravelLocalization::getCurrentLocale();
@endphp
<!DOCTYPE html>
<html lang="{{ $lang == 'ar' ? 'ar' : 'en' }}" dir="{{ $lang == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajyalyna</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <style>
        @font-face {
            font-family: 'Janna LT';
            src: url('{{asset('Janna LT Bold.ttf')}}') format('woff2'),
                url('path-to-fonts/janna-lt.woff') format('woff');
            font-weight: normal;
            font-style: normal;
        }

        .section-background {
            background: url('{{ asset('images/background.jpeg') }}') no-repeat center center fixed;
            background-size: cover;
        }

        body {
            font-family: 'Janna LT' !important;
        }
    </style>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light" @if(!Auth::check())style="padding-left: 30px; padding-right: 30px;" @endif>
        <a class="navbar-brand d-flex justify-content-center" href="{{ route('front_home') }}">
            <img src="{{ asset('images/new images/Asset 2.svg') }}" style="height: 55px;padding-right: 30px;padding-left: 30px;" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" id="sidebarToggle">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav d-none d-lg-flex p-0">
                <li class="nav-item mr-4 ml-4">
                    <a class="nav-link" href="{{ route('front_home') }}">@lang('front.Home')</a>
                </li>
                <li class="nav-item mr-4 ml-4">
                    <a class="nav-link" href="{{ route('festival') }}">@lang('front.Events')</a>
                </li>
                <li class="nav-item mr-4 ml-4">
                    <a class="nav-link" href="{{ route('news') }}">@lang('front.News')</a>
                </li>
                <li class="nav-item mr-4 ml-4">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#contactModal">@lang('front.Contact Us')</a>
                </li>
                <li class="nav-item mr-4 ml-4">
                    <a class="nav-link" href="{{ route('podcast') }}">@lang('front.Platform Works')</a>
                </li>
                <img src="{{ asset('images/Asset 1 (1).svg') }}" alt="" class="img-height mr-2 ml-2">
            </ul>
            <div class="form-inline d-none d-lg-flex">
                <div class="form-inline ml-2">
                    <button class="btn btn-outline-secondary" id="searchIcon">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                {{-- <div class="btn-group ml-3">
                    <a class="language-dropdown dropdown-toggle" !data-widget="fullscreen"     
                    href="{{ App::getLocale() == 'ar' ? LaravelLocalization::getLocalizedURL('en') : LaravelLocalization::getLocalizedURL('ar') }}"
                    role="button">
                        <i class="fas fa-globe"></i> <span class="m-2"> {{ App::getLocale() == 'ar' ? 'English' : 'العربية' }}</span> 
                    </a>
                </div> --}}
                <div class="btn-group ml-3">
                    <button class="language-dropdown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-globe"></i> <span class="m-2"> {{ App::getLocale() == 'ar' ?   'العربية' : 'English'}}</span> 
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" !data-widget="fullscreen" href="{{LaravelLocalization::getLocalizedURL('en')}}" role="button">English</a>
                        <a class="dropdown-item" !data-widget="fullscreen" href="{{LaravelLocalization::getLocalizedURL('ar')}}" role="button">العربية</a>
                    </div>
                </div>
                @if (!Auth::check())
                    <a class="custom-button" href="{{ route('login') }}">@lang('front.Login')</a>
                @else
                    <div class="dropdown">
                        <button class="custom-button dropdown-toggle ml-5" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @if (Auth::user()->category == 'admin')
                                <a class="dropdown-item" href="{{ route('admin.dashboard.index') }}">Admin Dashboard</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                @lang('front.Logout')
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </nav>
    
    <div class="sidebar d-lg-none" id="sidebar">
        <div class="sidebar-header">
            <button type="button" class="close" id="sidebarClose">&times;</button>
        </div>
        <ul class="navbar-nav">
            <li class="nav-item mr-4 ml-4">
                <a class="nav-link" href="{{ route('front_home') }}">@lang('front.Home')</a>
            </li>
            <li class="nav-item mr-4 ml-4">
                <a class="nav-link" href="{{ route('festival') }}">@lang('front.Events')</a>
            </li>
            <li class="nav-item mr-4 ml-4">
                <a class="nav-link" href="{{ route('news') }}">@lang('front.News')</a>
            </li>
            <li class="nav-item mr-4 ml-4">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#contactModal">@lang('front.Contact Us')</a>
            </li>
            <li class="nav-item mr-4 ml-4">
                <a class="nav-link" href="#">@lang('front.Platform Works')</a>
            </li>
            <img src="{{ asset('images/Asset 1 (1).svg') }}" alt="" class="img-height mr-2 ml-2">
        </ul>
        <div class="form-inline mt-3">
            <div class="form-inline search-container ml-2 mb-3 mt-3">
                <button class="btn btn-outline-secondary" id="searchIcon">
                    <i class="fas fa-search"></i>
                </button>   
            </div>
            <div class="btn-group ml-3">
                <button class="language-dropdown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-globe"></i> <span class="m-2"> العربية</span> 
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">English</a>
                    <a class="dropdown-item" href="#">Français</a>
                </div>
            </div>
            @if (!Auth::check())
                <a class="custom-button" href="{{ route('login') }}">@lang('front.Login')</a>
            @else
                <div class="dropdown mt-3">
                    <button class="custom-button dropdown-toggle" type="button" id="dropdownMenuButtonSidebar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonSidebar">
                        @if (Auth::user()->category == 'admin')
                            <a class="dropdown-item" href="{{ route('admin.dashboard.index') }}">Admin Dashboard</a>
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            @lang('front.Logout')
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
    
    <!-- Modal Structure -->
    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p>@lang('front.Contact Us') @lang('front.Social Media')</p>
                    <div class="d-flex justify-content-center">
                        <a href="https://www.tiktok.com/@ajyaljnx6wx?is_from_webapp=1&sender_device=pc" target="_blank">
                            <img src="https://img.icons8.com/color/48/000000/tiktok.png"/>
                        </a>
                        <a href="https://www.instagram.com/ajyalonaly/" target="_blank">
                            <img src="https://img.icons8.com/color/48/000000/instagram-new.png"/>
                        </a>
                        <a href="https://www.facebook.com/ajyalonaly" target="_blank">
                            <img src="https://img.icons8.com/color/48/000000/facebook-new.png"/>
                        </a>
                        <a href="https://x.com/Ajyalonaly" target="_blank" class="m-2" >
                            <img src="{{ asset('images/new images/x-twitter-brands-solid.svg') }}" style="height: 40px; width:40px;"  />
                        </a>
                        <a href="https://www.youtube.com/@ng_platform" target="_blank">
                            <img src="https://img.icons8.com/color/48/000000/youtube-play.png"/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="search-container ml-2">
        <input type="text" id="searchInput" class="search-input" placeholder="@lang('front.Search')">
        <i class="fas fa-times clear-icon" id="clearIcon"></i>
        <div class="p-1">
            <i class="fas fa-times close-icon btn p-0 " id="closeIcon"></i>
        </div>
        <i class="fas fa-search" id="search-icon-field"></i>
        <div class="search-results" id="searchResults"></div>
    </div>

    @yield('content')


    <!-- Footer Section -->
    <footer class="">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center footer">
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ asset('images/Asset 2.svg') }}" alt="">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="w-75 d-flex justify-content-between">
                                <a href="https://www.tiktok.com/@ajyaljnx6wx?is_from_webapp=1&sender_device=pc" target="_blank"><i class="fab fa-tiktok"></i></a>
                                <a href="https://www.instagram.com/ajyalonaly/" target="_blank"><i class="fab fa-instagram"></i></a>
                                <a href="https://www.facebook.com/ajyalonaly" target="_blank"><i class="fab fa-facebook"></i></a>
                                <a href="https://www.youtube.com/@ng_platform" target="_blank"><i class="fab fa-youtube"></i></a>
                                <a href="https://x.com/Ajyalonaly" target="_blank">
                                    <i class="fa-brands fa-x-twitter"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 d-flex flex-column align-content-between">
                        <p>
                            <span href="#" class="btn btn-outline-secondary">@lang('front.Get the App')</span>
                        </p>
                        <br>
                        <a href="#" class="">
                            <img src="{{ asset('images/new images/WhatsApp Image 2024-07-09 at 7.19.32 AM.jpeg') }}" style="width:135px; heigt:40px;">
                        </a>
                        <br>
                        <a  href="#" class="">
                            <img src="{{ asset('images/new images/WhatsApp Image 2024-07-09 at 7.19.32 AM (1).jpeg') }}" style="width:135px; heigt:40px;">
                        </a>
                    </div>
                    <div class="row d-flex flex-column mt-3 text-justify" style="color : #2a3167;">
                        <p>
                            @lang('front.Ajyalyna for Android')
                        </p>
                        <p>
                            @lang('front.Ajyalyna for iOS')
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <p class="footer-content text-justify"> 
                        @lang('front.She is an institution "developmental cultural development"')
                    </p>
                </div>
                <div class="col-md-2 footer-50">
                    <h5>@lang('front.Home')</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('festival') }}">@lang('front.Events')</a></li>
                        <li><a href="{{ route('news') }}">@lang('front.News')</a></li>
                        <li><a href="{{ route('podcast') }}">@lang('front.Platform Works')</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#contactModal">@lang('front.Contact Us')</a></li>
                    </ul>
                </div>
                <div class="col-md-2 footer-50">
                    <h5>@lang('front.About')</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('about') }}">@lang('front.Institution')</a></li>
                        <li><a class="nav-link" href="#" data-toggle="modal" data-target="#contactModal">@lang('front.Contact')</a></li>
                    </ul>
                </div>
            </div>
            <div class="row d-flex justify-content-center blue-background" style="color: white;">
                <div class="col-md-3">
                    <p class="text-justify pt-3 pr-3 pl-3">
                        ©2024-2025 اجيالنا.
                    </p>
                </div>
                <div class="col-md-4">
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="w-75 d-flex justify-content-between text-white">
                                <a class="text-white" href="{{ route('terms-conditions') }}">@lang('front.Privacy Policy')</a>
                                <a class="text-white" href="{{ route('terms-conditions') }}">@lang('front.Terms of Service')</a>
                                <a  class="text-white" href="#">@lang('front.Language')</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 pt-3 ">
                    <div class="btn-group ml-3">
                        <button class="footer-language dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-globe"></i> <span class="m-2"> العربية</span> 
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">English</a>
                            <a class="dropdown-item" href="#">Français</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @stack('scripts')
    <script>
        function changeDirection(direction) {
            document.body.dir = direction;
            document.querySelectorAll('.navbar-nav .nav-link').forEach(function (link) {
                if (direction === 'ltr') {
                    link.classList.remove('mr-2');
                    link.classList.add('ml-2');
                } else {
                    link.classList.remove('ml-2');
                    link.classList.add('mr-2');
                }
            });
        }

        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.add('show');
        });

        document.getElementById('sidebarClose').addEventListener('click', function() {
            document.getElementById('sidebar').classList.remove('show');
        });

    </script>

    <script>
        $(document).ready(function() {
            // Toggle search bar
            $('#searchIcon').click(function() {
                $('#searchInput').toggleClass('show');
                $('#clearIcon').show();
                $('#closeIcon').show();
                $('#search-icon-field').show();
                if ($('#searchInput').hasClass('show')) {
                    $('#searchInput').focus();
                } else {
                    $('#searchInput').val('').removeClass('show');
                    $('#searchResults').hide(); // Hide results when the search bar is hidden
                    $('#clearIcon').hide();
                    $('#closeIcon').hide();
                    $('#search-icon-field').hide();
                }
            });

            // Clear search input
            $('#clearIcon').click(function() {
                $('#searchInput').val('').focus();
                $('#searchResults').hide();
            });

            // Close search bar
            $('#closeIcon').click(function() {
                $('#searchInput').val('').removeClass('show');
                $('#searchResults').hide();
                $(this).hide();
                $('#clearIcon').hide();
                $('#search-icon-field').hide();
            });

            // AJAX search
            $('#searchInput').on('input', function() {
                const query = $(this).val();
                const resultsContainer = '#searchResults';

                if (query.length > 0) {
                    $.ajax({
                        url: '{{ route('search') }}',
                        type: 'GET',
                        data: { query: query },
                        success: function(data) {
                            $(resultsContainer).html(data).show();
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', status, error);
                        }
                    });
                } else {
                    $(resultsContainer).hide();
                }
            });

            // Hide results on click outside
            $(document).click(function(e) {
                if (!$(e.target).closest('.search-container, #searchIcon').length) {
                    $('#searchInput').val('').removeClass('show');
                    $('#searchResults').hide();
                    $('#clearIcon').hide();
                    $('#closeIcon').hide();
                    $('#search-icon-field').hide();
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const shareButtons = document.querySelectorAll('.shareButton');

            shareButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const url = button.getAttribute('data-url');
                    navigator.clipboard.writeText(url).then(function() {
                        alert('Link copied to clipboard!');
                    }).catch(function(error) {
                        console.error('Error copying text: ', error);
                    });
                });
            });
        });
    </script>
    

</body>
</html>


