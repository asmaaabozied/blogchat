@extends('layouts.new-resource')
@section('title', 'ShowPost')

@section('new-form')

    <x-input-select :collection="\App\Models\User::all()" title="User" value="id" : oldValue="{{$post['user_id']}}" name="user_id" display="name" ></x-input-select>
    <x-input-select :collection="\App\Models\Category::all()" title="Category" : oldValue="{{$post['cat_id']}}" name="cat_id" display="title" value="id"></x-input-select>

    <x-input-text name="views" title="views " value="{{$post['views']}}"></x-input-text>

    <x-input-long-text name="content" title="Description" : value="{{$post['content']}}"></x-input-long-text>


Files
    <table>
    @foreach(\App\Models\Media::where('collection_name', '28-videos')->get() as $item)
        <tr>
            <td class="checkbox-column">{{$item['id']}}</td>
            <td>
                <img class="rounded-circle profile-img" style="width: 100px;height: 100px" src="{{$item['url']}}" alt="url">
            </td>
    @endforeach
    </table>
@endsection
