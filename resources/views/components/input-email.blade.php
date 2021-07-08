@props(['name', 'value', 'title'])

<div class="form-group">
    @if($title)
        <label class="font-weight-bold" for="{{$name}}">{{$title}}</label>
    @endif
    <input type="email" class="form-control @error($name) is-invalid @endif" id="{{$name}}" value="{{$value}}" name="{{$name}}">
    @error($name)
    <div class="alert alert-danger mt-2">
        {{$message}}
    </div>
    @enderror
</div>
