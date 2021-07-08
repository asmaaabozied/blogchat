@extends('layouts.new-resource')
@section('title', 'Edit Category')
@section('index-url', route('category.index'))
@section('store-url', route('category.update', $category))
@section('new-form')
    @method('PATCH')
    <x-input-text name="title" :value="$category['title']" title="Title"></x-input-text>
    <x-input-checkbox name="is_paid" title="Is Paid" :value="$category['is_paid']"></x-input-checkbox>
    <x-input-number name="order" :value="$category['order']" title="Order"></x-input-number>
    <x-input-select name="place" :oldValue="$category['place']" title="Place" :collection="[['name'=>'up'],['name'=>'down']]" value="name" display="name"></x-input-select>

    <x-input-file name="image" :src="$category['image']" :value="$category['image']" title="image Picture:"></x-input-file>

    <div class="form-group">

    <img src="{{ asset('images/'.$category->image) }}" style="width: 400px" class="img-thumbnail image-preview"
         alt="">
    </div>
    <button id="submit-btn" type="submit" class="btn btn-primary float-right">Save</button>

@endsection
