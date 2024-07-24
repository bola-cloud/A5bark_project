<div style="display: none" id="editObjectsCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('festival.Update Play List')</h5>
        </div>
        <div class="col-6 text-end">
            <div class="toggle-btn btn btn-outline-dark btn-sm" data-current-card="#editObjectsCard" data-target-card="#objectsCard">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div>
    <hr/>

    <form action="/" id="editObjectForm" enctype="multipart/form-data">
        <input type="hidden" id="edit-id">

        <div class="my-3 row">
            <label for="edit-ar_title" class="col-sm-2 col-form-label">@lang('festival.ar_title')</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-ar_title" placeholder="@lang('festival.ar_title')">
            </div>
        </div>

        <div class="my-3 row">
            <label for="edit-en_title" class="col-sm-2 col-form-label">@lang('festival.en_title')</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-en_title" placeholder="@lang('festival.en_title')">
            </div>
        </div>

        <div class="my-3 row">
            <label for="edit-image" class="col-sm-2 col-form-label">@lang('festival.image')</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="edit-image" placeholder="@lang('festival.image')" accept="images/*">
                <div style="padding: 5px 7px; display: none" id="edit-imageErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div>

        <div class="my-3 row">
            <label for="edit-sound_link" class="col-sm-2 col-form-label">@lang('festival.sound_link')</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-sound_link" placeholder="@lang('festival.sound_link')">
            </div>
        </div>

        <div class="my-3 row">
            <label for="edit-spotify_link" class="col-sm-2 col-form-label">@lang('festival.spotify_link')</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-spotify_link" placeholder="@lang('festival.spotify_link')">
            </div>
        </div>

        <div class="my-3 row">
            <label for="edit-titok_link" class="col-sm-2 col-form-label">@lang('festival.titok_link')</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-titok_link" placeholder="@lang('festival.titok_link')">
            </div>
        </div>
        <div class="my-3 row">
            <label for="edit-youtube_link" class="col-sm-2 col-form-label">@lang('festival.youtube_link')</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-youtube_link" placeholder="@lang('festival.youtube_link')">
            </div>
        </div>
        
    
        <button class="update-object btn btn-warning float-end mx-3">@lang('festival.Update Title')</button>
    </form>
</div>

