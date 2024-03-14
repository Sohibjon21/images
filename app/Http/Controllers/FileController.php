<?php

namespace App\Http\Controllers;

use App\Http\Requests\Images\DownloadZipRequest;
use App\Http\Requests\Images\SortRequest;
use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class FileController extends Controller
{
    public function index()
    {
        return view('images.index');
    }

    public function show(SortRequest $request)
    {
        $sort = $request->validated();


        $images = Images::all();

        if (isset($sort['sort_by'])) {
            if ($sort['sort_by'] == 'name') {
                $images = Images::orderBy('name', $sort['value'])->get();
            }

            if ($sort['sort_by'] == 'date_time') {
                $images = Images::orderBy('uploaded_date_time', $sort['value'])->get();
            }
        }
        // dd($imageUrls);
        return view('images.show', compact('images'));
    }

    public function store(Request $request)
    {

        $files = $request->file('images');

        if (empty($files)) {
            return response()->json([
                'message' => 'no files'
            ]);
        }

        foreach ($files as $file) {
            $fileName = Str::lower(Str::ascii($file->getClientOriginalName()));
            dump($fileName);

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

        return response()->json(['message' => 'success'], 200);
    }

    public function upload()
    {
        return view('images.upload');
    }

    public function downloadZip(DownloadZipRequest $request)
    {
        $data = $request->validated();
        $imageName = $data['image_name'];
        $imagePath = storage_path('app/public/images/' . $imageName);
        $zipFileForDownload = $imageName . '.zip';

        $zip = new ZipArchive;

        if ($zip->open($zipFileForDownload, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            $zip->addFile($imagePath, $imageName);
            $zip->close();
            return response()->download($zipFileForDownload);
        }

        return response()->json([
            'message' => 'error'
        ]);
    }
}
