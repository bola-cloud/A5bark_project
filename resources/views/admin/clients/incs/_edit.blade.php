<div style="display: none" id="editObjectsCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('clients.Update Title')</h5>
        </div>
        <div class="col-6 text-end">
            <div class="toggle-btn btn btn-outline-dark btn-sm" data-current-card="#editObjectsCard" data-target-card="#objectsCard">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div><!-- /.row -->
    <hr/>

    <form action="/" id="objectForm">
        <input type="hidden" id="edit-id">

        <div class="my-3 row">
            <label for="edit-name" class="col-sm-2 col-form-label">@lang('clients.Name') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-name" placeholder="@lang('clients.Name')">
                <div style="padding: 5px 7px; display: none" id="edit-nameErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-3 -->
        
        <div class="my-3 row">
            <label for="edit-phone" class="col-sm-2 col-form-label">@lang('clients.Phone') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="edit-phone" class="form-control" id="edit-phone" placeholder="@lang('clients.Phone')">
                <div style="padding: 5px 7px; display: none" id="edit-phoneErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-3 -->
        
        <div class="my-3 row">
            <label for="edit-birth_day" class="col-sm-2 col-form-label">@lang('clients.Birth Day') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="edit-birth_day">
                <div style="padding: 5px 7px; display: none" id="edit-birth_dayErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="edit-email" class="col-sm-2 col-form-label">@lang('clients.Email')</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="edit-email" placeholder="@lang('clients.Email')">
                <div style="padding: 5px 7px; display: none" id="edit-emailErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-3 -->
        
        <div class="my-3 row">
            <label for="edit-gender" class="col-sm-2 col-form-label">@lang('clients.Gender')</label>
            <div class="col-sm-10">
                <select type="edit-gender" class="form-control" id="edit-gender" placeholder="@lang('clients.Gender')">
                    <option value="">@lang('clients.select gender')</option>
                    <option value="male">@lang('clients.male')</option>
                    <option value="female">@lang('clients.female')</option>
                </select>
                <div style="padding: 5px 7px; display: none" id="edit-genderErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label class="col-sm-2 col-form-label">@lang('clients.District') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10 row">
                <div class="col-sm-6">
                    <select id="edit-gove_id" data-target="#edit-dist_id" class="form-control"></select>
                    <div style="padding: 5px 7px; display: none" id="edit-gove_idErr" class="err-msg mt-2 alert alert-danger">
                    </div>
                </div>
                <div class="col-sm-6">
                    <select id="edit-dist_id" class="form-control" disabled="disabled"></select>
                    <div style="padding: 5px 7px; display: none" id="edit-dist_idErr" class="err-msg mt-2 alert alert-danger">
                    </div>
                </div>
            </div><!-- /.col-sm-10 -->
        </div><!-- /.my-3 -->
        
        <div class="my-3 row">
            <label for="edit-password" class="col-sm-2 col-form-label">@lang('clients.Password')</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-password" placeholder="@lang('clients.Password')">
            </div>
        </div><!-- /.my-3 -->

        <button class="update-object btn btn-warning float-end">@lang('clients.Update Title')</button>
    </form>
</div>