<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    protected $table='members';
    protected $fillable = [
        'member_name', 'first_name', 'surname','phone', 'postal_street_address', 'postal_suburb','postal_state', 'postal_postcode', 'postal_country','security_code', 'fob_number', 'avatar','id_user'
    ];
    public $timestamps = true;
}
