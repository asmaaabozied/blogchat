<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GroupUser extends Pivot
{
    protected $table = 'group_user';
    protected $guarded = [];
    public $incrementing = true;
    public $timestamps = true;

}
