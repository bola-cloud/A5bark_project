@if(isset($row_object->student->gove))
    {{ $lang == 'ar' ? $row_object->student->gove->ar_name : $row_object->student->gove->en_name }}
@else
    ---
@endif