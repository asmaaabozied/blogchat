<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdCollection;
use App\Models\Ad;

class AdController extends Controller
{
    public function index()
    {
        return new  AdCollection(Ad::where('is_active', true)->paginate(10));
    }
}
