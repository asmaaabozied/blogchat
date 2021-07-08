@extends('layouts.new-resource')

@section('title', 'Create New Message')
@section('index-url', route('message.index'))
@section('store-url', route('message.update', $message))
@section('new-form')
    @method('PATCH')
    <x-input-select :collection="['Group', 'Normal']" title="From : " oldValue="{{$message['type']}}" name="type"></x-input-select>
    <x-input-select :collection="\App\Models\User::all()" title="From : " value="id" oldValue="{{$message['from_id']}}" name="from_id" display="name"></x-input-select>
    <x-input-select :collection="\App\Models\User::all()" title="To : " value="id" oldValue="{{$message['to_id']}}" name="to_id" display="name"></x-input-select>
    <x-input-select :collection="\App\Models\Group::all()" title="Group : " value="id" oldValue="{{$message['group_id']}}" name="group_id" display="name"></x-input-select>
    <x-input-long-text name="message" value="{{$message['message']}}" title="Content:"></x-input-long-text>
    <button id="submit-btn" type="submit" class="btn btn-primary float-right">Save</button>

@endsection
