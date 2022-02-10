<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadFile
{
    public function uploadFile($dir, $request)
    {
        $result = null;
        $file = $request->file('file');
        $namaFile = time() . "_" . $file->getClientOriginalName();
        Storage::putFileAs($dir, $file, $namaFile);
        $result = $namaFile;
        return $result;
    }
}
