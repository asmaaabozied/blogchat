@extends('layouts.new-resource')
@section('title', 'Create New User')
@section('index-url', route('user.index'))
@section('store-url', route('user.store'))
@section('new-form')
    <x-input-text name="name" value="{{old('name')}}" title="Name: "></x-input-text>
    <x-input-password name="password" title="Password: "></x-input-password>
    <x-input-text name="phone" title="Phone: " value="{{old('phone')}}"></x-input-text>
    <x-input-text name="whatsapp" title="whatsapp: " value="{{old('whatsapp')}}"></x-input-text>
    <x-input-email name="email" title="Email: " value="{{old('email')}}"></x-input-email>
    <x-input-select name="country_id" title="Country :" display="name" :oldValue="old('country_id')" :collection="\App\Models\Country::all()" value="id"></x-input-select>
    <x-input-checkbox name="is_active" title="Active Status: " :value="old('is_active')"></x-input-checkbox>
    <x-input-file name="profile" title="Profile Picture:"></x-input-file>
    <button id="submit-btn" type="submit" class="btn btn-primary float-right">Save</button>
@endsection
