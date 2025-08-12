<?php

namespace App\Http\Controllers\ims;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ViewAttendanceController extends Controller
{
    public function viewattendance()
    {
        return view('ims/attendance/view-attendance');
    }
    public function sendDate(Request $req)
    {
        $year = $req->year;
        $month = $req->month;
        $day = $req->day;
        $date = Carbon::createFromDate($year, $month, $day);
        $formattedDate = $date->format('Y-m-d');
        $data = getAttendanceDetails($formattedDate, $req->e_id);
        // return $data;
        if (!$data) {
            return response()->json(['error' => 'No data found for this date'], 404);
        }
        return response()->json(['data' => $data]);
    }
}
