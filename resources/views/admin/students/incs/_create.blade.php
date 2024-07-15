
<div style="display: none" id="createObjectCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('students.Create Title')</h5>
        </div>
        <div class="col-6 text-end">
            <div class="toggle-btn btn btn-outline-dark btn-sm" data-current-card="#createObjectCard" data-target-card="#objectsCard">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div><!-- /.row -->
    <hr/>

    <form action="/" id="objectForm">
        <div class="my-2 row">
            <label for="name" class="col-sm-2 col-form-label">@lang('students.Name') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="@lang('students.Name')">
                <div style="padding: 5px 7px; display: none" id="nameErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-2 -->
        
        <div class="my-2 row">
            <label for="phone" class="col-sm-2 col-form-label">@lang('students.Phone') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="phone" class="form-control" id="phone" placeholder="@lang('students.Phone')">
                <div style="padding: 5px 7px; display: none" id="phoneErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-2 -->
        
        <div class="my-2 row">
            <label for="email" class="col-sm-2 col-form-label">@lang('students.Email') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" placeholder="@lang('students.Email')">
                <div style="padding: 5px 7px; display: none" id="emailErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-2 -->

        <div class="my-2 row">
            <label for="birth_date" class="col-sm-2 col-form-label">@lang('students.Birth Date') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="birth_date" placeholder="@lang('students.Birth Date')">
                <div style="padding: 5px 7px; display: none" id="birth_dateErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-2 -->
        
        <div class="my-2 row">
            <label for="password" class="col-sm-2 col-form-label">@lang('users.Password')</label>
            <div class="col-sm-10">
                <input class="form-control" id="password" placeholder="@lang('users.Password')">
                <div style="padding: 5px 7px; display: none" id="passwordErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-2 -->

        <div class="my-2 row">
            <label for="parent_id" class="col-sm-2 col-form-label">@lang('students.Parent')</label>
            <div class="col-sm-10">
                <select class="form-control" id="parent_id"></select>
                <div style="padding: 5px 7px; display: none" id="parent_idErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-2 -->

        <div class="my-2 row">
            <label for="preferences" class="col-sm-2 col-form-label">@lang('students.Preferences')</label>
            <div class="col-sm-10">
                <select class="form-control" id="preferences" multiple="multiple"></select>
                <div style="padding: 5px 7px; display: none" id="preferencesErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-2 -->
        
        <div class="my-2 row">
            <label for="parent_phone" class="col-sm-2 col-form-label">@lang('students.Government')</label>
            <div class="col-sm-5">
                <select class="form-control" id="gove_id"></select>
                <div style="padding: 5px 7px; display: none" id="gove_idErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
            <div class="col-sm-5">
                <select class="form-control" id="cent_id"></select>
                <div style="padding: 5px 7px; display: none" id="cent_idErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-2 -->

        <div class="my-2 row">
            <label for="address" class="col-sm-2 col-form-label">@lang('students.Address')</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="address" placeholder="@lang('students.Address')"></textarea>
                <div style="padding: 5px 7px; display: none" id="addressErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-2 -->

        <button class="create-object btn btn-primary float-end">@lang('students.Create Title')</button>
    </form>
</div>

@push('custome-js')
<script>
$(document).ready(function () {
    
});
</script>
@endpush