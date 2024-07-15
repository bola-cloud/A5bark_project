@extends('layouts.admin.app')

@push('title')
    <h1 class="h2">@lang('layouts.Users')</h1>
@endpush

@section('content')
    <div id="objectsCard" class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6 pt-1">
                    @lang('users.Title Adminstration')
                </div><!-- /.col-6 -->
                <div class="col-6 text-end">
                    
                    <button class="relode-btn btn btn-sm btn-outline-dark">
                        <i class="relode-btn-icon fas fa-sync-alt"></i>
                        <span class="relode-btn-loader spinner-grow spinner-grow-sm" style="display: none;" role="status" aria-hidden="true"></span>
                    </button>

                    <button class="btn btn-sm btn-outline-dark toggle-search">
                        <i class="fas fa-search"></i>
                    </button>

                    @if($permissions == 'admin' || in_array('users_add', $permissions))
                    <button class="btn btn-sm btn-outline-primary toggle-btn" data-current-card="#objectsCard" data-target-card="#createObjectCard">
                        <i class="fas fa-plus"></i>
                    </button>
                    @endif
                </div><!-- /.col-6 -->
            </div><!-- /.row -->
        </div><!-- /.card-header -->

        
        <div class="card-body custome-table">
            @include('admin.users.incs._search')

            <table id="dataTable" class="table text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('users.Name')</th>
                        <th>@lang('users.Category')</th>
                        <th>@lang('users.Roles')</th>
                        <th>@lang('users.Email')</th>
                        <th>@lang('users.Phone')</th>
                        <th>@lang('layouts.Active')</th>
                        <th>@lang('layouts.Actions')</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div><!-- /.card-body -->
    </div><!-- /.card -->

    @if($permissions == 'admin' || in_array('users_add', $permissions))
        @include('admin.users.incs._create')
    @endif
    
    @if($permissions == 'admin' || in_array('users_show', $permissions))
        @include('admin.users.incs._show')
    @endif
    
    @if($permissions == 'admin' || in_array('users_edit', $permissions))
        @include('admin.users.incs._edit')
    @endif

@endSection

