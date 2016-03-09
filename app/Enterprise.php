<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    //
}
