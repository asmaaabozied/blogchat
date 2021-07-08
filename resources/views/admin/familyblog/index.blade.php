@extends('layouts.main')
@section('content')
    <div class="row layout-top-spacing br-4">
        <div class="col">
            <div class="widget br-4">
                <div class="widget-header p-3 pl-4">
                    <h3 class="d-inline-block">Family Blogs</h3>
                    <a class="float-right d-inline-block btn btn-outline-primary" href="{{route('family.create')}}"><i data-feather="plus"></i></a>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <table id="family" class="table style-2  table-hover">
                            <thead>
                            <tr>
                                <th class="checkbox-column">Id</th>
                                <th>Image</th>
                                <th class="text-center" style="width: 80px;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Models\Media::where('collection_name', 'family')->get() as $item)
                                <tr>
                                    <td class="checkbox-column">{{$item['id']}}</td>
                                    <td>
                                        <img class="rounded-circle profile-img" style="width: 100px;height: 100px" src="{{$item['url']}}" alt="url">
                                    </td>
                                    <td class="text-center">
{{--                                        <a href="{{route('family.show', $item)}}"><i data-feather="eye" class="text-info"></i></a>--}}
                                        <form class="d-inline-block" action="{{route('family.destroy',$item)}}" method="post" onsubmit="confirm('Are you sure?')">
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
    <x-datatables id="family"></x-datatables>
@endpush
