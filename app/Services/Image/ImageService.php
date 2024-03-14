<?php

namespace App\Services\Image;

use App\Models\Images;
use Illuminate\Support\Str;
use ZipArchive;

class ImageService
{
    public function store($request)
    {
        if (!$request->hasFile('images')) {
            return response()->json([
                'message' => 'no files'
            ]);
        }

        if (count($request->file('images')) > 5) {
            return redirect()->back()->with('error', 'max count is 5');
        }

        $files = $request->file('images');

        foreach ($files as $file) {

            $mimeType = $file->getClientMimeType();

            if (strpos($mimeType, 'image/') !== 0) {
                return redirect()->back()->with('error', 'required images');
            }

            $fileName = Str::lower(Str::ascii($file->getClientOriginalName()));

            $dublicateCount = Images::where('name', '=', $fileName)->get()->count();

            if ($dublicateCount > 0) {
                $fileName = uniqid() . '_' . $fileName;
            }

            $file->storeAs('public/images', $fileName);


            Images::create([
                'name' => $fileName,
                'uploaded_date_time' => NOW(),
            ]);
        }

        return true;
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
