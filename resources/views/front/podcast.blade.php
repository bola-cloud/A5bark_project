@extends('layouts.main')

@section('content')
<style>
.icons a.btn{
  margin: 0;
}
.card-img-top{
  height: 50vh !important;
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
        @foreach ($episodes as $episode)
          <div class="col-md-3">
            <a href="">
              <div class="custom-card" style="min-width: 45vh;">
                @php
                    if (!function_exists('getYouTubeVideoId')) {
                        function getYouTubeVideoId($url) {
                            if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
                                preg_match('/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches);
                                return $matches[1] ?? null;
                            }
                            return null;
                        }
                    }

                    $videoUrl = $episode->video;
                    $videoId = getYouTubeVideoId($videoUrl);
                @endphp

                @if($videoId)
                    <!-- Display YouTube video -->
                    <iframe src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allowfullscreen></iframe>
                @else
                    <!-- Display video from other sources -->
                    <iframe src="{{ $videoUrl }}" frameborder="0" allowfullscreen></iframe>
                @endif

                {{-- <img src="{{ asset('images/صور/New folder/Rectangle 3516-1.png') }}" alt="Card image"> --}}
                <div class="card-body">
                    <div class="card-title row">
                        <h5 class="col-md-6 d-flex text-danger"> الحلقة :{{$episode->number}}</h5>
                        <div class="time-indicator col-md-6 d-flex justify-content-end">
                            <i class="far fa-clock"></i>
                            <span>{{$episode->time}}</span>
                        </div>
                    </div>
                    <div class="row d-flex flex-row-reverse justif-content-between mb-1 ml-1">
                        <div class="col-md-6">
                            <a href="#" class="card-link blue-color">مشاركة</a>
                        </div>
                        <div class="col-md-6 d-flex ">
                          <h4 class="blue-color"> {{$episode->ar_title}} </h4>
                        </div>
                    </div>
                    <p class="card-text text-justify">{{$episode->ar_description}}</p>
                </div>
                <div class="card-footer d-flex row">
                  <div class="col-md-12 d-flex flex-wrap">
                    <p href="#" class="card-link text-danger mt-3">استمع على:</p>
                    <p class="d-flex icons mt-3">
                      <a class="btn" href="{{$episode->tiktok_link}}"><i class="fab fa-tiktok"></i></a>
                      <a class="btn" href="{{$episode->spotify_link}}"><i class="fab fa-spotify"></i></a>
                      <a class="btn" href="{{$episode->youtube_link}}"><i class="fab fa-youtube"></i></a>
                      <a class="btn" href="{{$episode->sound_link}}"><i class="fab fa-soundcloud"></i></a>
                    </p>
                    <button class="btn"><i class="fas fa-share-alt"></i> مشاركة </button>
                  </div>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  <div class="content active" id="playlists">
    <!-- Content for playlists goes here -->
   
    <div class="container-fluid mt-5 p-5">
      <div class="row">
        @foreach ($playlists as $playlist)
          <div class="col-md-4 mt-4">
            <a href="{{route('episodes',$playlist)}}">
              <div class="card">
                <img src="{{asset('media/'.$playlist->image)}}" class="card-img-top w-100 h-100" alt="Podcast Image">
                <div class="card-body">
                  <div class="row justify-content-between">
                    <h5 class="card-title col-md-5 d-flex justify-content-start"> {{$playlist->ar_title}}</h5>
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
                    <a class="btn" href="{{$playlist->tiktok_link}}"><i class="fab fa-tiktok"></i></a>
                    <a class="btn" href="{{$playlist->spotify_link}}"><i class="fab fa-spotify"></i></a>
                    <a class="btn" href="{{$playlist->youtube_link}}"><i class="fab fa-youtube"></i></a>
                    <a class="btn" href="{{$playlist->sound_link}}"><i class="fab fa-soundcloud"></i></a>
                  </div>
                  <button class="btn"><i class="fas fa-share-alt"></i> مشاركة </button>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
      <div class="row d-flex justify-content-center mt-5" style="direction: ltr;">
        {{$playlists->links()}}
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
