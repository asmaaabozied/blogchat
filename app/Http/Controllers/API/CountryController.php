<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountryCollection;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        return new CountryCollection(Country::all());
    }
}
