@extends('layouts.main')

@section('content')
<style>
.icons a.btn{
  margin: 0;
}
</style>

<div class="container-fluid mt-5 mb-5">
  <div class="banner">
      <div class="header d-flex justify-content-center">
        <h1 class="d-flex justify-content-center blue-color"> بودكاست </h1>  
      </div>
      <div class="row">
        <div class="col-md-12">
          <img src="{{ asset('images/صور/New folder/Rectangle 3520.png') }}" alt="Podcast Banner" class="w-100">
        </div>
      </div>
      <div class="overlay-text">
        <h1> جيل جديد أفضل مكان للاستماع إلى البودكاست </h1> 
      </div>
  </div>
  <div class="card-footer d-flex p-5">
    <a href="#" class="card-link active" data-target="#playlists"><i class="fas fa-list"></i> قوائم التشغيل</a>
    <a href="#" class="card-link" data-target="#episodes"><i class="fas fa-play-circle"></i> الحلقات</a>
  </div>
  <div class="content " id="episodes">
    <!-- Content for episodes goes here -->
    <div class="container-fluid mt-5">
      <div class="row d-flex justify-content-center">
        <div class="col-md-3">
          <a href="">
            <div class="custom-card" style="min-width: 45vh;">
              <img src="{{ asset('images/صور/New folder/Rectangle 3516-1.png') }}" alt="Card image">
              <div class="card-body">
                  <div class="card-title row">
                      <h5 class="col-md-6 d-flex">الرياضة اليوم</h5>
                      <div class="time-indicator col-md-6 d-flex justify-content-end">
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
              <div class="card-footer d-flex row">
                <div class="col-md-12 d-flex flex-wrap">
                  <p href="#" class="card-link text-danger mt-3">استمع على:</p>
                  <p class="d-flex icons mt-3">
                    <a class="btn"><i class="fab fa-tiktok"></i></a>
                    <a class="btn"><i class="fab fa-spotify"></i></a>
                    <a class="btn"><i class="fab fa-youtube"></i></a>
                    <a class="btn"><i class="fab fa-soundcloud"></i></a>
                  </p>
                  <button class="btn"><i class="fas fa-share-alt"></i> مشاركة </button>
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-3">
          <a href="">
            <div class="custom-card" style="min-width: 45vh;">
              <img src="{{ asset('images/صور/New folder/Rectangle 3516-1.png') }}" alt="Card image">
              <div class="card-body">
                  <div class="card-title row">
                      <h5 class="col-md-6 d-flex">الرياضة اليوم</h5>
                      <div class="time-indicator col-md-6 d-flex justify-content-end">
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
              <div class="card-footer d-flex row">
                <div class="col-md-12 d-flex flex-wrap">
                  <p href="#" class="card-link text-danger mt-3">استمع على:</p>
                  <p class="d-flex icons mt-3">
                    <a class="btn"><i class="fab fa-tiktok"></i></a>
                    <a class="btn"><i class="fab fa-spotify"></i></a>
                    <a class="btn"><i class="fab fa-youtube"></i></a>
                    <a class="btn"><i class="fab fa-soundcloud"></i></a>
                  </p>
                  <button class="btn"><i class="fas fa-share-alt"></i> مشاركة </button>
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-3">
          <a href="">
            <div class="custom-card" style="min-width: 45vh;">
              <img src="{{ asset('images/صور/New folder/Rectangle 3516-1.png') }}" alt="Card image">
              <div class="card-body">
                  <div class="card-title row">
                      <h5 class="col-md-6 d-flex">الرياضة اليوم</h5>
                      <div class="time-indicator col-md-6 d-flex justify-content-end">
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
              <div class="card-footer d-flex row">
                <div class="col-md-12 d-flex flex-wrap">
                  <p href="#" class="card-link text-danger mt-3">استمع على:</p>
                  <p class="d-flex icons mt-3">
                    <a class="btn"><i class="fab fa-tiktok"></i></a>
                    <a class="btn"><i class="fab fa-spotify"></i></a>
                    <a class="btn"><i class="fab fa-youtube"></i></a>
                    <a class="btn"><i class="fab fa-soundcloud"></i></a>
                  </p>
                  <button class="btn"><i class="fas fa-share-alt"></i> مشاركة </button>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="content active" id="playlists">
    <!-- Content for playlists goes here -->
    
    <div class="container-fluid mt-5 p-5">
      <div class="row">
        <div class="col-md-4">
          <a href="{{route('episodes')}}">
            <div class="card">
              <img src="{{asset('images/123.jpeg')}}" class="card-img-top w-100 h-100" alt="Podcast Image">
              <div class="card-body">
                <div class="row justify-content-between">
                  <h5 class="card-title col-md-5 d-flex justify-content-start">كافي الزوى</h5>
                  <ul class="list-group list-group-flush col-md-5">
                    <h5 class="d-flex justify-content-end ml-3">
                        <span class="mr-2 ml-2">8</span>
                        <span> حلقات  <i class="fas fa-list"></i> </span>
                    </h5>
                  </ul>
                </div>
                  {{-- <p class="card-text">د. أسامة مقيل - عندنا مشكلة في الطب في ليبيا - ولا توجد رقابة كافية</p> --}}
              </div>
             
              <div class="card-footer d-flex justify-content-between">
                <p href="#" class="card-link text-danger">استمع على:</p>
                <div>
                  <a class="btn"><i class="fab fa-tiktok"></i></a>
                  <a class="btn"><i class="fab fa-spotify"></i></a>
                  <a class="btn"><i class="fab fa-youtube"></i></a>
                  <a class="btn"><i class="fab fa-soundcloud"></i></a>
                </div>
                <button class="btn"><i class="fas fa-share-alt"></i> مشاركة </button>
              </div>
            </div>
          </a>
          
        </div>
        <div class="col-md-4">
          <a href="{{route('episodes')}}">
            <div class="card">
              <img src="{{asset('images/123.jpeg')}}" class="card-img-top w-100 h-100" alt="Podcast Image">
              <div class="card-body">
                <div class="row justify-content-between">
                  <h5 class="card-title col-md-5 d-flex justify-content-start">كافي الزوى</h5>
                  <ul class="list-group list-group-flush col-md-5">
                    <h5 class="d-flex justify-content-end ml-3">
                        <span class="mr-2 ml-2">8</span>
                        <span> حلقات  <i class="fas fa-list"></i> </span>
                    </h5>
                  </ul>
                </div>
                  {{-- <p class="card-text">د. أسامة مقيل - عندنا مشكلة في الطب في ليبيا - ولا توجد رقابة كافية</p> --}}
              </div>
             
              <div class="card-footer d-flex justify-content-between">
                <p href="#" class="card-link text-danger">استمع على:</p>
                <div>
                  <a class="btn"><i class="fab fa-tiktok"></i></a>
                  <a class="btn"><i class="fab fa-spotify"></i></a>
                  <a class="btn"><i class="fab fa-youtube"></i></a>
                  <a class="btn"><i class="fab fa-soundcloud"></i></a>
                </div>
                <button class="btn"><i class="fas fa-share-alt"></i> مشاركة </button>
              </div>
            </div>
          </a>
          
        </div>
        <div class="col-md-4">
          <a href="{{route('episodes')}}">
            <div class="card">
              <img src="{{asset('images/123.jpeg')}}" class="card-img-top w-100 h-100" alt="Podcast Image">
              <div class="card-body">
                <div class="row justify-content-between">
                  <h5 class="card-title col-md-5 d-flex justify-content-start">كافي الزوى</h5>
                  <ul class="list-group list-group-flush col-md-5">
                    <h5 class="d-flex justify-content-end ml-3">
                        <span class="mr-2 ml-2">8</span>
                        <span> حلقات  <i class="fas fa-list"></i> </span>
                    </h5>
                  </ul>
                </div>
                  {{-- <p class="card-text">د. أسامة مقيل - عندنا مشكلة في الطب في ليبيا - ولا توجد رقابة كافية</p> --}}
              </div>
             
              <div class="card-footer d-flex justify-content-between">
                <p href="#" class="card-link text-danger">استمع على:</p>
                <div>
                  <a class="btn"><i class="fab fa-tiktok"></i></a>
                  <a class="btn"><i class="fab fa-spotify"></i></a>
                  <a class="btn"><i class="fab fa-youtube"></i></a>
                  <a class="btn"><i class="fab fa-soundcloud"></i></a>
                </div>
                <button class="btn"><i class="fas fa-share-alt"></i> مشاركة </button>
              </div>
            </div>
          </a>
          
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    $('.card-link').on('click', function(e) {
      e.preventDefault();
      $('.card-link').removeClass('active');
      $(this).addClass('active');
      $('.content').removeClass('active');
      $($(this).data('target')).addClass('active');
    });
  });
</script>

@endsection
