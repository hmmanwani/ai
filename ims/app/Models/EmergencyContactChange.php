<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyContactChange extends Model
{
    use HasFactory;
    protected $table = 'emergency_contact_change';

    protected $fillable = [
        'ec_id',
        'e_id',
        'name',
        'relationship',
        'phone'
    ];
}
