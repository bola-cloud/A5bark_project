<div style="display: none" id="createObjectCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('news.Create Place')</h5>
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
            <label for="ar_name" class="col-sm-2 col-form-label">@lang('news.Ar Name') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="ar_name" placeholder="@lang('news.Ar Name')">
                <div style="padding: 5px 7px; display: none" id="ar_nameErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="en_name" class="col-sm-2 col-form-label">@lang('news.En Name') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="en_name" placeholder="@lang('news.En Name')">
                <div style="padding: 5px 7px; display: none" id="en_nameErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="address" class="col-sm-2 col-form-label">@lang('news.Address') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="address" placeholder="@lang('news.Address')">
                <div style="padding: 5px 7px; display: none" id="addressErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="working_hours" class="col-sm-2 col-form-label">@lang('news.Working Hours') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="working_hours" placeholder="@lang('news.Working Hours')">
                <div style="padding: 5px 7px; display: none" id="working_hoursErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="branch_id" class="col-sm-2 col-form-label">@lang('news.Branch')</label>
            <div class="col-sm-10">
                <select class="form-control select2 w-100" id="branch_id" name="branch_id">
                    <option value="">@lang('news.Select Branch')</option>
                </select>
                <div style="padding: 5px 7px; display: none" id="branch_idErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->


        <button class="create-object btn btn-primary float-end mx-3">@lang('news.Create Name')</button>
    </form>
</div>
