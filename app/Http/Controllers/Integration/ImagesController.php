<?php

namespace App\Http\Controllers\Integration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\getInfoByIdRequest;
use App\Models\Images;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function getInfo()
    {
        $images = Images::all();
        $images->makeHidden(['created_at']);
        $images->makeHidden(['updated_at']);

        return response()->json([
            'info' => $images
        ]);
    }

    public function getInfoById(getInfoByIdRequest $request)
    {
        $data = $request->validated();

        $id = $data['id'];
        $image = Images::find($id);
        $image->makeHidden(['created_at']);
        $image->makeHidden(['updated_at']i);
        return response()->json([
            'info' => $image
        ]);
    }
}
