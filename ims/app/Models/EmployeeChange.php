<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeChange extends Model
{
    use HasFactory;

    protected $table = 'employee_change';
    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'nationality',
        'dob',
        'marital_status',
        'gender',
        'bloodtype',
        'phone',
        'pemail',
        'e_id'
    ];
}