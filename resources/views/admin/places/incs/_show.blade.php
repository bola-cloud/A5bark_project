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
            <label for="show-ar_name" class="col-sm-2 col-form-label">@lang('news.Ar Name')</label>
            <div class="col-sm-10">
                <input type="text" disabled="disabled" class="form-control" id="show-ar_name" placeholder="@lang('news.Ar Name')">
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="show-en_name" class="col-sm-2 col-form-label">@lang('news.En Name')</label>
            <div class="col-sm-10">
                <input type="text" disabled="disabled" class="form-control" id="show-en_name" placeholder="@lang('news.En Name')">
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="show-address" class="col-sm-2 col-form-label">@lang('news.Address')</label>
            <div class="col-sm-10">
                <textarea disabled="disabled" class="form-control" id="show-address" rows="3" placeholder="@lang('news.Address')"></textarea>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="show-working_hours" class="col-sm-2 col-form-label">@lang('news.Working Hours')</label>
            <div class="col-sm-10">
                <input type="text" disabled="disabled" class="form-control" id="show-working_hours" placeholder="@lang('news.Working Hours')">
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="show-branch_id" class="col-sm-2 col-form-label">@lang('news.Branch')</label>
            <div class="col-sm-10">
                <input type="text" disabled="disabled" class="form-control" id="show-branch_id" placeholder="@lang('news.Branch')">
            </div>
        </div><!-- /.my-3 -->
    </div><!-- /.my-1 -->
</div><!-- /.card -->
