@if(isset($row_object->student) && sizeof($row_object->student->preferences))
    @foreach($row_object->student->preferences as $prf)
        <div class="badge bg-primary">{{$lang == 'ar' ? $prf->ar_name : $prf->en_name }}</div><br/>
    @endforeach
@else
    <div class="text-center">---</div>
@endif