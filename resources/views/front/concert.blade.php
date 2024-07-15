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
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{ asset('images/صور/New folder/3d-music-related-scene.png') }}" alt="Sports" class="w-100">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-padding">
                <div class="event-image"></div>
                <div class="card-body">
                    <div class="card-title row d-flex justify-content-between">
                        <h3 class="col-md-4 d-flex justify-content-center blue-color">حفل مهرجان بنغازى - احمد سعد</h3>
                        <a href="#" class="btn btn-primary"> زيارة الموقع الالكترونى </a>
                    </div>
                    <div class="row d-flex justify-content-between mt-5">
                        <p class="card-text col-md-4 d-flex justify-content-center">
                            <span><i class="far fa-clock"></i> 1 ساعة و 30 دقيقة</span> &nbsp; &nbsp; &nbsp; &nbsp; 
                            <span><i class="fas fa-calendar-alt"></i> 30 يونيو 2024</span> 
                        </p>
                        <p class="mt-3 text-danger col-md-3">الأسعار تبدأ من : 350 د.ل</p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 d-flex justify-content-center">
                            <span><i class="fas fa-map-marker-alt"></i> البوسكو-بنغازى</span>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12 mt-5">
                            <h2 class="d-flex pr-5 pl-5"> اماكن بيع التذاكر </h2>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="{{route('branch')}}">
                                        <img src="{{ asset('images/صور/New folder/Rectangle 4495.png') }}" class="w-100">
                                        <br>
                                        <p class="d-flex"> فوري </p>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{route('branch')}}">
                                        <img src="{{ asset('images/صور/New folder/Rectangle 4495.png') }}" class="w-100">
                                        <br>
                                        <p class="d-flex"> فوري </p>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{route('branch')}}">
                                        <img src="{{ asset('images/صور/New folder/Rectangle 4495.png') }}" class="w-100">
                                        <br>
                                        <p class="d-flex"> فوري </p>
                                    </a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{route('branch')}}">
                                        <img src="{{ asset('images/صور/New folder/Rectangle 4495.png') }}" class="w-100">
                                        <br>
                                        <p class="d-flex"> فوري </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection
