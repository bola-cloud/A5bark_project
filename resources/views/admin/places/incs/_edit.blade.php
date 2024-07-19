<div style="display: none" id="editObjectsCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('news.Update Title')</h5>
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
            <label for="edit-ar_head" class="col-sm-2 col-form-label">@lang('news.Ar Head') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-ar_head" placeholder="@lang('news.Ar Head')">
                <div style="padding: 5px 7px; display: none" id="edit-ar_headErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="edit-ar_title" class="col-sm-2 col-form-label">@lang('news.Ar Title') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-ar_title" placeholder="@lang('news.Ar Title')">
                <div style="padding: 5px 7px; display: none" id="edit-ar_titleErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="edit-ar_content" class="col-sm-2 col-form-label">@lang('news.Ar Content') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <textarea class="form-control" id="edit-ar_content" rows="3" placeholder="@lang('news.Ar Content')"></textarea>
                <div style="padding: 5px 7px; display: none" id="edit-ar_contentErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="edit-en_head" class="col-sm-2 col-form-label">@lang('news.En Head') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-en_head" placeholder="@lang('news.En Head')">
                <div style="padding: 5px 7px; display: none" id="edit-en_headErr" class="err-msg mt-2 alert alert-danger"></div>
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
            <label for="edit-en_content" class="col-sm-2 col-form-label">@lang('news.En Content') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <textarea class="form-control" id="edit-en_content" rows="3" placeholder="@lang('news.En Content')"></textarea>
                <div style="padding: 5px 7px; display: none" id="edit-en_contentErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="edit-image" class="col-sm-2 col-form-label">@lang('news.Image')</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="edit-image">
                <div style="padding: 5px 7px; display: none" id="edit-imageErr" class="err-msg mt-2 alert alert-danger"></div>
                <img id="existing-image" src="" alt="Existing Image" class="mt-3" style="max-height: 200px; display: none;">
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="edit-branch_id" class="col-sm-2 col-form-label">@lang('news.Branch')</label>
            <div class="col-sm-10">
                <select class="form-control select2" id="edit-branch_id">
                    <option value="">@lang('news.Select Branch')</option>
                </select>
                <div style="padding: 5px 7px; display: none" id="edit-branch_idErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <button class="update-object btn btn-warning float-end mx-3">@lang('news.Update Title')</button>
    </form>
</div>
