<div style="display: none" id="editObjectsCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('students.Update Title')</h5>
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

        <div class="my-2 row">
            <label for="edit-name" class="col-sm-2 col-form-label">@lang('students.Name') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-name" placeholder="@lang('students.Name')">
                <div style="padding: 5px 7px; display: none" id="edit-nameErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-2 -->
        
        <div class="my-2 row">
            <label for="edit-phone" class="col-sm-2 col-form-label">@lang('students.Phone') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="phone" class="form-control" id="edit-phone" placeholder="@lang('students.Phone')">
                <div style="padding: 5px 7px; display: none" id="edit-phoneErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-2 -->
        
        <div class="my-2 row">
            <label for="edit-email" class="col-sm-2 col-form-label">@lang('students.Email') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="edit-email" placeholder="@lang('students.Email')">
                <div style="padding: 5px 7px; display: none" id="edit-emailErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-2 -->

        <div class="my-2 row">
            <label for="edit-birth_date" class="col-sm-2 col-form-label">@lang('students.Birth Date') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="date" class="form-control" id="edit-birth_date" placeholder="@lang('students.Birth Date')">
                <div style="padding: 5px 7px; display: none" id="edit-birth_dateErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-2 -->
        
        <div class="my-2 row">
            <label for="edit-gove_id" class="col-sm-2 col-form-label">@lang('students.Government')</label>
            <div class="col-sm-5">
                <select class="form-control" id="edit-gove_id"></select>
                <div style="padding: 5px 7px; display: none" id="edit-gove_idErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
            <div class="col-sm-5">
                <select class="form-control" id="edit-cent_id"></select>
                <div style="padding: 5px 7px; display: none" id="edit-cent_idErr" class="err-msg mt-2 alert alert-danger">
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
        
        <div class="my-2 row">
            <label for="edit-password" class="col-sm-2 col-form-label">@lang('users.Password')</label>
            <div class="col-sm-10">
                <input class="form-control" id="edit-password" placeholder="@lang('users.Password')">
                <div style="padding: 5px 7px; display: none" id="edit-passwordErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-2 -->

        
        <div class="my-2 row">
            <label for="edit-parent_id" class="col-sm-2 col-form-label">@lang('students.Parent')</label>
            <div class="col-sm-10">
                <select class="form-control" id="edit-parent_id"></select>
                <div style="padding: 5px 7px; display: none" id="edit-parent_idErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-2 -->

        <div class="my-2 row">
            <label for="edit-preferences" class="col-sm-2 col-form-label">@lang('students.Preferences')</label>
            <div class="col-sm-10">
                <select class="form-control" id="edit-preferences" multiple="multiple"></select>
                <div style="padding: 5px 7px; display: none" id="edit-preferencesErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-2 -->

        <button class="update-object btn btn-warning float-end">@lang('students.Update Title')</button>
    </form>
</div>

@push('custome-js')
<script>
$(document).ready(function () {
    
});
</script>
@endpush