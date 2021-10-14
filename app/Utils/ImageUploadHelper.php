<?php

namespace App\Utils;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Image;
use Symfony\Component\HttpFoundation\File\File;

class ImageUploadHelper {

    public static function processImg(&$obj, $model_key, $folder_name, $photo_name, $input_key = null) {
        if ( is_null($input_key) ) {
            $input_key = $model_key;
        }
        if (request()->hasFile($input_key)) {
            $imageFile = request()->file($input_key);
            $result = ImageUploadHelper::upload(
                $imageFile,
                'uploads/' . $folder_name. '/',
                $photo_name . '_' . date('YmdHis')
            );
            if ($result['success']) {
                $obj->$model_key = $result['image_relative_path'];
            }
        }
    }

    public static function processImgBase64(&$obj, $model_key, $folder_name, $photo_name, $input_base64) {
        // https://stackoverflow.com/a/58512459/2695256
        // decode the base64 file
        $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $input_base64));

        // save it to temporary dir first.
        $tmpFilePath = sys_get_temp_dir() . '/' . Str::uuid()->toString();
        file_put_contents($tmpFilePath, $fileData);

        // this just to help us get file info.
        $tmpFile = new File($tmpFilePath);

        $imageFile = new UploadedFile(
            $tmpFile->getPathname(),
            $tmpFile->getFilename(),
            $tmpFile->getMimeType(),
            0,
            true // Mark it as test, since the file isn't from real HTTP POST.
        );

        $result = ImageUploadHelper::upload(
            $imageFile,
            'uploads/' . $folder_name. '/',
            $photo_name . '_' . date('YmdHis')
        );
        if ($result['success']) {
            $obj->$model_key = $result['image_relative_path'];
        }
    }

    public static function upload($image, $path, $name, $generateThumbnail = true, $thumbWidth = 200, $thumbHeight = 200) {
        $ext = $image->getClientOriginalExtension() ?: 'jpg';

        $filename = $name . '.' . $ext;
        $relativePath = $path . $filename;
        $fullPath = public_path( $relativePath );

        // resize and save
        $imageObject = Image::make($image);
        $imageObject->save($fullPath);

        $result = [
            'success' => true,
            'image_filename' => $filename,
            'image_relative_path' => $relativePath,
            'image_full_path' => $fullPath,
        ];

        if ($generateThumbnail) {
            $filename_thumb = $name . '.thumb.' . $ext;
            $relativePath_thumb = $path . $filename_thumb;
            $fullPath_thumb = public_path( $relativePath_thumb );

            $imageObject->fit($thumbWidth, $thumbHeight)->save($fullPath_thumb);

            $result['thumb_filename'] = $filename;
            $result['thumb_relative_path'] = $relativePath;
            $result['thumb_full_path'] = $fullPath;
        }

        return $result;
    }
}