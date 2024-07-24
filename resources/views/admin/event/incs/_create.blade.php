<div style="display: none" id="createObjectCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('news.Create Events')</h5>
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
            <label for="ar_title" class="col-sm-2 col-form-label">@lang('news.Ar Title') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="ar_title" placeholder="@lang('news.Ar Title')">
                <div style="padding: 5px 7px; display: none" id="ar_titleErr" class="err-msg mt-2 alert alert-danger"></div>
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
            <label for="location" class="col-sm-2 col-form-label">@lang('festival.location')</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="location" placeholder="@lang('festival.location')">
            </div>
        </div> <!-- /.my-3 -->       

        <div class="my-3 row">
            <label for="price" class="col-sm-2 col-form-label">@lang('festival.price')</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="price" placeholder="@lang('festival.price')">
            </div>
        </div> <!-- /.my-3 -->

        <div class="my-3 row">
            <label for="tickets" class="col-sm-2 col-form-label">@lang('event.tickets_number')</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="tickets" placeholder="@lang('event.tickets_number')">
            </div>
        </div> <!-- /.my-3 -->

        <div class="my-3 row">
            <label for="date" class="col-sm-2 col-form-label">@lang('festival.start_date')</label>
            <div class="col-sm-10">
                <input type="datetime-local" class="form-control" id="date" placeholder="@lang('festival.start_date')">
            </div>
        </div>

        <div class="my-3 row">
            <label for="image" class="col-sm-2 col-form-label">@lang('news.Image')</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="image" accept="images/*">
                <div style="padding: 5px 7px; display: none" id="imageErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="festival_id" class="col-sm-2 col-form-label">@lang('festival.festival')</label>
            <div class="col-sm-10">
                <select class="form-control select2 w-100" id="festival_id" name="festival_id">
                    <option value="">@lang('news.Select Category')</option>
                </select>
                <div style="padding: 5px 7px; display: none" id="festival_idErr" class="err-msg mt-2 alert alert-danger"></div>
            </div>
        </div><!-- /.my-3 -->

        <button class="create-object btn btn-primary float-end mx-3">@lang('news.Create Title')</button>
    </form>
</div>
