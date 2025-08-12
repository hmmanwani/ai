<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressChange extends Model
{
    use HasFactory;

    protected $table = 'address_change';

    protected $fillable = [
        'ad_id',
        'e_id',
        'apartment_no',
        'apartment_name',
        'area',
        'city',
        'state',
        'country',
        'postal_code',
    ];
}