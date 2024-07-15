
<div style="display: none" id="createObjectCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('clients.Create Title')</h5>
        </div>
        <div class="col-6 text-end">
            <div class="toggle-btn btn btn-outline-dark btn-sm" data-current-card="#createObjectCard" data-target-card="#objectsCard">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div><!-- /.row -->
    <hr/>

    <form action="/" id="objectForm">
        <div class="my-3 row">
            <label for="name" class="col-sm-2 col-form-label">@lang('clients.Name') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="@lang('clients.Name')">
                <div style="padding: 5px 7px; display: none" id="nameErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-3 -->
        
        <div class="my-3 row">
            <label for="phone" class="col-sm-2 col-form-label">@lang('clients.Phone') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="phone" class="form-control" id="phone" placeholder="@lang('clients.Phone')">
                <div style="padding: 5px 7px; display: none" id="phoneErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-3 -->
        
        <div class="my-3 row">
            <label for="birth_day" class="col-sm-2 col-form-label">@lang('clients.Birth Day') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="birth_day">
                <div style="padding: 5px 7px; display: none" id="birth_dayErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-3 -->
        
        <div class="my-3 row">
            <label for="email" class="col-sm-2 col-form-label">@lang('clients.Email')</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" placeholder="@lang('clients.Email')">
                <div style="padding: 5px 7px; display: none" id="emailErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-3 -->
        
        <div class="my-3 row">
            <label for="gender" class="col-sm-2 col-form-label">@lang('clients.Gender')</label>
            <div class="col-sm-10">
                <select type="gender" class="form-control" id="gender" placeholder="@lang('clients.Gender')">
                    <option value="">@lang('clients.select gender')</option>
                    <option value="male">@lang('clients.male')</option>
                    <option value="female">@lang('clients.female')</option>
                </select>
                <div style="padding: 5px 7px; display: none" id="genderErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label class="col-sm-2 col-form-label">@lang('clients.District') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10 row">
                <div class="col-sm-6">
                    <select id="gove_id" data-target="#dist_id" class="form-control"></select>
                    <div style="padding: 5px 7px; display: none" id="gove_idErr" class="err-msg mt-2 alert alert-danger">
                    </div>
                </div>
                <div class="col-sm-6">
                    <select id="dist_id" class="form-control" disabled="disabled"></select>
                    <div style="padding: 5px 7px; display: none" id="dist_idErr" class="err-msg mt-2 alert alert-danger">
                    </div>
                </div>
            </div><!-- /.col-sm-10 -->
        </div><!-- /.my-3 -->
        
        <div class="my-3 row">
            <label for="password" class="col-sm-2 col-form-label">@lang('clients.Password')</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="password" placeholder="@lang('clients.Password')">
            </div>
        </div><!-- /.my-3 -->
        
        <button class="create-object btn btn-primary float-end">@lang('clients.Create Title')</button>
    </form>
</div>