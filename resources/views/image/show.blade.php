@extends('layouts.app')

<?php /** @var \App\Image $image */ ?>

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/gallery.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 image-viewer">
                <h1 class="mb-4">{{ $image->name }}</h1>

                <div class="image-holder viewer-root mb-4">
                    <img src="{{ route('assets.image', $image->id) }}"
                         alt="{{ $image->by }}" id="image">
                </div>

                @if($image->latitude !== null)
                    <div class="mb-4" id="map"></div>
                @endif

                @if($image->user_id == auth()->id())
                    <div>
                        <form method="POST"
                              action="{{ route('image.destroy', $image->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{ __('Delete Image') }}</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5Jrp9PtHe0WapppUzxbIpMDWMAcV3qE4"></script>
    <script src="https://unpkg.com/location-picker/dist/location-picker.min.js"></script>
    @jsmodule('gallery')
    @if($image->latitude !== null)
        <script>
            window.galleryMap
                = {!! json_encode(object_pluck($image, ['latitude', 'longitude']), JSON_THROW_ON_ERROR, 512) !!};
        </script>
    @endif
@endsection
