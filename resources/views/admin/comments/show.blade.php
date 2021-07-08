@extends('layouts.main')
@section('content')

    <div class="row layout-top-spacing br-6">
        <div class="col">
            <div class="widget br-4">
                <div class="widget-content-area br-6">
                    <div class="widget-content">
                        <div class="row">
                            <div class="col">

                                <x-show-text title="Family Blog: " value="{{$comment->familyBlog->name ?? ''}}"></x-show-text>

                                <x-show-text title="Comment's User: " value="{{$comment->user? $comment->user->name:''}}"></x-show-text>
                                <x-show-text title="Collection Name: " value="{{$comment['collection_name'] ?? ''}}"></x-show-text>


                                <div class="form-group">
                                    <label>Content :</label>
                                    <p class="border p-4 border-primary rounded pr-4">
                                        {{$comment['content']}}
                                    </p>
                                </div>
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
                    <h3 class="d-inline-block">Comment's Replies</h3>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="table-responsive mb-4">
                        <table id="replies" class="table style-2  table-hover">
                            <thead>
                            <tr>
                                <th class="checkbox-column">Id</th>
                                <th>Content</th>
                                <th>User</th>
                                <th class="text-center" style="width: 80px;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comment->replies as $item)
                                <tr>
                                    <td class="checkbox-column">{{$item['id']}}</td>
                                    <td>{{$item['content']}}</td>
                                    <td>{{$item->user ? $item->user->name:''}}</td>
                                    <td class="text-center">
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

    <div class="row layout-top-spacing br-4">
        <div class="col">
            <div class="widget br-4">
                <div class="widget-header p-3 pl-4">
                    <h3 class="d-inline-block">Comment Files</h3>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="row">
                        <div class="col">
{{--                            <audio src="{{$comment->media ? $comment->media->first()->url : '' }}" autoplay controls></audio>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('javascript')
    <x-datatables id="replies"></x-datatables>
@endpush
