<?php

namespace  App\Services\Image\Interfaces;

interface ValidatorInterface {
    public function checkHasFile($request):bool;
    public function checkCountFiles($request):bool;
    public function checkMimeType($file);



}
