<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'address', 'province', 'city', 'country', 'postal_code'
    ];    
    
    protected $table = 'user_addresses';
}
