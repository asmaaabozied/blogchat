@extends('layouts.main')
@section('title', 'Users')
@section('content')
    <div class="row layout-top-spacing br-4">
        <div class="col">
            <div class="widget br-4">
                <div class="widget-header p-3 pl-4">
                    <h3 class="d-inline-block">Users</h3>
                    <a class="float-right d-inline-block btn btn-outline-primary" href="{{route('user.create')}}"><i data-feather="plus"></i></a>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <table id="users" class="table style-2  table-hover">
                            <thead>
                            <tr>
                                <th class="checkbox-column">Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile No.</th>
                                <th>Country</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" style="width: 80px;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Models\User::all() as $item)
                                <tr>
                                    <td class="checkbox-column">{{$item['id']}}</td>
                                    <td>{{$item['name']}}</td>
                                    <td>{{$item['email']}}</td>
                                    <td>{{$item['phone']}}</td>
                                    <td>{{$item->country ? $item->country->name   : ''}}</td>
                                    <td class="text-center">
                                        <span><img src="{{asset($item->getFirstMediaUrl('profile'))}}" class="rounded-circle profile-img" alt="avatar" style="width: 80px;height: 80px;"></span>
                                    </td>
                                    <td class="text-center">
                                        @if($item['is_active'])
                                            <span class="shadow-none badge badge-success">Active</span>
                                        @else
                                            <span class="shadow-none badge badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('user.show', $item)}}"><i data-feather="eye" class="text-info"></i></a>
                                        <a href="{{route('user.edit', $item)}}"><i data-feather="edit" class="text-warning"></i></a>
                                        <form class="d-inline-block" action="{{route('user.destroy',$item)}}" method="post" onsubmit="confirm('Are you sure?')">
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
    <x-datatables id="users"></x-datatables>
@endpush
