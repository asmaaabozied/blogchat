@extends('layouts.new-resource')
@section('title', 'Edit Reply')
@section('index-url', route('reply.index'))
@section('store-url', route('reply.update', $reply))
@section('new-form')
    @method('PATCH')
    <x-input-select :collection="\App\Models\User::all()" title="User" :oldValue="$reply['user_id']" name="user_id" display="name" value="id"></x-input-select>
    <x-input-long-text rows="2" cols="10" name="content" :value="$reply['content']" title="Reply"></x-input-long-text>

    <div class="form-group">
        <label for="type">Type: </label>
        <select name="repliable_type" id="repliable_type" class="selectpicker form-control" onchange="change()">
            <option {{$reply['repliable_type'] == \App\Models\Comment::class ? 'selected':''}} value="{{\App\Models\Comment::class}}">Comment</option>
            <option {{$reply['repliable_type'] == \App\Models\Reply::class ? 'selected':''}} value="{{\App\Models\Reply::class}}">Reply</option>
        </select>
    </div>

    <div class="form-group" id="comment_id">
        <label for="type">Pick a comment Id: </label>
        <select name="repliable_id" id="comment_id" class="selectpicker form-control">
            @foreach(\App\Models\Comment::all() as $item)
                <option {{$reply['repliable_id'] == $item['id'] ? 'selected':''}} value="{{$item['id']}}">{{$item['id']}} - {{$item->user->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group" id="reply_id">
        <label for="type">Pick a reply id: </label>
        <select name="repliable_id" id="reply_id" class="form-control">
            @foreach(\App\Models\Reply::all() as $item)
                <option {{$reply['repliable_id'] == $item['id'] ? 'selected':''}} value="{{$item['id']}}">{{$item['id']}} - {{$item->user->name}}</option>
            @endforeach
        </select>
    </div>
    <button id="submit-btn" type="submit" class="btn btn-primary float-right">Save</button>

@endsection
@push('javascript')
    <script>
        let comment = $('#comment_id');
        let reply = $('#reply_id');

        reply.remove();

        function change() {
            if ($(event.target).val() == "App\\Models\\Comment") {
                reply.remove();
                $('#submit-btn').before(comment);
            }
            if ($(event.target).val() == "App\\Models\\Reply") {
                comment.remove();
                $('#submit-btn').before(reply);
            }

        }
    </script>
@endpush
