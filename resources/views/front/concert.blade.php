@extends('layouts.main')

@section('content')
<div class="container-fluid p-3 grey-background">
    <!-- Event panner Section -->
    <div class="row mb-3">
        <div class="col-12">
            <form class="row g-3 d-flex justify-content-center">
                <div class="col-md-3">
                    <label for="eventName" class="form-label">اسم الفعالية</label>
                    <input type="text" class="form-control" id="eventName">
                </div>
                <div class="col-md-3">
                    <label for="eventType" class="form-label">نوع الفعالية</label>
                    <select id="eventType" class="form-select form-control">
                        <option selected>اختر...</option>
                        <option>نوع 1</option>
                        <option>نوع 2</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="eventDate" class="form-label">تاريخ الفعالية</label>
                    <input type="date" class="form-control" id="eventDate">
                </div>
                <div class="col-md-1 text-center d-flex flex-column">
                    <button type="reset" class="btn btn-link text-danger">الغاء البحث</button>
                    <button type="submit" class="btn btn-primary">بحث</button>
                </div>
            </form>
        </div>
    </div>
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
                    <div class="card-title row d-flex justify-content-between">
                        <h3 class="col-md-4 d-flex justify-content-center blue-color text-justify"> {{$event->ar_title}} </h3>
                        <a href="#" class="btn btn-primary"> زيارة الموقع الالكترونى </a>
                    </div>
                    <div class="row d-flex justify-content-between mt-5">
                        <p class="card-text col-md-4 d-flex justify-content-center">
                            <span><i class="far fa-clock"></i> {{ date('h:i A', strtotime($event->date)) }}</span> &nbsp; &nbsp; &nbsp; &nbsp;
                            <span><i class="fas fa-calendar-alt"></i> {{ date('j F Y', strtotime($event->date)) }}</span>
                        </p>
                        <p class="mt-3 text-danger col-md-3">الأسعار تبدأ من : {{$event->price}} د.ل</p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 d-flex justify-content-center">
                            <span><i class="fas fa-map-marker-alt"></i> {{$event->location}} </span>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12 mt-5">
                            <h2 class="d-flex pr-5 pl-5"> اماكن بيع التذاكر </h2>
                            <br>
                            <div class="row">
                                @foreach ($event->branch as $branch)
                                <div class="col-md-3">
                                    <a href="{{route('branch_details',$branch->id)}}">
                                        <img src="{{ asset('media/'.$branch->image) }}" class="w-100">
                                        <br>
                                        <p class="d-flex"> {{$branch->ar_name}} </p>
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
