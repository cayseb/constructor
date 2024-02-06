<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="">
    @foreach($form->steps as $step)
        <div>
            {{$step->name}}
        </div>
        @foreach($step->fields as $field)
            @if($field->type === \App\Enums\FieldEnum::INPUT->value)
                <div>
                    <label for="{{$field->id}}">{{$field->input->label}}</label>
                    <input
                        id="{{$field->id}}"
                        placeholder="{{$field->input->placeholder}}"
                        type="{{$field->input->type}}"
                        {{$field->input->required ? "required" : null}}>
                </div>
            @endif
            @if($field->type === \App\Enums\FieldEnum::CHECKBOX->value)
                <div>{{$field->checkbox->name}}</div>
                @foreach($field->checkbox->options as $option)
                    <div>
                        <input type="checkbox" id="{{$option->id}}" name="{{$option->name}}"/>
                        <label for="{{$option->id}}">{{$option->name}}</label>
                    </div>
                @endforeach
            @endif
            @if($field->type === \App\Enums\FieldEnum::RADIO->value)
                <div>{{$field->radio->name}}</div>
                @foreach($field->radio->options as $option )
                    <div>
                        <input type="radio" id="{{$option->id}}" name="{{$field->radio->name}}"
                               value="{{$option->id}}"/>
                        <label for="{{$option->id}}">{{$option->name}}</label>
                    </div>
                @endforeach
            @endif
            @if($field->type === \App\Enums\FieldEnum::SELECT->value)
                <select {{$field->select->multi ? "multiple " : null}} name="select[]">
                    @foreach($field->select->options as $option)
                        <option value="{{$option->id}}">{{$option->name}}</option>
                    @endforeach
                </select>
            @endif

        @endforeach

    @endforeach

</form>
</body>
</html>
