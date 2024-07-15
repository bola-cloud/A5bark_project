<div style="display: none" id="createObjectCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('tracks.Create Title')</h5>
        </div>
        <div class="col-6 text-end">
            <div class="toggle-btn btn btn-outline-dark btn-sm" data-current-card="#createObjectCard" data-target-card="#objectsCard">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div><!-- /.row -->
    <hr/>

    <form action="/" id="objectForm">
        
        <div class="my-2 row">
            <label for="grade_id" class="col-sm-2 col-form-label">@lang('tracks.Grade') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <select class="form-control" id="grade_id" !multiple="multiple"></select>
                <div style="padding: 5px 7px; display: none" id="grade_idErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-2 -->

        <div class="my-2 row">
            <label for="ar_title" class="col-sm-2 col-form-label">@lang('tracks.Name') <span class="text-danger float-right">*</span></label>
            <div class="col-5" style="direction: rtl">
                <input type="text" class="form-control custome-ar-field" id="ar_title" placeholder="أسم التصنيف بالعربية">
                <div style="padding: 5px 7px; display: none" id="ar_titleErr" class="err-msg mt-2 alert alert-danger custome-ar-field">
                </div>
            </div><!-- /.col-5 -->
            <div class="col-5" style="direction: rtl">
                <input type="text" class="form-control custome-en-field" id="en_title" placeholder="Category name in english">
                <div style="padding: 5px 7px; display: none" id="en_titleErr" class="err-msg mt-2 alert alert-danger custome-en-field">
                </div>
            </div><!-- /.col-5 -->
        </div><!-- /.my-2 -->
        
        <div class="my-2 row">
            <label for="ar_description" class="col-sm-2 col-form-label">@lang('tracks.Description') <span class="text-danger float-right">*</span></label>
            <div class="col-5" style="direction: rtl">
                <textarea type="text" class="form-control custome-ar-field" id="ar_description" placeholder="الوصف بالعربية"></textarea>
                <div style="padding: 5px 7px; display: none" id="ar_descriptionErr" class="err-msg mt-2 alert alert-danger custome-ar-field">
                </div>
            </div><!-- /.col-5 -->
            <div class="col-5" style="direction: rtl">
                <textarea type="text" class="form-control custome-en-field" id="en_description" placeholder="Description in english"></textarea>
                <div style="padding: 5px 7px; display: none" id="en_descriptionErr" class="err-msg mt-2 alert alert-danger custome-en-field">
                </div>
            </div><!-- /.col-5 -->
        </div><!-- /.my-2 -->
        
        <div class="my-2 row">
            <label for="order" class="col-sm-2 col-form-label">@lang('tracks.Order') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="number" disabled="disabled" class="form-control" id="order">
                <div style="padding: 5px 7px; display: none" id="orderErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-2 -->

        <button class="create-object btn btn-primary float-end">@lang('tracks.Create Title')</button>
    </form>
</div>

@push('custome-js')
<script>
$(document).ready(function () {
    $('#grade_id').on('change', function () {
        let target_id = $(this).val();

        if (Boolean(target_id)) {
            // Send request latest order
            
            $('#loddingSpinner').show(500);

            axios.get(`{{ route('admin.trackGrades.index') }}/${target_id}`)
            .then((res) => {
                let { data, success } = res.data;

                console.log(data);

                if (success) {
                    let tracks = Boolean(data.tracks) ? data.tracks : [];

                    let last_order = 0;

                    tracks.forEach(track => {
                        if (track.order >= last_order)
                        last_order = track.order;
                    });

                    $('#order').attr('max', last_order + 1).val(last_order + 1);
                    $('#order').removeAttr('disabled');
                }
            }).catch(err => {

            }).finally(() => {
                $('#loddingSpinner').hide(500);
            });
        } else {
            $('#order').attr('disabled', 'disabled').val('');
        }

    });
});
</script>
@endpush