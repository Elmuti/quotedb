<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RandomQuoteController extends Controller
{
    public function index(Request $request)
    {
        $quote = Quote::all()->random();

        return Inertia::render('Random', ['quote' => QuoteResource::make($quote)]);
    }
}
