<div style="display: none" id="editObjectsCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('festival.Update Festival')</h5>
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
            <label for="edit-ar_title" class="col-sm-2 col-form-label">@lang('festival.Ar Title')</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-ar_title" placeholder="@lang('festival.Ar Title')">
            </div>
        </div>

        <div class="my-3 row">
            <label for="edit-en_title" class="col-sm-2 col-form-label">@lang('festival.En Title')</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-en_title" placeholder="@lang('festival.En Title')">
            </div>
        </div>

        <div class="my-3 row">
            <label for="edit-location" class="col-sm-2 col-form-label">@lang('festival.location')</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-location" placeholder="@lang('festival.location')">
            </div>
        </div>

        <div class="my-3 row">
            <label for="edit-media" class="col-sm-2 col-form-label">@lang('festival.media')</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="edit-media" placeholder="@lang('festival.media')" accept="images/*">
                <div style="padding: 5px 7px; display: none" id="edit-mediaErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div>

        <div class="my-3 row">
            <label for="edit-start_date" class="col-sm-2 col-form-label">@lang('festival.start_date')</label>
            <div class="col-sm-10">
                <input type="datetime-local" class="form-control" id="edit-start_date" placeholder="@lang('festival.start_date')">
            </div>
        </div>

        <button class="update-object btn btn-warning float-end mx-3">@lang('festival.Update Title')</button>
    </form>
</div>

