<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    use HasFactory;
    protected $hidden= [
        'model_type',
        'model_id',
        'uuid',
        'disk',
        'conversions_disk',
        'collection_name',
        'manipulations',
        'custom_properties',
        'responsive_images',
        'order_column'
    ];
    protected $appends = ['url'];


    public function getUrlAttribute()
    {
        return $this->getUrl();
    }

    public function collection()
    {
        return Media::where('collection_name', $this->collection_name)->get();
    }
}
