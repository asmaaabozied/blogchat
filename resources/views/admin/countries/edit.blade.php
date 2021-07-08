@extends('layouts.new-resource')
@section('title', 'Edit Country')
@section('index-url', route('country.index'))
@section('store-url', route('country.update', $country))
@section('new-form')
    @method('PATCH')
    <x-input-text name="name" title="Name:" :value="$country['name']"></x-input-text>
    <x-input-text name="code" title="Code:" :value="$country['code']"></x-input-text>
    <x-input-number name="rate" title="Rate:" :value="$country['rate']"></x-input-number>
    <x-input-file name="flag" title="Flag picture"></x-input-file>
    <button id="submit-btn" type="submit" class="btn btn-primary float-right">Save</button>

@endsection
