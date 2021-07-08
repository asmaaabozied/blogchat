@extends('layouts.main')
@section('content')
    <div class="row layout-top-spacing br-4">
        <div class="col">
            <div class="widget br-4">
                <div class="widget-header p-3 pl-4">
                    <h3 class="d-inline-block">Messages</h3>
                    <a class="float-right d-inline-block btn btn-outline-primary" href="{{route('message.create')}}"><i data-feather="plus"></i></a>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <table id="messages" class="table style-2  table-hover">
                            <thead>
                            <tr>
                                <th class="checkbox-column">Id</th>
                                <th>from</th>
                                <th>to</th>
                                <th>Message</th>
                                <th>Group</th>
                                <th>Created_At</th>
                                <th>Type</th>
                                <th class="text-center" style="width: 80px;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Models\Message::all() as $item)
                                <tr>
                                    <td class="checkbox-column">{{$item['id']}}</td>
                                    <td>{{$item->sender ? $item->sender->name:''}}</td>
                                    <td>{{$item->receiver ? $item->receiver->name:''}}</td>
                                    <td>{{$item['message']}}</td>
                                    <td>{{$item->group ? $item->group->name:''}}</td>
                                    <td>{{ isset($item->created_at) ? $item->created_at->diffForHumans() :''	 }}</td>
                                    <td>{{$item['type']}}</td>

                                    <td class="text-center">
                                        <a href="{{route('message.show', $item)}}"><i data-feather="eye" class="text-info"></i></a>
                                        <a href="{{route('message.edit', $item)}}"><i data-feather="edit" class="text-warning"></i></a>
                                        <form class="d-inline-block" action="{{route('message.destroy',$item)}}" method="post" onsubmit="confirm('Are you sure?')">
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
    <x-datatables id="messages"></x-datatables>
@endpush
