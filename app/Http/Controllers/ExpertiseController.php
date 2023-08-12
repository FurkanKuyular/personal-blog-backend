<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExpertiseResource;
use App\Models\Expertise;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ExpertiseController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $expertises = Expertise::query()->orderByDesc('start_date')->get();

        return ExpertiseResource::collection($expertises);
    }
}
