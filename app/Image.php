<?php

namespace App;

use File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Image as InterventionImage;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use function basename;
use function pathinfo;
use const PATHINFO_FILENAME;

class Image extends Model
{
    protected $fillable = [
        'name',
        'longitude',
        'latitude',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return string
     */
    public function getThumbnailAttribute()
    {
        return pathinfo($this->filename, PATHINFO_FILENAME) . '.jpg';
    }

    /**
     * @return string
     */
    public function getByAttribute()
    {
        return __('Image by') . " {$this->user->name}";
    }

    /**
     * @param UploadedFile $file
     * @return $this
     * @throws FileException
     */
    public function storeFile(UploadedFile $file): self
    {
        $path = $file->store('image', 'local');
        if ($path === false) {
            throw new FileException;
        }

        $this->filename = basename($path);

        $thumbnail = InterventionImage::make(storage_path('app') . "/$path");
        $thumbnail->fit(150);

        $base = pathinfo($path, PATHINFO_FILENAME);
        $dir = storage_path('app/thumbnail');
        if (! File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $thumbnail->save("$dir/$base.jpg", 50, 'jpg');

        return $this;
    }
}
