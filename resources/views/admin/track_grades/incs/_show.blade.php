
<div style="display: none" id="showObjectsCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('districts.Show Title')</h5>
        </div>
        <div class="col-6 text-end">
            <div class="toggle-btn btn btn-outline-dark btn-sm" data-current-card="#showObjectsCard" data-target-card="#objectsCard">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div><!-- /.row -->
    <hr/>

    <div class="my-1">
        
        <div class="row">
            <div class="col-md-8">
                <table class="table">
                    <tr>
                        <td>@lang('track_grades.Title')</td>
                        <td id="show-ar_title"></td>
                        <td id="show-en_title"></td>
                    </tr>
                    <tr>
                        <td>@lang('track_grades.Age From/To')</td>
                        <td id="show-from"></td>
                        <td id="show-to"></td>
                    </tr>
                    <tr>
                        <td>@lang('track_grades.Tracks')</td>
                        <td colspan="2" id="show-tracks"></td>
                    </tr>
                </table>
            </div><!-- /.col-md-8 -->
            <div class="col-md-4">
                <img id="show-image" class="img-fluid img-thumbnail" !style="width: 100%" src="">
            </div><!-- /.col-md-4 -->
        </div><!-- /.row -->    

    </div><!-- /.my-1 -->
</div><!-- /.card -->