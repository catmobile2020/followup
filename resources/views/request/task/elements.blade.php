<link href="{{URL::asset('css/plugins/select2/select2.css')}}" rel="stylesheet">
<link href="{{URL::asset('css/plugins/summernote/summernote.css')}}" rel="stylesheet">

@foreach($elements as $element)
    <div class="form-group">
        <label>{!! $element->title !!}</label>
        @if($element->type == 'select' and $element->value != null)
            <select name="{{$element->id}}" class="form-control" {{$element->validation ? 'required' : ''}}>
                @foreach(explode(',',$element->value) as $val)
                    <option value="{{$val}}"  {{$task->values_array[$element->id] == $val ? 'selected' : ''}}>{{$val}}</option>
                @endforeach
            </select>
        @elseif ($element->type == 'checkbox' and $element->value != null)
            @foreach(explode(',',$element->value) as $val)
                <input type="checkbox" name="{{$element->id}}[]" @if (is_array($task->values_array[$element->id]) and in_array($val,$task->values_array[$element->id])) checked @endif value="{{$val}}" placeholder="{{$element->placeholder}}" class="form-control" @if ($loop->first){{$element->validation ? 'required' : ''}}@endif/>{{$val}}
            @endforeach
        @elseif ($element->type == 'text')
            <textarea id="textarea" name="{{$element->id}}" placeholder="{{$element->placeholder}}" class="form-control" {{$element->validation ? 'required' : ''}}>{!! $task->values_array[$element->id] !!}</textarea>
        @endif
    </div>
@endforeach

<script src="{{URL::asset('js/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{URL::asset('js/plugins/summernote/summernote.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $(".select2").select2();
    });

    $('#textarea').summernote({
        height: 260,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: true,                  // set focus to editable area after initializing summernote
        fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ],
    });

</script>