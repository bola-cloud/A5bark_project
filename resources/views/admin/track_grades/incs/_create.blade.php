
<div style="display: none" id="createObjectCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('course_category.Create Title')</h5>
        </div>
        <div class="col-6 text-end">
            <div class="toggle-btn btn btn-outline-dark btn-sm" data-current-card="#createObjectCard" data-target-card="#objectsCard">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div><!-- /.row -->
    <hr/>

    <form action="/" id="objectForm">
        
        <div class="my-3 row">
            <label for="name" class="col-sm-2 col-form-label">@lang('track_grades.Title') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10 row" style="direction: rtl">
                <div class="col-6">
                    <input type="text" class="form-control custome-ar-field" id="ar_title" placeholder="العنوان بالعربية">
                    <div style="padding: 5px 7px; display: none" id="ar_titleErr" class="err-msg mt-2 alert alert-danger custome-ar-field">
                    </div>
                </div><!-- /.col-6 -->
                <div class="col-6">
                    <input type="text" class="form-control custome-en-field" id="en_title" placeholder="Title in english">
                    <div style="padding: 5px 7px; display: none" id="en_titleErr" class="err-msg mt-2 alert alert-danger custome-en-field">
                    </div>
                </div><!-- /.col-6 -->
            </div><!-- /.col-sm-10 -->
        </div><!-- /.my-3 -->

        <div class="my-3 row">
            <label for="name" class="col-sm-2 col-form-label">@lang('track_grades.Age From/To') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10 row">
                <div class="col-6">
                    <input type="number" class="form-control" id="from" placeholder="{{ __('track_grades.From')}}">
                    <div style="padding: 5px 7px; display: none" id="fromErr" class="err-msg mt-2 alert alert-danger ">
                    </div>
                </div><!-- /.col-6 -->
                <div class="col-6">
                    <input type="number" class="form-control" id="to" placeholder="{{ __('track_grades.To')}}">
                    <div style="padding: 5px 7px; display: none" id="toErr" class="err-msg mt-2 alert alert-danger">
                    </div>
                </div><!-- /.col-6 -->
            </div><!-- /.col-sm-10 -->
        </div><!-- /.my-3 -->       
        
        <div class="my-3 row">
            <div class="row">
                <label for="name" class="col-sm-2 col-form-label">@lang('track_grades.Image') <span class="text-danger float-right">*</span></label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="image" placeholder="@lang('trainers.Name')" accept="image/*">
                    <div style="padding: 5px 7px; display: none" id="imageErr" class="err-msg mt-2 alert alert-danger">
                    </div>
                </div><!-- /.col-sm-10 -->
            </div><!-- /.row -->
        </div><!-- /.my-3 -->

        <button class="create-object btn btn-primary float-end mx-3">@lang('track_grades.Create Title')</button>
    </form>
</div>