<div style="display: none" id="createObjectCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('news.Create Title')</h5>
        </div>
        <div class="col-6 text-end">
            <div class="toggle-btn btn btn-outline-dark btn-sm" data-current-card="#createObjectCard" data-target-card="#objectsCard">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div><!-- /.row -->
    <hr/>

    <form action="/" id="objectForm" enctype="multipart/form-data">
       

        <div class="my-3 row">
            <label for="ar_title" class="col-sm-2 col-form-label">@lang('news.Ar Title') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="ar_title" placeholder="@lang('news.Ar Title')">
                <div style="padding: 5px 7px; display: none" id="ar_titleErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="en_title" class="col-sm-2 col-form-label">@lang('news.En Title') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="en_title" placeholder="@lang('news.En Title')">
                <div style="padding: 5px 7px; display: none" id="en_titleErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        

        <div class="my-3 row">
            <label for="video" class="col-sm-2 col-form-label">@lang('news.Video link') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="video" placeholder="@lang('news.En Head')">
                <div style="padding: 5px 7px; display: none" id="videoErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->


        <div class="my-3 row">
            <label for="number" class="col-sm-2 col-form-label">@lang('news.Episode number') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="number" placeholder="@lang('news.Ar Head')">
                <div style="padding: 5px 7px; display: none" id="numberErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="time" class="col-sm-2 col-form-label">@lang('news.video time') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="time" placeholder="@lang('news. 1 ساعة و23 دقيقة')">
                <div style="padding: 5px 7px; display: none" id="timeErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="ar_description" class="col-sm-2 col-form-label">@lang('news.Episode ar_description') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <textarea class="form-control" id="ar_description" rows="3" placeholder="@lang('news.Ar Content')"></textarea>
                <div style="padding: 5px 7px; display: none" id="ar_descriptionErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="en_description" class="col-sm-2 col-form-label">@lang('news.En description') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <textarea class="form-control" id="en_description" rows="3" placeholder="@lang('news.En description')"></textarea>
                <div style="padding: 5px 7px; display: none" id="en_descriptionErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="playlist_id" class="col-sm-2 col-form-label">@lang('news.playlist')</label>
            <div class="col-sm-10">
                <select class="form-control select2 w-100" id="playlist_id" name="playlist_id">
                    <option value="">@lang('news.Select Category')</option>
                </select>
                <div style="padding: 5px 7px; display: none" id="playlist_idErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

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


        <button class="create-object btn btn-primary float-end mx-3">@lang('news.Create Title')</button>
    </form>
</div>
