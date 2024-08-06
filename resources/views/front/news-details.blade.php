@extends('layouts.main')

@section('content')

<div class="container">
    <div class="container-fluid pr-5 pl-5">
        <div class="row d-flex flex-column mt-5 padding-news-title">
            <h1 class="d-flex justify-content-center blue-color mt-5 text-justify"> 
                @lang('front.News') {{ App::getLocale() == 'ar' ? $news->newsCategory->ar_name : $news->newsCategory->en_name }}
            </h1>
            <h4 class="d-flex justify-content-start mt-4 text-justify">  
                {{ App::getLocale() == 'ar' ? $news->ar_head : $news->en_head }}  
            </h4>
            <h4 class="d-flex justify-content-start text-danger text-justify"> 
                @php
                    setlocale(LC_TIME, App::getLocale() == 'ar' ? 'ar_AE.UTF-8' : 'en_US.UTF-8'); // Set the locale to Arabic or English
                    \Carbon\Carbon::setLocale(App::getLocale());
                    $createdAt = \Carbon\Carbon::parse($news->created_at);
                @endphp
                <span>{{ $createdAt->translatedFormat(App::getLocale() == 'ar' ? 'l، d F Y - H:i' : 'l, d F Y - H:i') }}</span>
            </h4>
        </div>
    </div>
    <div class="row p-5">
        <div class="col-md-12">
            <img src="{{ asset('media/'.$news->image) }}" alt="" class="w-100" style="max-height: 70vh;">
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 pr-5 pl-5 mb-5">
                <h3 class="d-flex justify-content-start mt-4 text-justify blue-color">
                    {{ App::getLocale() == 'ar' ? $news->ar_title : $news->en_title }}
                </h3>
                <p class="d-flex justify-content-start mt-4 text-justify"> 
                    {{ App::getLocale() == 'ar' ? $news->ar_content : $news->en_content }} 
                </p>
            </div>
        </div>
    </div>

</div> 

@endsection
