<?php
namespace App\Services;


class Media {
    public function UploadMedia($media, $path)
    {
        // $file_extension = $media->getClientOriginalExtension();
        $file_name =  $media->hashName();
        $full_path = "store_assets/images/{$path}";
        $media->move(public_path($full_path),$file_name);
        return $file_name;
    }


    public function deleteMedia($media, $path)
    {
        $full_path = public_path("store_assets/images/{$path}");
        $image = $full_path.'/'.$media;
        if (file_exists($image))
        {
            unlink($image);
            return true;
        }
        return false;
    }
}
