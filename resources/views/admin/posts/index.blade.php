@extends('layouts.main')
@section('content')
    <div class="row layout-top-spacing br-4">
        <div class="col">
            <div class="widget br-4">
                <div class="widget-header p-3 pl-4">
                    <h3 class="d-inline-block">Post</h3>
                    <a class="float-right d-inline-block btn btn-outline-primary" href="{{route('post.create')}}"><i data-feather="plus"></i></a>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <table id="categories" class="table style-2  table-hover">
                            <thead>
                            <tr>
                                <th class="checkbox-column">Id</th>
                                <th>Content</th>
                                <th>Views</th>
                                <th>User</th>
                                <th>Category</th>
                                <th class="text-center" style="width: 80px;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Models\Post::all() as $item)
                                <tr>
                                    <td class="checkbox-column">{{$item['id']}}</td>
                                    <td>{{Str::limit($item['content'], 50)}}</td>
                                    <td>
                                        {{$item['views'] ?? ''}}

                                    </td>
                                    <td>{{$item->user->name ?? ''}}</td>
                                    <td>{{$item->category->title ?? ''}}</td>
                                    <td class="text-center">
                                        <a href="{{route('post.show', $item)}}"><i data-feather="eye" class="text-info"></i></a>
                                        <a href="{{route('post.edit', $item)}}"><i data-feather="edit" class="text-warning"></i></a>
                                        <form class="d-inline-block" action="{{route('post.destroy',$item)}}" method="post" onsubmit="confirm('Are you sure?')">
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
    <x-datatables id="categories"></x-datatables>
@endpush
