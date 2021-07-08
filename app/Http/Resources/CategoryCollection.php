<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @see \App\Models\Category */
class CategoryCollection extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
           'id'=>$this->id ?? '',
            'title' => $this->title ?? '',
            'order' => $this->order ?? '',
            'is_paid' => $this->is_paid ?? '',
            'place' => $this->place ?? '',
            'created_at' => $this->created_at ?? '',

            'image' => !empty(asset('public/' . $this->image) ) ? asset('public/' . $this->image) :'',

            'advertisements' => $this->advertisements ?? [],
           'popularPosts' => !empty( $this->popularPosts) ?  $this->popularPosts : [],

        ];
    }
}
