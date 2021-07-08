@extends('layouts.main')
@section('title', 'Users')
@section('content')
    <div class="row layout-top-spacing br-4">
        <div class="col">
            <div class="widget br-4">
                <div class="widget-header p-3 pl-4">
                    <h3 class="d-inline-block">Comments</h3>
                    <a class="float-right d-inline-block btn btn-outline-primary" href="{{route('comment.create')}}"><i data-feather="plus"></i></a>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <table id="media" class="table style-2  table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
{{--                                <th>Media Collection Name</th>--}}
{{--                                <th>Blog Owner</th>--}}
{{--                                <th>Blog Category</th>--}}
                                <th>Comment</th>
                                <th>Family Blog</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $items as $item)
                                <tr>
                                    <td>{{$item['id']}}</td>
                                    <td>{{$item->user->name ?? ''}}</td>
{{--                                    <td>{{$item['collection_name'] ??''}}</td>--}}
{{--       <td>{{$item->mediaCollection ? $item->mediaCollection->first()->collection_name : '' }}</td>--}}

                                    {{--                                    <td>{{$item->mediaCollection ? $item->mediaCollection[0]->model->name : '' }}</td>--}}
{{--                                    <td>{{$item->mediaCollection ? $item->mediaCollection[0]->category ? $item->mediaCollection[0]->category->title:'' : '' }}</td>--}}
                                    <td>{{Str::limit($item['content'], 50)}}</td>
                                    <td>{{$item->familyBlog->name ?? ''}}</td>
                                    <td>
{{--                                        @if($item->familyBlog)--}}
{{--                                            <img style="width: 100px; height: 100px;" class="rounded rounded-circle" src="{{$item->familyBlog->media[0]->getUrl()}}" alt="Media">--}}
{{--                                        @endif--}}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('comment.show', $item->id)}}"><i data-feather="eye" class="text-info"></i></a>
                                        <a href="{{route('comment.edit', $item->id)}}"><i data-feather="edit" class="text-warning"></i></a>
                                        <form class="d-inline-block" action="{{route('comment.destroy',$item)}}" method="post" onsubmit="confirm('Are you sure?')">
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
