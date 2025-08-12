<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationQualificationChange extends Model
{
    use HasFactory;

    protected $table = 'education_qualification_change';

    protected $fillable = [
        'edq_id',
        'e_id',
        'qualification',
        'university_name',
        'starting_year',
        'ending_year',
    ];
}