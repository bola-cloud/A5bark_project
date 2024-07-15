<div class="text-center">
    @if($permissions == 'admin' || in_array('trackGrades_edit', $permissions))
    <button class="pricing-plans btn btn-warning btn-sm" data-target="{{$row_object->id}}">
        <i class="fas fa-tags"></i>
    </button>
	@else 
	---
	@endif
</div><!-- /.text-center -->