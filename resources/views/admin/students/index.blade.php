@extends('layouts.admin.app')

@push('title')
    <h1 class="h2">@lang('layouts.Students')</h1>
@endpush

@section('content')
    <div id="objectsCard" class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6 pt-1">
                    @lang('students.Title Adminstration')
                </div><!-- /.col-6 -->
                <div class="col-6 text-end">
                    
                    <button class="relode-btn btn btn-sm btn-outline-dark">
                        <i class="relode-btn-icon fas fa-sync-alt"></i>
                        <span class="relode-btn-loader spinner-grow spinner-grow-sm" style="display: none;" role="status" aria-hidden="true"></span>
                    </button>

                    <button class="btn btn-sm btn-outline-dark toggle-search">
                        <i class="fas fa-search"></i>
                    </button>

                    @if($permissions == 'admin' || in_array('students_add', $permissions))
                    <button class="btn btn-sm btn-outline-primary toggle-btn" data-current-card="#objectsCard" data-target-card="#createObjectCard">
                        <i class="fas fa-plus"></i>
                    </button>
                    @endif
                </div><!-- /.col-6 -->
            </div><!-- /.row -->
        </div><!-- /.card-header -->

        
        <div class="card-body custome-table">
            @include('admin.students.incs._search')

            <table id="dataTable" class="table text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('students.Name')</th>
                        <th>@lang('students.Email')</th>
                        <th>@lang('students.Phone')</th>
                        <th>@lang('students.Birth Date')</th>
                        <th>@lang('students.Parent Name')</th>
                        <th>@lang('students.Parent Phone')</th>
                        <th>@lang('students.Preferences')</th>
                        <th>@lang('students.Government')</th>
                        <th>@lang('students.Center')</th>
                        <th>@lang('students.Top Student')</th>
                        <th>@lang('layouts.Active')</th>
                        <th>@lang('layouts.Actions')</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div><!-- /.card-body -->
    </div><!-- /.card -->

    @if($permissions == 'admin' || in_array('students_add', $permissions))
        @include('admin.students.incs._create')
    @endif
    
    @if($permissions == 'admin' || in_array('students_show', $permissions))
        @include('admin.students.incs._show')
    @endif
    
    @if($permissions == 'admin' || in_array('students_edit', $permissions))
        @include('admin.students.incs._edit')
    @endif

@endSection

