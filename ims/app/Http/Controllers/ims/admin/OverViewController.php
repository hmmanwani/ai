<?php

namespace App\Http\Controllers\ims\admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\ExtraHours;
use App\Models\Leaves;
use App\Models\LeaveType;
use App\Models\Team;
use App\Models\Wfh;
use Illuminate\Http\Request;

class OverViewController extends Controller
{
    // overview
    public function overview()
    {
        $totalEmployees = Employee::count();
        $totalTeam = Team::count();
        $pendingleave = Leaves::where('status', '=', 'Pending')->count();
        $pendingwfh = Wfh::where('status', '=', 'Pending')->count();
        $pendingextratime = ExtraHours::where('status', '=', 'Pending')->count();
        return view('ims/admin/overview', [
            'totalEmployees' => $totalEmployees,
            'totalTeam' => $totalTeam,
            'pendingleave' => $pendingleave,
            'pendingwfh' => $pendingwfh,
            'pendingextratime' => $pendingextratime,
        ]);
    }
}