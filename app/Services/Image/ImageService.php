<?php

namespace App\Services\Image;

use App\Models\Images;
use App\Services\Image\Interfaces\ImageInterface;
use Illuminate\Support\Str;
use ZipArchive;

class ImageService implements ImageInterface
{
    protected $validatorService;
    public function __construct()
    {
        $this->validatorService = new ValidatorService;
    }
    public function store($request): bool
    {
        if (!$this->validatorService->checkHasFile($request))
            return false;

        if (!$this->validatorService->checkCountFiles($request))
            return false;

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

    public function storeImageToStorage($file, $fileName): void
    {
        $file->storeAs('public/images', $fileName);
    }

    public function storeToDb(string $fileName): void
    {
        Images::create([
            'name' => $fileName,
            'uploaded_date_time' => NOW(),
        ]);
    }
    public function show($request)
    {
        $sort = $request->validated();
        $images = $this->orderBy($sort);

        return $images;
    }

    public function orderBy($sort)
    {
        $images = Images::orderBy('uploaded_date_time', 'desc')->get();
        if (isset($sort['sort_by'])) {
            switch ($sort['sort_by']) {
                case 'name':
                    $images = Images::orderBy('name', $sort['value'])->get();
                    break;
                case 'date_time':
                    $images = Images::orderBy('uploaded_date_time', $sort['value'])->get();
                    break;
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
