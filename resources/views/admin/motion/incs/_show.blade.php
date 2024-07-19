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
            <label for="show-content" class="col-sm-2 col-form-label" data-lang-image="@lang('news.Image')">@lang('news.Image')</label>
            <div class="col-sm-10">
                <div id="show-content" style="max-width: 200px; margin-top: 10px;"></div>
            </div>
        </div><!-- /.my-3 -->
        
    </div><!-- /.my-1 -->
</div><!-- /.card -->


