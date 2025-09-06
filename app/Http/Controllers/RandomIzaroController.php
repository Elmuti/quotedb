<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RandomIzaroController extends Controller
{
    public function index(Request $request)
    {
        $quote = Quote::where('user_id', 2)->inRandomOrder()->first();

        return Inertia::render('Random', ['quote' => QuoteResource::make($quote)]);
    }
}
