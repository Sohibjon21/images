<?php

namespace App\Services\Image;

use App\Models\Images;
use Illuminate\Support\Str;
use ZipArchive;

class ImageService
{
    protected $validatorService;
    public function __construct()
    {
        $this->validatorService = new ValidatorService;
    }
    public function store($request)
    {

        if (!$this->validatorService->checkHasFile($request)) {
            return false;
        }

        if (!$this->validatorService->checkCountFiles($request)) {
            return false;
        }

        $files = $request->file('images');
        foreach ($files as $file) {
            $this->validatorService->checkMimeType($file);
            $fileName = $this->generateFileName($file);
            $this->storeImageToStorage($file, $fileName);
            $this->storeToDb($fileName);
        }

        return true;
    }

    public function generateFileName($file): string
    {
        $fileName = Str::lower(Str::ascii($file->getClientOriginalName()));

        $fileName = uniqid() . '_' . $fileName;
        return $fileName;
    }

    public function storeImageToStorage($file, $fileName)
    {
        $file->storeAs('public/images', $fileName);
    }

    public function storeToDb($fileName)
    {
        Images::create([
            'name' => $fileName,
            'uploaded_date_time' => NOW(),
        ]);
    }
    public function show($request)
    {
        $sort = $request->validated();

        $images = Images::orderBy('uploaded_date_time', 'desc')->get();;

        if (isset($sort['sort_by'])) {
            if ($sort['sort_by'] == 'name') {
                $images = Images::orderBy('name', $sort['value'])->get();
            }

            if ($sort['sort_by'] == 'date_time') {
                $images = Images::orderBy('uploaded_date_time', $sort['value'])->get();
            }
        }
        return $images;
    }

    public function downloadZip($request)
    {
        $data = $request->validated();
        $imageName = $data['image_name'];
        $imagePath = storage_path('app/public/images/' . $imageName);
        $zipFileForDownload = $imageName . '.zip';
        $zip = new ZipArchive;

        if ($zip->open($zipFileForDownload, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            $zip->addFile($imagePath, $imageName);
            $zip->close();
            return $zipFileForDownload;
        }

        return false;
    }
}
