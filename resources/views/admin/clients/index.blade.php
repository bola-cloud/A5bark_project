@extends('layouts.admin.app')

@push('title')
    <h1 class="h2">@lang('layouts.Clients')</h1>
@endpush

@section('content')
    <div id="objectsCard" class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6 pt-1">
                    @lang('Clients.Title Adminstration')
                </div><!-- /.col-6 -->
                <div class="col-6 text-end">
                    
                    <button class="relode-btn btn btn-sm btn-outline-dark">
                        <i class="relode-btn-icon fas fa-sync-alt"></i>
                        <span class="relode-btn-loader spinner-grow spinner-grow-sm" style="display: none;" role="status" aria-hidden="true"></span>
                    </button>

                    <button class="btn btn-sm btn-outline-dark toggle-search">
                        <i class="fas fa-search"></i>
                    </button>

                    @if($permissions == 'admin' || in_array('clients_add', $permissions))
                    <button class="btn btn-sm btn-outline-primary toggle-btn" data-current-card="#objectsCard" data-target-card="#createObjectCard">
                        <i class="fas fa-plus"></i>
                    </button>
                    @endif
                </div><!-- /.col-6 -->
            </div><!-- /.row -->
        </div><!-- /.card-header -->

        
        <div class="card-body custome-table">
            @include('admin.clients.incs._search')

            <table id="dataTable" class="table text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('clients.Name')</th>
                        <th>@lang('clients.Gender')</th>
                        <th>@lang('clients.Email')</th>
                        <th>@lang('clients.Phone')</th>
                        <th>@lang('layouts.Gove')</th>
                        <th>@lang('layouts.Dict')</th>
                        <th>@lang('clients.Verification')</th>
                        <th>@lang('layouts.Active')</th>
                        <th>@lang('layouts.Actions')</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div><!-- /.card-body -->
    </div><!-- /.card -->

    @if($permissions == 'admin' || in_array('clients_add', $permissions))
        @include('admin.clients.incs._create')
    @endif

    @if($permissions == 'admin' || in_array('clients_show', $permissions))
        @include('admin.clients.incs._show')
    @endif 

    @if($permissions == 'admin' || in_array('clients_edit', $permissions))
        @include('admin.clients.incs._edit')
    @endif 
    
@endSection