@push('custome-js')
<script>
    $('document').ready(function () {
            
        const objects_dynamic_table = new DynamicTable(
            {
                index_route   : "{{ route('admin.users.index') }}",
                store_route   : "{{ route('admin.users.store') }}",
                show_route    : "{{ route('admin.users.index') }}",
                update_route  : "{{ route('admin.users.index') }}",
                destroy_route : "{{ route('admin.users.index') }}",
            },
            '#dataTable',
            {
                success_el : '#successAlert',
                danger_el  : '#dangerAlert',
                warning_el : '#warningAlert'
            },
            {
                table_id        : '#dataTable',
                toggle_btn      : '.toggle-btn',
                create_obj_btn  : '.create-object',
                update_obj_btn  : '.update-object',
                fields_list     : [
                    'id', 'name', 'email', 'phone', 'category', 'password', 
                    'role', 'permissions', 'is_custome_permissions'
                ],
                imgs_fields     : []
            },
            [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'category', name: 'category' },
                { data: 'roles', name: 'roles' },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                { data: 'activation', name: 'activation' },
                { data: 'actions', name: 'actions' },
            ],
            function (d) {
                if ($('#s-name').length)
                d.name = $('#s-name').val(); 

                if ($('#s-email').length)
                d.email = $('#s-email').val();  
                
                if ($('#s-phone').length)
                d.phone = $('#s-phone').val();  
                
                if ($('#s-category').length)
                d.category = $('#s-category').val();       
                
                if ($('#s-is_active').length)
                d.is_active = $('#s-is_active').val();    

                if ($('#s-roles').length)
                d.roles = $('#s-roles').val();
            
                if ($('#s-group_id').length)
                d.group_id = $('#s-group_id').val();
            }
        );

        objects_dynamic_table.validateData = (data, prefix = '') => {
            // inite validation flag
            let is_valide = true;

            // clear old validation session
            $('.err-msg').slideUp(500);

            if (data.get('name') === '') {
                is_valide = false;
                let err_msg = 'name is required';
                $(`#${prefix}nameErr`).text(err_msg);
                $(`#${prefix}nameErr`).slideDown(500);
            }

            if (data.get('email') === '') {
                is_valide = false;
                let err_msg = 'email name is required';
                $(`#${prefix}emailErr`).text(err_msg);
                $(`#${prefix}emailErr`).slideDown(500);
            }
            
            if (data.get('phone') === '') {
                is_valide = false;
                let err_msg = 'phone name is required';
                $(`#${prefix}phoneErr`).text(err_msg);
                $(`#${prefix}phoneErr`).slideDown(500);
            }

            if (data.get('category') === '') {
                is_valide = false;
                let err_msg = 'category name is required';
                $(`#${prefix}categoryErr`).text(err_msg);
                $(`#${prefix}categoryErr`).slideDown(500);
            }

            if (data.get('category') === 'admin') {
                data.delete('role');
                data.delete('permissions');
                data.delete('is_custome_permissions');
            } else {
                if (data.get('is_custome_permissions') != 'true' && (data.get('role') == 'null' || data.get('role') == '')) {
                    is_valide   = false;
                    let err_msg = 'role is required';
                    $(`#${prefix}roleErr`).text(err_msg);
                    $(`#${prefix}roleErr`).slideDown(500);
                } 

                if (data.get('is_custome_permissions') == 'true') {
                    data.delete('role');
                } else {
                    data.delete('permissions');
                    data.delete('is_custome_permissions');
                }
            }

            return is_valide;
        };

        objects_dynamic_table.showDataForm = async (targetBtn) => {
        
            let target_user = $(targetBtn).data('object-id');
            let keys = ['name', 'email', 'phone', 'category'];
            
            let response = await axios.get(`{{ url('admin/users') }}/${target_user}`);

            let { data, success } = response.data;
            
            if (success) {
                
                if (Boolean(data.roles) && data.roles.length) {
                    let user_role = `<span class="badge rounded-pill bg-primary">${data.roles[0].display_name}</span>`;
                    $(`#show-role`).html(user_role);
                } else {
                    $(`#show-role`).text('---');
                }

                if (Boolean(data.permissions)) {
                    let permissions = '';
                    
                    data.permissions.forEach(permission => {
                        permissions += `<span class="badge rounded-pill bg-primary mx-1">${permission.display_name}</span>`;
                    });

                    $(`#show-permissions`).html(permissions.length ? permissions : '---');
                } else {
                    $(`#show-permissions`).text('---');
                }

                keys.forEach(key => {
                    if (Boolean(data[key])) {
                        $(`#show-${key}`).text(data[key]);
                    } else {
                        $(`#show-${key}`).text('---');
                    }
                });

                return true;
            }

            return false;
        };
        
        objects_dynamic_table.addDataToForm = (fields_id_list, imgs_fields, data, prefix) => {
    
            $('#edit-role, #edit-permissions').empty().trigger("change");

            fields_id_list = fields_id_list.filter(el_id => !imgs_fields.includes(el_id));
            
            fields_id_list.forEach(el_id => {
                if (el_id !== 'permissions' || el_id !== 'is_custome_permissions') {
                    $(`#${prefix + el_id}`).val(data[el_id]).change();
                }
            });

            /**
                * Notice that we have an event in the edit form, that fires 
                * in the time when the category field trigger change event
                * sow we will set a flag that stops the change event while
                * we filling the edit form fields in first
            */
            if (data.category != 'admin') {
                if (Boolean(data.roles) && data.roles.length) { 
                    let role = data.roles[0]
                    $('#edit-is_custome_permissions_flag').prop('checked', false).trigger('change');

                    let tmp = new Option(`${role.name}`, role.id, false, true);
                    $('#edit-role').append(tmp).trigger('change');
                } else if (Boolean(data.permissions) && data.permissions.length) {
                    $('#edit-is_custome_permissions_flag').prop('checked', true).trigger('change');

                    data.permissions.forEach(permission => {
                        let tmp = new Option(`${permission.display_name}`, permission.id, false, true);
                        $('#edit-permissions').append(tmp);
                    });
                    $('#edit-permissions').removeAttr('disabled').trigger('change');
                }
            } else {
                $('.edit-technical-options').slideUp(500);
            }
            
            $('#edit-id').val(data.id);
        }

        const init = (() => {
            $('#role, #edit-role, #s-roles').select2({
                allowClear: true,
                width: '100%',
                placeholder: 'Select Rolle',
                ajax: {
                    url: '{{ url("admin/roles-search") }}',
                    dataType: 'json',
                    delay: 150,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: `${item.display_name}`,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            $('#permissions, #edit-permissions').select2({
                allowClear: true,
                width: '100%',
                placeholder: 'Select permissions',
                ajax: {
                    url: '{{ url("admin/permissions-search") }}',
                    dataType: 'json',
                    delay: 150,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: `${item.display_name}`,
                                    id: item.name
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        })();
        
    });
</script>
@endpush