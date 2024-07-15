@extends('layouts.admin.app')

@push('custome-plugin')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endpush

@push('title')
    <h1 class="h2">@lang('layouts.Track Grades')</h1>
@endpush

@section('content')
    <div id="objectsCard" class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6 pt-1">
                    @lang('track_grades.Title Adminstration')
                </div><!-- /.col-6 -->
                <div class="col-6 text-end">
                    
                    <button class="relode-btn btn btn-sm btn-outline-dark">
                        <i class="relode-btn-icon fas fa-sync-alt"></i>
                        <span class="relode-btn-loader spinner-grow spinner-grow-sm" style="display: none;" role="status" aria-hidden="true"></span>
                    </button>

                    <button class="btn btn-sm btn-outline-dark toggle-search">
                        <i class="fas fa-search"></i>
                    </button>

                    @if($permissions == 'admin' || in_array('trackGrades_add', $permissions))
                    <button class="btn btn-sm btn-outline-primary toggle-btn" data-current-card="#objectsCard" data-target-card="#createObjectCard">
                        <i class="fas fa-plus"></i>
                    </button>
                    @endif
                </div><!-- /.col-6 -->
            </div><!-- /.row -->
        </div><!-- /.card-header -->

        
        <div class="card-body custome-table">
            @include('admin.track_grades.incs._search')

            <table id="dataTable" class="table text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>@lang('track_grades.Ar Title')</th>
                        <th>@lang('track_grades.En Title')</th>
                        <th>@lang('track_grades.From')</th>
                        <th>@lang('track_grades.To')</th>
                        <th>@lang('track_grades.Tracks_Count')</th>
                        <th>@lang('track_grades.Pricing_Plans')</th>
                        <th>@lang('layouts.Active')</th>
                        <th>@lang('layouts.Actions')</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div><!-- /.card-body -->
    </div><!-- /.card -->

    
    @if($permissions == 'admin' || in_array('trackGrades_add', $permissions))
        @include('admin.track_grades.incs._create')
    @endif
        
    @if($permissions == 'admin' || in_array('trackGrades_show', $permissions))
        @include('admin.track_grades.incs._show')
    @endif 
    
    @if($permissions == 'admin' || in_array('trackGrades_edit', $permissions))
        @include('admin.track_grades.incs._edit')
        
        @include('admin.track_grades.incs._pricing_plans')
    @endif

@endSection

@push('custome-js')
<script>
    $('document').ready(function () {
            
        const objects_dynamic_table = new DynamicTable(
            {
                index_route   : "{{ route('admin.trackGrades.index') }}",
                store_route   : "{{ route('admin.trackGrades.store') }}",
                show_route    : "{{ route('admin.trackGrades.index') }}",
                update_route  : "{{ route('admin.trackGrades.index') }}",
                destroy_route : "{{ route('admin.trackGrades.index') }}",
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
                    'id', 'ar_title', 'en_title', 'from', 'to' , 'image'
                ],
                imgs_fields     : ['image']
            },
            [
                { data: 'id',           name: 'id' },
                { data: 'ar_title',     name: 'ar_title' },
                { data: 'en_title',     name: 'en_title' },
                { data: 'from',         name: 'from' },
                { data: 'to',           name: 'to' },
                { data: 'tracks_count', name: 'tracks_count' },
                { data: 'pricing_btn',  name: 'pricing_btn' },
                { data: 'activation',   name: 'activation' },
                { data: 'actions',      name: 'actions' },
            ],
            function (d) {

                if ($('#s-title').length)
                d.title = $('#s-title').val(); 
            
                if ($('#s-from').length)
                d.from = $('#s-from').val(); 

                if ($('#s-to').length)
                d.to = $('#s-to').val(); 

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
                let err_msg = '@lang("track_grades.title_required")';
                $(`#${prefix}ar_titleErr`).text(err_msg);
                $(`#${prefix}ar_titleErr`).slideDown(500);
            }

            if (data.get('en_title') === '') {
                is_valide = false;
                let err_msg = '@lang("track_grades.title_required")';
                $(`#${prefix}en_titleErr`).text(err_msg);
                $(`#${prefix}en_titleErr`).slideDown(500);
            }

            if (data.get('from') === '') {
                is_valide = false;
                let err_msg = '@lang("track_grades.age_from_required")';
                $(`#${prefix}fromErr`).text(err_msg);
                $(`#${prefix}fromErr`).slideDown(500);
            }

            if (Number(data.get('from')) < 0) {
                is_valide = false;
                let err_msg = '@lang("track_grades.age_should_be_positive")';
                $(`#${prefix}fromErr`).text(err_msg);
                $(`#${prefix}fromErr`).slideDown(500);
            }

            if (data.get('to') === '') {
                is_valide = false;
                let err_msg = '@lang("track_grades.age_to_required")';
                $(`#${prefix}toErr`).text(err_msg);
                $(`#${prefix}toErr`).slideDown(500);
            }

            if (Number(data.get('to')) < 0) {
                is_valide = false;
                let err_msg = '@lang("track_grades.age_should_be_positive")';
                $(`#${prefix}toErr`).text(err_msg);
                $(`#${prefix}toErr`).slideDown(500);
            }

            if (Number(data.get('to')) < Number(data.get('from'))) {
                is_valide = false;
                let err_msg = '@lang("track_grades.from_age_must_be_bigger_than_to")';
                $(`#${prefix}toErr`).text(err_msg);
                $(`#${prefix}toErr`).slideDown(500);
            }

            if (prefix == '' && ['', 'undefined'].includes(data.get('image'))) {
                is_valide = false;
                let err_msg = '@lang("track_grades.image_required")';
                $(`#${prefix}imageErr`).text(err_msg); // Corrected line
                $(`#${prefix}imageErr`).slideDown(500); // Corrected line
            }

            if (['', 'undefined'].includes(data.get('image'))) {
                data.delete('image');
            }

            if (prefix == '' && Boolean(data.get('image')) && ($(`#image`).get(0).files[0].size / (10 ** 6)) > 10) {
                is_valide = false;
                let err_msg = '@lang("track_grades.max_file_size")';
                $(`#${prefix}imageErr`).text(err_msg); // Corrected line
                $(`#${prefix}imageErr`).slideDown(500); // Corrected line
            }

            return is_valide;
        };
    
        objects_dynamic_table.showDataForm = async (targetBtn) => {
        
            let target_user = $(targetBtn).data('object-id');
            let keys = ['ar_title', 'en_title', 'from', 'to'];
            
            let response = await axios.get(`{{ url('admin/track-grades') }}/${target_user}`);

            let { data, success, msg } = response.data;
            
            if (success) {

                keys.forEach(key => {
                    $(`#show-${key}`).text(data[key]);
                });

                if (data.tracks) {
                    let tracks_el = '';
                    data.tracks.forEach(track => {
                        tracks_el += `<span class="mx-2 badge bg-primary">${track.ar_title} / ${track.en_title}</span>`;
                    });

                    $('#show-tracks').html(tracks_el.length ? tracks_el : '---');
                }

                $('#show-image').attr('src', Boolean(data.image) ? `{{ url('/') }}/${data.image}` : '')
                
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
            // Check if the field is not an image field
                if (!imgs_fields.includes(el_id)) {
                    $(`#${prefix + el_id}`).val(Boolean(data[el_id]) ? data[el_id] : '').change();
                }
            });
        }
        
    });
</script>
@endpush