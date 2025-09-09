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

    public function getRandomQuotes(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'max_quotes' => ['required', 'integer', 'min:1', 'max:1000'],
        ]);
        $quotes = Quote::where('user_id', '=', $id)->inRandomOrder()->limit($validated['max_quotes'])->get();

        return response()->json(['quotes' => QuoteResource::collection($quotes)]);
    }

    public function getQuotesByServerId(Request $request, int $serverId): JsonResponse
    {
        $validated = $request->validate([
            'max_quotes' => ['required', 'integer', 'min:1', 'max:1000'],
        ]);
        $quotes = Quote::where('server_id', '=', $serverId)->latest()->limit($validated['max_quotes'])->get();

        return response()->json(['quotes' => QuoteResource::collection($quotes)]);
    }

    public function getRandomQuotesByServerId(Request $request, int $serverId): JsonResponse
    {
        $validated = $request->validate([
            'max_quotes' => ['required', 'integer', 'min:1', 'max:1000'],
        ]);
        $quotes = Quote::where('server_id', '=', $serverId)->inRandomOrder()->limit($validated['max_quotes'])->get();

        return response()->json(['quotes' => QuoteResource::collection($quotes)]);
    }

    public function addQuotes(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'quote' => ['required', 'string'],
            'author' => ['required', 'string'],
            'date' => ['string'],
            'server_id' => ['integer'],
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
        if ($request->has('server_id')) {
            $quote->server_id = $validated['server_id'];
        }
        $quote->save();

        return response()->json(['quote' => new QuoteResource($quote)], Response::HTTP_CREATED);
    }
}
