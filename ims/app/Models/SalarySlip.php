<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalarySlip extends Model
{
    use HasFactory;
    protected $table = "salary_slip";
    protected $fillable = [
        'ssid', 'e_id', 'name', 'empid', 'department', 'designation', 'date', 'bank_name', 'action', 'ifsc', 'account_no', 'pan', 'actual_payable_days', 'total_working_days', 'loss_of_pay_days', 'days_payable', 'basic', 'city_comp_allowance', 'bonus', 'professional_tax', 'total_earnings_a', 'professional_tax', 'total_deductions_c', 'net_salary_payable_a_c', 'net_alary_in_words'
    ];
    public static function getsalaryslipdetailsAdmin($Data, $sort_field, $orderBy, $c)
    {
        $query = SalarySlip::query();
        if (!empty($Data['search']['value'])) {
            $query->where('ss_id', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('name', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('department', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('designation', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('designation', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('date', "LIKE", "%{$Data['search']['value']}%")
                ->orWhere('bank_name', "LIKE", "%{$Data['search']['value']}%");
        }
        $query->orderBy('ss_id', $orderBy);
        if ($c == 1) {
            if ($Data['length'] != -1) {
                $query->offset($Data['start']);
                $query->limit($Data['length']);
            }
            return $query->get();
        } else {
            $result['NumRecords'] = $query->count();
            return $result;
        }
    }
}
