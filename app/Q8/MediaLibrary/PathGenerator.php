<?php


namespace App\Q8\MediaLibrary;


use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PathGenerator implements \Spatie\MediaLibrary\Support\PathGenerator\PathGenerator
{

    public function getPath(Media $media): string
    {
        return
            (new \ReflectionClass($media->model_type))->getShortName()
            . '/'
            . $media->model_id
            . '/';
    }

    public function getPathForConversions(Media $media): string
    {
        return
            (new \ReflectionClass($media->model_type))->getShortName()
            . '/'
            . $media->model_id
            . '/'
            . 'conversions'
            . '/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return
            (new \ReflectionClass($media->model_type))->getShortName()
            . '/'
            . $media->model_id
            . '/'
            . 'responsive'
            . '/';
    }
}