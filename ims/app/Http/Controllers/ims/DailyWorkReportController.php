<?php

namespace App\Http\Controllers\ims;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Team;
use App\Models\Wfh;
use App\Models\Workreport;
use App\Models\Workreportsetting;
use App\Models\Workviewaccess;
use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DailyWorkReportController extends Controller
{
    protected $emailService;

    public function __construct(MailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function daily_work_report()
    {
        $emp_login = session()->get('emp_login', []);
        $empdata = '';
        $data = Employee::where('e_id', $emp_login['e_id'])->first();
        if ($data->work_report_team == null) {
            $show_project_task = 0;
        } else {
            $show_project_task = 1;
            $emp = Employee::where('status', 'Active')
                ->where('e_id', $emp_login['e_id'])
                ->select('work_report_team')
                ->first();
            $empId = json_decode($emp->work_report_team, true);
            $empdata = Employee::whereIn('employee.team', $empId)
                ->where('employee.status', 'Active')
                ->selectRaw("CONCAT(fname, ' ', lname) AS full_name, e_id")
                ->get();
        }
        if ($emp_login['team_lead'] == 0 && $data['work_report_team'] == null) {
            $accessname = Workviewaccess::where('e_id', $emp_login['e_id'])
                ->pluck('access_emp')
                ->toArray();
            $mergedAccessEmp = [];
            foreach ($accessname as $item) {
                $mergedAccessEmp = array_merge($mergedAccessEmp, json_decode($item, true));
            }
            $empdata = Employee::whereIn('e_id', $mergedAccessEmp)
                ->where('employee.status', 'Active')
                ->selectRaw("CONCAT(fname, ' ', lname) as full_name, e_id")
                ->get();
        }
        return view(
            'ims.project.daily-work-report.daily-work-report',
            [
                'show_project_task' => $show_project_task,
                'emp' => $empdata
            ]
        );
    }

    public function work_email_setting()
    {
        return view('ims.project.daily-work-report.work-email-setting');
    }
    public function get_team_emp_list(Request $request)
    {
        $emp_login = session()->get('emp_login', []);
        $post = $request->input();
        $emp_login = session()->get('emp_login');
        if ($post) {
            $field_pos = array('t_id' => '0', 'name' => '1', 'team' => '2');
            $sort_field = array_search($post['order']['0']['column'], $field_pos);
            if ($post['order']['0']['dir'] == 'asc') {
                $orderBy = "ASC";
            } else {
                $orderBy = 'DESC';
            }
            // DB::enableQueryLog();
            $TotalRecord = Workreportsetting::getTeamEmpList($post, $sort_field, $orderBy, 0);
            $emplists = Workreportsetting::getTeamEmpList($post, $sort_field, $orderBy, 1);
            $iTotalRecords = $TotalRecord['NumRecords'];
            $records = array();
            $records['data'] = array();
            foreach ($emplists as $key => $value) {
                $isCheck = Workreportsetting::where('e_id', $value->e_id)->where('leder_id', $emp_login['e_id'])->where('status', 1)->first();
                if ($isCheck) {
                    $checked = 'checked';
                } else {
                    $checked = '';
                }
                // $checked = 'checked';
                $status = '<div><input type="checkbox" class="js-switch"  data-id="' . $value->e_id . '" data-leader-id="' . $emp_login['e_id'] . '" ' . $checked . ' /></div>';
                $records['data'][] = array(
                     ($iTotalRecords - (($post['start'] ?? 0) + $key)),
                    ucfirst($value->fname) . ' ' . $value->lname,
                    $value->team_name,
                    $status
                );
            }
            $records['draw'] = intval($post['draw']);
            $records['recordsTotal'] = $iTotalRecords;
            $records['recordsFiltered'] = $iTotalRecords;
            echo json_encode($records);
            exit();
        }
    }
    public function update_work_report_setting_status(Request $req)
    {
        $emp_login = session()->get('emp_login');
        $recoord = Workreportsetting::where('e_id', $req->e_id)->where('leder_id', $req->l_id)->first();
        if ($recoord) {
            $recoord->status = $req->status;
            $recoord->save();
            return response()->json(['message' => 'success']);
        } else {
            $data = new Workreportsetting();
            $data->e_id = $req->e_id;
            $data->leder_id = $emp_login['e_id'];
            $data->status = $req->status;
            $save = $data->save();
            if ($save) {
                return response()->json(['message' => 'success']);
            } else {
                return response()->json(['message' => 'error']);
            }
        }
    }
    public function internal_team_access()
    {
        $emp_login = session()->get('emp_login', []);
        $emp = Employee::where('status', 'Active')
            ->where('e_id', $emp_login['e_id'])
            ->where('team_lead', 1)
            ->select('team', 'work_report_team')
            ->first();
        $workReportTeams = json_decode($emp->work_report_team, true);
        $name = Employee::whereIn('employee.team', $workReportTeams)
            ->join('teams', 'teams.t_id', '=', 'employee.team')
            ->where('employee.e_id', '!=', $emp_login['e_id'])
            ->where('employee.status', 'Active')
            ->selectRaw("CONCAT(fname, ' ', lname) as fullname, teams.team, employee.e_id")
            ->get();
        return view('ims.project.daily-work-report.internal-team-access', ['name' => $name]);
    }
    public function get_internal_team_list(Request $request)
    {
        $emp_login = session()->get('emp_login', []);
        $post = $request->input();
        if ($post) {
            $field_pos = array('t_id' => '0', 'name' => '1', 'team' => '2');
            $sort_field = array_search($post['order']['0']['column'], $field_pos);
            if ($post['order']['0']['dir'] == 'asc') {
                $orderBy = "ASC";
            } else {
                $orderBy = 'DESC';
            }
            $TotalRecord = Workreportsetting::getInternalTeamList($post, $sort_field, $orderBy, 0);
            $internalteamlist = Workreportsetting::getInternalTeamList($post, $sort_field, $orderBy, 1);
            $iTotalRecords = $TotalRecord['NumRecords'];
            $records = array();
            $records['data'] = array();
            foreach ($internalteamlist as $key => $value) {
                $status  = '<div class="d-flex f-18 justify-content-start"><a href="javascript:void(0)" id="internal_team_' . $key . '" data-id="' . $value->e_id . '" data-leader-id="' . $emp_login['e_id'] . '"><i class="fa fa-plus" aria-hidden="true"></i></a></div>';
                $records['data'][] = array(
                     ($iTotalRecords - (($post['start'] ?? 0) + $key)),
                    ucfirst($value->fname) . ' ' . $value->lname,
                    $value->team_name,
                    $status
                );
            }
            $records['draw'] = intval($post['draw']);
            $records['recordsTotal'] = $iTotalRecords;
            $records['recordsFiltered'] = $iTotalRecords;
            echo json_encode($records);
            exit();
        }
    }
    // public function 
    public function update_work_view_access_emp(Request $req)
    {
        $check = Workviewaccess::where('l_id', $req->l_id)
            ->where('e_id', $req->e_id)
            ->first();
        if ($check) {
            if ($req->emp == null) {
                $WorkViewAccess = Workviewaccess::where('l_id', $req->l_id)
                    ->where('e_id', $req->e_id)
                    ->delete();
                session()->flash('notification', ['type' => 'success', 'message' => "Access Update successfully."]);
                return redirect('internal-team-access');
            }
            $WorkViewAccess = Workviewaccess::where('l_id', $req->l_id)
                ->where('e_id', $req->e_id)->update(['access_emp' => json_encode($req->emp)]);
            session()->flash('notification', ['type' => 'success', 'message' => "Access Update successfully."]);
            return redirect('internal-team-access');
        } else {
            $WorkViewAccess = new Workviewaccess();
            $WorkViewAccess->l_id = $req->l_id;
            $WorkViewAccess->e_id = $req->e_id;
            $WorkViewAccess->access_emp = json_encode($req->emp);
            $WorkViewAccess->save();
        }
        if ($WorkViewAccess) {
            session()->flash('notification', ['type' => 'success', 'message' => "Access Update successfully."]);
            return redirect('internal-team-access');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect('daily-work-report');
        }
    }
    public function get_internal_team_member_emp(Request $req)
    {
        $data = Workviewaccess::where('l_id', $req->l_id)
            ->where('e_id', $req->e_id)
            ->select('access_emp')
            ->get();
        $Ids = json_decode($data[0]->access_emp);
        $emp = Employee::whereIn('e_id', $Ids)
            ->selectRaw("CONCAT(fname, ' ', lname) as full_name, e_id")
            ->get();
        return response()->json(['success' => true, 'data' => $emp]);
    }
    public function add_work_report()
    {
        $emp_login = session('emp_login');
        $loginTime = Attendance::where('e_id', $emp_login['e_id'])
            ->where('date', date('Y-m-d'))
            ->selectRaw("TIME_FORMAT(login_time, '%h:%i %p') as time")
            ->first();
        $showtask = Workreport::where('e_id', $emp_login['e_id'])
            ->where('work_date', date('Y-m-d'))
            ->count();
        return view('ims.project.daily-work-report.add-work-report', ['loginTime' => $loginTime->time, 'showtask' => $showtask]);
    }
    public function submit_add_work_report(Request $req)
    {

        $emp_login = session('emp_login');
        $currentTime = now()->format('d.m.Y');
        $currentDate = now()->format('Y-m-d');

        $work_title = Employee::where('e_id', $emp_login['e_id'])
            ->selectRaw("CONCAT(fname, ' ', lname) as full_name")
            ->value('full_name') . '_' . $currentTime;
         // insert the login time(if change anyone)
        $emp_login = session('emp_login');
        $loginTime = Attendance::where('e_id', $emp_login['e_id'])
            ->where('date', date('Y-m-d'))
            ->selectRaw("TIME_FORMAT(login_time, '%h:%i %p') as time")
            ->first();
        $updatedReport = preg_replace(
            '/(Please note that my Login time today is\s+)[^\n\.]+/',
            '$1 ' . $loginTime->time,
            $req->workreport
        );
        $data = [
            'e_id' => $emp_login['e_id'],
            'team' => $emp_login['team'],
            'work_date' =>  $currentDate,
            'work_title' => $work_title,
            'description' => $updatedReport,
        ];
        $save = Workreport::create($data);

        if ($save) {

            // make email title for email
            if ($data = Employee::where('is_wfh_permanent', 1)
                ->where('status', 'Active')
                ->where('e_id', $emp_login['e_id'])
                ->selectRaw("CONCAT(fname, ' ', lname) as full_name")
                ->first()
            ) {
                $work_title = 'Work From Home_' . $data->full_name . '_' . $currentTime;
            } elseif ($wfhRecord = Wfh::whereDate('wfh.wfh_date', $currentDate)
                ->where('wfh.e_id', $emp_login['e_id'])
                ->where('wfh.status', 'Approve')
                ->join('employee', 'wfh.e_id', '=', 'employee.e_id')
                ->where('employee.status', 'Active')
                ->selectRaw("CONCAT(employee.fname, ' ', employee.lname) as full_name")
                ->first()
            ) {
                $work_title = 'Work From Home_' . $wfhRecord->full_name . '_' . $currentTime;
            } else {
                $data = Employee::where('e_id', $emp_login['e_id'])
                    ->selectRaw("CONCAT(fname, ' ', lname) as full_name")
                    ->first();
                $work_title = 'Work From Office_' . $data->full_name . '_' . $currentTime;
            }

            // check email setting for work report
            $check = Workreportsetting::where('work_report_setting.e_id', $emp_login['e_id'])
                ->where('work_report_setting.status', 1)
                ->join('employee', 'employee.e_id', '=', 'work_report_setting.leder_id')
                ->select('employee.email')
                ->get();


            if ($check->isNotEmpty()) {
                $msg = $work_title;

                foreach ($check as $email) {
                    $to = $email->email; // To email
                    $this->emailService->sendMail($to, $msg, 'ims/mail/dailtworkreportmail', ['data' => $req->workreport]);
                }
            }

            session()->flash('notification', ['type' => 'success', 'message' => "Report inserted successfully."]);
            return redirect('daily-work-report');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect('add-work-report');
        }
        return redirect('add-work-report');
    }
    public function get_work_list(Request $request)
    {
        $post = $request->input();
        if ($post) {
            $field_pos = array('wr_id' => '0', 'name' => '1', 'team' => '2', 'title' => '3', 'description' => '4');
            $sort_field = array_search($post['order']['0']['column'], $field_pos);
            if ($post['order']['0']['dir'] == 'asc') {
                $orderBy = "ASC";
            } else {
                $orderBy = 'DESC';
            }
            $TotalRecord = Workreport::getworklist($post, $sort_field, $orderBy, 0);
            $worklists = Workreport::getworklist($post, $sort_field, $orderBy, 1);
            $iTotalRecords = $TotalRecord['NumRecords'];
            $records = array();
            $records['data'] = array();
            foreach ($worklists as $key => $value) {
                $value = (object) $value; // Ensure $value is treated as an object
                $action = '<div class="d-flex f-18 justify-content-start"><a href="javascript:void(0)" id="Work-details_' . $value->wr_id  . '" data-id="' . $value->e_id . '" data-date="' . $value->work_date . '"><i class="fa fa-eye" aria-hidden="true"></i></a></div>';
                $records['data'][] = array(
                    ($iTotalRecords - (($post['start'] ?? 0) + $key)),
                    ucfirst($value->fname) . ' ' . $value->lname,
                    $value->team,
                    '<b>' . date('d-m-Y', strtotime($value->work_date)) . '</b>',
                    $action,
                );
            }
            $records['draw'] = intval($post['draw']);
            $records['recordsTotal'] = $iTotalRecords;
            $records['recordsFiltered'] = $iTotalRecords;
            echo json_encode($records);
            exit();
        }
    }
    public function work_info(Request $req)
    {
        $data = Workreport::where('e_id', $req->id)
            ->where('work_date', $req->date)
            ->select('description', DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y %h:%i %p') as formatted_created_at"))
            ->get();
        if ($data) {
            return response()->json(['data' => $data]);
        } else {
            return response()->json(['data' => null]);
        }
        return response()->json(['data' => $data]);
    }
}
