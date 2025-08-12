<?php

namespace App\Http\Controllers\ims;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\BankInformation;
use App\Models\Education_Qualification;
use App\Models\EmergencyContact;
use App\Models\Holiday;
use App\Models\LeaveCount;
use App\Models\Leaves;
use App\Models\LeaveType;
use App\Models\TaskManage;
use App\Models\Wfh;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : index
     use for : Send the employee data(BrithdayToday,UpComingBrithday,UpComingHoliday,WorkAnniversary,
               LeaveOnToday) for the on dashboard page.
     ---------------------------------------------------------------------------------------------------------*/
    public function index()
    {
        $empLogin = session('emp_login');
        $e_id = $empLogin['e_id'];
        $today = Carbon::now();
        $currentDate = $today->toDateString();
        $currentYear = now()->year;
        $data = Attendance::where('e_id', $e_id)->where('date', date('Y-m-d'))->first();
        if ($data) {
            $login_time = Carbon::parse($data->login_time);
            $data->formatted_login_time = $login_time->format('jS M \a\t h:i:s A');
            if ($data->logout_time) {
                $logout_time = Carbon::parse($data->logout_time);
                $data->formatted_logout_time = $logout_time->format('jS M \a\t h:i:s A');
                $workingHours = $logout_time->diff($login_time);
                $hours = $workingHours->h;
                $minutes = $workingHours->i;
                $seconds = $workingHours->s;
                $data->total_working_hours = $hours . 'h : ' . $minutes . 'm : ' . $seconds . 's';
                $data->total_working_hours_decimal = $hours + ($minutes / 60);
            } else {
                $data->formatted_logout_time = '-';
                $data->total_working_hours = 'Still logged in';
            }
        }
        $birthdaysToday = Employee::whereMonth('dob', '=', $today->month)
            ->whereDay('dob', '=', $today->day)
            ->select('fname', 'lname', 'dob')
            ->where('status', 'Active')
            ->get();
        // if ($birthdaysToday->isNotEmpty() && session("birthday_popup_shown_{$e_id}") !== $currentDate) {
        //     session(["birthday_popup_shown_{$e_id}" => $currentDate]);
        //     session(['show_birthday_popup' => true]);
        // } else {
        //     session(['show_birthday_popup' => false]);
        // }
        $currentMonth = $today->month;
        $currentDay = $today->day;
        $nextMonth = ($currentMonth % 12) + 1;

        $upcomingBirthdays = Employee::where(function ($query) use ($currentMonth, $currentDay) {
            $query->whereMonth('dob', $currentMonth)
                ->whereDay('dob', '>', $currentDay)
                ->where('status', 'Active');
        })
        ->orWhere(function ($query) use ($nextMonth) {
            $query->whereMonth('dob', $nextMonth)
                ->where('status', 'Active');
        })
        ->selectRaw('fname, lname, DATE_FORMAT(dob, "%d-%m-%Y") as dob')
        ->orderByRaw('MONTH(dob), DAY(dob)')
        ->first();
        $upcomingworkanniversary = Employee::where(function ($query) use ($currentMonth, $currentDay) {
            $query->whereMonth('join_date', $currentMonth)
                ->whereDay('join_date', '>', $currentDay)
            ->where('status', 'Active');
        })
            ->orWhere(function ($query) use ($nextMonth) {
                $query->whereMonth('join_date', $nextMonth);
            })
            ->selectRaw('fname, lname, status, DATE_FORMAT(join_date, "%d-%m-%Y") as formatted_join_date')
            ->orderByRaw('MONTH(join_date), DAY(join_date)')  // Sort by month and then day
            ->first();

        $workanniversary = Employee::whereMonth('join_date', '=', $currentMonth)
            ->whereDay('join_date', '=', $currentDay)
            ->select('fname', 'lname')
            ->where('status', 'Active')
            ->get();

        $upcomingHolidays = Holiday::where('date', '>=', $currentDate)
            ->orderBy('date', 'asc')
            ->first();
        if ($upcomingHolidays) {
            $upcomingHolidays->date = Carbon::parse($upcomingHolidays->date)->format('l, d M Y');
        } else {
            $upcomingHolidays = null;
        }
        $leaveonToday = Leaves::whereDate('leave_date', $currentDate)
            ->where('leaves.status', 'Approve')
            ->where('employee.status', 'Active')
            ->join('employee', 'leaves.e_id', '=', 'employee.e_id')
            ->select('employee.fname', 'employee.lname', 'leaves.leave_for', 'employee.e_id')
            ->get();

        // Fetch employees with permanent WFH
        $permanentwfh = Employee::where('is_wfh_permanent', 1)
            ->where('employee.status', 'Active')
            ->select('employee.fname', 'employee.lname', 'e_id')
            ->get();

        $leaveonTodayIds = $leaveonToday->pluck('e_id');

        // Set permanent WFH employee data to null if they have leave today
        $permanentwfh->transform(function ($wfhEmployee) use ($leaveonTodayIds) {
            if ($leaveonTodayIds->contains($wfhEmployee->e_id)) {
                $wfhEmployee->fname = null;
                $wfhEmployee->lname = null;
                $wfhEmployee->e_id = null;
            }
            return $wfhEmployee;
        });
        // Remove null entries from permanentwfh collection
        $permanentwfh = $permanentwfh->filter(function ($wfhEmployee) {
            return $wfhEmployee->e_id !== null;
        });
        $wfhonToday  = Wfh::whereDate('wfh_date', $currentDate)
            ->where('wfh.status', 'Approve')
            ->where('employee.status', 'Active')
            ->join('employee', 'wfh.e_id', '=', 'employee.e_id')
            ->select('employee.fname', 'employee.lname', 'wfh.apply_for')
            ->get();
        $leavesummary = LeaveType::where('total_leave', '>', 0)->get();
        $year = date('Y');
        $currentMon = date('m');
        $currentCheckmon = date('n');
        $leavecountdate = LeaveCount::where('e_id', $e_id)
            ->where('mon', $currentCheckmon)
            ->where('year', $currentYear)->first();
        if ($leavecountdate) {
            $prCurrent = $leavecountdate->pr_current;
        } else {
            $prCurrent = 0;
        }
        foreach ($leavesummary as $key => $leaveType) {
            $StartDatePaidL = $currentYear . '-' . $currentMon . '-01';
            $startDate = $year . '-01-01';
            $startDateToUse = $leaveType->lt_id == 1 ? $StartDatePaidL : $startDate;
            $endDate = $year . '-12-31';
            $approvedLeaves = Leaves::where('leave_type', $leaveType->lt_id)
                ->where('status', 'Approve')
                ->where('e_id', $e_id)
                ->whereBetween('leave_date', [$startDateToUse, $endDate])
                ->get();

            $approvedLeavesCount = 0;
            $paidLeaveCount = 0;
            $remainingLeaves = 0;
            foreach ($approvedLeaves as $leave) {
                if ($leave->leave_for == 'first-half' || $leave->leave_for == 'second-half') {
                    $approvedLeavesCount += 0.5;
                } else {
                    $approvedLeavesCount += 1;
                }
                if ($leave->leave_type == 1) {
                    if ($leave->leave_for == 'first-half' || $leave->leave_for == 'second-half') {
                        $paidLeaveCount += 0.5;
                    } else {
                        $paidLeaveCount += 1;
                    }
                }
                if ($leave->leave_type == 1) {
                    $remainingLeaves = ($prCurrent - $paidLeaveCount);
                } else {
                    $remainingLeaves = $leaveType->total_leave - $approvedLeavesCount;
                }
            }

            if (count($approvedLeaves) > 0) {
                $leavesummary[$key]->reamingleave = $remainingLeaves;
            } else {
                if ($leaveType->lt_id == 1) {
                    $leavesummary[$key]->reamingleave = $prCurrent;
                } else {
                    $leavesummary[$key]->reamingleave = $leaveType->total_leave;
                }
            }
        }
        // end leave summary
        // $showBirthdayPopup = session('show_birthday_popup', false);

        // incomplete profile
        $education_qualification = Education_Qualification::where('e_id', $e_id)->first();
        $address = Address::where('e_id', $e_id)->first();
        $Emergency = EmergencyContact::where('e_id', $e_id)->first();
        $bank = BankInformation::where('e_id', $e_id)->first();
        $displayData = [
            'education_display' => $education_qualification ? 0 : 1,
            'address_display' => $address ? 0 : 1,
            'emergency_display' => $Emergency ? 0 : 1,
            'bank_display' => $bank ? 0 : 1,
        ];

        // show task
        $checktask = TaskManage::whereRaw('assign_task LIKE ?', ['%"' . $e_id . '"%'])->whereDate('created_at', $currentDate)->get();
        if ($checktask->isNotEmpty()) {
            $showtask = 1;
        } else {
            $showtask = 0;
        }
        $pendingleave = Leaves::where('status', '=', 'Pending')->count();
        $pendingwfh = Wfh::where('status', '=', 'Pending')->count();

   $rowtime = Attendance::where('e_id',  $empLogin['e_id'])->where('date', date('Y-m-d'))->first();
        return view('ims/dashboard', [
            'data' => $data,
            'employees' => $birthdaysToday,
            'workanniversaryes' => $workanniversary,
            'upcomingHolidays' => $upcomingHolidays,
            'leaveonToday' => $leaveonToday,
            'permanentwfh' => $permanentwfh,
            'wfhonToday' => $wfhonToday,
            'leavesummary' => $leavesummary,
            'upcomingBirthdays' => $upcomingBirthdays,
            'upcomingworkanniversary' => $upcomingworkanniversary,
            'birthdaysToday' => $birthdaysToday,
            // 'showBirthdayPopup' => $showBirthdayPopup,
            'displayData' => $displayData,
            'pendingleave' => $pendingleave,
            'pendingwfh' => $pendingwfh,
            'showtask' => $showtask,
            'time' => $rowtime->login_time
        ]);
    }

    public function destroyBirthdayPopupSession()
    {
        session()->forget('birthday_popup_shown');
        return response()->json(['status' => 'success']);
    }
}
