<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuotesApiController extends JsonResponse
{
    public function getQuotes(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'max_quotes' => ['required', 'integer', 'min:1', 'max:1000'],
        ]);
        $quotes = Quote::where('user_id', '=', $id)->latest()->limit($validated['max_quotes'])->get();

        return response()->json(['quotes' => QuoteResource::collection($quotes)]);
    }

    public function addQuotes(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'integer'],
            'quote' => ['required', 'string'],
            'author' => ['required', 'string'],
            'date' => ['string'],
        ]);
        $quote = new Quote;
        $quote->user_id = $validated['user_id'];
        $quote->quote = $validated['quote'];
        $quote->author = $validated['author'];
        if ($request->has('date')) {
            $carbonDate = Carbon::parse($validated['date']);
            $quote->created_at = $carbonDate;
        } else {
            $quote->created_at = Carbon::now();
        }
        $quote->save();

        return response()->json(['quote' => new QuoteResource($quote)], Response::HTTP_CREATED);
    }
}
