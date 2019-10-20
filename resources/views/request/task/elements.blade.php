@foreach($elements as $element)
    <div class="form-group">
        <label>{{$element->title}}</label>
        @if($element->type == 'select' and $element->value != null)
            <select name="{{$element->id}}" class="form-control" {{$element->validation ? 'required' : ''}}>
                @foreach(explode(',',$element->value) as $val)
                    <option value="{{$val}}"  {{$task->values_array[$element->id] == $val ? 'selected' : ''}}>{{$val}}</option>
                @endforeach
            </select>
        @elseif ($element->type == 'checkbox' and $element->value != null)
            @foreach(explode(',',$element->value) as $val)
                <input type="checkbox" name="{{$element->id}}[]" @if (is_array($task->values_array[$element->id]) and in_array($val,$task->values_array[$element->id])) checked @endif value="{{$val}}" placeholder="{{$element->placeholder}}" class="form-control" {{$element->validation ? 'required' : ''}}/>{{$val}}
            @endforeach
        @elseif ($element->type == 'text')
            <input type="text" name="{{$element->id}}" value="{{$task->values_array[$element->id]}}" placeholder="{{$element->placeholder}}" class="form-control" {{$element->validation ? 'required' : ''}}/>
        @endif
    </div>
@endforeach