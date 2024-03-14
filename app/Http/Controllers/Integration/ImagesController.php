<?php

namespace App\Http\Controllers\Integration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\getInfoRequest;
use App\Models\Images;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function getInfo(getInfoRequest $request)
    {
        $data = $request->validated();

        if (isset($data['id'])) {
            $id = $data['id'];
            $image = Images::find($id);
            $image->makeHidden(['created_at']);
            $image->makeHidden(['updated_at']);
            return response()->json([
                'info' => $image
            ]);
        }

        $images = Images::all();
        $images->makeHidden(['created_at']);
        $images->makeHidden(['updated_at']);

        return response()->json([
            'info' => $images
        ]);
    }
}
