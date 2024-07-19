<div style="display: none" id="showObjectsCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('news.Show Title')</h5>
        </div>
        <div class="col-6 text-end">
            <div class="toggle-btn btn btn-outline-dark btn-sm" data-current-card="#showObjectsCard" data-target-card="#objectsCard">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div><!-- /.row -->
    <hr/>

    <div class="my-1">
        <div class="my-3 row">
            <label for="show-ar_head" class="col-sm-2 col-form-label">@lang('news.Ar Head')</label>
            <div class="col-sm-10">
                <input type="text" disabled="disabled" class="form-control" id="show-ar_head" placeholder="@lang('news.Ar Head')">
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="show-ar_title" class="col-sm-2 col-form-label">@lang('news.Ar Title')</label>
            <div class="col-sm-10">
                <input type="text" disabled="disabled" class="form-control" id="show-ar_title" placeholder="@lang('news.Ar Title')">
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="show-ar_content" class="col-sm-2 col-form-label">@lang('news.Ar Content')</label>
            <div class="col-sm-10">
                <textarea disabled="disabled" class="form-control" id="show-ar_content" rows="3" placeholder="@lang('news.Ar Content')"></textarea>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="show-en_head" class="col-sm-2 col-form-label">@lang('news.En Head')</label>
            <div class="col-sm-10">
                <input type="text" disabled="disabled" class="form-control" id="show-en_head" placeholder="@lang('news.En Head')">
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="show-en_title" class="col-sm-2 col-form-label">@lang('news.En Title')</label>
            <div class="col-sm-10">
                <input type="text" disabled="disabled" class="form-control" id="show-en_title" placeholder="@lang('news.En Title')">
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="show-en_content" class="col-sm-2 col-form-label">@lang('news.En Content')</label>
            <div class="col-sm-10">
                <textarea disabled="disabled" class="form-control" id="show-en_content" rows="3" placeholder="@lang('news.En Content')"></textarea>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="show-image" class="col-sm-2 col-form-label">@lang('news.Image')</label>
            <div class="col-sm-10">
                <img id="show-image" src="" alt="@lang('news.Image')" style="max-width: 200px; margin-top: 10px;">
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="show-news_category_id" class="col-sm-2 col-form-label">@lang('news.Category')</label>
            <div class="col-sm-10">
                <input type="text" disabled="disabled" class="form-control" id="show-news_category_id" placeholder="@lang('news.Category')">
            </div>
        </div><!-- /.my-3 -->
    </div><!-- /.my-1 -->
</div><!-- /.card -->
