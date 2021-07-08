@extends('layouts.main')
@section('content')
    <div class="row layout-top-spacing br-4">
        <div class="col">
            <div class="widget br-4">
                <div class="widget-header p-3 pl-4">
                    <h3 class="d-inline-block">Replies</h3>
                    <a class="float-right d-inline-block btn btn-outline-primary" href="{{route('reply.create')}}"><i data-feather="plus"></i></a>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <table id="replies" class="table style-2  table-hover">
                            <thead>
                            <tr>
                                <th class="checkbox-column">Id</th>
                                <th>Content</th>
                                <th>User</th>
                                <th>Type</th>
                                <th>Type Id</th>
                                <th class="text-center" style="width: 80px;">Action</th>
                            </tr>
                            </thead>
                            <tbody>1
                            @foreach(\App\Models\Reply::all() as $item)
                                <tr>
                                    <td class="checkbox-column">{{$item['id']}}</td>

                                    <td>{{Str::limit($item['content'], 50)}}</td>

                                    <td>{{$item->user ? $item->user->name:''}}</td>
                                    <td>{{$item['repliable_type']==\App\Models\Comment::class ? 'Comment' : 'Reply'}}</td>
                                    <td>{{$item['repliable_id']}}</td>

                                    <td class="text-center">
                                        <a href="{{route('reply.show', $item)}}"><i data-feather="eye" class="text-info"></i></a>
                                        <a href="{{route('reply.edit', $item)}}"><i data-feather="edit" class="text-warning"></i></a>
                                        <form class="d-inline-block" action="{{route('reply.destroy',$item)}}" method="post" onsubmit="confirm('Are you sure?')">
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
    <x-datatables id="replies"></x-datatables>
@endpush
