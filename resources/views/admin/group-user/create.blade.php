@extends('layouts.new-resource')
@section('title','Assign Users to Group')
@section('index-url', route('group.index'))
@section('store-url', route('group-user.store'))
@section('new-form')
    <x-input-select name="group_id" value="id" title="Group Id" display="name" oldValue="{{old('group_id')}}" :collection="\App\Models\Group::all()"></x-input-select>
    <x-input-select name="user_ids[]" multiple="true" value="id" title="User Ids" display="name" oldValue="{{old('user_ids')}}" :collection="\App\Models\User::all()"></x-input-select>

    <button id="submit-btn" type="submit" class="btn btn-primary float-right">Save</button>

@endsection
