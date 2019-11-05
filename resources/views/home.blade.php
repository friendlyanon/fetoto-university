@extends('layouts.app')

<?php /** @var \Illuminate\Support\LazyCollection $images */ ?>
<?php /** @var \App\Image $image */ ?>
<?php /** @var \Illuminate\Support\Collection|\App\Tier[] $tiers */ ?>
<?php /** @var \App\Tier $tier */ ?>
<?php /** @var string $key */ ?>

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <h1>{{ __('Image sharing made simple!') }}</h1>
            </div>
        </div>
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Most recent images') }}</div>

                    <div class="card-body">
                        <div class="row">
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

        @auth
            <div class="row justify-content-center mb-4">
                <div class="col-md-8">
                    <h2>{{ __('Upload your own images today!') }}</h2>
                    <a class="btn btn-primary" role="button"
                       href="{{ route('image.create') }}">
                        {{ __('Upload') }}
                    </a>
                </div>
            </div>
        @endauth

        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3>{{ __('Register today and upgrade for additional perks!') }}</h3>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        @foreach($tiers as $tier)
                            <th scope="col">{{ $tier->name }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">{{ __('Price') }}</th>
                        @foreach($tiers as $tier)
                            <td>{{ $tier->price }}</td>
                        @endforeach
                    </tr>
                    @foreach(\App\Enums\TierAttributeKey::getValues() as $key)
                        <tr>
                            <th scope="row">{{ trans("tiers.$key") }}</th>
                            @foreach($tiers as $tier)
                                <td>{{ $tier->attributes[$key] }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
    @jsmodule('home')
@endsection
