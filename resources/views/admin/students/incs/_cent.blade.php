@if(isset($row_object->student->cent))
    {{ $lang == 'ar' ? $row_object->student->cent->ar_name : $row_object->student->cent->en_name }}
@else
    ---
@endif