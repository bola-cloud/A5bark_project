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
            <label for="ar_head" class="col-sm-2 col-form-label">@lang('news.Ar Head') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="ar_head" placeholder="@lang('news.Ar Head')">
                <div style="padding: 5px 7px; display: none" id="ar_headErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="ar_title" class="col-sm-2 col-form-label">@lang('news.Ar Title') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="ar_title" placeholder="@lang('news.Ar Title')">
                <div style="padding: 5px 7px; display: none" id="ar_titleErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="ar_content" class="col-sm-2 col-form-label">@lang('news.Ar Content') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <textarea class="form-control" id="ar_content" rows="3" placeholder="@lang('news.Ar Content')"></textarea>
                <div style="padding: 5px 7px; display: none" id="ar_contentErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="en_head" class="col-sm-2 col-form-label">@lang('news.En Head') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="en_head" placeholder="@lang('news.En Head')">
                <div style="padding: 5px 7px; display: none" id="en_headErr" class="err-msg mt-2 alert alert-danger"></div>
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
            <label for="en_content" class="col-sm-2 col-form-label">@lang('news.En Content') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <textarea class="form-control" id="en_content" rows="3" placeholder="@lang('news.En Content')"></textarea>
                <div style="padding: 5px 7px; display: none" id="en_contentErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="image" class="col-sm-2 col-form-label">@lang('news.Image')</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="image">
                <div style="padding: 5px 7px; display: none" id="imageErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->


        <button class="create-object btn btn-primary float-end mx-3">@lang('news.Create Title')</button>
    </form>
</div>
