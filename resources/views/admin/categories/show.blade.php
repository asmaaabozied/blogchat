@extends('layouts.new-resource')
@section('title', 'ShowCategory')

@section('new-form')

    <x-input-text name="title" value="{{$category['title']}}" title="Title"></x-input-text>
    <x-input-checkbox name="is_paid" title="Is Paid" value="{{$category['is_paid']}}"></x-input-checkbox>
    <x-input-number name="order" value="{{$category['order']}}" title="Order"></x-input-number>
    <x-input-text name="place" Value="{{$category['place']}}" title="Place" ></x-input-text>
    <label>Image</label>
    <div class="form-group">

        <img src="{{ asset('images/'.$category->image) }}" style="width: 400px" class="img-thumbnail image-preview"
             alt="">
    </div>

@endsection
