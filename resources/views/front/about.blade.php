@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">@lang('front.about_us')</h1>
    <div class="text-center mt-5">
        <img src="{{ asset('images/new images/Asset 2.svg') }}" alt="Ajyalyna Logo" class="img-fluid" style="max-width: 150px;">
    </div>
    <div class="about-content mt-4">
        <p class="text-right">@lang('front.about_title')</p>
        <p class="text-right">
            @lang('front.about_paragraph1')
        </p>
        <p class="text-right">
            @lang('front.vision_title')
            @lang('front.vision_paragraph')
        </p>
        <p class="text-right">
            @lang('front.invitation_paragraph')
        </p>
        <p class="text-right">
            @lang('front.slogan')
        </p>
    </div>
</div>
@endsection