@push('custome-js')
<script>
    $('document').ready(function () {
        let lang = "{{ $lang }}";

        const objects_dynamic_table = new DynamicTable(
            {
                index_route   : "{{ route('admin.students.index') }}",
                store_route   : "{{ route('admin.students.store') }}",
                show_route    : "{{ route('admin.students.index') }}",
                update_route  : "{{ route('admin.students.index') }}",
                destroy_route : "{{ route('admin.students.index') }}",
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
                    'birth_date', 'gove_id', 'cent_id', 'address', 
                    'parent_id', 'preferences'
                ],
                imgs_fields     : []
            },
            [
                { data: 'id',           name: 'id' },
                { data: 'name',         name: 'name' },
                { data: 'email',        name: 'email' },
                { data: 'phone',        name: 'phone' },
                { data: 'birth_date',   name: 'birth_date' },
                { data: 'parent_name',  name: 'parent_name' },
                { data: 'parent_phone', name: 'parent_phone' },
                { data: 'preferences',  name: 'preferences' },
                { data: 'gove',         name: 'gove' },
                { data: 'cent',         name: 'cent' },
                { data: 'top_student',  name: 'top_student' },
                { data: 'activation',   name: 'activation' },
                { data: 'actions',      name: 'actions' },
            ],
            function (d) {
                if ($('#s-name').length)
                d.name = $('#s-name').val(); 

                if ($('#s-email').length)
                d.email = $('#s-email').val();  
                
                if ($('#s-phone').length)
                d.phone = $('#s-phone').val();  
                
                if ($('#s-is_active').length)
                d.is_active = $('#s-is_active').val(); 
            
                if ($('#s-gove').length)
                d.gove = $('#s-gove').val(); 
            
                if ($('#s-cent').length)
                d.cent = $('#s-cent').val();    
            
                if ($('#s-parents').length)
                d.parents = $('#s-parents').val(); 
            
                if ($('#s-birth_date_from').length)
                d.birth_date_from = $('#s-birth_date_from').val(); 
            
                if ($('#s-birth_date_to').length)
                d.birth_date_to = $('#s-birth_date_to').val();    
            
                if ($('#s-preferences').length)
                d.preferences = $('#s-preferences').val();    
            }
        );

        objects_dynamic_table.validateData = (data, prefix = '') => {
            // inite validation flag
            let is_valide = true;

            // clear old validation session
            $('.err-msg').slideUp(500);

            if (data.get('name') === '') {
                is_valide = false;
                let err_msg = '@lang("students.name is required")';
                $(`#${prefix}nameErr`).text(err_msg);
                $(`#${prefix}nameErr`).slideDown(500);
            }

            if (data.get('email') === '') {
                is_valide = false;
                let err_msg = '@lang("students.email is required")';
                $(`#${prefix}emailErr`).text(err_msg);
                $(`#${prefix}emailErr`).slideDown(500);
            }
            
            if (data.get('phone') === '') {
                is_valide = false;
                let err_msg = '@lang("students.phone is required")';
                $(`#${prefix}phoneErr`).text(err_msg);
                $(`#${prefix}phoneErr`).slideDown(500);
            }

            if (data.get('birth_date') === '') {
                is_valide = false;
                let err_msg = '@lang("students.birth date is required")';
                $(`#${prefix}birth_dateErr`).text(err_msg);
                $(`#${prefix}birth_dateErr`).slideDown(500);
            }

            if (['null', null, '', 'undefined'].includes(data.get('gove_id'))) {
                is_valide = false;
                let err_msg = '@lang("students.gove is required")';
                $(`#${prefix}gove_idErr`).text(err_msg);
                $(`#${prefix}gove_idErr`).slideDown(500);
            }

            if (['null', null, '', 'undefined'].includes(data.get('cent_id'))) {
                data.delete('cent_id');
            }

            if (['null', null, '', 'undefined'].includes(data.get('address'))) {
                data.delete('address');
            }

            if (['null', null, '', 'undefined'].includes(data.get('parent_id'))) {
                data.delete('parent_id');
            }

            return is_valide;
        };

        objects_dynamic_table.showDataForm = async (targetBtn) => {
        
            let target_user = $(targetBtn).data('object-id');
            let keys = ['name', 'email', 'phone', 'password', 'birth_date', 'gove_id', 'cent_id', 'address'];
            
            let response = await axios.get(`{{ url('admin/students') }}/${target_user}`);

            let { data, success } = response.data;
            
            if (success) {

                keys.forEach(key => {
                    if (Boolean(data[key])) {
                        $(`#show-${key}`).text(data[key]);
                    } else {
                        $(`#show-${key}`).text('---');
                    }
                });

                
                if(Boolean(data.student?.gove)) { 
                    $('#show-gove').text(lang == 'ar' ? data.student.gove.ar_name : data.student.gove.en_name);
                } else {
                    $('#show-gove').text('---');
                }

                if(Boolean(data.student?.cent)) { 
                    $('#show-cent').text(lang == 'ar' ? data.student.cent.ar_name : data.student.cent.en_name);
                } else {
                    $('#show-cent').text('---');
                }

                if (Boolean(data.student.preferences)) {
                    let tmp = '';

                    data.student.preferences.forEach(pref => {
                        tmp += `
                            <span class="badge bg-primary">${lang == 'ar' ? pref.ar_name : pref.en_name}</span>
                        `;
                    });   
                    
                    $('#show-preferences').html(tmp.length ? tmp : '---');
                }

                $('#show-address').text(Boolean(data.student?.address) ? data.student.address : '---');
                $('#show-birth_date').text(Boolean(data.student?.birth_date) ? data.student.birth_date : '---');
                $('#show-parent').text(Boolean(data.parent) ? `${data.parent.name} - ${data.parent.phone} - ${data.parent.email}` : '---');

                return true;
            }

            return false;
        };
        
        objects_dynamic_table.addDataToForm = (fields_id_list, imgs_fields, data, prefix) => {
            
            $('#edit-gove_id, #edit-cent_id, #edit-parent_id, #edit-preferences').empty().change();

            fields_id_list = fields_id_list.filter(el_id => !imgs_fields.includes(el_id));
            
            fields_id_list.forEach(el_id => {
                if (!['gove_id', 'cent_id', 'address', 'birth_date'].includes(el_id)) {
                    $(`#${prefix + el_id}`).val(data[el_id]).change();
                }
            });
            
            if(Boolean(data.student?.gove)) { 
                let tmp = new Option(`${lang == 'ar' ? data.student.gove.ar_name : data.student.gove.en_name }`, data.student.gove.id, false, true);
                $('#edit-gove_id').append(tmp).change();
            }

            if(Boolean(data.student?.cent)) { 
                let tmp = new Option(`${lang == 'ar' ? data.student.cent.ar_name : data.student.cent.en_name }`, data.student.cent.id, false, true);
                $('#edit-cent_id').append(tmp).change();
            }

            if(Boolean(data.parent)) { 
                let tmp = new Option(`${data.parent.name} - ${data.parent.phone} - ${data.parent.email}`, data.parent.id, false, true);
                $('#edit-parent_id').append(tmp).change();
            }

            if (Boolean(data.student.preferences)) {
                data.student.preferences.forEach(pref => {
                    let tmp = new Option(`${lang == 'ar' ? pref.ar_name : pref.en_name}`, pref.id, false, true);
                    $('#edit-preferences').append(tmp);
                });   

                $('#edit-preferences').trigger('change');
            }

            Boolean(data.student?.address)    ? $('#edit-address').val(data.student.address) : $('#edit-address').val('');
            Boolean(data.student?.birth_date) ? $('#edit-birth_date').val(data.student.birth_date) : $('#edit-birth_date').val('');
        
        }

        const init = (() => {
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
                    target == '#edit-cent_id' 
                        ? $(target).removeAttr('disabled')
                        : $(target).val('').removeAttr('disabled').trigger('change');
                } else {
                    $(target).val('').attr('disabled', 'disabled').trigger('change');
                }
            });

            $('#s-cent, #cent_id, #edit-cent_id').select2({
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
            });

            $('#s-parents, #parent_id, #edit-parent_id').select2({
                allowClear: true,
                width: '100%',
                placeholder: '@lang("layouts.Select_Parent")',
                ajax: {
                    url: `{{ route("admin.search.parents") }}`,
                    dataType: 'json',
                    delay: 150,
                    processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: `${item.name} - ${item.phone} - ${item.email}`,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            $('#s-preferences, #preferences, #edit-preferences').select2({
                allowClear: true,
                width: '100%',
                placeholder: '@lang("layouts.Select_Course_Category")',
                ajax: {
                    url: `{{ route("admin.search.courseCategories") }}`,
                    dataType: 'json',
                    delay: 150,
                    processResults: function (data) {
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: `${lang == 'ar' ? item.ar_name : item.en_name}`,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            $('#dataTable').on('change', '.c-top_student-btn', function (e, current_objct = objects_dynamic_table) {
                let target_id = $(this).data('target-obj');

                axios.post(`${current_objct.routs.update_route}/${target_id}`, {
                    _token  : $('meta[name="csrf-token"]').attr('content'),
                    _method : 'PUT',
                    is_top_object: true
                }).then(res => {
                    const { success, msg } = res.data;

                    if (!success) {
                        $(this).prop('checked', !$(this).prop('checked'));
                        
                        current_objct.showAlertMsg(Boolean(msg) ? msg : 'Somthing went rong please refresh the page!!', current_objct.msg_container.danger_el);
                    } else {
                        current_objct.showAlertMsg(msg, current_objct.msg_container.success_el);
                    }
                })// axios
            });
            
        })();
        
    });
</script>
@endpush