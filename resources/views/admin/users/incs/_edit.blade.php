<div style="display: none" id="editObjectsCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('users.Update User')</h5>
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
            <label for="edit-name" class="col-sm-2 col-form-label">@lang('users.Name') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-name" placeholder="@lang('users.Name')">
                <div style="padding: 5px 7px; display: none" id="edit-nameErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-2 -->
        
        <div class="my-2 row">
            <label for="edit-phone" class="col-sm-2 col-form-label">@lang('users.Phone') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="phone" class="form-control" id="edit-phone" placeholder="@lang('users.Phone')">
                <div style="padding: 5px 7px; display: none" id="edit-phoneErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-2 -->

        <div class="my-2 row">
            <label for="edit-email" class="col-sm-2 col-form-label">@lang('users.Email')</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="edit-email" placeholder="@lang('users.Email')">
                <div style="padding: 5px 7px; display: none" id="edit-emailErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-2 -->

        <div class="my-2 row">
            <label for="edit-category" class="col-sm-2 col-form-label">@lang('users.Category') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <select class="form-control" id="edit-category" placeholder="@lang('users.Category')">    
                    <option value="">@lang('layouts.select category')</option>
                    <option value="admin">@lang('layouts.admin')</option>
                    <option value="technical">@lang('layouts.technical')</option>
                </select>
            </div>
        </div><!-- /.my-2 -->

        <div class="my-2 row edit-technical-options" style="display: none">
            <label for="edit-role" class="col-sm-2 col-form-label">@lang('users.Role') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <select class="form-control" id="edit-role"></select>
                <div style="padding: 5px 7px; display: none" id="edit-roleErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-2 -->
        
        <div class="my-2 row edit-technical-options" style="display: none">
            <label for="edit-permissions" class="col-sm-2 col-form-label">@lang('users.Permissions')</label>
            <div class="col-sm-6">
                <select name="permissions[]" id="edit-permissions" class="form-control" multiple="multiple" disabled="disabled"></select>
            </div>
            <label class="col-sm-3 pt-1">
                <span class="pr-2">@lang('users.Custome_Permissions')</span>
                <input type="hidden" id="edit-is_custome_permissions" value="false">
                <input type="checkbox" id="edit-is_custome_permissions_flag"> 
            </label>
            <div class="col-sm-1">
                <div id="edit-spinner-border" style="display: none;" class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div><!-- /.col-sm-1 -->
        </div><!-- /.my-2 -->

        <div class="my-2 row">
            <label for="edit-password" class="col-sm-2 col-form-label">@lang('users.Password')</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="edit-password" placeholder="Password">
            </div>
        </div><!-- /.my-2 -->

        <button class="update-object btn btn-warning float-end">@lang('users.Update User')</button>
    </form>
</div>

@push('custome-js')
<script>
$(document).ready(function () {
    
    $('#edit-category').change(function () {
        let target = $(this).val();
        
        if (target === 'admin') {
            $('.edit-technical-options').slideUp(500);
        } else if (target === 'technical') {
            $('.edit-technical-options').slideDown(500);
        }
    });

    $('#edit-role').change(function () {
        /**
         * get requested role permissions
         */

        let category_id = $(this).val();

        if (Boolean(category_id)) {
            // clear old session
            $('#edit-spinner-border').show(500);
            $('#edit-permissions').val('').trigger('change');
            
            axios.get(`{{ url("admin/roles") }}/${category_id}`, {
                params : {
                    'fast_acc': true
                }
            }).then(res => {
                if (res.data.success) {
                    res.data.data.permissions.length && res.data.data.permissions.forEach(item => {
                        let tmp = new Option(`${item.name}`, item.id, false, true);
                        $('#edit-permissions').append(tmp);
                    });

                    $('#edit-permissions').trigger('change');
                }

                $('#edit-spinner-border').hide(500);
            });
        }
    });

    $('#edit-is_custome_permissions_flag').change(function () {
        if ($(this).prop('checked')) {
            $('#edit-role').attr('disabled', 'disabled').val('').empty().change();
            $('#edit-permissions').removeAttr('disabled');
            $('#edit-is_custome_permissions').val('true');
        } else {
            $('#edit-role').removeAttr('disabled');
            $('#edit-permissions').attr('disabled', 'disabled').val('').empty().change();
            $('#edit-is_custome_permissions').val('false');
        }
    });

});
</script>
@endpush