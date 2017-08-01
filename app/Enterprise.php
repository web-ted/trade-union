<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enterprise extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [ 'name' ];

	public function workers()
	{
		return $this->hasMany('App\Worker');
	}
}
