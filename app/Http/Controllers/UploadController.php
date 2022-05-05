<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;

class UploadController extends Controller
{
    protected function uploadImageToServer($file, $last = null)
    {
        $imagePath = "u/images";
        $urlArray = [];
        if (is_array($file)) {
            for ($i = 0; $i < count($file); $i++) {
                $files = $file[$i];
                $filename = now()->timestamp . '_' . $files->getClientOriginalName();
                $files->move(public_path($imagePath), $filename);
                $urlArray[] = "{$imagePath}/{$filename}";
            }
            return $urlArray;
        }
        $filename = now()->timestamp . '_' . $file->getClientOriginalName();
        if (!file_exists(public_path($imagePath))) {
            mkdir(public_path($imagePath), 0775, true);
        }
        $file->move(public_path($imagePath), $filename);
        if ($last != null) {
            unlink($last);
        }
        return "{$imagePath}/{$filename}";
    }

}
