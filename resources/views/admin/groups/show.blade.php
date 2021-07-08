@extends('layouts.show-resource')
@section('title', 'Create New Group')
@section('index-url', route('group.index'))
@section('edit-url', route('group.edit', $group))
@section('resource-data')
    <x-show-text name="name" title="Name " value="{{$group['name']}}"></x-show-text>
    <x-long-text name="description" value="{{$group['description']}}" title="Description"></x-long-text>
@endsection
