@extends('layouts.show-resource')
@section('title', 'Show Reply')
@section('index-url', route('reply.index'))
@section('edit-url', route('reply.edit', $reply->id))
@section('resource-data')

    <x-show-text title="User" name="user_id" display="name" value="{{$reply->user->name}}"></x-show-text>
    <x-long-text name="content" value="{{$reply->content}}" title="Reply"></x-long-text>
    <x-show-text title="Type" name="user_id" display="name"
                 value="{{(new \ReflectionClass($reply->repliable_type))->getShortName()}}"></x-show-text>
    <x-show-text title="{{(new \ReflectionClass($reply->repliable_type))->getShortName()}} Id" name="user_id"
                 display="name"
                 value="{{$reply->repliable_id.' - '. $reply->repliable->user->name}}"></x-show-text>

@endsection
