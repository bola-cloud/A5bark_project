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
          <h1 class="d-flex justify-content-center blue-color"> {{$playlist->ar_title}} </h1>  
        </div>
        <div class="row d-flex justify-content-center">
          <div class="col-md-12 d-flex justify-content-center">
            <img src="{{ asset('media/'.$playlist->image) }}" alt="Podcast Banner" class="w-75">
          </div>
        </div>
    </div>
    <div class="container-fluid mt-5">
        <div class="row d-flex justify-content-center">
          @foreach ($episodes as $episode)
            <div class="col-md-3">
              <a href="">
                <div class="custom-card" style="min-width: 45vh;">
                  @php
                    // Function to check if the URL is a YouTube URL and extract the video ID
                    function getYouTubeVideoId($url) {
                        if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
                            preg_match('/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches);
                            return $matches[1] ?? null;
                        }
                        return null;
                    }

                    $videoUrl = $episode->video;
                    $videoId = getYouTubeVideoId($videoUrl);
                  @endphp

                  @if($videoId)
                      <!-- Display YouTube video -->
                      <iframe src="https://www.youtube.com/embed/{{ $videoId }}" class="w-100 h-100"
                      style="min-height: 30vh;" frameborder="0" allowfullscreen></iframe>
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
        <div class="row d-flex justify-content-center mt-5" style="direction: ltr;">
          {{$episodes->links()}}
        </div>
    </div>
</div>

@endsection
