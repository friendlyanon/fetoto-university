<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Response;
use function compact;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::with(['latestFiveImages', 'tierName'])->findOrFail($id);

        return response()->view('user.show', compact('user'));
    }
}
