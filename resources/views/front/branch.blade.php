@extends('layouts.main')

@section('content')

<div class="container-fluid p-3 grey-background">
     <!-- Event panner Section -->
     <div class="row mb-3">
        <div class="col-12">
            <form class="row g-3 d-flex justify-content-center">
                <div class="col-md-3">
                    <label for="eventName" class="form-label d-flex">@lang('front.EventName')</label>
                    <input type="text" class="form-control" id="eventName">
                </div>
                <div class="col-md-3">
                    <label for="eventType" class="form-label d-flex">@lang('front.EventType')</label>
                    <select id="eventType" class="form-select form-control">
                        <option selected>@lang('front.Choose')...</option>
                        <option>@lang('front.Type1')</option>
                        <option>@lang('front.Type2')</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="eventDate" class="form-label d-flex">@lang('front.EventDate')</label>
                    <input type="date" class="form-control" id="eventDate">
                </div>
                <div class="col-md-1 text-center d-flex flex-column">
                    <button type="reset" class="btn btn-link text-danger">@lang('front.CancelSearch')</button>
                    <button type="submit" class="btn btn-primary">@lang('front.Search')</button>
                </div>
            </form>
        </div>
    </div>
    <div class="adv-section section-bakground">
        <div class="row p-5">
            <div class="col-md-12 p-3">
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{ asset('media/'.$target_branch->image) }}" style="max-height: 80vh;" class="w-100">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5 d-flex justify-content-center">
        <div class="col-md-9">
            <table class="table blue-color">
                <thead>
                    <tr>
                        <th scope="col text-justify">@lang('front.BranchName')</th>
                        <th scope="col text-justify">@lang('front.Address')</th>
                        <th scope="col text-justify">@lang('front.WorkingHours')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($target_branch->places as $place)
                    <tr>
                        <td>{{ App::getLocale() == 'ar' ? $place->ar_name : $place->en_name }}</td>
                        <td>{{ $place->address }}</td>
                        <td>{{ $place->working_hours }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-5 container-padding">
        <div class="col-md-12 mt-5">
            <h2 class="d-flex pr-5 pl-5">@lang('front.TicketSalesLocations')</h2>
            <br>
            <div class="row">
                @foreach ($branches as $branch)
                <div class="col-md-3">
                    <a href="{{route('branch_details', $branch->id)}}">
                        <img src="{{ asset('media/'.$branch->image) }}" class="w-100">
                        <br>
                        <p class="d-flex">{{ App::getLocale() == 'ar' ? $branch->ar_name : $branch->en_name }}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
