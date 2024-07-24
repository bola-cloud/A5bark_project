<div style="display: none" id="editObjectsCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('news.Update Events')</h5>
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
            <label for="edit-location" class="col-sm-2 col-form-label">@lang('news.location') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-location" placeholder="@lang('news.location')">
                <div style="padding: 5px 7px; display: none" id="edit-locationErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="edit-price" class="col-sm-2 col-form-label">@lang('news.price') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="edit-price" placeholder="@lang('news.price')">
                <div style="padding: 5px 7px; display: none" id="edit-priceErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="edit-tickets" class="col-sm-2 col-form-label">@lang('event.tickets_number') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="edit-tickets" placeholder="@lang('event.tickets_number')">
                <div style="padding: 5px 7px; display: none" id="edit-priceErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="edit-date" class="col-sm-2 col-form-label">@lang('festival.start_date')</label>
            <div class="col-sm-10">
                <input type="datetime-local" class="form-control" id="edit-date" placeholder="@lang('festival.start_date')">
            </div>
        </div>       

        <div class="my-3 row">
            <label for="edit-day" class="col-sm-2 col-form-label">@lang('news.day') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-day" placeholder="@lang('news.day')">
                <div style="padding: 5px 7px; display: none" id="edit-dayErr" class="err-msg mt-2 alert alert-danger"></div>
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
            <label for="edit-festival_id" class="col-sm-2 col-form-label">@lang('festival.festival')</label>
            <div class="col-sm-10">
                <select class="form-control select2" id="edit-festival_id">
                    <option value="">@lang('news.Select Category')</option>
                </select>
                <div style="padding: 5px 7px; display: none" id="edit-festival_idErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <button class="update-object btn btn-warning float-end mx-3">@lang('news.Update Title')</button>
    </form>
</div>
