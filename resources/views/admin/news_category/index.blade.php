@extends('layouts.admin.app')

@push('custome-plugin')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endpush

@push('title')
    <h1 class="h2">@lang('layouts.Course Categories')</h1>
@endpush

@section('content')
    <div id="objectsCard" class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6 pt-1">
                    @lang('course_category.Title Adminstration')
                </div><!-- /.col-6 -->
                <div class="col-6 text-end">
                    
                    <button class="relode-btn btn btn-sm btn-outline-dark">
                        <i class="relode-btn-icon fas fa-sync-alt"></i>
                        <span class="relode-btn-loader spinner-grow spinner-grow-sm" style="display: none;" role="status" aria-hidden="true"></span>
                    </button>

                    <button class="btn btn-sm btn-outline-dark toggle-search">
                        <i class="fas fa-search"></i>
                    </button>

                    @if($permissions == 'admin' || in_array('courseCategories_add', $permissions))
                    <button class="btn btn-sm btn-outline-primary toggle-btn" data-current-card="#objectsCard" data-target-card="#createObjectCard">
                        <i class="fas fa-plus"></i>
                    </button>
                    @endif
                </div><!-- /.col-6 -->
            </div><!-- /.row -->
        </div><!-- /.card-header -->

        
        <div class="card-body custome-table">
            @include('admin.news_category.incs._search')

            <table id="dataTable" class="table text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('course_category.Ar Name')</th>
                        <th>@lang('course_category.En Name')</th>
                        <th>@lang('layouts.Active')</th>
                        <th>@lang('layouts.Actions')</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div><!-- /.card-body -->
    </div><!-- /.card -->

    
    @if($permissions == 'admin' || in_array('courseCategories_add', $permissions))
        @include('admin.news_category.incs._create')
    @endif
        
    @if($permissions == 'admin' || in_array('courseCategories_show', $permissions))
        @include('admin.news_category.incs._show')
    @endif 
    
    @if($permissions == 'admin' || in_array('courseCategories_edit', $permissions))
        @include('admin.news_category.incs._edit')
    @endif

@endSection

@push('custome-js')
<script>
    $('document').ready(function () {
            
        const objects_dynamic_table = new DynamicTable(
            {
                index_route   : "{{ route('admin.news_category.index') }}",
                store_route   : "{{ route('admin.news_category.store') }}",
                show_route    : "{{ route('admin.news_category.index') }}",
                update_route  : "{{ route('admin.news_category.index') }}",
                destroy_route : "{{ route('admin.news_category.index') }}",
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
                    'id', 'ar_name', 'en_name'
                ],
                imgs_fields     : []
            },
            [
                { data: 'id',         name: 'id' },
                { data: 'ar_name',    name: 'ar_name' },
                { data: 'en_name',    name: 'en_name' },
                { data: 'activation', name: 'activation' },
                { data: 'actions',    name: 'actions' },
            ],
            function (d) {

                if ($('#s-name').length)
                d.name = $('#s-name').val(); 
            
                if ($('#s-is_active').length)
                d.is_active = $('#s-is_active').val(); 

            }
        );

        objects_dynamic_table.validateData = (data, prefix = '') => {
            // inite validation flag
            let is_valide = true;

            // clear old validation session
            $('.err-msg').slideUp(500);

            if (data.get('ar_name') === '') {
                is_valide = false;
                let err_msg = '@lang("course_category.ar_name_required")';
                $(`#${prefix}ar_nameErr`).text(err_msg);
                $(`#${prefix}ar_nameErr`).slideDown(500);
            }

            if (data.get('en_name') === '') {
                is_valide = false;
                let err_msg = '@lang("course_category.en_name_required")';
                $(`#${prefix}en_nameErr`).text(err_msg);
                $(`#${prefix}en_nameErr`).slideDown(500);
            }

            return is_valide;
        };
    
        objects_dynamic_table.showDataForm = async (targetBtn) => {
        
            let target_user = $(targetBtn).data('object-id');
            let keys = ['ar_name', 'en_name'];
            
            let response = await axios.get(`{{ url('admin/news_category') }}/${target_user}`);

            let { data, success, msg } = response.data;
            
            if (success) {
                    
                $('#show-ar_name').val(data.ar_name);
                $('#show-en_name').val(data.en_name);

                keys.forEach(key => {
                    $(`#show-${key}`).val(data[key]);
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
            fields_id_list.forEach(el_id => {
                $(`#${prefix + el_id}`).val(Boolean(data[el_id]) ? data[el_id] : '').change();
            });
        }
        
    });
</script>
@endpush