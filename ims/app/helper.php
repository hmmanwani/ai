<?php

use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\ExtraHours;
use App\Models\Holiday;
use App\Models\LeaveCount;
use App\Models\Leaves;
use App\Models\LeaveType;
use App\Models\Salary;
use App\Models\Wfh;
use Illuminate\Support\Facades\URL;


function get_client_ip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
function browser_info()
{
    if (preg_match('/(opera|chrome|safari|firefox|msie|trident|edge|ucbrowser|brave|vivaldi|yabrowser|qqbrowser|coc_coc_browser|sleipnir|midori|comodo_dragon|yandex_browser|palemoon|iceweasel|seamonkey|iceape|flock|icecat|iron|phoenix|coolnovo|avant|aol|camino|chimera|conkeror|lynx|dillo|epiphany|netscape|galeon|opera mini|opera mobi|webtv|playstation|silk|puffin|maxthon|k_meleon|lunascape|slim|baidu|maple|maplesyrup)[\/\s]([\d\.]+)/i', $agent = $_SERVER["HTTP_USER_AGENT"], $matches)) {
        $browser = $matches[1];
        $version = $matches[2];
        return $matches;
    }
}

// get the isp
function getUserCountry()
{
    $ip = $_SERVER['REMOTE_ADDR']; // Get user's IP address
    // Use an external API to get geolocation info
    $geoData = @file_get_contents("http://ip-api.com/json/{$ip}");
    if ($geoData) {
        $geoData = json_decode($geoData, true);
        return $geoData['isp'] ?? 'NULL'; // Default to 'US' if not found
    }

    return 'NULL';
}

/* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : Get Attendance
     use for  : Send the data in the view attendance module in the calendar
     ---------------------------------------------------------------------------------------------------------*/
