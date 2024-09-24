<?php

namespace App\Services\Image;

use App\Models\Images;
use Illuminate\Support\Str;
use ZipArchive;

class ValidatorService
{
    public function checkHasFile($request)
    {
        if (!$request->hasFile('images')) {
           return false;
        }
        return true;
    }
    public function checkCountFiles($request)
    {
        if (count($request->file('images')) > 5) {
            return false;
        }
        return true;
    }

    public function checkMimeType($file)
    {
        $mimeType = $file->getClientMimeType();
        if (strpos($mimeType, 'image/') !== 0) {
            return redirect()->back()->with('error', 'required images');
        }
    }
}
