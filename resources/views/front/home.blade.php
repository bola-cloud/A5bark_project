@extends('layouts.main')

@section('content')

<!-- Motion Section -->
<div class="container-fluid motion-section mt-3">
    <div class="panner position-relative">
        <div class="row">
            <div class="col-md-12 p-0">
                <div class="motion-content">
                    <video src="{{ asset('images/motions.mp4') }}" autoplay loop muted playsinline></video>
                </div>
            </div>
            <div class="overlay-text-center">
                <a href="{{route('event')}}" class="btn btn-danger mr-5 ml-5 mt-3">مزيد من التفاصيل</a>
                <a href="{{route('event')}}" class="btn btn-danger mr-5 ml-5 mt-3">استكشف الفعاليات</a>
            </div>
        </div>
    </div>
</div>


<div class="container-fluid p-0 container-padding section-background">
    <!-- Adv Section -->
    <div class="adv-section section-bakground">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-3 mt-5 blue-color"> اعلان </h1>
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{ asset('images/صور/New folder/Rectangle 4498.png') }}" alt="Sports" class="w-100">
                    </div>
                </div>
                <div class="overlay-text-adv">
                    <h1>
                        اكتشف معنا مهرجان صيف بنغازي
                    </h1>
                    <h5>
                        نحن متحمسون لتوفير منصة سهلة عبر الإنترنت لحجز تذاكر الأحداث الترفيهية. استعد للغوص في محيط الأحداث المسلية والمثيرة.
                    </h5>
                    <div class="text-left">
                        <a href="{{route('adverticement')}}" class="btn btn-danger btn-border-adv"> مزيد من التفاصيل </a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <!-- News Section -->
    <div class="news-section">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-3 mt-5">الأخبار</h1>
                <p class="text-center" style="font-size: larger">
                    <span class="news-span"> الأخبار :</span>  <span class="highlight news-span text-danger">الأعمال الخيرية</span>
                     : الجمعيات الخيرية تخفف أعباء المعوزين خلال شهر رمضان. 
                     <span class="highlight news-span text-danger">الاجتماعية</span>
                      : وزير التضامن الاجتماعي يشهد انطلاق فعاليات الأسبوع الوطني للتنمية المستدامة.
                </p>

                <div class="row custom-section">
                    <div class="col-lg-6 order-lg-2">
                        <img src="{{ asset('images/صور/New folder/Rectangle 3519.png') }}" class="img-fluid" alt="Responsive Image">
                    </div>
                    <div class="col-lg-6 order-lg-1 d-flex flex-column justify-content-center">
                        <h2 class="text-justify">الرياضية</h2>
                        <p class="text-justify">Facilis culpa cumque et eum. Aut tempora voluptates ipsa. Excepturi porro assumenda voluptatibus voluptatem quia voluptatem aut quasi ut. Eligendi qui voluptatem natus reprehenderit. Aut id eum dolore voluptas velit rerum quaerat. Unde non fugiat et quod itaque quidem facilis. Qui aspernatur quod repellat atque enim maiores.</p>
                        <a href="{{route('news')}}" class="custom-btn align-self-end">المزيد</a>
                    </div>
                </div>
                <div class="row custom-section">
                    <div class="col-lg-6">
                        <img src="{{ asset('images/صور/New folder/food-donations-collected-charity-1.png') }}" class="img-fluid" alt="Responsive Image">
                    </div>
                    <div class="col-lg-6 d-flex flex-column justify-content-center">
                        <h2 class="text-justify">الثقافة</h2>
                        <p class="text-justify">Facilis culpa cumque et eum. Aut tempora voluptates ipsa. Excepturi porro assumenda voluptatibus voluptatem quia voluptatem aut quasi ut. Eligendi qui voluptatem natus reprehenderit. Aut id eum dolore voluptas velit rerum quaerat. Unde non fugiat et quod itaque quidem facilis. Qui aspernatur quod repellat atque enim maiores.</p>
                        <a href="{{route('news')}}" class="custom-btn align-self-end">المزيد</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- works Section -->
    <div class="work-section">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-3 mt-5" style="color: #2a3167;">أعمال المنصة </h1>
            </div>
        </div>
    </div>
    <!-- Video Section -->
    <div class="row blue-background container-padding">
        <div class="col-md-12">
            <div class="row custom-section d-flex container-padding">
                <div class="col-lg-6 pr-5 pl-5">
                    <h1 class="text-center mb-3 mt-5" style="color: white;">بودكاست جيل جديد  </h1>
                </div>
                <div class="col-lg-6 d-flex flex-column justify-content-center align-items-center pr-5 pl-5 pt-5" style="color: white;">
                    <span class="text-justify">
                        اكتشف معنا افضل حلقات البودكاست حيث نعمل على إنتاج وتوزيع برامج صوتية عالية الجودة باللغة العربية في مختلف المواضيع والفئات
                    </span>
                    <a href="{{route('podcast')}}" class="btn btn-danger">  المزيد من الحلقات </a>   
                </div>
                
            </div>
            <div class="row">
                <div class="col-lg-12 container-padding">
                    <img src="{{ asset('images/صور/New folder/Video.png') }}" class="img-fluid  container-padding" alt="Responsive Image">
                </div>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <div class="About-section mb-2">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-3 mt-5" style="color: #2a3167;" > عن المؤسسة </h1>
            </div>
        </div>
        <div class="row">
            <div class="custom-white">
                <div class="col-md-12">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center pr-5 pl-5 pt-5" style="color: #2a3167;">
                            <h1> تعرف على اجيالنا  </h1>
                            <br>
                            <span class="text-justify">
                                هى مؤسسة " تنموية ثقافية تطويرية " تطمح المؤسسة للتجديد ولترك بصمة فعالة على الصعيد المحلي والعربي , اجيالنا مؤسسة داعمة للجيل الجديد في شتي المجالات , رياضياً وعلمياً وثقافياً وفنياً 
                            </span>
                        </div>
                        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center pr-5 pl-5 pt-5" style="color: #2a3167;">
                            <img src="{{ asset('images/صور/New folder/Decoration Profile.png') }}" class="img-fluid  container-padding" alt="Responsive Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection
