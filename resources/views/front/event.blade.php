@extends('layouts.main')

@section('content')
<div class="container-fluid p-0 section-background p-3">
    <!-- Event planner Section -->
    <div class="adv-section section-background">
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
    <div class="row mb-3 mt-5">
        <div class="col-12">
            <form class="row g-3 d-flex justify-content-center" method="GET" action="{{ route('festival') }}">
                <div class="col-md-3">
                    <label for="eventName" class="form-label">@lang('front.EventName')</label>
                    <input type="text" class="form-control" id="eventName" name="eventName" value="{{ request()->eventName }}">
                </div>
                <div class="col-md-3">
                    <label for="location" class="form-label">@lang('front.Location')</label>
                    <input type="text" class="form-control" id="location" name="location" value="{{ request()->location }}">
                </div>
                <div class="col-md-3">
                    <label for="eventDate" class="form-label">@lang('front.EventDate')</label>
                    <input type="date" class="form-control" id="eventDate" name="eventDate" value="{{ request()->eventDate }}">
                </div>
                <div class="col-md-1 text-center d-flex flex-column">
                    <button type="reset" class="btn btn-link text-danger">@lang('front.CancelSearch')</button>
                    <button type="submit" class="btn btn-primary">@lang('front.Search')</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card-container-padding">
        <div class="row m-5 card-mobile">
            @foreach ($events as $event)
                <div class="col-md-4 mt-5">
                    <a href="{{ route('event_details', $event->id) }}">
                        <div class="card card-custom">
                            <img src="{{ asset('media/'.$event->image) }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <p class="text-muted text-justify" style="font-size: small;">
                                        <i class="fas fa-map-marker-alt icon"></i>
                                        {{ $event->location }}
                                    </p>
                                    <a href="#" class="btn btn-custom" style="font-size: small;">@lang('front.VisitWebsite')</a>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title mt-3 text-justify">
                                        {{ App::getLocale() == 'ar' ? $event->ar_title : $event->en_title }}
                                    </h5>
                                    <div class="mt-3 text-justify">
                                        <a class="btn shareButton" href="javascript:void(0);" data-url="{{ route('event_details', $event->id) }}" style="text-decoration: none;">
                                            <i class="fas fa-share-alt icon"></i> @lang('front.Share')
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="text-end ml-4" style="font-size: small;">
                                        <i class="far fa-clock icon"></i>
                                        {{ $event->diffInHours }} @lang('front.Hours') {{ $event->diffInMinutes }} @lang('front.Minutes')
                                    </div>
                                    <div class="text-start mr-3" style="font-size: small;">
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
