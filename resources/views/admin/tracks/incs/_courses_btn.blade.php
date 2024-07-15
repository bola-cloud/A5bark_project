<div class="d-flex justify-content-center">
	@if($permissions == 'admin' || in_array('courses_edit', $permissions))
	<button class="update-courses btn btn-sm btn-warning" data-target="{{ $row_object->id }}">
        <i class="fas fa-clipboard-list"></i>
    </button>
	@else 
	<button class="update-courses btn btn-sm btn-warning" disabled="disabled">
        <i class="fas fa-clipboard-list"></i>
    </button>
	@endif
</div>
