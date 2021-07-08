@extends('layouts.main')
@section('content')
    <div class="row layout-top-spacing br-4">
        <div class="col">
            <div class="widget br-4">
                <div class="widget-header p-3 pl-4">
                    <h3 class="d-inline-block">Countries</h3>
                    <a class="float-right d-inline-block btn btn-outline-primary" href="{{route('country.create')}}"><i data-feather="plus"></i></a>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <table id="countries" class="table style-2  table-hover">
                            <thead>
                            <tr>
                                <th class="checkbox-column">Id</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Image</th>
                                <th>Rate</th>
                                <th class="text-center" style="width: 80px;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Models\Country::all() as $item)
                                <tr>
                                    <td class="checkbox-column">{{$item['id']}}</td>
                                    <td>{{$item['name']}}</td>
                                    <td>{{$item['code']}}</td>
                                    <td class="text-center">
                                        <span><img src="{{asset($item->getFirstMediaUrl('flags'))}}" class="rounded-circle profile-img" alt="Flag" style="width: 80px;height: 80px;"></span>
                                    </td>
                                    <td>{{$item['rate']}}</td>
                                    <td class="text-center">
{{--                                        <a href="{{route('country.show', $item)}}"><i data-feather="eye" class="text-info"></i></a>--}}
                                        <a href="{{route('country.edit', $item)}}"><i data-feather="edit" class="text-warning"></i></a>
                                        <form class="d-inline-block" action="{{route('country.destroy',$item)}}" method="post" onsubmit="confirm('Are you sure?')">
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
    <x-datatables id="countries"></x-datatables>
@endpush
