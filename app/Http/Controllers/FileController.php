<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $filename)
    {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (!in_array($extension, ['jpg', 'jpeg', 'bmp', 'png', 'pdf'])) {
            abort(404);
        }

        // Menentukan Content-Type berdasarkan ekstensi
        $mimeTypes = [
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'bmp'  => 'image/bmp',
            'png'  => 'image/png',
            'pdf'  => 'application/pdf',
        ];

        $contentType = $mimeTypes[$extension] ?? 'application/octet-stream';

        return response()->stream(function () use ($filename) {
            $stream = Storage::disk('s3')->readStream(str_replace('|', '/', $filename));
            while (!feof($stream)) {
                echo fread($stream, 1024 * 8);
            }
            fclose($stream);
        }, 200, [
            'Content-Type' => $contentType,
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }
}
