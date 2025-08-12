<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveCount;
use App\Models\Leaves;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Cronjobs extends Controller
{
    public function updateLeaveCount()
    {
        $currentMonth = date('n');
        $currentYear = date('Y');
        $lastMonth = date('n', strtotime('first day of last month'));
        $lastYear = date('Y', strtotime('last day of last month'));
        $lastMonthStart = date('Y-m-01', strtotime('first day of last month'));
        $lastMonthEnd = date('Y-m-t', strtotime('last day of last month'));
        $empDetails = Employee::where('status', 'Active')->get();
        foreach ($empDetails as $key => $value) {
            $lastMonLeaveCount = LeaveCount::where('e_id', $value->e_id)->where('mon',$lastMonth)->where('year', $lastYear )->first();
            // Update Last Month
            $LastMonthLeaveCount = Leaves::whereMonth('leave_date', $lastMonth)
            ->where('e_id', $value->e_id)
            ->where('leave_type','=','1')
            ->get()
            ->sum(function ($leave) {
                return $leave->leave_for == 'full-day' ? 1 : 0.5;
            });
            $leave = $LastMonthLeaveCount;
             $formattedValue = ($leave == floor($leave)) ? (int)$leave : $leave;
            $updateDate = array(
                'pr_leave' => $formattedValue,
            );
            $up = LeaveCount::where('lc_id',$lastMonLeaveCount->lc_id)->update($updateDate);
            // Insert current Month
            if(($lastMonLeaveCount->pr_current - $formattedValue) <= 0){
                $pr_current = 1;
                $pr_carry = 0;
            }else{
                $pr_current = ($lastMonLeaveCount->pr_current - $formattedValue) + 1;
                $pr_carry = $pr_current - 1;
            }
            $leaveCount = new LeaveCount();
            $leaveCount->e_id = $value->e_id;
            $leaveCount->mon = $currentMonth;
            $leaveCount->year = $currentYear;
            $leaveCount->pr_leave = 0;
            $leaveCount->pr_current = $pr_current;
            $leaveCount->pr_carry  = $pr_carry;
            $save = $leaveCount->save();

            // --------------

            // $leaveCount = new LeaveCount();
            // $leaveCount->e_id = $value->e_id;
            // $leaveCount->mon = 11;
            // $leaveCount->year = $currentYear;
            // $leaveCount->pr_leave = 0;
            // $leaveCount->pr_current = 1;
            // $leaveCount->pr_carry  = 0;
            // $save = $leaveCount->save();
         }
    }
}
