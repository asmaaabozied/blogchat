@props(['name', 'value', 'title', 'style'])

<div class="form-group">
    @if($title)
        <label class="font-weight-bold" for="{{$name}}">{{$title}}</label>
    @endif
    <div class="form-control-long-text">
        <div class=" eading-normal whitespace-pre-wrap">
            {{$value}}
        </div>
    </div>
    @error($name)
    <div class="alert alert-danger mt-2">
        {{$message}}
    </div>
    @enderror
</div>
