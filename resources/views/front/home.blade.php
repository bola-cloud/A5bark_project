@extends('layouts.main')

@section('content')
<!-- Motion section -->
<div class="container-fluid motion-section mt-3">
    <div class="panner position-relative">
        <div class="row">
            <div class="col-md-12 p-0">
                <div class="motion-content">
                    @if($motion)
                        @php
                            $fileType = strtolower(pathinfo($motion[0]->image, PATHINFO_EXTENSION));
                        @endphp
                        @if(in_array($fileType, ['mp4', 'webm', 'ogg']))
                            <video src="{{ asset('media/'.$motion[0]->image) }}" autoplay loop muted playsinline style="max-width: 100%;"></video>
                        @elseif(in_array($fileType, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']))
                            <img src="{{ asset('media/'.$motion[0]->image) }}" alt="Motion Image" style="max-width: 100%;">
                            <style>
                                .motion-content{
                                    padding: 0;
                                }
                            </style>
                        @else
                            <p>Unsupported content type.</p>
                        @endif
                    @else
                        <p>No active motion found.</p>
                    @endif
                </div>
            </div>
            <div class="overlay-text-center">
                <a href="{{ route('festival') }}" class="btn btn-danger mr-5 ml-5 mt-3">استكشف الفعاليات</a>
            </div>
        </div>
    </div>
</div>



<div class="container-fluid p-0 container-padding section-background">
    <!-- Adv Section -->
    <div class="adv-section section-bakground">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-5 mt-3 blue-color"> اعلان </h1>
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{ asset('media/'.$adverticement[0]->image) }}" alt="Sports" class="w-100">
                    </div>
                </div>
                <div class="overlay-text-adv">
                    <p>
                       {{$adverticement[0]->ar_title}}
                    </p>
                    <p>
                        {{$adverticement[0]->ar_head}}
                    </p>
                    
                </div>
                <div class="overlay-text-btn">
                    <a href="{{route('adverticement')}}" class="btn btn-danger btn-border-adv"> مزيد من التفاصيل </a>
                </div>
            </div>
            
        </div>
    </div>

    <!-- News Section -->
    <div class="news-section">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-3 mt-5 blue-color">الأخبار</h1>
                <div class="news-ticker">
                    @foreach ($news as $new)
                        <p class="news-text">
                            <span class="news-span"> الأخبار :</span>
                            <span class="highlight news-span text-danger"> {{$new->newsCategory->ar_name}} </span> 
                            : {{$new->ar_head}}
                        </p>
                    @endforeach
                    
                    <p class="news-text">
                        <span class="news-span"> الأخبار :</span>
                        <span class="highlight news-span text-danger">الأعمال الخيرية</span> 
                        : الجمعيات الخيرية تخفف أعباء المعوزين خلال شهر رمضان.
                        <span class="highlight news-span text-danger">الاجتماعية</span>
                        : وزير التضامن الاجتماعي يشهد انطلاق فعاليات الأسبوع الوطني للتنمية المستدامة.
                    </p>
                </div>
                

                <div class="row custom-section">
                    <div class="col-lg-6 order-lg-2">
                        <img src="{{ asset('media/'.$news[0]->image) }}" class="img-fluid" alt="Responsive Image" style="max-height: 608px;">
                    </div>
                    <div class="col-lg-6 order-lg-1 d-flex flex-column justify-content-center">
                        <h2 class="text-justify">{{$news[0]->newsCategory->ar_name}}</h2>
                        <p class="text-justify">{{$news[0]->ar_title}}</p>
                        <p class="text-justify"> {{$news[0]->ar_head}} </p>
                        <a href="{{route('news_details',$news[0]->id)}}" class="custom-btn align-self-start">المزيد</a>
                    </div>
                </div>
                <div class="row custom-section">
                    <div class="col-lg-6 ">
                        <img src="{{ asset('media/'.$news[1]->image) }}" class="img-fluid" alt="Responsive Image">
                    </div>
                    <div class="col-lg-6  d-flex flex-column justify-content-center">
                        <h2 class="text-justify">{{$news[1]->newsCategory->ar_name}}</h2>
                        <p class="text-justify">{{$news[1]->ar_title}}</p>
                        <p class="text-justify"> {{$news[1]->ar_head}} </p>
                        <a href="{{route('news_details',$news[1]->id)}}" class="custom-btn align-self-start">المزيد</a>
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
    <div class="row blue-background container-padding-rl">
        <div class="col-md-12">
            <div class="row custom-section d-flex container-padding">
                <div class="col-lg-6 pr-5 pl-5 d-flex justify-content-start">
                    <h1 class="text-center mb-3 mt-5" style="color: white;" > <img src="{{asset('images/bi_mic-fill.svg')}}" alt=""> بودكاست جيل جديد  </h1>
                </div>
                <div class="col-lg-6 d-flex flex-column pr-5 pl-5 pt-5" style="color: white;">
                    <span class="text-justify ml-4">
                        اكتشف معنا افضل حلقات البودكاست حيث نعمل على إنتاج وتوزيع برامج صوتية عالية الجودة باللغة العربية في مختلف المواضيع والفئات
                    </span>
                    <div class="d-flex justify-content-end ml-4">
                        <a href="{{route('podcast')}}" class="btn btn-danger mb-4 mt-3 ">  المزيد من الحلقات </a>   
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-lg-12 container-padding-rl">
                    <img src="{{ asset('images/صور/New folder/Video.png') }}" class="img-fluid  container-padding" alt="Responsive Image">
                </div>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <div class="About-section mb-2">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-5 mt-5" style="color: #2a3167;" > عن المؤسسة </h1>
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
