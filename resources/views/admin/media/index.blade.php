@extends('layouts.main')
@section('title', 'Users')
@section('content')
    <div class="row layout-top-spacing br-4">
        <div class="col">
            <div class="widget br-4">
                <div class="widget-header p-3 pl-4">
                    <h3 class="d-inline-block">Media</h3>
                    <a class="float-right d-inline-block btn btn-outline-primary" href="{{route('media.create')}}"><i data-feather="plus"></i></a>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <table id="media" class="table style-2  table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Category</th>
                                <th>File Name</th>
                                <th>Size</th>
                                <th>Collection</th>
                                <th>Type</th>
                                <th>Views</th>
                                <th>number of comments</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Models\Media::where('collection_name','like', '%videos%' )->get() as $item)
                                <tr>
                                    <td>{{$item['id']}}</td>
                                    <td>{{$item->model->name}}</td>
                                    <td>{{$item->category ? $item->category->title  : ''}}</td>
                                    <td>{{Str::limit($item['file_name'], 30)}}</td>
                                    <td>{{$item->human_readable_size}}</td>
                                    <td>{{$item['collection_name']}}</td>
                                    <td>{{$item['mime_type']}}</td>
                                    <td>{{$item->views}}</td>
                                    <td>{{$item->comments_count}}</td>

                                    <td class="text-center">
                                        <a href="{{route('media.show', $item)}}"><i data-feather="eye" class="text-info"></i></a>
                                        {{--                                        <a href="{{route('media.edit', $item)}}"><i data-feather="edit" class="text-warning"></i></a>--}}
                                        <form class="d-inline-block" action="{{route('media.destroy',$item)}}" method="post" onsubmit="confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete"><i data-feather="x-circle" class="text-danger"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('javascript')
    <x-datatables id="media"></x-datatables>
@endpush
