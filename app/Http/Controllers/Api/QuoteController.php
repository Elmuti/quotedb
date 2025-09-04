<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'author' => 'required|string|max:255',
            'quote' => 'required|string|max:65535',
        ]);

        $user = User::where('name', 'test')->first();

        $quote = Quote::create([
            'author' => $validated['author'],
            'quote' => $validated['quote'],
            'user_id' => $user->id,
        ]);

        return response()->json($quote, 201);
    }
}
