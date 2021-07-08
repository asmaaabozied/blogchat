@extends('layouts.new-resource')
@section('title', 'Create New Category')
@section('index-url', route('category.index'))
@section('store-url', route('category.store'))
@section('new-form')
    <x-input-text name="title" :value="old('title')" title="Title"></x-input-text>
    <x-input-checkbox name="is_paid" title="Is Paid" :value="old('is_paid')"></x-input-checkbox>
    <x-input-number name="order" :value="old('order')" title="Order"></x-input-number>
    <x-input-select name="place" :oldValue="old('place')" title="Place" :collection="[['name'=>'up'],['name'=>'down']]" value="name" display="name"></x-input-select>

    <x-input-file name="image" title="image Picture:"></x-input-file>
    <button id="submit-btn" type="submit" class="btn btn-primary float-right">Save</button>


@endsection
