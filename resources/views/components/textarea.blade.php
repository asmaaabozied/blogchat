@props(['name', 'value', 'title', 'style'])

<div class="form-group">
    @if($title)
        <label for="{{$name}}">{{$title}}</label>
    @endif
    <textarea style="{{$style ??= 0}}" type="text" class="form-control @error($name) is-invalid @endif" id="{{$name}}" name="{{$name}}">{{$value}}</textarea>
    @error($name)
    <div class="alert alert-danger mt-2">
        {{$message}}
    </div>
    @enderror
</div>
