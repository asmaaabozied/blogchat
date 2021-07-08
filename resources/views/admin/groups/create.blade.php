@extends('layouts.new-resource')
@section('title', 'Create New Group')
@section('store-url', route('group.store'))
@section('index-url', route('group.index'))
@section('new-form')
    <x-input-text name="name" title="Name " value="{{old('name')}}"></x-input-text>
    <x-input-long-text name="description" value="{{old('description')}}" title="Description"></x-input-long-text>
    <button id="submit-btn" type="submit" class="btn btn-primary float-right">Save</button>

@endsection
