@extends('layouts.main')
@section('content')


    <div class="container layout-top-spacing">
        <div class="row">
            <div class="col-lg-12 col-md-12 mb-5 p-0">
                <div id="style1" class="carousel slide style-custom-1" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($media->collection() as $item)
                            <li data-target="#style1" data-slide-to="{{$item['id']}}" class="{{$item->id == $media->collection()->first()->id ? 'active' : ''}}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach($media->collection() as $item)
                            <div class="carousel-item {{$item->id == $media->collection()->first()->id ? 'active' : ''}}" style="width: 100%;height: 600px;">
                                @if(Str::contains($item['mime_type'], 'image'))
                                    <img class="d-block w-100 slide-image" src="{{asset($item['url'])}}" alt="First slide">
                                @else
                                    <video  class="d-block w-100 slide-image" src="{{$item['url']}}" controls></video>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" style="background: black" href="#style1" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" style="background: black"  href="#style1" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="widget">
                    <div class="widget-content widget-content-area pr-4">
                        <div class="row">
                            <div class="col">
                                <x-show-text title="Collection Name: " value="{{$media['collection_name']}}"></x-show-text>
                                <x-show-text title="Number of Items: " value="{{$media->collection()->count()}}"></x-show-text>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row layout-top-spacing br-4">
        <div class="col">
            <div class="widget br-4">
                <div class="widget-header p-3 pl-4">
                    <h3 class="d-inline-block">Collection Comments</h3>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <table id="media" class="table style-2  table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Blog Category</th>
                                <th>Comment</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($media->comments as $item)
                                <tr>
                                    <td>{{$item['id']}}</td>
                                    <td>{{$item->user->name}}</td>
                                    <td>{{$item->mediaCollection ? $item->mediaCollection->category->title : '' }}</td>
                                    <td>{{Str::limit($item['content'], 50)}}</td>
                                    <td class="text-center">
                                        <a href="{{route('comment.show', $item)}}"><i data-feather="eye" class="text-info"></i></a>
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
