@props(['name', 'title'])

<div class="form-group">
    @if($title)
        <label class="font-weight-bold" for="{{$name}}">{{$title}}</label>
    @endif
    <input type="password" class="form-control @error($name) is-invalid @endif" id="{{$name}}" name="{{$name}}">
    @error($name)
    <div class="alert alert-danger mt-2">
        {{$message}}
    </div>
    @enderror
</div>
<div class="form-group">
    @if($title)
        <label class="font-weight-bold" for="{{$name}}">{{str_replace(':', ' ',$title).'Confirmation:'}}</label>
    @endif
    <input type="password" class="form-control @error($name) is-invalid @endif" id="{{$name}}" name="{{$name}}_confirmation">
</div>
