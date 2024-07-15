
<div style="display: none" id="showObjectsCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('students.Show Title')</h5>
        </div>
        <div class="col-6 text-end">
            <div class="toggle-btn btn btn-outline-dark btn-sm" data-current-card="#showObjectsCard" data-target-card="#objectsCard">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div><!-- /.row -->
    <hr/>

    <div>
        <table class="table">
            <tr>
                <td>@lang('students.Name')</td>
                <td id="show-name"></td>
            </tr>
            <tr>
                <td>@lang('students.Email')</td>
                <td id="show-email"></td>
            </tr>
            <tr>
                <td>@lang('students.Phone')</td>
                <td id="show-phone"></td>
            </tr>

            <tr>
                <td>@lang('students.Birth Date')</td>
                <td id="show-birth_date"></td>
            </tr>
            
            <tr>
                <td>@lang('students.Government')</td>
                <td id="show-gove"></td>
            </tr>

            <tr>
                <td>@lang('students.Center')</td>
                <td id="show-cent"></td>
            </tr>

            <tr>
                <td>@lang('students.Address')</td>
                <td id="show-address"></td>
            </tr>
            
            <tr>
                <td>@lang('students.Parent')</td>
                <td id="show-parent"></td>
            </tr>
            
            <tr>
                <td>@lang('students.Preferences')</td>
                <td id="show-preferences"></td>
            </tr>
        
        </table>
    </div>
</div>