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
<form action="{{route('form.store')}}" method="POST">
    @csrf
    <input type="hidden" name="form" value="{{$form->id}}">
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
                        name="{{$field->type}}/{{$field->id}}"
                        placeholder="{{$field->input->placeholder}}"
                        type="{{$field->input->type}}"
{{--                        {{$field->input->required ? "required" : null}}--}}
                    >
                </div>
            @endif
            @if($field->type === \App\Enums\FieldEnum::CHECKBOX->value)
                <div>{{$field->checkbox->name}}</div>
                @foreach($field->checkbox->options as $option)
                    <div>
                        <input
                            type="checkbox"
                            id="{{$option->id}}"
                            name="{{$option->name}}"
                            {{$option->checked ? "checked" : null}}
                        />
                        <label
                            for="{{$option->id}}"
                        >
                            {{$option->name}}
                        </label>
                    </div>
                @endforeach
            @endif
            @if($field->type === \App\Enums\FieldEnum::RADIO->value)
                <div>{{$field->radio->name}}</div>
                @foreach($field->radio->options as $option )
                    <div>
                        <input
                            type="radio"
                            id="{{$option->id}}"
                            name="{{$field->radio->name}}"
                            value="{{$option->id}}"
                            {{$option->checked ? "checked" : null}}
                        />
                        <label
                            for="{{$option->id}}"
                        >
                            {{$option->name}}
                        </label>
                    </div>
                @endforeach
            @endif
            @if($field->type === \App\Enums\FieldEnum::SELECT->value)
                <div>
                <select
                    {{$field->select->multi ? "multiple " : null}}
                    name="select"
                >
                    @foreach($field->select->options as $option)
                        @if($option->default)
                            <option selected value="" disabled>
                                {{$option->name}}
                            </option>
                            @else
                        <option
                            {{$option->selected ? "selected" : null}}
                            value="{{$option->id}}"
                        >
                            {{$option->name}}
                        </option>
                        @endif
                    @endforeach
                </select>
                </div>
            @endif
        @endforeach
    @endforeach
    <button type="submit">Отправить</button>
</form>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</body>
</html>
