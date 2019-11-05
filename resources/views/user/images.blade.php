@extends('layouts.app')

<?php /** @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $images */ ?>
<?php /** @var \App\Image $image */ ?>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{ $images->links() }}

                <div class="card">
                    <div class="card-header">{{ __('Your images') }}</div>

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

                {{ $images->links() }}
            </div>
        </div>
    </div>
@endsection
