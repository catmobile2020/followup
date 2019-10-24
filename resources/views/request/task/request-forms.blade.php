<label>Select Form</label>
<select name="request_form_id" class="form-control changeForm" data-type="form" >
    <option value selected disabled>Select Form</option>
    @foreach($forms as $val=>$name)
        <option value="{{$val}}">{!! $name !!}</option>
    @endforeach
</select>