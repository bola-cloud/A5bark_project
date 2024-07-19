<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Example</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <style>
        @font-face {
            font-family: 'Janna LT';
            src: url('{{asset('Janna LT Bold.ttf')}}') format('woff2'),
                url('path-to-fonts/janna-lt.woff') format('woff');
            /* Add additional formats as needed */
            font-weight: normal;
            font-style: normal;
        }
        .section-background {
            background: url('{{ asset('images/background.jpeg') }}') no-repeat center center fixed;
            background-size: cover;
        }
        body{
            font-family: 'Janna LT' !important ;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand d-flex justify-content-center" href="#">
            <img src="{{asset('images/Asset 2.svg')}}" style="height: 40px;" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-4 ml-4">
                    <a class="nav-link" href="{{route('front_home')}}">الصفحة الرئيسية</a>
                </li>
                <li class="nav-item mr-4 ml-4">
                    <a class="nav-link" href="{{route('festival')}}">الفعاليات</a>
                </li>
                <li class="nav-item mr-4 ml-4">
                    <a class="nav-link" href="{{route('news')}}">الأخبار</a>
                </li>
                <li class="nav-item mr-4 ml-4">
                    <a class="nav-link" href="#">تواصل معنا</a>
                </li>
                <li class="nav-item mr-4 ml-4">
                    <a class="nav-link" href="#">أعمال المنصة</a>
                </li>
                <img src="{{asset('images/Asset 1 (1).svg')}}" alt="" class="img-height mr-2 ml-2">
            </ul>
            <form class="form-inline ml-auto">
                <button class="search-button ml-3">
                    <i class="fas fa-search"></i>
                </button>
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
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li> --}}
                    <a class="custom-button" href="{{ route('login') }}">تسجيل دخول</a>
                @else
                <p class="mr-3 ml-3 mt-3">{{Auth::user()->name}}</p>
                <div>
                    <a class="custom-button" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        @lang('layouts.Logout') 
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                
                @endif
            </form>
        </div>
    </nav>

    @yield('content')


    <!-- Footer Section -->
    <footer class="">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center footer">
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{asset('images/Asset 2.svg')}}" alt="">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="w-75 d-flex justify-content-between">
                                <a href="#"><i class="fab fa-tiktok"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-facebook"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <p>
                            <span href="#" class="btn btn-outline-secondary">احصل على التطبيق</span>
                        </p>
                    </div>
                    <div class="row d-flex flex-column mt-3 text-justify" style="color : #2a3167;">
                        <p>
                            Ajyalyna.com for Android
                        </p>
                        <p>
                            Ajyalyna.com for iOs
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <p class="footer-content text-justify"> 
                        هي مؤسسة "تنموية ثقافية تطويرية" تطمح المؤسسة للتجديد ولترك بصمة فعالة
                        على الصعيد المحلي والعربي، إحلالنا مؤسسة داعمة للجيل الجديد في شتى المجالات، رياضياً وعملياً وثقافياً وفنياً. 

                    </p>
                </div>
                <div class="col-md-2 footer-50">
                    <h5>الرئيسية</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">الفعاليات</a></li>
                        <li><a href="#">الأخبار</a></li>
                        <li><a href="#">أعمال المنصة</a></li>
                        <li><a href="#">تواصل معنا</a></li>
                    </ul>
                </div>
                <div class="col-md-2 footer-50">
                    <h5>عنا</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">المؤسسة</a></li>
                        <li><a href="#">التواصل</a></li>
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
                                <a class="text-white" href="#"> سياسة الخصوصية </a>
                                <a class="text-white" href="#">  شروط الخدمة </a>
                                <a  class="text-white" href="#">اللغة</a>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
    </script>

</body>
</html>


