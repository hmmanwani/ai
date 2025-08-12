<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workreportsetting extends Model
{
    use HasFactory;
    protected $table = 'work_report_setting';
    protected $primaryKey = 'wrs_id';
    // daliy work report team employee list
    public static function getTeamEmpList($Data, $sort_field, $orderBy, $c)
    {
        $emp_login = session()->get('emp_login');
        // $query = Workreportsetting::query();

        // Apply search filters
        $emp = Employee::where('status', 'Active')
            ->where('e_id', $emp_login['e_id'])
            ->where('team_lead', 1)
            ->where('work_report_team', '!=', null)
            ->select('team', 'work_report_team')
            ->first();
        $workReportTeams = json_decode($emp->work_report_team, true);
        $query = Employee::whereIn('employee.team', $workReportTeams)
            ->where('employee.status', 'Active')
            ->where('employee.e_id', '!=', $emp_login['e_id'])
            ->join('teams', 'teams.t_id', '=', 'employee.team')
            // ->leftJoin('work_report_setting as wrs', 'wrs.e_id', '=', 'employee.e_id')
            ->select(
                'employee.fname',
                'employee.lname',
                'teams.team as team_name',
                'employee.e_id',
                // DB::raw('COALESCE(wrs.status, 0) as email_status')
            );
        if (!empty($Data['search']['value'])) {
            $query->where(function ($q) use ($Data) {
                $q->where('e_id', "LIKE", "%{$Data['search']['value']}%")
                    ->orWhere('fname', "LIKE", "%{$Data['search']['value']}%")
                    ->orWhere('lname', "LIKE", "%{$Data['search']['value']}%");
            });
        }
        if (!empty($sort_field) && !empty($orderBy)) {
            $query->orderBy($sort_field, $orderBy);
        }

        if ($c == 1) {
            if ($Data['length'] != -1) {
                $query->offset($Data['start']);
                $query->limit($Data['length']);
            }
            return $query->get();
        } else {
            return ['NumRecords' => $query->count()];
        }
    }
    public static function getInternalTeamList($Data, $sort_field, $orderBy, $c)
    {
        $emp_login = session()->get('emp_login');
        // $query = Workreportsetting::query();

        // Apply search filters


        $emp = Employee::where('status', 'Active')
            ->where('e_id', $emp_login['e_id'])
            ->where('team_lead', 1)
            ->select('team', 'work_report_team')
            ->first();

        $workReportTeams = json_decode($emp->work_report_team, true);

        $query = Employee::whereIn('employee.team', $workReportTeams)
            ->where('employee.status', 'Active')
            ->where('employee.e_id', '!=', $emp_login['e_id'])
            ->join('teams', 'teams.t_id', '=', 'employee.team')
            // ->leftJoin('work_report_setting as wrs', 'wrs.e_id', '=', 'employee.e_id')
            ->select(
                'employee.fname',
                'employee.lname',
                'teams.team as team_name',
                'employee.e_id',
                // DB::raw('COALESCE(wrs.status, 0) as email_status')
            );
        if (!empty($Data['search']['value'])) {
            $query->where(function ($q) use ($Data) {
                $q->where('e_id', "LIKE", "%{$Data['search']['value']}%")
                    ->orWhere('fname', "LIKE", "%{$Data['search']['value']}%")
                    ->orWhere('lname', "LIKE", "%{$Data['search']['value']}%");
            });
        }
        if (!empty($sort_field) && !empty($orderBy)) {
            $query->orderBy($sort_field, $orderBy);
        }

        if ($c == 1) {
            if ($Data['length'] != -1) {
                $query->offset($Data['start']);
                $query->limit($Data['length']);
            }
            return $query->get();
        } else {
            return ['NumRecords' => $query->count()];
        }
    }
}















// public static function getTeamEmpList($Data, $sort_field, $orderBy, $c)
// {
//     $emp_login = session()->get('emp_login');
//     $query = Employee::query();

//     // Apply search filters
//     if (!empty($Data['search']['value'])) {
//         $query->where(function ($q) use ($Data) {
//             $q->where('e_id', "LIKE", "%{$Data['search']['value']}%")
//                 ->orWhere('fname', "LIKE", "%{$Data['search']['value']}%")
//                 ->orWhere('lname', "LIKE", "%{$Data['search']['value']}%");
//         });
//     }

//     $emp = Employee::where('status', 'Active')
//         ->where('e_id', $emp_login['e_id'])
//         ->where('team_lead', 1)
//         ->select('team', 'work_report_team',)
//         ->first();

//     if (!$emp) {
//         return [];
//     }
//     $workReportTeams = json_decode($emp->work_report_team, true);
//     $query->whereIn('employee.team', $workReportTeams)
//         ->where('status', 'Active')
//         ->join('teams', 'teams.t_id', '=', 'employee.team')
//        //  ->join('work_report_setting', 'work_report_setting.team_id', '=', 'employee.team') // Join the work_report_setting table
//         ->select(
//             'employee.team', 'employee.e_id',
//             DB::raw("CONCAT(employee.fname, ' ', employee.lname) as full_name"),
//             'teams.team as team_name',
//         );

//     if (!empty($sort_field) && !empty($orderBy)) {
//         $query->orderBy($sort_field, $orderBy);
//     }

//     if ($c == 1) {
//         if ($Data['length'] != -1) {
//             $query->offset($Data['start']);
//             $query->limit($Data['length']);
//         }
//         return $query->get();
//     } else {
//         return ['NumRecords' => $query->count()];
//     }
// }
