<?php

use App\Http\Controllers\QuotesApiController;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::get('quotes/search/user/{id}', [QuotesApiController::class, 'getQuotes'])->name('quotes.search.user');
    Route::get('quotes/random/user/{id}', [QuotesApiController::class, 'getRandomQuotes'])->name('quotes.random.user');
    Route::post('quotes', [QuotesApiController::class, 'addQuotes'])->name('quotes.store');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/tokens/create', function (Request $request) {
        $token = $request->user()->createToken($request->token_name);

        return ['token' => $token->plainTextToken];
    })->name('tokens.create');
    Route::get('/tokens', function (Request $request, #[CurrentUser] User $user) {
        return $user->tokens()->get();
    })->name('tokens.index');
    Route::delete('/tokens/{id}', function (Request $request, #[CurrentUser] User $user, int $id) {
        $user->tokens()->where('id', $id)->delete();

        return response()->noContent();
    })->name('tokens.destroy');
});
