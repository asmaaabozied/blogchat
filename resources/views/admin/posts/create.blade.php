@extends('layouts.new-resource')
@section('title', 'Create New Post')
@section('index-url', route('post.index'))
@section('store-url', route('post.store'))
@section('new-form')
    <x-input-select :collection="\App\Models\User::all()" title="User" :oldValue="old('user_id')" name="user_id" display="name" value="id"></x-input-select>
    <x-input-select :collection="\App\Models\Category::all()" title="Category" :oldValue="old('cat_id')" name="cat_id" display="title" value="id"></x-input-select>

    <x-input-text name="views" title="views " value="{{old('views')}}"></x-input-text>

    <x-input-long-text name="content" title="Description" :value="old('content')"></x-input-long-text>

    <x-input-file name="media[]" title="Video and images"></x-input-file>

    <button id="submit-btn" type="submit" class="btn btn-primary float-right">Save</button>


@endsection
