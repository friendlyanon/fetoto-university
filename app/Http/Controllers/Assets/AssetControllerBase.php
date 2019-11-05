<?php

namespace App\Http\Controllers\Assets;

use App\Http\Controllers\Controller;
use ReflectionClass;
use ReflectionMethod;
use Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

abstract class AssetControllerBase extends Controller
{
    /** @var string */
    protected $storagePath;

    public function __construct()
    {
        $this->storagePath = config('filesystems.disks.local.root');
    }

    /**
     * @param int $id
     * @param string $folder
     * @param string|null $attribute
     * @return BinaryFileResponse
     */
    protected function userImage($id, $folder, $attribute = null)
    {
        /** @var Image $image */
        $image = Image::findOrFail($id, ['filename']);
        $path = $this->storagePath . '/' . $folder;

        return response()->file("$path/{$image->{$attribute ?? $folder}}");
    }

    public static function routes(): void
    {
        Route::prefix('assets')->group(static function () {
            static::installRoutes();
        });
    }

    protected static function installRoutes(): void
    {
        $reflClass = new ReflectionClass(static::class);
        $methods = collect($reflClass->getMethods(ReflectionMethod::IS_PUBLIC))
            ->lazy()
            ->where('class', static::class)
            ->reject->isStatic()
            ->reject->isConstructor()
            ->reject->isDestructor();
        foreach ($methods as $method) {
            $name = $method->name;
            Route::get("$name/{id}", as_route(static::class, $name))
                ->name("assets.$name");
        }
    }
}
