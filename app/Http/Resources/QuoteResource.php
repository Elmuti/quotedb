<?php

namespace App\Http\Resources;

use App\Models\Quote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Quote
 */
class QuoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'quote' => $this->quote,
            'author' => $this->author,
            'date' => Carbon::make($this->created_at)->format('Y-m-d'),
            'server_id' => $this->whenNotNull($this->server_id),¬
        ];
    }
}