function getAttendance($attDate, $ep_id = '')
{
    if ($ep_id == '') {
        $sessionData = session('emp_login');
        $e_id = $sessionData['e_id'];
    } else {
        $e_id = $ep_id;
    }
    $date = $attDate;
    $sdate = Carbon::parse($attDate);
    $weekend = 0;
    $holidayinfo = Holiday::whereDate('date', $date)->first();
    if ($sdate->isSaturday() || $sdate->isSunday()) {
        $weekend = 1;
    }
    $leaveinfo = Leaves::where('e_id', $e_id)->whereDate('leave_date', $date)->where('status', 'Approve')->first();
    $attendanceinfo = Attendance::where('e_id', $e_id)->whereDate('date', $date)->first();
    $extraInfo = Attendance::where('e_id', $e_id)->whereDate('date', $date)->whereNotNull('ex_id')->first();
    $Wfhinfo = Wfh::where('e_id', $e_id)->whereDate('wfh_date', $date)->where('status', 'Approve')->first();
    if ($extraInfo) {
        $extraInfo = 'yes';
    } else {
        $extraInfo = '';
    }
    
    $class = '';
    $content = '';
    $info = '';
    $HRS = '';
    $workingh = $attendanceinfo ? $attendanceinfo->working_hours : null;

    // if today
    if ($date == date('Y-m-d') ) {
        if ($attendanceinfo == null) {
            $class = 'leave';
            $content = 'L';
        }else if ($holidayinfo) {
            $class = 'holiday';
            $content = 'H';
        }else if ($weekend) {
            $class = 'weekend';
            $content = 'S';
        }else if($Wfhinfo){
            $class = 'WorkFromHome';
            $content = 'W';
        }else if ($leaveinfo) { 
            if ($leaveinfo->leave_for == 'full-day') {
                if ($leaveinfo->leave_type == 2) {
                    $class = 'leave';
                    $content = 'SL';
                } elseif ($leaveinfo->leave_type == 3) {
                    $class = 'leave';
                    $content = 'VL';
                } elseif ($leaveinfo->leave_type == 4) {
                    $class = 'leave';
                    $content = 'OL';
                } else {
                    $class = 'leave';
                    $content = 'L';
                }
            } else if ($leaveinfo->leave_for == 'second-half') {
                $class = 'halfday';
                $content = 'SH';
            } else {
                $class = 'halfday';
                $content = 'FH';
            }
        } 
        else{
            $class = 'presence';
            $content = 'P';
        }
        $info = array(
            'class' => $class,
            'content' => $content,
            'extraInfo' => $extraInfo,
            'HRS' => $HRS
        );
    } else {
        if ($holidayinfo) {
            $class = 'holiday';
            $content = 'H';
            $info = array(
                'class' => $class,
                'content' => $content,
                'extraInfo' => $extraInfo,
                'HRS' => $HRS
            );
        } else if ($weekend) {

            if ($attendanceinfo) {
                $class = 'presence';
                $content = 'P';
                $HRS = 'HRS : ' . ($workingh ? $workingh : '-');
            } else {
                $class = 'weekend';
                $content = 'S';
            }
            $info = array(
                'class' => $class,
                'content' => $content,
                'extraInfo' => $extraInfo,
                'HRS' => $HRS
            );
        }
        if ($leaveinfo) {
            if ($leaveinfo->leave_for == 'full-day') {
                if ($leaveinfo->leave_type == 2) {
                    $class = 'leave';
                    $content = 'SL';
                } elseif ($leaveinfo->leave_type == 3) {
                    $class = 'leave';
                    $content = 'VL';
                } elseif ($leaveinfo->leave_type == 4) {
                    $class = 'leave';
                    $content = 'OL';
                } else {
                    $class = 'leave';
                    $content = 'L';
                }
            } else if ($leaveinfo->leave_for == 'second-half') {
                $class = 'halfday';
                $content = 'SH';
                $HRS = 'HRS : ' . ($workingh ? $workingh : '-');
            } else {
                $class = 'halfday';
                $content = 'FH';
                $HRS = 'HRS : ' . ($workingh ? $workingh : '-');
            }
            $info = array(
                'class' => $class,
                'content' => $content,
                'extraInfo' => $extraInfo,
                'HRS' => $HRS
            );
        }
        if ($Wfhinfo) {
            $class = 'WorkFromHome';
            $content = 'W';
            $info = array(
                'class' => $class,
                'content' => $content,
                'extraInfo' => $extraInfo,
                'HRS' => $HRS
            );
        }
        if ($attendanceinfo) {
            $forgetLG = Attendance::where('e_id', $e_id)->whereDate('date', $date)->whereNotNull('login_time')->whereNull('logout_time')->whereNull('working_hours')->whereNull('presence')->first();
            // return $attendanceinfo;
            if ($attendanceinfo->is_early_leave == 1) {
                $class = 'early-leave';
                $content = 'EL';
                $HRS = 'HRS : ' . ($workingh ? $workingh : '-');
                $info = array(
                    'class' => $class,
                    'content' => $content,
                    'extraInfo' => $extraInfo,
                    'HRS' => $HRS
                );
            } elseif ($Wfhinfo) {
                $class = 'WorkFromHome';
                $content = 'W';
                $HRS = 'HRS : ' . ($workingh ? $workingh : '-');
                $info = array(
                    'class' => $class,
                    'content' => $content,
                    'extraInfo' => $extraInfo,
                    'HRS' => $HRS
                );
            } 
            // elseif ($Wfhinfo && $leaveinfo) {
            //     $class = 'WFhLeave';
            //     $content = 'W & L';
            //     $HRS = 'HRS : ' . ($workingh ? $workingh : '-');
            //     $info = array(
            //         'class' => $class,
            //         'content' => $content,
            //         'extraInfo' => $extraInfo,
            //         'HRS' => $HRS
            //     );
            // } 
            else {
                if ($attendanceinfo->presence == null) {
                    if ($attDate < date('Y-m-d')) {
                        $class = 'presence';
                        $content = 'P';
                        $HRS = 'HRS : ' . ($workingh ? $workingh : '-');
                    }
                    if ($attDate == date('Y-m-d')) {
                        $class = 'presence';
                        $content = 'P';
                        $HRS = 'HRS : ' . ($workingh ? $workingh : '-');
                    }
                } else if ($attendanceinfo->presence == 0) {
                    $class = 'presence';
                    $content = 'P';
                    $HRS = 'HRS : ' . ($workingh ? $workingh : '-');
                } else if ($attendanceinfo->presence == 1) {
                    $class = 'halfday';
                    $content = 'P';
                    $HRS = 'HRS : ' . ($workingh ? $workingh : '-');
                } else if ($attendanceinfo->presence == 3) {
                    $class = 'leave';
                    $content = 'L';
                    $HRS = 'HRS : ' . ($workingh ? $workingh : '-');
                } else if ($attendanceinfo->presence == 4) {
                    $class = 'leave';
                    $content = 'L';
                    $HRS = 'HRS : ' . ($workingh ? $workingh : '-');
                }

                if ($forgetLG) {
                    $class = 'leave';
                    $content = 'P';
                    $HRS = 'HRS : ' . ($workingh ? $workingh : '-');
                }
                $info = array(
                    'class' => $class,
                    'content' => $content,
                    'extraInfo' => $extraInfo,
                    'HRS' => $HRS
                );
            }
        }
       
        if ($Wfhinfo && $leaveinfo) {
            $class = 'WFhLeave';
            $content = 'W & L';
            $HRS = 'HRS : ' . ($workingh ? $workingh : '-');
            $info = array(
                'class' => $class,
                'content' => $content,
                'extraInfo' => $extraInfo,
                'HRS' => $HRS
            );
        } 
    }

    if ($date < date('Y-m-d') && empty($info)) {
        $class = 'leave';
        $content = 'L';
        $info = array(
            'class' => $class,
            'content' => $content,
            'extraInfo' => $extraInfo,
            'HRS' => $HRS
        );
    }
    return $info;
}

