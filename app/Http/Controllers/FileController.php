<?php

namespace App\Http\Controllers;

use App\Http\Requests\Images\DownloadZipRequest;
use App\Http\Requests\Images\SortRequest;
use App\Models\Images;
use App\Services\Image\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class FileController extends Controller
{

    private function service()
    {
        return new ImageService;
    }
    public function index()
    {
        return view('images.index');
    }

    public function show(SortRequest $request)
    {
        $images = $this->service()->show($request);

        return view('images.show', compact('images'));
    }

    public function store(Request $request)
    {
        $store = $this->service()->store($request);
        if ($store) {
            return redirect()->route('images.show');
        }
    }

    public function upload()
    {
        return view('images.upload');
    }

    public function downloadZip(DownloadZipRequest $request)
    {

        $zipFileForDownload = $this->service()->downloadZip($request);

        if (!$zipFileForDownload) {
            return response()->json([
                'message' => 'error'
            ]);
        }

        return response()->download($zipFileForDownload);
    }
}
