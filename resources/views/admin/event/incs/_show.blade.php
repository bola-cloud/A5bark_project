<div style="display: none" id="showObjectsCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('news.Show Events')</h5>
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
            <label for="show-ar_title" class="col-sm-2 col-form-label">@lang('news.Ar Title')</label>
            <div class="col-sm-10">
                <input type="text" disabled="disabled" class="form-control" id="show-ar_title" placeholder="@lang('news.Ar Title')">
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="show-en_title" class="col-sm-2 col-form-label">@lang('news.En Title')</label>
            <div class="col-sm-10">
                <input type="text" disabled="disabled" class="form-control" id="show-en_title" placeholder="@lang('news.En Title')">
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="show-location" class="col-sm-2 col-form-label">@lang('news.location')</label>
            <div class="col-sm-10">
                <input type="text" disabled="disabled" class="form-control" id="show-location" placeholder="@lang('news.location')">
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="show-price" class="col-sm-2 col-form-label">@lang('news.price')</label>
            <div class="col-sm-10">
                <input type="text" disabled="disabled" class="form-control" id="show-price" placeholder="@lang('news.price')">
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="show-tickets" class="col-sm-2 col-form-label">@lang('event.tickets_number')</label>
            <div class="col-sm-10">
                <input type="text" disabled="disabled" class="form-control" id="show-tickets" placeholder="@lang('event.tickets_number')">
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="show-date" class="col-sm-2 col-form-label">@lang('news.start_date')</label>
            <div class="col-sm-10">
                <input type="text" disabled="disabled" class="form-control" id="show-date" placeholder="@lang('news.start_date')">
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="show-festival_id" class="col-sm-2 col-form-label">@lang('festival.festival')</label>
            <div class="col-sm-10">
                <select class="form-control select2 w-100" id="show-festival_id" disabled>
                    <option value="">@lang('news.Select Category')</option>
                </select>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="show-image" class="col-sm-2 col-form-label">@lang('news.Image')</label>
            <div class="col-sm-10">
                <img id="show-image" src="" alt="@lang('news.Image')" style="max-width: 200px; margin-top: 10px;">
            </div>
        </div><!-- /.my-3 -->

    </div><!-- /.my-1 -->
</div><!-- /.card -->
