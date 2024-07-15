@extends('layouts.main')

@section('content')
<div class="container">
    <h1 class="d-flex justify-content-center blue-color mt-5"> الاخبار </h1>
    <div class="row">
        <br>
        <div class="row mt-5 d-flex">
            <div class="col-md-12">
                <button class="btn btn-outline-primary btn-color m-3">الكل</button>
                <button class="btn btn-outline-primary btn-color m-3">رياضة</button>
                <button class="btn btn-outline-primary btn-color m-3">اجتماعية</button>
                <button class="btn btn-outline-primary btn-color m-3">ثقافية</button>
                <button class="btn btn-outline-primary btn-color m-3">الاعمال الخيرية</button>
            </div>
        </div>
    </div>
    
    <div class="row  mb-5 ">
        <div class="col-md-4 mt-5">
            <a href="{{route('news-details')}}">
                <div class="custom-card">
                    <img src="{{ asset('images/صور/New folder/Rectangle 3507.png') }}" alt="Card image">
                    <div class="card-body">
                        <div class="card-title row">
                            <h5 class="col-md-6">الرياضة اليوم</h5>
                            <div class="time-indicator col-md-6">
                                <i class="far fa-clock"></i>
                                <span>1 ساعة و 30 دقيقة</span>
                            </div>
                        </div>
                        <div class="row d-flex flex-row-reverse mb-1 ml-1">
                            <div class="col-md-4 ">
                                <a href="#" class="card-link">مشاركة</a>
                            </div>
                        </div>
                        <p class="card-text">انضم إلينا كل يوم من أيام الأسبوع حيث نقدم لك آخر الأخبار والاتجاهات في مجموعة مختارة من المواضيع.</p>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mt-5">
            <a href="{{route('news-details')}}">
                <div class="custom-card">
                    <img src="{{ asset('images/صور/New folder/Rectangle 3507.png') }}" alt="Card image">
                    <div class="card-body">
                        <div class="card-title row">
                            <h5 class="col-md-6">الرياضة اليوم</h5>
                            <div class="time-indicator col-md-6">
                                <i class="far fa-clock"></i>
                                <span>1 ساعة و 30 دقيقة</span>
                            </div>
                        </div>
                        <div class="row d-flex flex-row-reverse mb-1 ml-1">
                            <div class="col-md-4 ">
                                <a href="#" class="card-link">مشاركة</a>
                            </div>
                        </div>
                        <p class="card-text">انضم إلينا كل يوم من أيام الأسبوع حيث نقدم لك آخر الأخبار والاتجاهات في مجموعة مختارة من المواضيع.</p>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mt-5">
            <a href="{{route('news-details')}}">
                <div class="custom-card">
                    <img src="{{ asset('images/صور/New folder/Rectangle 4499.png') }}" alt="Card image">
                    <div class="card-body">
                        <div class="card-title row">
                            <h5 class="col-md-6">الرياضة اليوم</h5>
                            <div class="time-indicator col-md-6">
                                <i class="far fa-clock"></i>
                                <span>1 ساعة و 30 دقيقة</span>
                            </div>
                        </div>
                        <div class="row d-flex flex-row-reverse mb-1 ml-1">
                            <div class="col-md-4 ">
                                <a href="#" class="card-link">مشاركة</a>
                            </div>
                        </div>
                        <p class="card-text">انضم إلينا كل يوم من أيام الأسبوع حيث نقدم لك آخر الأخبار والاتجاهات في مجموعة مختارة من المواضيع.</p>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mt-5">
            <a href="{{route('news-details')}}">
                <div class="custom-card">
                    <img src="{{ asset('images/صور/New folder/Rectangle 3507.png') }}" alt="Card image">
                    <div class="card-body">
                        <div class="card-title row">
                            <h5 class="col-md-6">الرياضة اليوم</h5>
                            <div class="time-indicator col-md-6">
                                <i class="far fa-clock"></i>
                                <span>1 ساعة و 30 دقيقة</span>
                            </div>
                        </div>
                        <div class="row d-flex flex-row-reverse mb-1 ml-1">
                            <div class="col-md-4 ">
                                <a href="#" class="card-link">مشاركة</a>
                            </div>
                        </div>
                        <p class="card-text">انضم إلينا كل يوم من أيام الأسبوع حيث نقدم لك آخر الأخبار والاتجاهات في مجموعة مختارة من المواضيع.</p>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mt-5">
            <a href="{{route('news-details')}}">
                <div class="custom-card">
                    <img src="{{ asset('images/صور/New folder/Rectangle 3507.png') }}" alt="Card image">
                    <div class="card-body">
                        <div class="card-title row">
                            <h5 class="col-md-6">الرياضة اليوم</h5>
                            <div class="time-indicator col-md-6">
                                <i class="far fa-clock"></i>
                                <span>1 ساعة و 30 دقيقة</span>
                            </div>
                        </div>
                        <div class="row d-flex flex-row-reverse mb-1 ml-1">
                            <div class="col-md-4 ">
                                <a href="#" class="card-link">مشاركة</a>
                            </div>
                        </div>
                        <p class="card-text">انضم إلينا كل يوم من أيام الأسبوع حيث نقدم لك آخر الأخبار والاتجاهات في مجموعة مختارة من المواضيع.</p>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

@endsection
