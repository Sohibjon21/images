<?php

namespace App\Http\Controllers\Integration;

use App\Http\Controllers\Controller;
use App\Models\Images;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function getInfo()
    {
        return response()->json([
            'info'=>Images::all()
        ]);
    }
}
