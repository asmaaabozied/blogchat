@extends('layouts.new-resource')
@section('title', 'Create New Media')
@section('store-url', route('media.store'))
@section('index-url', route('media.index'))
@section('new-form')

    <x-input-select :collection="\App\Models\User::all()" title="User" :oldValue="old('user_id')" name="user_id" display="name" value="id"></x-input-select>
    <x-input-select :collection="\App\Models\Category::all()" title="Category" :oldValue="old('cat_id')" name="cat_id" display="title" value="id"></x-input-select>
    <x-input-long-text name="description" title="Description" :value="old('description')"></x-input-long-text>
    <x-input-file name="media[]" title="Video and images"></x-input-file>
    <button id="submit-btn" type="submit" class="btn btn-primary float-right">Save</button>

@endsection
