<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RandomQuoteController extends Controller
{
    public function index(Request $request)
    {
        $quotes = Quote::all();
        return Inertia::render('Quotes', ['quotes' => QuoteResource::collection($quotes)]);
    }
}
