<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReferenceResource;
use App\Models\Reference;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReferenceController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return ReferenceResource::collection(Reference::all());
    }
}
