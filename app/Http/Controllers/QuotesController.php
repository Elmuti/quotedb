<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuotesController extends Controller
{
    public function index(Request $request)
    {
        $quotes = Quote::where('user_id', '=', $request->user()->id)->latest()->limit(10000)->get();

        return Inertia::render('Quotes', ['quotes' => QuoteResource::collection($quotes)]);
    }
}
