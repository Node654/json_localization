<?php

namespace App\Services\Language;

use App\Models\Language;

class LanguageService
{
    public function store(array $data)
    {
        Language::create($data);

        return response()->json([
            'message' => 'success',
        ]);
    }
}
