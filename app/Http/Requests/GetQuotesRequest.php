<?php

namespace App\Http\Requests;

class GetQuotesRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'exclude_closing_messages' => $this->exclude_closing_messages === 'true',
        ]);
    }
}
