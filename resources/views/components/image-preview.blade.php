<?php /** @var \App\Image $image */ ?>

<div class="col image-preview">
    <a href="{{ route('image.show', ['image' => $image->id]) }}">
        <img alt="{{ $image->by }}"
             src="{{ route('assets.thumbnail', ['id' => $image->id]) }}">
        <div class="image-description">{{ $image->by }}</div>
    </a>
</div>
