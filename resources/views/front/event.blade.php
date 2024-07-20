@extends('layouts.main')

@section('content')
<div class="container-fluid p-0 section-background p-3">
    <!-- Event panner Section -->
    <div class="adv-section section-bakground">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{ asset('media/'.$festival[0]->media) }}" alt="Sports" class="w-100 h-100">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-container-padding">
        <div class="row m-5 card-mobile">
            @foreach ($events as $event)
                <div class="col-md-4 mt-5">
                    <a href="{{route('event_details',$event->id)}}">
                        <div class="card card-custom">
                            <img src="{{ asset('media/'.$event->image) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <p class="text-muted text-justify"><i class="fas fa-map-marker-alt icon"></i>البوسكو-بنغازى</p>
                                    <a href="#" class="btn btn-custom">زيارة الموقع الالكترونى</a>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title mt-3 text-justify">ندوة ثقافية</h5>
                                    <div class="mt-3 text-justify">
                                        <i class="fas fa-share-alt icon"></i> مشاركة
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center">

                                <div class="d-flex align-items-center">
                                    <div class="text-end ml-4">
                                        <i class="far fa-clock icon"></i>
                                        {{ $event->diffInHours }} ساعة و {{ $event->diffInMinutes }} دقيقة
                                    </div>
                                    <div class="text-start mr-3">
                                        <i class="far fa-calendar-alt icon ml-4"></i>{{ $event->formattedDate }}
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
   