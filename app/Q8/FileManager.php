<?php
/**
 * Created by PhpStorm.
 * User: kareem
 * Date: 08/03/19
 * Time: 18:37
 */

namespace App\Q8;


use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class FileManager
{
    /**
     * a global helper function for storing files
     * @param string $path
     * @param File $file
     * @return string
     */
    public static function storeFile(string $path, $file): string
    {

        $path = static::generateFilePathName($path, $file->getClientOriginalName(),
            $file->getClientOriginalExtension());

        Storage::disk('public')->put($path, \Illuminate\Support\Facades\File::get($file));

        return 'storage/' . $path;

    }

    public static function storeFileContent($path, $fileName, $extension, $content): string
    {
        $path = static::generateFilePathName($path, $fileName, $extension);
        Storage::disk('public')->put($path, $content);
        return 'storage/' . $path;
    }

    public static function generateFilePathName($path, $filename, $extension): string
    {
        $date = date('Ymdhis');

        return self::generateFileFolder($path, $date)
            . self::generateFileName($filename, $extension, $date);

    }

    public static function generateFileFolder($path, $date = null): string
    {
        $date ??= date('Ymdhis');
        return $folder = $path . '/' . $date . '/';
    }

    public static function generateAndCreateFileFolder($path, $date = null): string
    {
        $dir = self::generateFileFolder($path, $date);
        File::makeDirectory($dir, 0755, true);
        return $dir;
    }

    public static function generateFileName($filename, $extension, $date = null): string
    {
        $date ??= date('Ymdhis');
        return hash('sha256', $date . $filename . rand(100, 100000)) . '.' . $extension;
    }

    public static function generateFileNameFromFile($file, $date = null): string
    {
        return
            self::generateFileName(
                $file->getClientOriginalName(),
                $file->getClientOriginalExtension(), $date
            );
    }
}
