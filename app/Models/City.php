<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = [
        'name',
        'state_id',
        'latitude',
        'longitude',
    ];

    /**
     * A city belongs to a state
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * A city belongs to a country (via state)
     */
    public function country()
    {
        return $this->hasOneThrough(
            Country::class,
            State::class,
            'id',         // Foreign key on states table
            'id',         // Foreign key on countries table
            'state_id',   // Foreign key on cities table
            'country_id'  // Foreign key on states table
        );
    }

    /**
     * A city has many customers
     */
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }


}
