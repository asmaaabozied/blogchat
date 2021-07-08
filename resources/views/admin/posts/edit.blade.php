@extends('layouts.new-resource')
@section('title', 'Edit Post')
@section('index-url', route('post.index'))
@section('store-url', route('post.update', $post))
@section('new-form')
    @method('PATCH')
    <x-input-select :collection="\App\Models\User::all()" title="User" value="id" : oldValue="{{$post['user_id']}}"
                    name="user_id" display="name"></x-input-select>
    <x-input-select :collection="\App\Models\Category::all()" title="Category" : oldValue="{{$post['cat_id']}}"
                    name="cat_id" display="title" value="id"></x-input-select>

    <x-input-text name="views" title="views " value="{{$post['views']}}"></x-input-text>

    <x-input-long-text name="content" title="Description" : value="{{$post['content']}}"></x-input-long-text>
    <x-input-file name="media[]" title="Video and images"></x-input-file>

    <button id="submit-btn" type="submit" class="btn btn-primary float-right">Save</button>

@endsection
