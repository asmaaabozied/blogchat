@extends('layouts.main')
@section('content')
    <div class="row layout-top-spacing br-4">
        <div class="col">
            <div class="widget br-4">
                <div class="widget-header p-3 pl-4">
                    <h3 class="d-inline-block">@yield('title')</h3>
                    <a class="float-right d-inline-block btn btn-outline-primary" href="@yield('index-url')"><i data-feather="list"></i></a>
                </div>
                <div class="widget-content widget-content-area br-4">
                    <div class="row">
                        <div class="col">
                            <form action="@yield('store-url')" method="post" enctype="multipart/form-data" id="create-form">
                                @csrf
                                @yield('new-form')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
