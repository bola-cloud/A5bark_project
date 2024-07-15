<div class="d-flex justify-content-center">
	@if($permissions == 'admin' || in_array('students_edit', $permissions))
	<div class="form-check form-switch">
		<input class="c-top_student-btn form-check-input" id="customSwitch{{ $row_object->id }}" data-target-obj="{{ $row_object->id }}" type="checkbox" @if($row_object->student->is_top_student) checked="true" @endif>
		<label class="form-check-label" for="customSwitch{{ $row_object->id }}"></label>
	</div>
	@else 
	{!!
		$row_object->is_active ? '<span class="badge badge-primary">active</span>' : '<span class="badge badge-warning">de-active</span>'
	!!}
	@endif
</div>
