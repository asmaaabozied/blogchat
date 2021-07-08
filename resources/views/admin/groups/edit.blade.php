@extends('layouts.new-resource')
@section('title', 'Create New Group')
@section('index-url', route('group.index'))
@section('store-url', route('group.update', $group))
@section('new-form')
    @method('PATCH')
    <x-input-text name="name" title="Name " value="{{$group['name']}}"></x-input-text>
    <x-input-long-text name="description" value="{{$group['description']}}" title="Description"></x-input-long-text>
    <button id="submit-btn" type="submit" class="btn btn-primary float-right">Save</button>

@endsection
