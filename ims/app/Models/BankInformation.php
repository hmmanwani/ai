<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankInformation extends Model
{
    use HasFactory;
    protected $table = 'bank_information';

    protected $fillable = [
        'e_id',
        'bank_name',
        'branch',
        'account_no',
        'ifsc_code',
        'pan_no',
        'uan_no',
        'pf_no',
    ];
}