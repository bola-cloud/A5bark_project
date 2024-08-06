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
                            <p>@lang('front.UnsupportedContent')</p>
                        @endif
                    @else
                        <p>@lang('front.NoActiveMotion')</p>
                    @endif
                </div>
            </div>
            <div class="overlay-text-center">
                <a href="{{ route('festival') }}" class="btn btn-danger mr-5 ml-5 mt-3 btn-border-adv">@lang('front.ExploreEvents')</a>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid p-0 container-padding section-background">
    <!-- Adv Section -->
    <div class="adv-section section-bakground" style="position: relative; text-align: center; color: white;">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-5 mt-3 blue-color">@lang('front.Advertisement')</h1>
                <div class="row" style="position: relative;">
                    <div class="col-md-12 p-0" style="position: relative; width: 100%; height: 100%;">
                        <img src="{{ asset('media/'.$adverticement->image) }}" alt="Sports" class="w-100" style="position: relative; width: 100%; height: 100%;">
                        <div class="overlay-background">
                            <div class="overlay-text-adv">
                                <p class="text-size-overlay paragaph-shadow">
                                    {{ App::getLocale() == 'ar' ? $adverticement->ar_title : $adverticement->en_title }}
                                </p>
                                <p class="text-size-overlay paragaph-shadow">
                                    {{ App::getLocale() == 'ar' ? $adverticement->ar_head : $adverticement->en_head }}
                                </p>
                            </div>
                            <div class="overlay-text-btn">
                                <a href="{{route('adverticement')}}" class="btn btn-danger btn-border-adv">@lang('front.MoreDetails')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- News Section -->
    <div class="news-section">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-3 mt-5 blue-color">@lang('front.News')</h1>
                <div class="news-ticker">
                    <div class="ticker-wrap">
                        <div class="ticker-move">
                            @foreach ($news as $new)
                                <p class="news-text">
                                    <span class="news-span">@lang('front.News') :</span>
                                    <span class="highlight news-span text-danger"> 
                                        {{ App::getLocale() == 'ar' ? $new->newsCategory->ar_name : $new->newsCategory->en_name }} 
                                    </span> 
                                    : {{ App::getLocale() == 'ar' ? $new->ar_head : $new->en_head }}
                                </p>
                            @endforeach                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @foreach($latestNews as $index => $news)
                    <div class="row custom-section">
                        <div class="col-lg-6 {{ $index % 2 == 0 ? 'order-lg-2' : '' }}">
                            <img src="{{ asset('media/'.$news->image) }}" class="img-fluid news-cover-size" alt="Responsive Image" style="max-height: 550px !important">
                        </div>
                        <div class="col-lg-6 {{ $index % 2 == 0 ? 'order-lg-1' : '' }} d-flex flex-column justify-content-center">
                            <h2 class="text-justify">{{ App::getLocale() == 'ar' ? $news->news_category->ar_name : $news->news_category->en_name }}</h2>
                            <p class="text-justify">{{ App::getLocale() == 'ar' ? $news->ar_title : $news->en_title }}</p>
                            <p class="text-justify">{{ App::getLocale() == 'ar' ? $news->ar_head : $news->en_head }}</p>
                            <a href="{{ route('news_details', $news->id) }}" class="custom-btn align-self-start">@lang('front.More')</a>
                        </div>
                    </div>
                @endforeach

            </div>  
        </div>
    </div>

    <!-- works Section -->
    <div class="work-section">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-3 mt-5" style="color: #2a3167;">@lang('front.PlatformWorks')</h1>
            </div>
        </div>
    </div>
    <!-- Video Section -->
    <div class="row blue-background container-padding-rl">
        <div class="col-md-12">
            <div class="row custom-section d-flex container-padding">
                <div class="col-lg-6 pr-5 pl-5 d-flex justify-content-start">
                    <h1 class="text-center mb-3 mt-5" style="color: white;" > 
                        <img src="{{asset('images/bi_mic-fill.svg')}}" alt=""> 
                        @lang('front.PodcastTitle')
                    </h1>
                </div>
                <div class="col-lg-6 d-flex flex-column pr-5 pl-5 pt-5" style="color: white;">
                    <span class="text-justify ml-4">
                        @lang('front.PodcastDescription')
                    </span>
                    <div class="d-flex justify-content-end ml-4">
                        <a href="{{route('podcast')}}" class="btn btn-danger mb-4 mt-3">@lang('front.MoreEpisodes')</a>   
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-lg-12 container-padding-rl">
                    @php
                        if (!function_exists('getYouTubeVideoId')) {
                            function getYouTubeVideoId($url) {
                                // Regular expression pattern to match YouTube video ID
                                $pattern = '/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/';
                                preg_match($pattern, $url, $matches);
                                return $matches[1] ?? null;
                            }
                        }
            
                        $videoUrl = $podacstEpisode->video;
                        $videoId = getYouTubeVideoId($videoUrl);
                    @endphp
            
                    @if($videoId)
                        <!-- Display YouTube video -->
                        <iframe src="https://www.youtube.com/embed/{{ $videoId }}" class="w-100 h-100"
                        style="min-height: 65vh;" frameborder="0" allowfullscreen></iframe>
                    @else
                        <!-- Display video from other sources -->
                        <iframe src="{{ $videoUrl }}" class="w-100 h-100 container-padding" style="min-height: 65vh;" frameborder="0" allowfullscreen></iframe>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    <!-- About Section -->
    <div class="About-section mb-2">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-5 mt-5" style="color: #2a3167;">@lang('front.About')</h1>
            </div>
        </div>
        <div class="row">
            <div class="custom-white">
                <div class="col-md-12">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center pr-5 pl-5 pt-5" style="color: #2a3167;">
                            <h1>@lang('front.AboutUsTitle')</h1>
                            <br>
                            <span class="text-justify">
                                @lang('front.AboutUsDescription')
                            </span>
                        </div>
                        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center pr-5 pl-5 pt-5" style="color: #2a3167;">
                            <img src="{{ asset('images/صور/New folder/Decoration Profile.png') }}" class="img-fluid container-padding" alt="Responsive Image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection
