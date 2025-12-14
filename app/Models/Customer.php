<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\State;
use App\Models\City;
use App\Models\Country;

class Customer extends Model {
    protected $table = 'customers';

    protected $fillable = [
        'name',
        'email',
        'contact_no',
        'whatsapp_no',
        'profile_image',
        'address',
        'country_id',
        'state_id',
        'city_id',
        'zipcode',
        'otp',
        'is_active'
    ];


    public function state() {
        return $this->belongsTo(State::class);
    }

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function country() {
        return $this->belongsTo(Country::class);
    }
}
