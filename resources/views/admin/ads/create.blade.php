@extends('layouts.new-resource')
@section('index-url', route('ads.index'))
@section('title', 'Create New Ads')
@section('store-url', route('ads.store'))
@section('new-form')
    <x-input-text title="Name" value="{{old('name')}}" name="name"></x-input-text>
    <x-input-checkbox name="is_active" value="{{old('is_active')}}" title="Is Active"></x-input-checkbox>
    <x-input-select name="category_id" value="id" title="Category" oldValue="{{old('category_id')}}" display="title" :collection="\App\Models\Category::all()"></x-input-select>
    <x-input-file name="media[]" title="Media : "></x-input-file>
    <button id="submit-btn" type="submit" class="btn btn-primary float-right">Save</button>

@endsection
