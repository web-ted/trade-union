<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worker extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
        'birth_date' => 'timestamp',
        'hire_date' => 'timestamp',
        'registered_at' => 'timestamp',
    ];


    protected $fillable = [
        'registration_number',
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
     * Get the specialty record associated with the worker.
     */
    public function specialty()
    {
        return $this->hasOne('App\Specialty');
    }

    /**
     * Get the enterprise record associated with the worker.
     */
    public function enterprise()
    {
        return $this->hasOne('App\Enterprise');
    }
}
