@extends('layouts.main')

@section('content')

<div class="container-fluid p-0 container-padding section-background">
    <!-- Adv Section -->
    <div class="adv-section section-bakground">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center mb-3">{{ App::getLocale() == 'ar' ? $Adverticement->ar_title : $Adverticement->en_title }}</h1>
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{ asset('media/'.$Adverticement->image) }}" alt="Sports" class="w-100">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center blue-color">{{ App::getLocale() == 'ar' ? $Adverticement->ar_head : $Adverticement->en_head }}</h1> <br>
                        <div class="container-padding">
                            <p class="padding-parag text-justify">
                                {{ App::getLocale() == 'ar' ? $Adverticement->ar_content : $Adverticement->en_content }}    
                            </p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
