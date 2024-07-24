<div style="display: none" id="editObjectsCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('news.Update Episode')</h5>
        </div>
        <div class="col-6 text-end">
            <div class="toggle-btn btn btn-outline-dark btn-sm" data-current-card="#editObjectsCard" data-target-card="#objectsCard">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div><!-- /.row -->
    <hr/>

    <form action="/" id="editObjectForm" enctype="multipart/form-data">
        <input type="hidden" id="edit-id">

        <div class="my-3 row">
            <label for="edit-ar_title" class="col-sm-2 col-form-label">@lang('news.Ar Title') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-ar_title" placeholder="@lang('news.Ar Title')">
                <div style="padding: 5px 7px; display: none" id="edit-ar_titleErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="edit-en_title" class="col-sm-2 col-form-label">@lang('news.En Title') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-en_title" placeholder="@lang('news.En Title')">
                <div style="padding: 5px 7px; display: none" id="edit-en_titleErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="edit-ar_description" class="col-sm-2 col-form-label">@lang('news.Episode ar_description') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <textarea class="form-control" id="edit-ar_description" rows="3" placeholder="@lang('news.Episode ar_description')"></textarea>
                <div style="padding: 5px 7px; display: none" id="edit-ar_descriptionErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="edit-en_description" class="col-sm-2 col-form-label">@lang('news.En description') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <textarea class="form-control" id="edit-en_description" rows="3" placeholder="@lang('news.En description')"></textarea>
                <div style="padding: 5px 7px; display: none" id="edit-en_descriptionErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="edit-time" class="col-sm-2 col-form-label">@lang('news.video time') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-time" placeholder="@lang('news.video time')">
                <div style="padding: 5px 7px; display: none" id="edit-timeErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="edit-sound_link" class="col-sm-2 col-form-label">@lang('festival.sound_link') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-sound_link" placeholder="@lang('festival.sound_link')">
                <div style="padding: 5px 7px; display: none" id="edit-sound_linkErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="edit-spotify_link" class="col-sm-2 col-form-label">@lang('festival.spotify_link') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-spotify_link" placeholder="@lang('festival.spotify_link')">
                <div style="padding: 5px 7px; display: none" id="edit-spotify_linkErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="edit-titok_link" class="col-sm-2 col-form-label">@lang('festival.tiktok_link') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-titok_link" placeholder="@lang('festival.tiktok_link')">
                <div style="padding: 5px 7px; display: none" id="edit-titok_linkErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="edit-youtube_link" class="col-sm-2 col-form-label">@lang('festival.youtube_link') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-youtube_link" placeholder="@lang('festival.youtube_link')">
                <div style="padding: 5px 7px; display: none" id="edit-youtube_link" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="edit-video" class="col-sm-2 col-form-label">@lang('news.Video link') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-video" placeholder="@lang('news.Video link')">
                <div style="padding: 5px 7px; display: none" id="edit-videoErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->


        <div class="my-3 row">
            <label for="edit-number" class="col-sm-2 col-form-label">@lang('news.Episode number') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-number" placeholder="@lang('news.Episode number')">
                <div style="padding: 5px 7px; display: none" id="edit-numberErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        

        <div class="my-3 row">
            <label for="edit-playlist_id" class="col-sm-2 col-form-label">@lang('news.Category')</label>
            <div class="col-sm-10">
                <select class="form-control select2" id="edit-playlist_id">
                    <option value="">@lang('news.Select Category')</option>
                </select>
                <div style="padding: 5px 7px; display: none" id="edit-playlist_idErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <button class="update-object btn btn-warning float-end mx-3">@lang('news.Update Title')</button>
    </form>
</div>
