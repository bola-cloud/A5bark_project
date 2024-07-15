<div style="display: none" id="editObjectsCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('course_category.Update Title')</h5>
        </div>
        <div class="col-6 text-end">
            <div class="toggle-btn btn btn-outline-dark btn-sm" data-current-card="#editObjectsCard" data-target-card="#objectsCard">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div><!-- /.row -->
    <hr/>

    <form action="/" id="objectForm">
        <input type="hidden" id="edit-id">

        
        <div class="my-3 row">
            <label for="name" class="col-sm-2 col-form-label">@lang('track_grades.Title') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10 row" style="direction: rtl">
                <div class="col-6">
                    <input type="text" class="form-control custome-ar-field" id="edit-ar_title" placeholder="العمر بداية من بالعربية">
                    <div style="padding: 5px 7px; display: none" id="edit-ar_titleErr" class="err-msg mt-2 alert alert-danger custome-ar-field">
                    </div>
                </div><!-- /.col-6 -->
                <div class="col-6">
                    <input type="text" class="form-control custome-en-field" id="edit-en_title" placeholder="Age from in english">
                    <div style="padding: 5px 7px; display: none" id="edit-en_titleErr" class="err-msg mt-2 alert alert-danger custome-en-field">
                    </div>
                </div><!-- /.col-6 -->
            </div>
        </div><!-- /.my-3 -->  
        
        <div class="my-3 row">
            <label for="name" class="col-sm-2 col-form-label">@lang('track_grades.Age From/To') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10 row">
                <div class="col-6">
                    <input type="number" class="form-control custome-ar-field" id="edit-from" placeholder="{{ __('track_grades.From')}}">
                    <div style="padding: 5px 7px; display: none" id="edit-fromErr" class="err-msg mt-2 alert alert-danger custome-ar-field">
                    </div>
                </div><!-- /.col-6 -->
                <div class="col-6">
                    <input type="number" class="form-control custome-ar-field" id="edit-to" placeholder="{{ __('track_grades.To')}}">
                    <div style="padding: 5px 7px; display: none" id="edit-toErr" class="err-msg mt-2 alert alert-danger custome-en-field">
                    </div>
                </div><!-- /.col-6 -->
            </div><!-- /.col-sm-10 -->
        </div><!-- /.my-3 -->    

        <div class="my-3 row">
            <div class="row">
                <label for="name" class="col-sm-2 col-form-label">@lang('track_grades.Image') <span class="text-danger float-right">*</span></label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="edit-image" placeholder="@lang('track_grades.Image')" accept="image/*">
                    <div style="padding: 5px 7px; display: none" id="edit-imageErr" class="err-msg mt-2 alert alert-danger">
                    </div>
                </div><!-- /.col-sm-10 -->
            </div><!-- /.row -->
        </div><!-- /.my-3 -->


        <button class="update-object btn btn-warning float-end mx-3">@lang('course_category.Update Title')</button>
    </form>
</div>