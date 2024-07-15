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
            <label for="location" class="col-sm-2 col-form-label">@lang('festival.location')</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="location" placeholder="@lang('festival.location')">
            </div>
        </div>

        <div class="my-3 row">
            <label for="media" class="col-sm-2 col-form-label">@lang('festival.media') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="media" placeholder="@lang('festival.media')" accept="images/*">
                <div style="padding: 5px 7px; display: none" id="mediaErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div>

        <div class="my-3 row">
            <label for="start_date" class="col-sm-2 col-form-label">@lang('festival.start_date')</label>
            <div class="col-sm-10">
                <input type="datetime-local" class="form-control" id="start_date" placeholder="@lang('festival.start_date')">
            </div>
        </div>

        <button class="create-object btn btn-primary float-end mx-3">@lang('festival.Create Title')</button>
    </form>
</div>
