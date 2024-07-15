@if (sizeof($row_object->categories))
    @foreach($row_object->categories as $category)
        <span class="badge bg-primary">{{ $lang == 'ar' ? $category->ar_name : $category->en_name }}</span>
    @endforeach
@else 
    ---
@endif