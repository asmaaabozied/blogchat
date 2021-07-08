@props(['name', 'title', 'value'=>'1', 'option1'=>'No', 'option2'=>'Yes'])

<div class="form-group">
    <label class="font-weight-bold">{{$title}}</label>
    <div class="mb-3">
        <label class="mr-3">{{$option1}}</label>
        <label class="switch s-icons s-outline s-outline-default mr-2 s-outline-success" >
            <input class="myChk" id="{{$name}}" name="{{$name}}" type="checkbox" {{$value  ? 'checked'  :''}} value="{{$value ? 1 : 0}}">
            <span class="slider round"></span>
        </label>
        {{$option2}}
    </div>
</div>
@push('javascript')
    <script>
        $('.myChk').change(function (event) {
            if ($(this).is(':checked')) {
                $(this).val(1);
            } else {
                $(this).val(0);
            }
        })
    </script>
@endpush
