
<div class="card my-3">
    <div class="card-header" id="search-box-container">
        <div class="row">
            <div class="col-3">
                <div class="form-group search-action">
                    <label for="">@lang('layouts.Gove')</label>
                    <select class="form-control" id="s-gove" data-target="#s-dist"></select>
                </div><!-- /.form-group -->
            </div><!-- /.col-3 -->
            
            <div class="col-3">
                <div class="form-group search-action">
                    <label for="">@lang('layouts.Dict')</label>
                    <select class="form-control" id="s-dist" disabled="disabled"></select>
                </div><!-- /.form-group -->
            </div><!-- /.col-3 -->

            
            <div class="col-6 text-end">
                <button class="relode-btn btn btn-sm btn-outline-dark">
                    <i class="relode-btn-icon fas fa-sync-alt"></i>
                    <span class="relode-btn-loader spinner-grow spinner-grow-sm" style="display: none;" role="status" aria-hidden="true"></span>
                </button>
            </div><!-- /.col-3 -->

            {{--
            <div class="col-3">
                <div class="form-group search-action">
                    <label for="">@lang('layouts.Nationalities')</label>
                    <select class="form-control" id="s-nationalities" multiple="multiple"></select>
                </div><!-- /.form-group -->
            </div><!-- /.col-3 -->

            <div class="col-3">
                <div class="form-group search-action">
                    <label for="">@lang('schools.Schools')</label>
                    <select class="form-control" id="s-school"></select>
                </div><!-- /.form-group -->
            </div><!-- /.col-3 -->
            --}}
        </div><!-- /.row -->
    </div>

    <div class="card-body">
        <div id="map-1"></div>
        
        <div class="form-group mt-3">
            <h3 class="text-primary text-left">
                @lang('layouts.Workshops') :
                <span id="workshops-count"></span>
            </h3>
        </div><!-- /.form-group -->
    </div><!-- /.card-body -->
</div><!-- /.card -->


@push('custome-plugin')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<!-- After Leaflet script -->
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
<script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

<style>
    #map-1  {
        height: 400px;
    }
</style>
@endpush

@push('custome-js')
<script>
$('document').ready(function () {
    const lang = '{{ "ar" }}';

    function renderMap (mapId) {
        let mapObj = L.map(mapId, {zoomControl : true, zoom: 3, scrollWheelZoom: true}).setView([24.726534635226155, 46.710584266031596], 6);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mapObj);
        mapGroup = L.layerGroup().addTo(mapObj);

        var markers = L.markerClusterGroup();
        // // markers.addLayer(L.marker(getRandomLatLng(mapObj)));
        // mapObj.addLayer(markers);

        return {mapGroup, mapObj};
    }

    function renderPins (mapGroup, data, map) {
        mapGroup.clearLayers();
        var markers     = L.markerClusterGroup({
            // spiderfyOnMaxZoom: false,
            // showCoverageOnHover: false,
            // zoomToBoundsOnClick: false
        });

        var markerGroup = L.layerGroup().addTo(mapGroup);

        data.forEach(record => {
            var marker = L.marker([record.geo_lat, record.geo_lng], {draggable :false});

			markers.addLayer(marker);
        })

        map.addLayer(markers);

    }

    function requestWorkshops (filtrAtr, map) {
        
        $('.relode-btn-icon').hide(500);
        $('.relode-btn-loader').show(500);

        axios.get(`{{ route('admin.dashboard.index') }}`, {
            params : {
                get_workshops: true,
                ...filtrAtr
            }
        }).then(res => {
            let { data : { workshops, gove }, success } = res.data;
            
            if (success) {
                renderPins(map.mapGroup, workshops, map.mapObj);
                
                if (Boolean(gove) && workshops.length != 1) {
                    map.mapObj.setView([gove.geo_lat, gove.geo_lng], 13);
                } else if (workshops.length == 1) {
                    let school = workshops[0];
                    map.mapObj.setView([school.geo_lat, school.geo_lng], 18)
                } else {
                    map.mapObj.setView([30.046348, 31.199246,16], 7)
                }

                $('#workshops-count').text(workshops.length);
            }
        }).finally(e => {
            $('.relode-btn-icon').show(500);
            $('.relode-btn-loader').hide(500);
        });
    }

    const init = (() => {

        // START GOVE, DIST SELECT ACTION ...
        $('#s-gove').select2({
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
                target == '#edit-dist_id' 
                    ? $(target).removeAttr('disabled')
                    : $(target).val('').removeAttr('disabled').trigger('change');
            } else {
                $(target).val('').attr('disabled', 'disabled').trigger('change');
            }
        });

        $('#s-dist').select2({
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
        
        // START WORKSHOPS, MANAGERS & DIST SELECT ACTION ... 
        $('#search-box-container').on('change , keyup', '#s-gove, #s-dist, .relode-btn', function () {
            let filtrAtr = {
                gove       : $('#s-gove').val(),
                dist       : $('#s-dist').val(),
            }

            requestWorkshops(filtrAtr, workShopsMapObj);
        });

        $('.relode-btn').click(function () {
            $('.relode-btn').trigger('change');
        });

        const workShopsMapObj = renderMap('map-1');
        requestWorkshops({}, workShopsMapObj);
        
    })();
});
</script>
@endpush