@push('custome-js')
<script>
    $('document').ready(function () {
            
        const objects_dynamic_table = new DynamicTable(
            {
                index_route   : "{{ route('admin.clients.index') }}",
                store_route   : "{{ route('admin.clients.store') }}",
                show_route    : "{{ route('admin.clients.index') }}",
                update_route  : "{{ route('admin.clients.index') }}",
                destroy_route : "{{ route('admin.clients.index') }}",
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
                    'id', 'name', 'email', 'phone', 'password', 
                    'gender', 'gove_id', 'dist_id', 'birth_day'
                ],
                imgs_fields     : []
            },
            [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'gender', name: 'gender' },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                { data: 'gove', name: 'gove' },
                { data: 'dist', name: 'dist' },
                { data: 'phone_verified_at', name: 'phone_verified_at' },
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
                let err_msg = '@lang("clients.name is required")';
                $(`#${prefix}nameErr`).text(err_msg);
                $(`#${prefix}nameErr`).slideDown(500);
            }

            if (data.get('email') === '') {
                is_valide = false;
                let err_msg = '@lang("clients.email name is required")';
                $(`#${prefix}emailErr`).text(err_msg);
                $(`#${prefix}emailErr`).slideDown(500);
            }
            
            if (data.get('phone') === '') {
                is_valide = false;
                let err_msg = '@lang("clients.phone name is required")';
                $(`#${prefix}phoneErr`).text(err_msg);
                $(`#${prefix}phoneErr`).slideDown(500);
            }

            if (data.get('gender') === '') {
                is_valide = false;
                let err_msg = '@lang("clients.gender is required")';
                $(`#${prefix}genderErr`).text(err_msg);
                $(`#${prefix}genderErr`).slideDown(500);
            }

            if (data.get('birth_day') === '') {
                is_valide = false;
                let err_msg = '@lang("clients.birth_day is required")';
                $(`#${prefix}birth_dayErr`).text(err_msg);
                $(`#${prefix}birth_dayErr`).slideDown(500);
            }

            if (data.get('gove_id') === '' || data.get('gove_id') == 'null') {
                is_valide = false;
                let err_msg = '@lang("clients.gove_required")';
                $(`#${prefix}gove_idErr`).text(err_msg);
                $(`#${prefix}gove_idErr`).slideDown(500);
            }

            if (data.get('dist_id') === '' || data.get('dist_id') == 'null') {
                is_valide = false;
                let err_msg = '@lang("clients.dist_required")';
                $(`#${prefix}dist_idErr`).text(err_msg);
                $(`#${prefix}dist_idErr`).slideDown(500);
            }

            return is_valide;
        };

        objects_dynamic_table.showDataForm = async (targetBtn) => {
        
            let target_user = $(targetBtn).data('object-id');
            let keys = ['name', 'email', 'phone', 'category'];
            
            let response = await axios.get(`{{ url('admin/clients') }}/${target_user}`);

            let { data, success, msg } = response.data;
            
            if (success) {
                keys.forEach(key => {
                    if (Boolean(data[key])) {
                        $(`#show-${key}`).text(data[key]);
                    } else {
                        $(`#show-${key}`).text('---');
                    }
                });

                return true;
            } else {
                Toastify({
                    text: msg,
                    className: "info",
                    offset: {
                        x: 20, // horizontal axis - can be a number or a string indicating unity. eg: '2em'
                        y: 50 // vertical axis - can be a number or a string indicating unity. eg: '2em'
                    },
                    style: {
                        color: '#842029', background: '#f8d7da', borderColor: '#f5c2c7'
                    }
                }).showToast();
            }

            return false;
        };
        
        objects_dynamic_table.addDataToForm = (fields_id_list, imgs_fields, data, prefix) => {
            
            $('#edit-gove_id, #edit-dist_id').empty().trigger("change");

            fields_id_list = fields_id_list.filter(el_id => !imgs_fields.includes(el_id));
            
            fields_id_list.forEach(el_id => {
                if (Boolean(data[el_id])) {
                    $(`#edit-${el_id}`).val(data[el_id]).change();
                }
            });

            if (data?.client) {
                let gove_option_el = new Option(`${data.client.gove.ar_name} - ${data.client.gove.en_name}`, data.client.gove.id, true, true);
                $('#edit-gove_id').append(gove_option_el).trigger('change');
                
                let dist_option_el = new Option(`${data.client.dist.ar_name} - ${data.client.dist.en_name}`, data.client.dist.id, true, true);
                $('#edit-dist_id').append(dist_option_el).trigger('change');

                $('#edit-gender').val(data?.client?.gender);
                $('#edit-birth_day').val(data?.client?.birth_day);
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

            // START GOVE, DIST SELECT ACTION ...
            $('#s-gove, #gove_id, #edit-gove_id').select2({
                allowClear: true,
                width: '100%',
                placeholder: '@lang("layouts.Select_Governorate")',
                ajax: {
                    url: '{{ url("admin/districts-search") }}?is_main=true',
                    dataType: 'json',
                    delay: 150,
                    processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: `${item['ar_name']} - ${item['en_name']}`,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            }).change(function () {
                window.gove_id = $(this).val(); 
                let target = $(this).data('target');
                
                if (window.gove_id != null) {
                    target == '#edit-dist_id' ? 
                    $(target).removeAttr('disabled')
                        :
                    $(target).val('').removeAttr('disabled').trigger('change');
                } else {
                    $(target).val('').attr('disabled', 'disabled').trigger('change');
                }
            });

            $('#s-dist, #dist_id, #edit-dist_id').select2({
                allowClear: true,
                width: '100%',
                placeholder: '@lang("layouts.Select_District")',
                ajax: {
                    url: `{{ url("admin/districts-search") }}`,
                    dataType: 'json',
                    delay: 150,
                    data: function (params) {
                        var query = {
                            q  : params.term,
                            is_sub  : true, 
                            gove_id : window.gove_id
                        }
                        return query;
                    },
                    processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: `${item['ar_name']} - ${item['en_name']}`,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            }).change((e) => {
                let dis_val = $(e.target).val();
                let prefex  = e.target.id == 'edit-dist_id' ? 'edit-' : '';

                if (Boolean(dis_val)) {
                    $(`#${prefex}address`).removeAttr('disabled');
                } else {
                    $(`#${prefex}address`).attr('disabled', 'disabled');
                }
            });

        })();
        
    });
</script>
@endpush