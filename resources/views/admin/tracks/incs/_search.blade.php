
<!-- START SEARCH BAR -->
<div style="display: none" class="search-container row mb-2">
    <div class="col-3">
        <div class="my-2 search-action">
            <label for="">@lang('courses.Name')</label>
            <input type="text" class="form-control" id="s-name">
        </div><!-- /.my-2 -->
    </div><!-- /.col-3 -->
    
    <div class="col-3">
        <div class="my-2 search-action">
            <label for="">@lang('courses.Trainer')</label>
            <select type="text" multiple="multiple" class="form-control" id="s-trainers"></select>
        </div><!-- /.my-2 -->
    </div><!-- /.col-3 -->
    
    <div class="col-3">
        <div class="my-2 search-action">
            <label for="">@lang('courses.Grade')</label>
            <select type="text" multiple="multiple" class="form-control" id="s-grades"></select>
        </div><!-- /.my-2 -->
    </div><!-- /.col-3 -->

    <div class="col-3">
        <div class="my-2 search-action">
            <label for="">@lang('courses.Categories')</label>
            <select type="text" multiple="multiple" class="form-control" id="s-categories"></select>
        </div><!-- /.my-2 -->
    </div><!-- /.col-3 -->

    <div class="col-3">
        <div class="my-2 search-action">
            <label for="">@lang('layouts.Active')</label>
            <select type="text" class="form-control" id="s-is_active">
                <option value="">@lang('layouts.all')</option>
                <option value="1">@lang('layouts.active')</option>
                <option value="0">@lang('layouts.de-active')</option>
            </select>
        </div><!-- /.my-2 -->
    </div><!-- /.col-3 -->

</div><!-- /.row --> 
<!-- END   SEARCH BAR -->