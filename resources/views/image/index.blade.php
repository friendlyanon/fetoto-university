@extends('layouts.app')

<?php /** @var \Illuminate\Support\LazyCollection $images */ ?>
<?php /** @var \App\Image $image */ ?>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('All images') }}</div>

                    <div class="card-body">
                        <div class="row viewer-root">
                            @forelse($images as $image)
                                @component('components.image-preview', compact('image'))
                                @endcomponent
                            @empty
                                <div class="no-images">{{ __('No images found!') }}</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
