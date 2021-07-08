@extends('layouts.new-resource')
@section('title', 'Create New FamilyBlog blog')
@section('store-url', route('family.store'))
@section('index-url', route('family.index'))
@section('new-form')
    <x-input-file name="media[]" title="Pictures"></x-input-file>
    <button id="submit-btn" type="submit" class="btn btn-primary float-right">Save</button>

@endsection
