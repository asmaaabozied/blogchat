@extends('layouts.new-resource')
@section('title', 'Create New Country')
@section('index-url', route('country.index'))
@section('store-url', route('country.store'))
@section('new-form')
    <x-input-text name="name" title="Name:" :value="old('name')"></x-input-text>
    <x-input-text name="code" title="Code:" :value="old('code')"></x-input-text>
    <x-input-number name="rate" title="Rate:" :value="old('rate')"></x-input-number>
    <x-input-file name="flag" title="Flag picture"></x-input-file>
    <button id="submit-btn" type="submit" class="btn btn-primary float-right">Save</button>

@endsection
