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
          <h1 class="d-flex justify-content-center"> بودكاست </h1>  
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
    <div class="container-fluid mt-5">
        <div class="row d-flex justify-content-center">
          <div class="col-md-3">
            <a href="">
              <div class="custom-card" style="min-width: 45vh;">
                <img src="{{ asset('images/صور/New folder/Rectangle 3516-1.png') }}" alt="Card image">
                <div class="card-body">
                    <div class="card-title row">
                        <h5 class="col-md-6 d-flex text-danger"> الحلقة :1</h5>
                        <div class="time-indicator col-md-6 d-flex justify-content-end">
                            <i class="far fa-clock"></i>
                            <span>1 ساعة و 30 دقيقة</span>
                        </div>
                    </div>
                    <div class="row d-flex flex-row-reverse justif-content-between mb-1 ml-1">
                        <div class="col-md-6">
                            <a href="#" class="card-link">مشاركة</a>
                        </div>
                        <div class="col-md-6 d-flex ">
                          <h4 class="blue-color">برنامج اجتماعى</h4>
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
                        <h5 class="col-md-6 d-flex text-danger"> الحلقة :1</h5>
                        <div class="time-indicator col-md-6 d-flex justify-content-end">
                            <i class="far fa-clock"></i>
                            <span>1 ساعة و 30 دقيقة</span>
                        </div>
                    </div>
                    <div class="row d-flex flex-row-reverse justif-content-between mb-1 ml-1">
                        <div class="col-md-6">
                            <a href="#" class="card-link">مشاركة</a>
                        </div>
                        <div class="col-md-6 d-flex ">
                          <h4 class="blue-color">برنامج اجتماعى</h4>
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
                        <h5 class="col-md-6 d-flex text-danger"> الحلقة :1</h5>
                        <div class="time-indicator col-md-6 d-flex justify-content-end">
                            <i class="far fa-clock"></i>
                            <span>1 ساعة و 30 دقيقة</span>
                        </div>
                    </div>
                    <div class="row d-flex flex-row-reverse justif-content-between mb-1 ml-1">
                        <div class="col-md-6">
                            <a href="#" class="card-link">مشاركة</a>
                        </div>
                        <div class="col-md-6 d-flex ">
                          <h4 class="blue-color">برنامج اجتماعى</h4>
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

@endsection
