<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Response;
use function compact;

class UserImagesController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param int $userId
     * @return Response
     */
    public function index($userId = null)
    {
        /** @var User $user */
        $user = User::with('images')->findOrFail($userId);
        $images = $user->images()->paginate(15);

        return response()->view('user.images', compact('user', 'images'));
    }

    public static function route()
    {
        return route('user.images.index', Auth::id());
    }
}
