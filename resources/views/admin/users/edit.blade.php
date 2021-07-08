@extends('layouts.new-resource')
@section('title', 'Edit User')
@section('index-url', route('user.index'))
@section('store-url', route('user.update', $user))
@section('new-form')
    @method('PATCH')
    <x-input-text name="name" value="{{$user['name']}}" title="Name: "></x-input-text>
    <x-input-password name="password" title="Password: "></x-input-password>
    <x-input-text name="phone" title="Phone: " value="{{$user['phone']}}"></x-input-text>
    <x-input-text name="whatsapp" title="whatsapp: " value="{{$user['whatsapp']}}"></x-input-text>
    <x-input-email name="email" title="Email: " value="{{$user['email']}}"></x-input-email>
    <x-input-select name="country_id" title="Country :" display="name" :oldValue="$user['country_id']" :collection="\App\Models\Country::all()" value="id"></x-input-select>
    <x-input-checkbox name="is_active" title="Active Status: " :value="$user['is_active']"></x-input-checkbox>
    <x-input-file name="profile" title="Profile Picture:"></x-input-file>
    <button id="submit-btn" type="submit" class="btn btn-primary float-right">Save</button>

@endsection
