<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImageUploadRequest;
use App\Image;
use Auth;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use function compact;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $images = Image::with('user')->latest()->take(10)->cursor();

        return response()->view('image.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return response()->view('image.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ImageUploadRequest $request
     * @return RedirectResponse
     * @throws FileException
     */
    public function store(ImageUploadRequest $request)
    {
        $fillAttributes = ! empty($request->get('location')) ?
            ['name', 'longitude', 'latitude'] :
            ['name'];

        $image = new Image($request->only(...$fillAttributes));
        $image->user()->associate(Auth::user());
        $image->storeFile($request->file('image'))
            ->save();

        return redirect()->route('image.show', $image->id);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $image = Image::with('user')->findOrFail($id);

        return response()->view('image.show', compact('image'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy($id)
    {
        $user_id = Auth::id();
        Image::where(compact('id', 'user_id'))->delete();

        return redirect()->route('home');
    }
}
