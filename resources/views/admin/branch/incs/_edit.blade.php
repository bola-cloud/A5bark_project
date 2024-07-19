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
            <label for="edit-ar_name" class="col-sm-2 col-form-label">@lang('news.Ar Name') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-ar_name" placeholder="@lang('news.Ar Name')">
                <div style="padding: 5px 7px; display: none" id="edit-ar_nameErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="edit-en_name" class="col-sm-2 col-form-label">@lang('news.En Name') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-en_name" placeholder="@lang('news.En Name')">
                <div style="padding: 5px 7px; display: none" id="edit-en_nameErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="edit-image" class="col-sm-2 col-form-label">@lang('news.Image')</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="edit-image" name="image">
                <div style="padding: 5px 7px; display: none" id="edit-imageErr" class="err-msg mt-2 alert alert-danger"></div>
                <img id="existing-image" src="" alt="Existing Image" class="mt-3" style="max-height: 200px; display: none;">
            </div>
        </div>
        
        

        <button class="update-object btn btn-warning float-end mx-3">@lang('news.Update Title')</button>
    </form>
</div>
