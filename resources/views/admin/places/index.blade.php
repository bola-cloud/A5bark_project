@extends('layouts.admin.app')

@push('custome-plugin')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endpush

@push('title')
    <h1 class="h2">@lang('layouts.Brach Places')</h1>
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
            @include('admin.places.incs._search')

            <table id="dataTable" class="table text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('news.Ar Head')</th>
                        <th>@lang('news.Ar Title')</th>
                        <th>@lang('news.En Head')</th>
                        <th>@lang('news.En Title')</th>
                        <th>@lang('news.Category')</th>
                        <th>@lang('layouts.Active')</th>
                        <th>@lang('layouts.Actions')</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div><!-- /.card-body -->
    </div><!-- /.card -->

    
    @if($permissions == 'admin' || in_array('courseCategories_add', $permissions))
        @include('admin.places.incs._create')
    @endif
        
    @if($permissions == 'admin' || in_array('courseCategories_show', $permissions))
        @include('admin.places.incs._show')
    @endif 
    
    @if($permissions == 'admin' || in_array('courseCategories_edit', $permissions))
        @include('admin.places.incs._edit')
    @endif

@endsection

@push('custome-js')
<script>
    $(document).ready(function () {
        const objects_dynamic_table = new DynamicTable(
            {
                index_route:    "{{ route('admin.places.index') }}",
                store_route:    "{{ route('admin.places.store') }}",
                show_route:     "{{ route('admin.places.index') }}",
                update_route:   "{{ route('admin.places.index') }}",
                destroy_route:  "{{ route('admin.places.index') }}",
            },
            '#dataTable',
            {
                success_el: '#successAlert',
                danger_el: '#dangerAlert',
                warning_el: '#warningAlert'
            },
            {
                table_id: '#dataTable',
                toggle_btn: '.toggle-btn',
                create_obj_btn: '.create-object',
                update_obj_btn: '.update-object',
                fields_list: [
                    'id', 'ar_name', 'en_name', 'address',  'working_hours', 'branch_id'
                ],
                imgs_fields: []
            },
            [
                { data: 'id', name: 'id' },
                { data: 'ar_name', name: 'ar_name' },
                { data: 'en_name', name: 'en_name' },
                { data: 'address',      name: 'address' },
                { data: 'working_hours', name: 'working_hours' },
                { data: 'branch_name',  name: 'branch_name' },
                { data: 'activation',   name: 'activation' },
                { data: 'actions', name: 'actions' },
            ],
            function (d) {
                if ($('#s-name').length)
                d.name = $('#s-name').val(); 

                if ($('#s-is_active').length)
                d.is_active = $('#s-is_active').val();  
            }
        );

        objects_dynamic_table.validateData = (data, prefix = '') => {
            let is_valid = true;
            $('.err-msg').slideUp(500);

            if (data.get('address') === '') {
                is_valid = false;
                let err_msg = '@lang("news.address_required")';
                $(`#${prefix}addressErr`).text(err_msg).slideDown(500);
            }

            if (data.get('ar_name') === '') {
                is_valid = false;
                let err_msg = '@lang("news.ar_name_required")';
                $(`#${prefix}ar_nameErr`).text(err_msg).slideDown(500);
            }


            if (data.get('working_hours') === '') {
                is_valid = false;
                let err_msg = '@lang("news.working_hours_required")';
                $(`#${prefix}working_hoursErr`).text(err_msg).slideDown(500);
            }

            if (data.get('en_name') === '') {
                is_valid = false;
                let err_msg = '@lang("news.en_name_required")';
                $(`#${prefix}en_nameErr`).text(err_msg).slideDown(500);
            }

            return is_valid;
        };

        objects_dynamic_table.showDataForm = async (targetBtn) => {
            let target_id = $(targetBtn).data('object-id');
            let keys = ['ar_name', 'en_name', 'address',  'working_hours', 'branch_id'];

            let response = await axios.get(`{{ url('admin/places') }}/${target_id}`);
            
            let { data, success, msg } = response.data;
            console.log(data)

            if (success) {
                keys.forEach(key => {
                    $(`#show-${key}`).val(data[key]);
                });

                $('#show-branch_id').val(data.branch_id).trigger('change');

                return true;
            } else {
                Toastify({
                    text: msg,
                    className: "info",
                    offset: {
                        x: 20,
                        y: 50
                    },
                    style: {
                        color: '#842029', background: '#f8d7da', borderColor: '#f5c2c7'
                    }
                }).showToast();
            }

            return false;
        };


        objects_dynamic_table.addDataToForm = (fields_id_list, imgs_fields, data, prefix) => {
            // console.log(data);
            fields_id_list.forEach(el_id => {
                $(`#${prefix + el_id}`).val(Boolean(data[el_id]) ? data[el_id] : '').change();
            });

            if (data.branch) {
                let option = new Option(data.branch.ar_name, data.branch.id, true, true);
                $('#edit-branch_id').append(option).trigger('change');
            }
        };
        $('#branch_id, #edit-branch_id , #show-branch_id').select2({
            ajax: {
                url: "{{ route('admin.search.branch') }}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.map(function (item) {
                            return {
                                id: item.id,
                                text: item.ar_name + ' / ' + item.en_name
                            };
                        })
                    };
                },
                cache: true
            },
            placeholder: '@lang('news.Select Category')',
            minimumInputLength: 1,
            width: "100%"
        });
    });
</script>
@endpush