
<div style="display: none" id="createObjectCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('news.Create News Category')</h5>
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
            <label for="name" class="col-sm-2 col-form-label">@lang('news.Name') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10 row" style="direction: rtl">
                <div class="col-6">
                    <input type="text" class="form-control custome-ar-field" id="ar_name" placeholder="أسم التصنيف بالعربية">
                    <div style="padding: 5px 7px; display: none" id="ar_nameErr" class="err-msg mt-2 alert alert-danger custome-ar-field">
                    </div>
                </div><!-- /.col-6 -->
                <div class="col-6">
                    <input type="text" class="form-control custome-en-field" id="en_name" placeholder="Category name in english">
                    <div style="padding: 5px 7px; display: none" id="en_nameErr" class="err-msg mt-2 alert alert-danger custome-en-field">
                    </div>
                </div><!-- /.col-6 -->
            </div>
        </div><!-- /.my-3 -->
        

        <button class="create-object btn btn-primary float-end mx-3">@lang('layouts.Create Title')</button>
    </form>
</div>