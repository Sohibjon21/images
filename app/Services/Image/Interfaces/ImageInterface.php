<?php

namespace  App\Services\Image\Interfaces;

use Illuminate\Http\Request;

interface ImageInterface {
    public function store(Request $request):bool;
    public function generateFileName($file): string;
    public function storeImageToStorage($file,string $fileName):void;
    public function storeToDb(string $fileName):void;
    public function show($request);
    public function downloadZip($request);

}
