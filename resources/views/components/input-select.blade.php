@props(['name', 'title', 'collection', 'hasEmptyOption'=>1, 'display', 'value', 'oldValue', 'changeEvent'=>'', 'multiple'=>false])

<div class="form-group">
    @if($title)
        <label class="font-weight-bold" for="{{$name}}">{{$title}}</label>
    @endif
    <select class="selectpicker form-control" data-live-search="true" id="{{$name}}" name="{{$name}}" onchange="{{$changeEvent}}" @if($multiple) multiple @endif>
        @if($hasEmptyOption)
            <option value=""></option>
        @endif
        @foreach($collection as $item)
            <option value="@if(isset($value)) {{$item[$value]}} @else {{$item}} @endif" @if(isset($value)) {{ $item[$value] == $oldValue ? 'selected':''}} @else {{ $item == $oldValue ? 'selected':''}} @endif >
                @if(isset($value)) {{$item[$display]}} @else {{ $item }} @endif
            </option>
        @endforeach
    </select>
    @error($name)
    <div class="alert alert-danger mt-2">
        {{$message}}
    </div>
    @enderror
</div>
