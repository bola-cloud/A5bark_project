@extends('layouts.admin.app')

@push('title')
    <h1 class="h2">@lang('layouts.Tracks')</h1>
@endpush

@section('content')
    <div id="objectsCard" class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6 pt-1">
                    @lang('tracks.Title Adminstration')
                </div><!-- /.col-6 -->
                <div class="col-6 text-end">
                    
                    <button class="relode-btn btn btn-sm btn-outline-dark">
                        <i class="relode-btn-icon fas fa-sync-alt"></i>
                        <span class="relode-btn-loader spinner-grow spinner-grow-sm" style="display: none;" role="status" aria-hidden="true"></span>
                    </button>

                    <button class="btn btn-sm btn-outline-dark toggle-search">
                        <i class="fas fa-search"></i>
                    </button>

                    @if($permissions == 'admin' || in_array('courses_add', $permissions))
                    <button class="btn btn-sm btn-outline-primary toggle-btn" data-current-card="#objectsCard" data-target-card="#createObjectCard">
                        <i class="fas fa-plus"></i>
                    </button>
                    @endif
                </div><!-- /.col-6 -->
            </div><!-- /.row -->
        </div><!-- /.card-header -->

        
        <div class="card-body custome-table">
            @include('admin.tracks.incs._search')

            <table id="dataTable" class="table text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('tracks.Name')</th>
                        <th>@lang('tracks.Grade')</th>
                        <th>@lang('tracks.Order')</th>
                        <th>@lang('tracks.Courses')</th>
                        <th>@lang('layouts.Active')</th>
                        <th>@lang('layouts.Actions')</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div><!-- /.card-body -->
    </div><!-- /.card -->

    @if($permissions == 'admin' || in_array('tracks_add', $permissions))
        @include('admin.tracks.incs._create')
    @endif
    
    @if($permissions == 'admin' || in_array('tracks_show', $permissions))
        @include('admin.tracks.incs._show')
    @endif
    
    @if($permissions == 'admin' || in_array('tracks_edit', $permissions))
        @include('admin.tracks.incs._edit')

        @include('admin.tracks.incs._media')
    @endif

@endSection

