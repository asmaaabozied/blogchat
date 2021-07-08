@props(['name', 'title'=>'Picture'])

<div class="custom-file-container" data-upload-id="media-file">
    <label class="font-weight-bold"> {{$title}} <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
    <label class="custom-file-container__custom-file">
        <input type="file" class="custom-file-container__custom-file__custom-file-input" accept='image/*, video/*, .mkv' name="{{$name}}" multiple>
        <span class="custom-file-container__custom-file__custom-file-control"></span>
    </label>
    <div class="custom-file-container__image-preview"></div>
</div>

@push('javascript')
    <script>
        let firstUpload = new FileUploadWithPreview('media-file')
    </script>
@endpush
