<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankInformationChange extends Model
{
    use HasFactory;
    protected $table = 'bank_information_change';

    protected $fillable = [
        'bi_id',
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