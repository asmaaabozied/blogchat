@extends('layouts.new-resource')
@section('title', 'Create New Comment')
@section('index-url', route('comment.index'))
@section('store-url', route('comment.store'))
@section('new-form')

    <x-input-select :collection="\App\Models\User::all()" title="User" :oldValue="old('user_id')" name="user_id" display="name" value="id"></x-input-select>
    <x-input-select :collection="\App\Models\Media::where('collection_name','like', '%videos%' )->get()->groupBy('collection_name')->keys()" name="collection_name" title="Collection Name: " :oldValue="old('collection_name')"></x-input-select>
    <x-input-long-text name="content" :value="old('content')" title="Comment"></x-input-long-text>
    <x-input-file name="media" title="Video and images"></x-input-file>
    <x-input-select :collection="\App\Models\FamilyBlog::all()" name="family_blog_id" title="Family Blog id: " display="id" :oldValue="old('family_blog_id')" value="id"></x-input-select>

    <button id="submit-btn" type="submit" class="btn btn-primary float-right">Save</button>

@endsection
