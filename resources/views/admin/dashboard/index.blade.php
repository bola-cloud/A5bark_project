@extends('layouts.admin.app')

@push('title')
    <h1 class="h2">@lang('layouts.Dashboard')</h1>
@endpush

@section('content')

    <div class="row">
        <div class="col-md-3">
            <div class="rounded-1 p-3 mb-2 bg-primary text-white">
                <i class="fas fa-users fa-3x"></i>    
                <span class="fs-2 float-end" id="stat-clients">
                    <span style="display: none" class="count"></span>

                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </span>
                <hr/>

                {{-- <a class=" text-white" href="{{ route('admin.students.index') }}">@lang('layouts.Students')</a> --}}
            </div>
        </div><!-- /.col-md-3 -->
        
        <div class="col-md-3">
            <div class="rounded-1 p-3 mb-2 bg-primary text-white">
                <i class="fas fa-user-tie fa-3x"></i> 
                <span class="fs-2 float-end" id="stat-workShopManagers">
                    <span style="display: none" class="count"></span>

                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </span>
                <hr/>

                {{-- <a class=" text-white" href="{{ route('admin.trainers.index') }}">@lang('layouts.Trainers')</a> --}}
            </div>
        </div><!-- /.col-md-3 -->

        <div class="col-md-3">
            <div class="rounded-1 p-3 mb-2 bg-primary text-white">
                <i class="fas fa-chalkboard-teacher fa-3x"></i> 
                <span class="fs-2 float-end" id="stat-workShops">
                    <span style="display: none" class="count"></span>

                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </span>
                <hr/>

                {{-- <a class=" text-white" href="{{ route('admin.courses.index') }}">@lang('layouts.Courses')</a> --}}
            </div>
        </div><!-- /.col-md-3 -->

        
        <div class="col-md-3">
            <div class="rounded-1 p-3 mb-2 bg-primary text-white">
                <i class="fas fa-shopping-cart fa-3x"></i> 
                <span class="fs-2 float-end" id="stat-workShops">
                    <span style="display: none" class="count"></span>

                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </span>
                <hr/>

                {{-- <a class=" text-white" href="{{ route('admin.courseSubscription.index') }}">@lang('dashboard.Courses_Subscriptipons')</a> --}}
            </div>
        </div><!-- /.col-md-3 -->

        {{--
        <div class="col-md-3">
            <div class="rounded-1 p-3 mb-2 bg-primary text-white">
                <i class="fas fa-tools fa-3x"></i>
                <span class="fs-2 float-end" id="stat-workshopOrders">
                    <span style="display: none" class="count"></span>

                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </span>
                <hr/>

                <a class=" text-white" href="{{ route('admin.workshopsOrders.index') }}">@lang('layouts.Workshops Orders')</a>
            </div>
        </div><!-- /.col-md-3 -->
        --}}
    </div><!-- /.row -->

    <hr/>

    {{--
        @include('admin.dashboard.incs._map')
    --}}

@endSection

@push('custome-js')
<script>
$('document').ready(function () {
    /**
    const renderStatistics = async () => {
        const target_el = ['clients', 'workShops', 'workshopOrders', 'workShopManagers'];

        const res = await axios.get(`{{ route('admin.dashboard.index') }}?get_counts=true`);

        const { data, success } = res.data;
        
        if (success) {
            target_el.forEach(el => {
                $(`#stat-${el}`).find('.spinner-border').hide(500);
                $(`#stat-${el}`).find('.count').text(data[el]).hide(500).show(500);
            });

            $('#workshops-count').text(data.workShops);
        }
    }

    const inite = (() => {
        renderStatistics();
    })();
    */
});
</script>
@endpush