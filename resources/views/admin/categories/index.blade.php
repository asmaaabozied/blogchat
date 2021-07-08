@extends('layouts.main')
@section('content')
    <div class="row layout-top-spacing br-4">
        <div class="col">
            <div class="widget br-4">
                <div class="widget-header p-3 pl-4">
                    <h3 class="d-inline-block">Category</h3>
                    <a class="float-right d-inline-block btn btn-outline-primary" href="{{route('category.create')}}"><i data-feather="plus"></i></a>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <table id="categories" class="table style-2  table-hover">
                            <thead>
                            <tr>
                                <th class="checkbox-column">Id</th>
                                <th>Title</th>
                                <th>Is Paid</th>
                                <th>Order</th>
                                <th>Place</th>
                                <th class="text-center" style="width: 80px;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Models\Category::all() as $item)
                                <tr>
                                    <td class="checkbox-column">{{$item['id']}}</td>
                                    <td>{{$item['title']}}</td>
                                    <td>
                                        @if($item['is_paid'])
                                            <span class="shadow-none badge badge-success">Yes</span>
                                        @else
                                            <span class="shadow-none badge badge-danger">No</span>
                                        @endif
                                    </td>
                                    <td>{{$item['order']}}</td>
                                    <td>{{$item['place']}}</td>
                                    <td class="text-center">
                                        <a href="{{route('category.show', $item)}}"><i data-feather="eye" class="text-info"></i></a>
                                        <a href="{{route('category.edit', $item)}}"><i data-feather="edit" class="text-warning"></i></a>
                                        <form class="d-inline-block" action="{{route('category.destroy',$item)}}" method="post" onsubmit="confirm('Are you sure?')">
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
