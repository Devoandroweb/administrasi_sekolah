<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadFile
{
    public function uploadFile($path, $file)
    {
        $result = null;
        $ext = $file->getClientOriginalExtension();
        $namaFile = time().'.'.$ext;
        Storage::putFileAs($path, $file, $namaFile);
        $result = $namaFile;
        return $result;
    }
}
