<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class FileController extends Controller
{
    public function show($filename)
    {
        $path = storage_path('app/public/uploads/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        $mimeType = mime_content_type($path);
        return response()->file($path, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline'
        ]);
    }
}
