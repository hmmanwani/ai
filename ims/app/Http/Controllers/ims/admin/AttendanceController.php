<?php

namespace App\Http\Controllers\ims\admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function admin_view_attedance()
    {
        $data = Employee::where('status', 'Active')->select('e_id', 'fname', 'lname')->get();
        return view('ims/admin/view-attendance/admin-view-attendance', ['data' => $data]);
    }
}