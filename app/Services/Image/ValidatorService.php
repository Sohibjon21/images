<?php

namespace App\Services\Image;

use App\Services\Image\Interfaces\ValidatorInterface;

class ValidatorService implements ValidatorInterface
{
    public function checkHasFile($request): bool
    {
        if (!$request->hasFile('images')) {
            return false;
        }
        return true;
    }
    public function checkCountFiles($request): bool
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
