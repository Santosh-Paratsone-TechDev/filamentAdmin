<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';

    protected $fillable = [
        'short_name',
        'name',
        'country_id',
    ];

    /**
     * A state belongs to a country
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * A state has many cities
     */
    public function city()
    {
        return $this->hasMany(City::class);
    }

    /**
     * A state has many customers
     */
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
