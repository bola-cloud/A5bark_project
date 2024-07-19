@extends('layouts.main')

@section('content')

<div class="container-fluid ">
    <div class="container">
        <div class="row d-flex flex-column mt-5">
            <h1 class="d-flex justify-content-center blue-color mt-5"> الاخبار {{ $news->newsCategory->ar_name}}</h1>
            <h4 class="d-flex justify-content-start mt-4">  {{$news->ar_head}}  </h4>
            <h4 class="d-flex justify-content-start text-danger"> @php
                    setlocale(LC_TIME, 'ar_AE.UTF-8'); // Set the locale to Arabic
                    \Carbon\Carbon::setLocale('ar');
                    $createdAt = \Carbon\Carbon::parse($news->created_at);
                @endphp
                <span>{{ $createdAt->translatedFormat('l، d F Y - H:i') }}</span>
            </h4>
        </div>
    </div>
    <div class="row p-5">
        <div class="col-md-12">
            <img src="{{ asset('media/'.$news->image) }}" alt="" class="w-100">
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 pr-5 pl-5 mb-5">
                <h4 class="d-flex justify-content-start mt-4">
                    {{$news->ar_title}}

                </h4>
                <h4 class="d-flex justify-content-start mt-4 text-justify"> {{$news->ar_content}} </h4>
            </div>
        </div>
    </div>

</div> 

@endsection
