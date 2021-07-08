@extends('layouts.main')
@section('content')

    <div class="container layout-top-spacing">
        <div class="row">
            <div class="col-lg-12 col-md-12 mb-5 p-0">
                <div id="style1" class="carousel slide style-custom-1" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($ad->getMedia($ad['collection_name']) as $item)
                            <li data-target="#style1" data-slide-to="{{$item['id']}}" class="{{$item->id == $ad->getMedia($ad['collection_name'])->first()->id ? 'active' : ''}}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                        @foreach($ad->getMedia($ad['collection_name']) as $item)
                            <div class="carousel-item {{$item->id == $ad->getMedia($ad['collection_name'])->first()->id ? 'active' : ''}}" style="width: 100%;height: 600px;">
                                @if(Str::contains($item['mime_type'], 'image'))
                                    <img class="d-block w-100 slide-image" src="{{asset($item['url'])}}" alt="First slide">
                                @else
                                    <video src="{{$item['url']}}" controls></video>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#style1" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#style1" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