/* --------------------------------------------------------------------------------------------------------
        Devloper : Utsav Savaliya
        function : Get Attendance Details
        use for : Send the Particluer date details in the view attendance module in the calendar
        ---------------------------------------------------------------------------------------------------------*/
function getAttendanceDetails($attDate, $ep_id = '')
{
    // Determine employee ID
    if ($ep_id == '') {
        $sessionData = session('emp_login');
        $e_id = $sessionData['e_id'];
    } else {
        $e_id = $ep_id;
    }
    $date = $attDate;
    $changedate = DateTime::createFromFormat('Y-m-d', $date);
    $formattedDate = $changedate->format('d-m-Y');
    $sdate = Carbon::parse($attDate);
    $weekend = 0;
    $holidayinfo = Holiday::whereDate('date', $date)->first();

    // Check for weekends
    if ($sdate->isSaturday() || $sdate->isSunday()) {
        $weekend = 1;
        $day = $sdate->isSaturday() ? "Saturday" : "Sunday";
    }

    $leaveinfo = Leaves::where('e_id', $e_id)->whereDate('leave_date', $date)->where('status', 'Approve')->first();
    $attendanceinfo = Attendance::where('e_id', $e_id)->whereDate('date', $date)->first();
    $extraInfo = Attendance::where('e_id', $e_id)->whereDate('date', $date)->whereNotNull('ex_id')->first();
    $Wfhinfo = Wfh::where('e_id', $e_id)->whereDate('wfh_date', $date)->where('status', 'Approve')->first();
    // $check = Leaves::where('leave_date', $date)->where('is_sandwich', 1)->first();
    if ($extraInfo) {
        $extraInfo = 'yes';
    } else {
        $extraInfo = '';
    }
    $class = '';
    $content = '';
    $info = [];
    // Check for extra working hours
    if ($attendanceinfo && $attendanceinfo->ex_id !== null) {
        $extraHoursInfo = ExtraHours::where('ex_id', $attendanceinfo->ex_id)->where('status', 'Approve')->first();
        if ($extraHoursInfo) {
            $ex_starting_time = date('d-m-Y h:i A', strtotime($extraHoursInfo->starting_time));
            $ex_ending_time = date('d-m-Y h:i A', strtotime($extraHoursInfo->ending_time));
            $ex_working_hour = $extraHoursInfo->working_hour;

            $info['extra_working'] = array(
                'extra_working_starting_time' => $ex_starting_time,
                'extra_working_ending_time' => $ex_ending_time,
                'extra_working_working_hour' => $ex_working_hour,
            );
        }
    }

    // Handle holidays
    if ($holidayinfo) {
        $holiday = $holidayinfo->holiday;
        $class = 'holiday';
        $content = 'Holiday';
        $info['holiday'] = array(
            'class' => $class,
            'content' => $content,
            'extraInfo' => $extraInfo,
            'data' => $formattedDate,
            'holiday' => $holiday,
        );
    }

    // Handle leaves
    if ($leaveinfo) {
        $reason = $leaveinfo->leave_reason;
        if ($leaveinfo->leave_for == 'full-day') {
            $class = 'leave';
            $content = 'Leave';
        } else if ($leaveinfo->leave_for == 'second-half') {
            if ($attendanceinfo) {
                $class = 'halfday';
                $content = 'second Half';
                // exit the leaveinfo condition and execute the attendance login ,to send the ( attendance data + leave data)
            } else {
                $class = 'halfday';
                $content = 'second Half';
            }
        } else {
            if ($attendanceinfo) {
                $class = 'halfday';
                $content = 'First Half';
            } else {
                $class = 'halfday';
                $content = 'First Half';
            }
        }
      if ($leaveinfo && $Wfhinfo) {
            $leave_name = LeaveType::where('lt_id', $leaveinfo->leave_type)->first();
            $leave_name = $leave_name->leave_type;
            $class = 'WFhLeave';
            $content = 'WFH & '. $leave_name;
        }
        $info['leave'] = array(
            'class' => $class,
            'content' => $content,
            'extraInfo' => $extraInfo,
            'data' => $formattedDate,
            'reason' => $reason,
        );
    }
    // Handle weekends
    if ($weekend) {
        if ($attendanceinfo) {
            // exit the weekend condication and excute the Handle attendance code
        } else {
            $class = 'weekend';
            $content = $day;
            $info['weekend'] = array(
                'class' => $class,
                'content' => $content,
                'extraInfo' => $extraInfo,
                'data' => $formattedDate,
            );
        }
    }

    // Handle attendance
    if ($attendanceinfo) {
        $forgetLG = Attendance::where('e_id', $e_id)->whereDate(
            'date',
            $date
        )->whereNotNull('login_time')->whereNull('logout_time')->whereNull('working_hours')->whereNull('presence')->whereDate(
            'date',
            '!=',
            date('Y-m-d')
        )->first();
        $login = $attendanceinfo->login_time ? Carbon::parse($attendanceinfo->login_time)->format('h:i:s A') : '';
        $logout = $attendanceinfo->logout_time ? Carbon::parse($attendanceinfo->logout_time)->format('h:i:s A') : '';
        $workingh = $attendanceinfo->working_hours;
        $reason = '';
        $presence = '';

        if ($attendanceinfo->presence == 0) {
            $class = 'presence';
            $content = 'Present';
            $presence = '0';
        }
        if ($attendanceinfo->presence == 1) {
            $class = 'halfday';
            $content = 'Half Day';
            $presence = '1';
        }
        if ($attendanceinfo->presence == 3) {
            $class = 'leave';
            $content = 'Leave';
            $presence = '3';
            $reason = 'You have done early clock out.';
        }
        if ($attendanceinfo->presence == 4) {
            $class = 'leave';
            $content = 'Leave';
            $presence = '4';
            $reason = 'data not found';
        }
        if ($forgetLG) {
            $class = 'leave';
            $content = 'presence';
            $reason = 'It seems like you might have forgotten to clock out.';
        }
        if ($attendanceinfo->is_early_leave == 1) {
            $class = 'early-leave';
            $content = 'Early Leave';
            $presence = '5';
            $reason = $attendanceinfo->reason;
        }
        if ($Wfhinfo) {
            $class = 'WorkFromHome';
            $content = 'Work From Home';
            $presence = '6';
            $reason = $Wfhinfo->apply_reason;
        }
        if ($leaveinfo && $Wfhinfo) {
            $class = 'WFhLeave';
            $content = 'Work From Home & Leave';
            $presence = '7';
            $reason = "Leave :- $leaveinfo->leave_reason<br> WFH :- $Wfhinfo->apply_reason";
            
        }
        // Add attendance info to the response
        $info['attendance'] = array(
            'class' => $class,
            'content' => $content,
            'extraInfo' => $extraInfo,
            'data' => $formattedDate,
            'login' => $login,
            'logout' => $logout,
            'workingh' => $workingh,
            'reason' => $reason,
            'presence' => $presence,
            'extra_working_starting_time' => isset($extraHoursInfo) ? date(
                'd-m-Y h:i A',
                strtotime($extraHoursInfo->starting_time)
            ) : '',
            'extra_working_ending_time' => isset($extraHoursInfo) ? date(
                'd-m-Y h:i A',
                strtotime($extraHoursInfo->ending_time)
            ) : '',
            'extra_working_working_hour' => isset($extraHoursInfo) ? $extraHoursInfo->working_hour : '',
        );
    }
    // Handle cases where no info is found
    if ($date < date('Y-m-d') && empty($info)) {
        $info = [];
        $class = 'leave';
        $content = 'Leave';
        $info['notfound'] = array(
            'class' => $class,
            'content' => $content,
            'extraInfo' => $extraInfo,
            'data' => $formattedDate,
            'reason' => 'Data not found.',
        );
    }
    if (empty($info)) {
        $info = [];
        $class = 'leave';
        $content = 'Leave';
        $info['notfound'] = array(
            'class' => $class,
            'content' => $content,
            'extraInfo' => $extraInfo,
            'data' => $formattedDate,
            'reason' => 'Data not found.',
        );
    }
    return $info;
}


function getSalaryDetails($e_id, $mon, $year)
{
    $salDetails = LeaveCount::where('e_id', $e_id)->where('mon', $mon)->where('year', $year)->get();
    return $salDetails;

    $salDetails = array(
        'totalPayable' => 30,
        'totalWorkingDay' => 30,
        'totalLossDay' => 2,
        'payableDays' => 28,
        'basic' => 0,
        'pt' => 0,
        'deduction' => 0,
        'salary' => 35000,
        'inWord' => 'Thirty Five Thousand'
    );
}

function baseUrl()
{
    return URL::to('/');
}
