<?php
namespace App\Http\Helpers;

use Illuminate\Support\Facades\File;

class Helper
{
    public static function uploadImage($image)
    {
        $relativePath = 'images/' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $relativePath);
        return $relativePath;
    }

    public static function updateImage($image,$oldImage)
    {
        if(File::exists(public_path($oldImage)))
        {
            File::delete(public_path($oldImage));
        }
        $relativePath = 'images/' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $relativePath);
        return $relativePath;
    }
    
    public static function uploadFile($file)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = uniqid() . '_' . time() . '.' . $extension;
        $relativePath = 'files/' . $fileName;
        $file->move(public_path('files'), $fileName);
        return $relativePath;
    }

    public static function updateFile($file,$oldFile)
    {
        if(File::exists(public_path($oldFile)))
        {
            File::delete(public_path($oldFile));
        }
        
        $extension = $file->getClientOriginalExtension();
        $fileName = uniqid() . '_' . time() . '.' . $extension;
        $relativePath = 'files/' . $fileName;
        $file->move(public_path('files'), $fileName);
        return $relativePath;
    }
}