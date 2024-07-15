
<!-- START SEARCH BAR -->
<div style="display: none" class="search-container row mb-2">
    <div class="col-4">
        <div class="my-2 search-action">
            <label for="">@lang('users.Name')</label>
            <input type="text" class="form-control" id="s-name">
        </div><!-- /.my-2 -->
    </div><!-- /.col-4 -->
    
    <div class="col-4">
        <div class="my-2 search-action">
            <label for="">@lang('users.Email')</label>
            <input type="text" class="form-control" id="s-email">
        </div><!-- /.my-2 -->
    </div><!-- /.col-4 -->

    <div class="col-4">
        <div class="my-2 search-action">
            <label for="">@lang('users.Phone')</label>
            <input type="text" class="form-control" id="s-phone">
        </div><!-- /.my-2 -->
    </div><!-- /.col-4 -->

    <div class="col-4">
        <div class="my-2 search-action">
            <label for="">@lang('layouts.Active')</label>
            <select type="text" class="form-control" id="s-is_active">
                <option value="">@lang('layouts.all')</option>
                <option value="1">@lang('layouts.active')</option>
                <option value="0">@lang('layouts.de-active')</option>
            </select>
        </div><!-- /.my-2 -->
    </div><!-- /.col-4 -->
    
    <div class="col-4">
        <div class="my-2 search-action">
            <label for="">@lang('layouts.Gove')</label>
            <select type="text" class="form-control" id="s-gove"></select>
        </div><!-- /.my-2 -->
    </div><!-- /.col-4 -->
    
    <div class="col-4">
        <div class="my-2 search-action">
            <label for="">@lang('layouts.Dict')</label>
            <select type="text" class="form-control" id="s-cent"></select>
        </div><!-- /.my-2 -->
    </div><!-- /.col-4 -->

    <div class="col-4">
        <div class="my-2 search-action">
            <label for="">@lang('students.Parents')</label>
            <select multiple="multiple" type="text" class="form-control" id="s-parents"></select>
        </div><!-- /.my-2 -->
    </div><!-- /.col-4 -->

    <div class="col-4">
        <div class="my-2 search-action">
            <label for="">@lang('students.Form Birth Date')</label>
            <input type="date" class="form-control" id="s-birth_date_from">
        </div><!-- /.my-2 -->
    </div><!-- /.col-4 -->
    
    <div class="col-4">
        <div class="my-2 search-action">
            <label for="">@lang('students.To Birth Date')</label>
            <input type="date" class="form-control" id="s-birth_date_to">
        </div><!-- /.my-2 -->
    </div><!-- /.col-4 -->

    <div class="col-12">
        <div class="my-2 search-action">
            <label for="">@lang('students.Preferences')</label>
            <select multiple="multiple" type="text" class="form-control" id="s-preferences"></select>
        </div><!-- /.my-2 -->
    </div><!-- /.col-12 -->

</div><!-- /.row --> 
<!-- END   SEARCH BAR -->