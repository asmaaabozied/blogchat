@props(['name', 'value', 'title', 'rows'=>10, 'cols'=>30])

<div class="form-group">
    @if($title)
        <label class="font-weight-bold" for="{{$name}}">{{$title}}</label>
    @endif
    <textarea class="form-control @error($name) is-invalid @endif" name="{{$name}}" id="{{$name}}" cols="{{$cols}}" rows="{{$rows}}">{{$value}}</textarea>
    @error($name)
    <div class="alert alert-danger mt-2">
        {{$message}}
    </div>
    @enderror
</div>
