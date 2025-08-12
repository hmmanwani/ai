<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education_Qualification extends Model
{
    use HasFactory;
    protected $table = 'education_qualification';

    protected $fillable = [
        'e_id',
        'qualification',
        'university_name',
        'starting_year',
        'ending_year',
    ];
}