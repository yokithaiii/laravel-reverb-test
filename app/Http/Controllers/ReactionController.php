<?php

namespace App\Http\Controllers;

use App\Events\ReactedEvent;
use App\TestClass;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReactionController extends Controller
{
    public function index()
    {
        return Inertia::render('Reaction');
    }

    public function store(Request $request)
    {
        $request->validate(['required']);
        $image = $request->file('image');
        $saveFile = new TestClass();
        $saveFile->save($image->path(), $image);
    }

    public function reaction()
    {
        event(
            new ReactedEvent(
                buttonId: request()->input('buttonId'),
                emoji: request()->input('emoji'),
            )
        );

        return response()->json(['message' => 'success!']);
    }
}
