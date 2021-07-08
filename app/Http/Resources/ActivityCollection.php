<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \Spatie\Activitylog\Models\Activity */
class ActivityCollection extends ResourceCollection
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function ($item) {
                $item['causer'] = User::find($item['causer_id']);
                return $item;
            }),
        ];
    }
}
