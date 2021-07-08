@extends('layouts.main')
@section('content')
    <div class="row layout-top-spacing br-4">
        <div class="col">
            <div class="widget br-4">
                <div class="widget-header p-3 pl-4">
                    <h3 class="d-inline-block">Activities</h3>
                                        <a class="float-right d-inline-block btn btn-outline-primary" href="{{route('activity.create')}}"><i data-feather="plus"></i></a>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <table id="activities" class="table style-2  table-hover">
                            <thead>
                            <tr>
                                <th class="checkbox-column">Id</th>
                                <th>Activity name</th>
                                <th>Activity description</th>
                                <th>caused by</th>
                                <th>performed on</th>
                                <th class="text-center" style="width: 80px;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\Spatie\Activitylog\Models\Activity::all() as $item)
                                <tr>
                                    <td class="checkbox-column">{{$item['id']}}</td>
                                    <td>{{$item['log_name']}}</td>
                                    <td>{{$item['description']}}</td>
                                    <td>{{$item['causer_id'] ?  \App\Models\User::find($item['causer_id'])->name : ''}}</td>
                                    <td>
                                        @if($item['subject_type'])
                                            @if($item['subject_type'] == \App\Models\User::class)
                                                {{($item['subject_type'])::find($item['subject_id'])->name}}
                                            @elseif($item['subject_type'] == \App\Models\Media::class)
                                                {{($item['subject_type'])::find($item['subject_id'])->collection_name}}
                                            @elseif($item['subject_type'] == \App\Models\Comment::class)
                                                {{($item['subject_type'])::find($item['subject_id'])->comment}}
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{--                                        <a href="{{route('activity.show', $item)}}"><i data-feather="eye" class="text-info"></i></a>--}}
                                        <form class="d-inline-block" action="{{route('activity.destroy',$item)}}" method="post" onsubmit="confirm('Are you sure?')">
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
    <x-datatables id="activities"></x-datatables>
@endpush
