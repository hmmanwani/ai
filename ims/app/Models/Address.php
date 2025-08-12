<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'address';

    protected $fillable = [
        'e_id',
        'address_type',
        'apartment_no',
        'apartment_name',
        'area',
        'city',
        'state',
        'country',
        'postal_code',
    ];
}