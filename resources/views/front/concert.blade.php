@extends('layouts.main')

@section('content')
<div class="container-fluid p-3 grey-background">
    <!-- Event panner Section -->

    <div class="adv-section section-bakground">
        <div class="row">
            <div class="col-md-12">
                <div class="row ">
                    <div class="col-md-12 d-flex justify-content-center">
                        <img src="{{ asset('media/'.$event->image) }}" alt="Sports" class="" style="max-height: 80vh; width:93%">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mr-5 ml-5 concert-mobile">
        <div class="col-md-12">
            <div class="card card-padding">
                <div class="event-image"></div>
                <div class="card-body">
                    <div class="card-title row d-flex justify-content-between align-items-center">
                        <h3 class="col-md-4 d-flex blue-color text-justify pr-5 pl-5"> 
                            {{ App::getLocale() == 'ar' ? $event->ar_title : $event->en_title }}
                        </h3>
                        <a href="#" class="btn btn-primary">@lang('front.VisitWebsite')</a>
                    </div>
                    <div class="row d-flex justify-content-between mt-5">
                        <p class="card-text col-md-4 d-flex text-justify pr-5 pl-5">
                            <span><i class="far fa-clock"></i> {{ date('h:i A', strtotime($event->date)) }}</span> &nbsp; &nbsp; &nbsp; &nbsp;
                            <span><i class="fas fa-calendar-alt"></i> {{ date('j F Y', strtotime($event->date)) }}</span>
                        </p>
                        @if($event->price > 0)
                            <p class="mt-3 text-danger col-md-3">@lang('front.PricesStartAt') : {{$event->price}} @lang('front.Currency')</p>
                        @elseif($event->price == 0)
                            <p class="mt-3 text-danger col-md-3">@lang('front.FreeBooking')</p>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-md-3 d-flex text-justify pr-5 pl-5">
                            <span><i class="fas fa-map-marker-alt"></i> {{$event->location}} </span>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12 mt-5">
                            <h2 class="d-flex pr-5 pl-5">@lang('front.TicketSalesLocations')</h2>
                            <br>
                            <div class="row">
                                @foreach ($event->branch as $branch)
                                <div class="col-md-3">
                                    <a href="{{route('branch_details',$branch->id)}}">
                                        <img src="{{ asset('media/'.$branch->image) }}" class="w-100">
                                        <br>
                                        <p class="d-flex"> {{ App::getLocale() == 'ar' ? $branch->ar_name : $branch->en_name }} </p>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection
