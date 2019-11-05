<?php

namespace App\Http\Controllers;

use App\Image;
use App\Tier;
use function compact;

class HomeController extends Controller
{
    public function index()
    {
        $images = Image::with('user')->latest()->take(5)->cursor();
        $tiers = Tier::orderBy('id')->get();

        return response()->view('home', compact('images', 'tiers'));
    }

    public function about()
    {
        return response()->view('about');
    }

    public function contact()
    {
        return response()->view('contact');
    }
}
