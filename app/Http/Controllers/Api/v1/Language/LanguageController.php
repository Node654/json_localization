<?php

namespace App\Http\Controllers\Api\v1\Language;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Language\StoreRequest;
use App\Http\Resources\Api\v1\Language\LanguageResource;
use App\Models\Language;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LanguageController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return LanguageResource::collection(Language::all());
    }

    public function store(StoreRequest $request)
    {
        return $request->addLanguage();
    }
}
