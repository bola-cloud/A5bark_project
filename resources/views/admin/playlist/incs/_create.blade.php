<div style="display: none" id="createObjectCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('festival.Create Title')</h5>
        </div>
        <div class="col-6 text-end">
            <div class="toggle-btn btn btn-outline-dark btn-sm" data-current-card="#createObjectCard" data-target-card="#objectsCard">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div>
    <hr/>

    <form action="/" id="objectForm" enctype="multipart/form-data">
        
        <div class="my-3 row">
            <label for="ar_title" class="col-sm-2 col-form-label">@lang('festival.ar_title')</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="ar_title" placeholder="@lang('festival.ar_title')">
            </div>
        </div>

        <div class="my-3 row">
            <label for="en_title" class="col-sm-2 col-form-label">@lang('festival.en_title')</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="en_title" placeholder="@lang('festival.en_title')">
            </div>
        </div>

        <div class="my-3 row">
            <label for="image" class="col-sm-2 col-form-label">@lang('festival.image') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="image" placeholder="@lang('festival.image')" accept="images/*">
                <div style="padding: 5px 7px; display: none" id="imageErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div>

        <div class="my-3 row">
            <label for="sound_link" class="col-sm-2 col-form-label">@lang('festival.sound_link')</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="sound_link" placeholder="@lang('festival.sound_link')">
            </div>
        </div>

        <div class="my-3 row">
            <label for="spotify_link" class="col-sm-2 col-form-label">@lang('festival.spotify_link')</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="spotify_link" placeholder="@lang('festival.spotify_link')">
            </div>
        </div>

        <div class="my-3 row">
            <label for="titok_link" class="col-sm-2 col-form-label">@lang('festival.titok_link')</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="titok_link" placeholder="@lang('festival.titok_link')">
            </div>
        </div>

        <div class="my-3 row">
            <label for="youtube_link" class="col-sm-2 col-form-label">@lang('festival.youtube_link')</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="youtube_link" placeholder="@lang('festival.youtube_link')">
            </div>
        </div>

        <button class="create-object btn btn-primary float-end mx-3">@lang('festival.Create Title')</button>
    </form>
</div>