@push('custome-js')
<script>
    $('document').ready(function () {
        let lang = "{{ $lang }}";

        const objects_dynamic_table = new DynamicTable(
            {
                index_route   : "{{ route('admin.tracks.index') }}",
                store_route   : "{{ route('admin.tracks.store') }}",
                show_route    : "{{ route('admin.tracks.index') }}",
                update_route  : "{{ route('admin.tracks.index') }}",
                destroy_route : "{{ route('admin.tracks.index') }}",
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
                    'id','grade_id',
                    'ar_title', 'en_title',
                    'ar_description', 'en_description', 'order'
                ],
                imgs_fields     : []
            },
            [
                { data: 'id',                   name: 'id' },
                { data: 'title',                name: 'title' },
                { data: 'grade',                name: 'grade' },
                { data: 'order',                name: 'order' },
                { data: 'courses_btn',          name: 'courses_btn' },
                { data: 'activation',           name: 'activation' },
                { data: 'actions',              name: 'actions' },
            ],
            function (d) {
                if ($('#s-name').length)
                d.name = $('#s-name').val(); 

                if ($('#s-trainers').length)
                d.trainers = $('#s-trainers').val();  
                
                if ($('#s-categories').length)
                d.categories = $('#s-categories').val();  

                if ($('#s-grades').length)
                d.grades = $('#s-grades').val();  
                
                if ($('#s-is_active').length)
                d.is_active = $('#s-is_active').val(); 
            }
        );

        objects_dynamic_table.validateData = (data, prefix = '') => {
            // inite validation flag
            let is_valide = true;

            // clear old validation session
            $('.err-msg').slideUp(500);

            if (data.get('ar_title') === '') {
                is_valide = false;
                let err_msg = '@lang("tracks.ar_title is required")';
                $(`#${prefix}ar_titleErr`).text(err_msg);
                $(`#${prefix}ar_titleErr`).slideDown(500);
            }

            if (data.get('en_title') === '') {
                is_valide = false;
                let err_msg = '@lang("tracks.en_title is required")';
                $(`#${prefix}en_titleErr`).text(err_msg);
                $(`#${prefix}en_titleErr`).slideDown(500);
            }

            if (data.get('ar_description') === '') {
                is_valide = false;
                let err_msg = '@lang("tracks.ar_description is required")';
                $(`#${prefix}ar_descriptionErr`).text(err_msg);
                $(`#${prefix}ar_descriptionErr`).slideDown(500);
            }

            if (data.get('en_description') === '') {
                is_valide = false;
                let err_msg = '@lang("tracks.en_description is required")';
                $(`#${prefix}en_descriptionErr`).text(err_msg);
                $(`#${prefix}en_descriptionErr`).slideDown(500);
            }

            if (['', 'null', null, 'undefined'].includes(data.get('grade_id'))) {
                is_valide = false;
                let err_msg = '@lang("tracks.grade_id is required")';
                $(`#${prefix}grade_idErr`).text(err_msg);
                $(`#${prefix}grade_idErr`).slideDown(500);
            }

            if (data.get('order') === '') {
                is_valide = false;
                let err_msg = '@lang("tracks.order is required")';
                $(`#${prefix}orderErr`).text(err_msg);
                $(`#${prefix}orderErr`).slideDown(500);
            }

            return is_valide;
        };

        objects_dynamic_table.showDataForm = async (targetBtn) => {
        
            let target_user = $(targetBtn).data('object-id');
            let keys = ['ar_title', 'en_title', 'ar_description', 'en_description', 'order'];
            
            let response = await axios.get(`{{ url('admin/tracks') }}/${target_user}`);

            let { data, success } = response.data;
            
            
            if (success) {
                keys.forEach(key => {
                    $(`#show-${key}`).text(Boolean(data[key]) ? data[key] : '---');
                });

                $('#show-grade_id').html(Boolean(data.grade) ? data.grade.ar_title : data.grade.en_title);

                return true;
            }

            return false;
        };
        
        objects_dynamic_table.addDataToForm = (fields_id_list, imgs_fields, data, prefix) => {
            $('#edit-track_grade_id').empty().trigger('change');
            
            $('#edit-id').val(data.id);

            $('#origin-order').val(Boolean(data.order) ? data.order : '');
            $('#origin-grade_id').val(Boolean(data.grade?.id) ? data.grade.id : '');
            
            fields_id_list.forEach(el_id => {
                if (['ar_title', 'en_title', 'ar_description', 'en_description', 'order'].includes(el_id)) {
                    $(`#${prefix + el_id}`).val(data[el_id]).change();
                }
            });
            
            if(Boolean(data.grade)) {
                let tmp = new Option(`${ lang == 'ar' ? data.grade.ar_title : data.grade.en_title }`, data.grade.id, false, true);
                $('#edit-grade_id').append(tmp);
                $('#edit-grade_id').removeAttr('disabled').trigger('change');
            }  
        };

        const init = (() => {
            let lang = "{{ $lang }}";
            
            $('#categories, #edit-categories, #s-categories').select2({
                allowClear: true,
                width: '100%',
                placeholder: "@lang('layouts.Select_Course_Category')",
                ajax: {
                    url: '{{ url("admin/course-categories-search") }}',
                    dataType: 'json',
                    delay: 150,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text : lang == 'ar' ? item.ar_name : item.en_name,
                                    id   : item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            $('#grade_id, #edit-grade_id, #s-grades').select2({
                allowClear: true,
                width: '100%',
                placeholder: "@lang('tracks.Select Grade')",
                ajax: {
                    url: '{{ route("admin.search.grades") }}',
                    dataType: 'json',
                    delay: 150,
                    processResults: function (data) {
                        return {
                            results: data.map(function (item) {
                                return {
                                    text : lang == 'ar' ? item.ar_title : item.en_title ,
                                    id   : item.id
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