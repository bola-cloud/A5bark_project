
<div style="display: none" id="showObjectsCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('tracks.Show Title')</h5>
        </div>
        <div class="col-6 text-end">
            <div class="toggle-btn btn btn-outline-dark btn-sm" data-current-card="#showObjectsCard" data-target-card="#objectsCard">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div><!-- /.row -->
    <hr/>

    <div class="row">
        <table class="table">
            <tr>
                <td>@lang('tracks.Grade')</td>
                <td colspan="2" id="show-grade_id"></td>
            </tr>

            <tr>
                <td>@lang('tracks.Name')</td>
                <td class="text-right" id="show-ar_title"></td>
                <td class="text-left" id="show-en_title"></td>
            </tr>

            <tr>
                <td>@lang('tracks.Description')</td>
                <td id="show-ar_description"></td>
                <td id="show-en_description"></td>
            </tr>

            <tr>
                <td>@lang('tracks.Order')</td>
                <td colspan="2" id="show-order"></td>
            </tr>

        </table>
    </div><!-- /.row -->
</div>