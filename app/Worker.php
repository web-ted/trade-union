<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worker extends Model
{
    use SoftDeletes;


	/**
	 * That attributes that can be filled
	 * @var array
	 */
    protected $fillable = [
        'registration_number',
	    'registered_at',
        'active',
        'first_name',
        'last_name',
        'father_name',
        'birth_date',
        'id_card',
        'phone',
        'mobile_phone',
        'email',
        'address',
        'postal_code',
        'region',
        'city',
        'hire_date',
        'insurance_number',
        'comment',
        'enterprise_id',
        'specialty_id',
    ];

	/**
	 * Accessor for registered_at attribute
	 * @param $registered_at
	 * @return mixed
	 */
    public function getRegisteredAtAttribute($registered_at)
    {
    	if(!is_null($registered_at)) {
    	    return Carbon::createFromFormat('Y-m-d H:i:s', $registered_at)->format('c');
	    }

	    return null;
    }


	/**
	 * Mutator for registered_at attribute
	 * @param $registered_at
	 * @return $this
	 */
	public function setRegisteredAtAttribute($registered_at)
	{
		$this->attributes['registered_at'] = Carbon::parse($registered_at)->format('Y-m-d H:i:s');
	}

	/**
	 * Accessor for birth_date attribute
	 * @param $birth_date
	 * @return mixed
	 */
    public function getBirthDateAttribute($birth_date)
    {
    	if(!is_null($birth_date)) {
    	    return Carbon::createFromFormat('Y-m-d H:i:s', $birth_date)->format('c');
	    }

	    return null;
    }


	/**
	 * Mutator for birth_date attribute
	 * @param $birth_date
	 * @return $this
	 */
	public function setBirthDateAttribute($birth_date)
	{
		$this->attributes['birth_date'] = Carbon::parse($birth_date)->format('Y-m-d H:i:s');
	}

	/**
	 * Accessor for hire_date attribute
	 * @param $hire_date
	 * @return mixed
	 */
    public function getHireDateAttribute($hire_date)
    {
    	if(!is_null($hire_date)) {
    	    return Carbon::createFromFormat('Y-m-d H:i:s', $hire_date)->format('c');
	    }

	    return null;
    }


	/**
	 * Mutator for hire_date attribute
	 * @param $hire_date
	 * @return $this
	 */
	public function setHireDateAttribute($hire_date)
	{
		$this->attributes['hire_date'] = Carbon::parse($hire_date)->format('Y-m-d H:i:s');
	}


	/**
	 * Accessor for updated_at attribute
	 * @param $updated_at
	 * @return mixed
	 */
	public function getUpdatedAtAttribute($updated_at)
	{
		if(!is_null($updated_at)) {
			return Carbon::createFromFormat('Y-m-d H:i:s', $updated_at)->format('c');
		}

		return null;
	}


	/**
	 * Accessor for created_at attribute
	 * @param $created_at
	 * @return mixed
	 */
	public function getCreatedAtAttribute($created_at)
	{
		if(!is_null($created_at)) {
			return Carbon::createFromFormat('Y-m-d H:i:s', $created_at)->format('c');
		}

		return null;
	}

	/**
	 * Accessor for deleted_at attribute
	 * @param $deleted_at
	 * @return mixed
	 */
	public function getDeletedAtAttribute($deleted_at)
	{
		if(!is_null($deleted_at)) {
			return Carbon::createFromFormat('Y-m-d H:i:s', $deleted_at)->format('c');
		}

		return null;
	}

    /**
     * Get the specialty record associated with the worker.
     */
    public function specialty()
    {
        return $this->belongsTo('App\Specialty');
    }

    /**
     * Get the enterprise record associated with the worker.
     */
    public function enterprise()
    {
        return $this->belongsTo('App\Enterprise');
    }
}
