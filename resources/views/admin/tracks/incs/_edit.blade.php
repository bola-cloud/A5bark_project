<div style="display: none" id="editObjectsCard" class="card card-body">
    <div class="row">
        <div class="col-6">
            <h5>@lang('courses.Update Title')</h5>
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
        <input type="hidden" id="origin-order">
        <input type="hidden" id="origin-grade_id">
        
        <div class="my-2 row">
            <label for="edit-grade_id" class="col-sm-2 col-form-label">@lang('tracks.Grade') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <select class="form-control" id="edit-grade_id" !multiple="multiple"></select>
                <div style="padding: 5px 7px; display: none" id="edit-grade_idErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div>
        </div><!-- /.my-2 -->
        
        <div class="my-2 row">
            <label for="edit-ar_title" class="col-sm-2 col-form-label">@lang('tracks.Name') <span class="text-danger float-right">*</span></label>
            <div class="col-5" style="direction: rtl">
                <input type="text" class="form-control custome-ar-field" id="edit-ar_title" placeholder="أسم التصنيف بالعربية">
                <div style="padding: 5px 7px; display: none" id="edit-ar_titleErr" class="err-msg mt-2 alert alert-danger custome-ar-field">
                </div>
            </div><!-- /.col-5 -->
            <div class="col-5" style="direction: rtl">
                <input type="text" class="form-control custome-en-field" id="edit-en_title" placeholder="Category name in english">
                <div style="padding: 5px 7px; display: none" id="edit-en_titleErr" class="err-msg mt-2 alert alert-danger custome-en-field">
                </div>
            </div><!-- /.col-5 -->
        </div><!-- /.my-2 -->
        
        <div class="my-2 row">
            <label for="edit-ar_description" class="col-sm-2 col-form-label">@lang('tracks.Description') <span class="text-danger float-right">*</span></label>
            <div class="col-5" style="direction: rtl">
                <textarea type="text" class="form-control custome-ar-field" id="edit-ar_description" placeholder="الوصف بالعربية"></textarea>
                <div style="padding: 5px 7px; display: none" id="edit-ar_descriptionErr" class="err-msg mt-2 alert alert-danger custome-ar-field">
                </div>
            </div><!-- /.col-5 -->
            <div class="col-5" style="direction: rtl">
                <textarea type="text" class="form-control custome-en-field" id="edit-en_description" placeholder="Description in english"></textarea>
                <div style="padding: 5px 7px; display: none" id="edit-en_descriptionErr" class="err-msg mt-2 alert alert-danger custome-en-field">
                </div>
            </div><!-- /.col-5 -->
        </div><!-- /.my-2 -->
       
        <div class="my-2 row">
            <label for="edit-order" class="col-sm-2 col-form-label">@lang('tracks.Order') <span class="text-danger float-right">*</span></label>
            <div class="col-sm-10">
                <input type="number" disabled="disabled" class="form-control" id="edit-order">
                <div style="padding: 5px 7px; display: none" id="edit-orderErr" class="err-msg mt-2 alert alert-danger">
                </div>
            </div><!-- /.col-sm-10 -->
        </div><!-- /.my-2 -->

        <button class="update-object btn btn-warning float-end">@lang('courses.Update Title')</button>
    </form>
</div>

@push('custome-js')
<script>
$(document).ready(function () {
    $('#edit-grade_id').on('change', function () {
        let target_id = $(this).val();

        if (Boolean(target_id)) {
            // Send request latest order
            
            $('#loddingSpinner').show(500);
            let origin_order    = $('#origin-order').val();
            let origin_grade_id = $('#origin-grade_id').val();
            
            axios.get(`{{ route('admin.trackGrades.index') }}/${target_id}`)
            .then((res) => {
                let { data, success } = res.data;

                if (success) {
                    let tracks = Boolean(data.tracks) ? data.tracks : [];

                    let last_order = 0;

                    tracks.forEach(track => {
                        if (track.order >= last_order)
                        last_order = track.order;
                    });

                    $('#edit-order').attr('max', last_order + 1).val(origin_grade_id == target_id ? origin_order : last_order);
                    $('#edit-order').removeAttr('disabled');
                }
            }).catch(err => {

            }).finally(() => {
                $('#loddingSpinner').hide(500);
            });
        } else {
            $('#edit-order').attr('disabled', 'disabled').val('');
        }

    });
});
</script>
@endpush