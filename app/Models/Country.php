<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {
    protected $table = 'countries';

    protected $fillable = [
        'short_name',
        'name',
        'phonecode',
    ];

    /**
     * Country has many states
     */
    public function states() {
        return $this->hasMany(State::class);
    }

    /**
     * Country has many cities (through states)
     */
    public function city() {
        return $this->hasManyThrough(
            City::class,
            State::class,
            'country_id', // FK on states
            'state_id',   // FK on cities
            'id',         // PK on countries
            'id'          // PK on states
        );
    }

    /**
     * Country has many customers
     */
    public function customers() {
        return $this->hasMany(Customer::class);
    }
}
