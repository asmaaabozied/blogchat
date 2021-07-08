@props(['name', 'value', 'title'])

<div class="form-group">
    @if($title)
        <label for="{{$name}}">{{$title}}</label>
    @endif
    <input type="text" class="form-control @error($name) is-invalid @endif" id="{{$name}}" value="{{$value}}" name="{{$name}}">
    @error($name)
    <div class="alert alert-danger mt-2">
        {{$message}}
    </div>
    @enderror
</div>
@if(isset($name))
    @push('javascript')
        <script>
            f2 = flatpickr(document.getElementById('{{$name}}'), {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });
        </script>
    @endpush
@endif
