@extends('layouts.main')

@section('content')
<div class="container">
    <h1 class="d-flex justify-content-center blue-color mt-5">@lang('front.News')</h1>
    <div class="row">
        <br>
        <div class="row mt-5 d-flex">
            <div class="col-md-12">
                <a href="{{ route('news') }}" class="btn btn-outline-primary btn-color m-3 {{ is_null($selectedCategory) ? 'active' : '' }}">@lang('front.All')</a>
                @foreach ($categories as $category)
                    <a href="{{ route('news.filter', $category->id) }}" class="btn btn-outline-primary btn-color m-3 {{ $selectedCategory && $selectedCategory->id == $category->id ? 'active' : '' }}">
                        {{ App::getLocale() == 'ar' ? $category->ar_name : $category->en_name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    
    <div class="row mb-5">
        @foreach ($news as $new)
        <div class="col-md-4 mt-5">
            <a href="{{route('news_details', $new->id)}}">
                <div class="custom-card">
                    <img src="{{ asset('media/'.$new->image) }}" alt="Card image" style="min-height: 31vh;">
                    <div class="card-body">
                        <div class="card-title row">
                            <h5 class="col-md-11 blue-color text-justify"> {{ App::getLocale() == 'ar' ? $new->ar_head : $new->en_head }} </h5>
                        </div>
                        <div class="row d-flex flex-row-reverse mb-1 ml-1">
                            <div class="col-md-4 mb-3">
                                <a href="#" class="btn card-link text-justify shareButton" href="javascript:void(0);" 
                                data-url="http://127.0.0.1:8000/front/news/details/{{ $new->id }}">
                                @lang('front.Share')
                            </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="card-text text-justify"> {{ App::getLocale() == 'ar' ? $new->ar_title : $new->en_title }}  </p>
                            </div>
                            <div class="time-indicator col-md-6 pl-3" style="font-size: small;">
                                <i class="far fa-clock"></i>
                                <span>{{ $new->created_at->diffForHumans(null, false, false, 2) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    
</div>

@endsection
