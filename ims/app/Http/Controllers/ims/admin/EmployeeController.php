<?php

namespace App\Http\Controllers\ims\admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\AddressChange;
use App\Models\Attendance;
use App\Models\BankInformation;
use App\Models\BankInformationChange;
use App\Models\Education_Qualification;
use App\Models\EducationQualificationChange;
use App\Models\EmergencyContact;
use App\Models\EmergencyContactChange;
use App\Models\Employee;
use App\Models\EmployeeChange;
use App\Models\LeaveCount;
use App\Models\Team;
use App\Models\Roles;
use App\Models\Salary;
use App\Services\MailService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    protected $emailService;

    public function __construct(MailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function employee()
    {
        $data['team'] = Team::get();
        return view('ims/admin/employee/employee', $data);
    }
    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : Employee List
     use for  : Fetch the Employee details in datatable using Ajax
     ---------------------------------------------------------------------------------------------------------*/
    public function get_emp_list(Request $request)
    {
        $post = $request->input();
        if ($post) {
            $field_pos = array('e_id' => '0', 'fname' => '1', 'email' => '2', 'teamName' => '3');
            $sort_field = array_search($post['order']['0']['column'], $field_pos);
            if ($post['order']['0']['dir'] == 'asc') {
                $orderBy = "ASC";
            } else {
                $orderBy = 'DESC';
            }
            $TotalRecord = Employee::getEmployeeList($post, $sort_field, $orderBy, 0);
            $employees = Employee::getEmployeeList($post, $sort_field, $orderBy, 1);
            $iTotalRecords = $TotalRecord['NumRecords'];
            $records = array();
            $records['data'] = array();
            $desc = '';
            foreach ($employees as $key => $value) {
                $check_pending_status = Employee::where('p_details_status', 'Pending')->where('e_id', $value->e_id)->select('e_id')
                    ->union(
                        Education_Qualification::where('status', 'Pending')->where('e_id', $value->e_id)->select('e_id')
                    )
                    ->union(
                        EmergencyContact::where('status', 'Pending')->where('e_id', $value->e_id)->select('e_id')
                    )
                    ->union(
                        BankInformation::where('status', 'Pending')->where('e_id', $value->e_id)->select('e_id')
                    )->first();

                if ($check_pending_status) {
                    $eyeAction = '<div class="d-flex f-18 justify-content-center"><a href="' . URL('') . '/employee-detail/' . $value->e_id . '"><i class="fa fa-eye f-red" aria-hidden="true"></i></a></div>';
                } else {
                    $eyeAction = '<div class="d-flex f-18 justify-content-center"><a href="' . URL('') . '/employee-detail/' . $value->e_id . '"><i class="fa fa-eye" aria-hidden="true"></i></a></div>';
                }
                $action = '<div class="d-flex gap-4">' . $eyeAction . '
                         <div class="d-flex f-18 justify-content-center"><a href="' . URL('') . '/edit-employee/' . $value->e_id . '"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
                         <div class="d-flex f-18 justify-content-center"><a href="' . URL('') . '/edit-attendance/' . $value->e_id . '"><i class="fa fa-clock-o" aria-hidden="true"></i></a></div>
                         <div class="d-flex f-18 justify-content-center"><a href="' . URL('') . '/admin-view-attendance/' . $value->e_id . '"><i class="fa fa-calendar" aria-hidden="true"></i></a></div>
                         <div class="d-flex f-18 justify-content-center"><a href="' . URL('') . '/admin-emp-salary/' . $value->e_id . '"><i class="fa fa-money" aria-hidden="true"></i></a></div></div>';

                $status = '<a href="javascript:void(0);" onclick="toggleStatus(' . $value->e_id . ', \'' . $value->status . '\')">' . ($value->status == 'Active' ? '<span class="badge bg-success f-14">Active</span>' : '<span class="badge bg-danger f-14">Inactive</span>') . '</a>';

                $education_qualification = Education_Qualification::where('e_id', $value->e_id)->first();
                $address = Address::where('e_id', $value->e_id)->first();
                $Emergency = EmergencyContact::where('e_id', $value->e_id)->first();
                $bank = BankInformation::where('e_id', $value->e_id)->first();
                $displayData = [
                    'education_display' => $education_qualification ? 0 : 1,
                    'address_display' => $address ? 0 : 1,
                    'emergency_display' => $Emergency ? 0 : 1,
                    'bank_display' => $bank ? 0 : 1,
                ];
                $applyRedClass = in_array(1, $displayData);
                $fullName = '<span class="' . ($applyRedClass ? 'f-red' : '') . '">' . ucfirst($value->fname) . ' ' . $value->lname . '</span>';

                $records['data'][] = array(
                    $value->e_id,
                    $fullName,
                    $value->email,
                    $value->teamName,
                    $status,
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
    public function updateEmployeeStatus(Request $request)
    {
        $empLogin = session('emp_login');
        $employee = Employee::where('e_id', $request->input('employee_id'))->first();
        if ($employee) {
            if ($employee->status == 'Active') {
                $employee->status = 'Inactive';
            } elseif ($employee->status == 'Inactive') {
                $employee->status = 'Active';
            }
            $clientIp = get_client_ip();
            $browser = browser_info();
            $currentTime = now()->format('Y-m-d h:i:s A');
            $username = Employee::where('e_id', $empLogin['e_id'])->select(DB::raw("CONCAT(fname, ' ', lname) as name"))->first();
            $empname = Employee::where('e_id', $request->input('employee_id'))->select(DB::raw("CONCAT(fname, ' ', lname) as name"))->first();
            $logText = "-------------------\nEdit Employee Status \n[" . $currentTime . "] || User: " . $username->name .
                " || Action: " . $empname->name . " update the Status this (" . $request->input('new_status') . ") || IP Address: " . $clientIp .
                " || Browser: " . $browser[1] . " " . $browser[2];

            $logFilePath = storage_path('logs/Admin.log');

            if (!file_exists(dirname($logFilePath))) {
                mkdir(dirname($logFilePath), 0755, true);
            }
            file_put_contents($logFilePath, $logText . PHP_EOL, FILE_APPEND);
            $employee->save();
        }
        return response()->json(['success' => true]);
    }

    public function addemployee()
    {
        $team = Team::all();
        $empLogin = session('emp_login');
        if ($empLogin['role'] == 1) {
            $role = Roles::all();
        } else {
            $role = Roles::where('r_id', '!=', 1)->get();
        }
        return view('ims/admin/employee/addemployee', ['team' => $team, 'role' => $role]);
    }
    public function submitemployee(Request $req)
    {
        $currentMonth = date('n');
        $currentYear = date('Y');
        // return $req;
        $empLogin = session('emp_login');
        $e_id = $empLogin['e_id'];
        if ($req->team_lead == 0) {
            $workreportteam = null;
        }else{
            $workreportteam = json_encode($req->workreportteam);
        }
        $employee = new Employee();
        $employee->fname = $req->fname;
        $employee->mname = $req->mname;
        $employee->lname = $req->lname;
        $employee->email = $req->email;
        $employee->password = md5($req->password);
        $employee->nationality = $req->nationality;
        $employee->marital_status = $req->marital_status;
        $employee->gender = $req->gender;
        $employee->phone = $req->phone;
        $employee->bloodtype = $req->bloodtype;
        $employee->pemail = $req->pemail;
        $employee->dob = date('Y-m-d', strtotime($req->dob));
        $employee->team = $req->team;
        $employee->team_lead = $req->team_lead ? $req->team_lead : 0;
        $employee->work_report_team = $workreportteam;
        $employee->designation = $req->designation;
        $employee->emp_experience = $req->emp_experience;
        $employee->role = $req->role;
        $employee->join_date = date('Y-m-d', strtotime($req->join_date));
        $employee->created_by = $e_id;
        $employee->download_ss = $req->download_ss ? $req->download_ss : 0;
        $employee->is_wfh_permanent = $req->is_wfh_permanent ? $req->is_wfh_permanent : 0;
        $save = $employee->save();
        if ($save) {
            $leaveCount = new LeaveCount();
            $leaveCount->e_id = $employee->e_id;
            $leaveCount->mon = $currentMonth;
            $leaveCount->year = $currentYear;
            $leaveCount->pr_leave = 0;
            $leaveCount->pr_current = 1;
            $leaveCount->pr_carry  = 0;
            $save = $leaveCount->save();
            $empId = 'HMMBizEmp00' . $employee->e_id;
            $update = Employee::where('e_id', $employee->e_id)->update(['empid' => $empId]);
            if ($update) {
                session()->flash('notification', ['type' => 'success', 'message' => "Employee added successfully."]);
                return redirect('employee');
            } else {
                session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
                return redirect(url('addemployee'));
            }
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('addemployee'));
        }
    }

    public function employee_details($id)
    {
        // fetch the Employee
        $details = Employee::select('employee.*', 'teams.team')->where('e_id', $id)->join('teams', 'teams.t_id', '=', 'employee.team')->first();
        $details_change = [];
        if ($details['p_details_status'] === 'Pending') {
            $records = EmployeeChange::where('e_id', $details['e_id'])->first();
            if ($records) {
                array_push($details_change, $records);
            }
        }

        // fetch the Education Qualification
        $eduction = Education_Qualification::where('e_id', '=', $id)->get();
        $education_changes = [];

        foreach ($eduction as $item) {
            if ($item['status'] === 'Pending') {
                $records = EducationQualificationChange::where('edq_id', $item['edq_id'])->first();
                if ($records) {
                    $records->starting_year = Carbon::parse($records->starting_year)->format('m-Y');
                    $records->ending_year = Carbon::parse($records->ending_year)->format('m-Y');
                    array_push($education_changes, $records);
                }
            }
        }
        // fetch the address
        $addresses = Address::select('address.*', 'cities.name as city', 'states.name as state', 'countries.name as country')
            ->where('e_id', '=', $id)
            ->join('cities', 'cities.id', '=', 'address.city')
            ->join('states', 'states.id', '=', 'address.state')
            ->join('countries', 'countries.id', '=', 'address.country')->get();
        $addresses_changes = [];
        foreach ($addresses as $item) {
            if ($item['status'] === 'Pending') {
                $records = AddressChange::select('address_change.*', 'cities.name as city', 'states.name as state', 'countries.name as country')
                    ->where('ad_id', $item['ad_id'])
                    ->join('cities', 'cities.id', '=', 'address_change.city')
                    ->join('states', 'states.id', '=', 'address_change.state')
                    ->join('countries', 'countries.id', '=', 'address_change.country')
                    ->get();
                array_push($addresses_changes, $records[0]);
            }
        }
        // fetch the emerygency contect
        $contects = EmergencyContact::where('e_id', '=', $id)->get();
        $contects_changes = [];
        foreach ($contects as $item) {
            if ($item['status'] === 'Pending') {
                $records = EmergencyContactChange::where('ec_id', $item['ec_id'])->first();
                array_push($contects_changes, $records);
            }
        }
        // fetch the Bank Information
        $bank = BankInformation::where('e_id', '=', $id)->first();
        $bank_changes = [];

        if ($bank && $bank->status === 'Pending') {
            $records = BankInformationChange::where('e_id', $bank->e_id)->first();
            array_push($bank_changes, $records);
        }
        if ($details) {
            return view('ims/admin/employee/employee-details', [
                'details' => $details,
                'details_change' => $details_change,
                'eduction' => $eduction,
                'education_changes' => $education_changes,
                'addresses' => $addresses,
                'addresses_changes' => $addresses_changes,
                'contects' => $contects,
                'contects_changes' => $contects_changes,
                'bank' => $bank,
                'bank_changes' => $bank_changes,
            ]);
        } else {
            return redirect('/overview');
        }
    }
    public function edit_employee($id)
    {
        $data = Employee::where('e_id', '=', $id)->first();
        $data['dob'] = date('d-m-Y', strtotime($data['dob']));
        $data['join_date'] = date('d-m-Y', strtotime($data['join_date']));
        $empLogin = session('emp_login');
        if ($empLogin['role'] == 1) {
            $role = Roles::all();
        } else {
            $role = Roles::where('r_id', '!=', 1)->get();
        }
        $team = Team::all();

        // log entry
        $clientIp = get_client_ip();
        $browser = browser_info();
        $currentTime = now()->format('Y-m-d h:i:s A');
        $username = Employee::where('e_id', $empLogin['e_id'])->select(DB::raw("CONCAT(fname, ' ', lname) as name"))->first();
        $logText = "-------------------\n Open Edit Employee Page\n[" . $currentTime . "] || User: " . $username->name .
            " || Action: Open Edit Employe Page  || IP Address: " . $clientIp .
            " || Browser: " . $browser[1] . " " . $browser[2];
        $logFilePath = storage_path('logs/Admin.log');

        if (!file_exists(dirname($logFilePath))) {
            mkdir(dirname($logFilePath), 0755, true);
        }
        file_put_contents($logFilePath, $logText . PHP_EOL, FILE_APPEND);
        // $data->work_report_team = json_decode($data->work_report_team);
        return view('ims/admin/employee/edit-employee', [
            'data' => $data,
            'team' => $team,
            'role' => $role,
        ]);
    }
    public function submit_admin_employee(Request $req)
    {
        $empLogin = session('emp_login');
        if ($req->download_ss == 'on') {
            $download_ss = 1;
        }else{
            $download_ss = 0;
        }
        if ($req->team_lead_hidden == 0) {
            $workreportteam = null;
        }else{
            $workreportteam = json_encode($req->workreportteam);
        }

        $updatemployee = [
            'fname' => $req->fname,
            'mname' => $req->mname,
            'lname' => $req->lname,
            'email' => $req->email,
            'nationality' => $req->nationality,
            'marital_status' => $req->marital_status,
            'gender' => $req->gender,
            'bloodtype' => $req->bloodtype,
            'phone' => $req->phone,
            'pemail' => $req->pemail,
            'team' => $req->team,
            'team_lead' => $req->team_lead_hidden,
            'work_report_team' => $workreportteam,
            'dob' => date('Y-m-d', strtotime($req->dob)),
            'designation' => $req->designation,
            'emp_experience' => $req->emp_experience,
            'role' => $req->role,
            'join_date' => date('Y-m-d', strtotime($req->join_date)),
            'download_ss' =>  $download_ss,
            'is_wfh_permanent' => $req->is_wfh_permanent,
        ];
        $employee = Employee::where('e_id', '=', $req->id)->update($updatemployee);
        if ($employee) {
            $clientIp = get_client_ip();
            $browser = browser_info();
            $currentTime = now()->format('Y-m-d h:i:s A');
            $username = Employee::where('e_id', $empLogin['e_id'])->select(DB::raw("CONCAT(fname, ' ', lname) as name"))->first();
            $logText = "-------------------\nEdit Employee Details\n[" . $currentTime . "] || User: " . $username->name .
                " || Action: Edit Employee Details || IP Address: " . $clientIp .
                " || Browser: " . $browser[1] . " " . $browser[2];

            $logFilePath = storage_path('logs/Admin.log');

            if (!file_exists(dirname($logFilePath))) {
                mkdir(dirname($logFilePath), 0755, true);
            }
            file_put_contents($logFilePath, $logText . PHP_EOL, FILE_APPEND);

            session()->flash('notification', ['type' => 'success', 'message' => "Employee data updated successfully."]);
            return redirect('employee');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('overview'));
        }
    }

    public function edit_attendance($id)
    {
        $empLogin = session('emp_login');
        // log entry
        $clientIp = get_client_ip();
        $browser = browser_info();
        $currentTime = now()->format('Y-m-d h:i:s A');
        $username = Employee::where('e_id', $empLogin['e_id'])->select(DB::raw("CONCAT(fname, ' ', lname) as name"))->first();
        $logText = "-------------------\n Open Edit Attendance Page\n[" . $currentTime . "] || User: " . $username->name .
            " || Action: Open Edit Attendance Page  || IP Address: " . $clientIp .
            " || Browser: " . $browser[1] . " " . $browser[2];
        $logFilePath = storage_path('logs/Admin.log');

        if (!file_exists(dirname($logFilePath))) {
            mkdir(dirname($logFilePath), 0755, true);
        }
        file_put_contents($logFilePath, $logText . PHP_EOL, FILE_APPEND);
        return view('ims/admin/employee/edit-attendance', ['id' => $id]);
    }
    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : autocomplete Time
     use for  : Fetch requested name and send the data in database using Ajax
     ---------------------------------------------------------------------------------------------------------*/
    public function autocomplete(Request $req)
    {
        $dateString = $req->date;
        $date = Carbon::createFromFormat('d-m-Y', $dateString);
        $formattedDate = $date->format('Y-m-d');
        $attendance = Attendance::where('date', $formattedDate)->where('e_id', $req->id)->first();
        if (!$attendance) {
            return response()->json(['error' => 'No attendance record found for this date'], 404);
        }
        $loginTime = '';
        $logoutTime = '';

        if ($attendance->login_time) {
            $loginTime = Carbon::createFromFormat('Y-m-d H:i:s', $attendance->login_time);
            if ($loginTime) {
                $loginTime = $loginTime->format('h:i:s');
            }
        }

        if ($attendance->logout_time) {
            $logoutTime = Carbon::createFromFormat('Y-m-d H:i:s', $attendance->logout_time);
            if ($logoutTime) {
                $logoutTime = $logoutTime->format('h:i:s');
            }
        }
        if ($attendance->update_reason) {
            $reason = $attendance->update_reason;
        } else {
            $reason = '';
        }
        $data = [
            'login_time' => $loginTime,
            'logout_time' => $logoutTime,
            'reason' => $reason,
        ];
        return response()->json($data);
    }
    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : Update employee time
     use for  : Update the employee time and workig hours and if null so insert the working houes and calculate
                the FullDay, HalfDay, Leave.
     ---------------------------------------------------------------------------------------------------------*/
    public function update_employee_time(Request $req)
    {
        $empLogin = session('emp_login');
        $date = Carbon::createFromFormat('d-m-Y', $req->date);
        $formattedDate = $date->format('Y-m-d');
        $loginTime = Carbon::parse($req->login_time)->format('H:i:s');
        $combinedlogintime = $formattedDate . ' ' . $loginTime;
        if ($req->logout_time) {
            $logoutTime =  Carbon::parse($req->logout_time)->format('H:i:s');
            $combinedlogouttime = $formattedDate . ' ' . $logoutTime;
            $loginCarbon = Carbon::parse($loginTime);
            $logoutCarbon = Carbon::parse($logoutTime);
            $diffInHours = $logoutCarbon->diffInHours($loginCarbon);
            if ($diffInHours >= 7) {
                $presence = 0;
            } else if ($diffInHours >= 4 && $diffInHours < 7) {
                $presence = 1;
            } else {
                $presence = 3;
            }
            $diffTime = $logoutCarbon->diff($loginCarbon);
            $workingHours = $diffTime->format('%H:%I:%S');
        } else {
            $combinedlogouttime = null;
            $workingHours = null;
            $presence = null;
        }
        $updatetime = [
            'login_time' =>  $combinedlogintime,
            'logout_time' =>  $combinedlogouttime,
            'working_hours' => $workingHours,
            'presence' => $presence,
            'update_reason' => $req->reason,
            'updated_by' => $empLogin['empid']
        ];
        $check = Attendance::selectRaw("CONCAT(em.fname, ' ', em.lname) as name, attendance.*")
            ->join('employee as em', 'attendance.e_id', '=', 'em.e_id')
            ->where('date', $formattedDate)
            ->where('attendance.e_id', $req->id)
            ->first();
        // return $check->at_id;
        $updateBy = Employee::selectRaw("CONCAT(fname, ' ', lname) as update_by")
            ->where('e_id', $empLogin['e_id'])->first();

        if ($check) {
            $data = Attendance::where('at_id', $check->at_id)->update($updatetime);
            // return $data;
            if ($data) {
                $emailData = [
                    'name' => $check->name,
                    'update_by' => $updateBy->update_by,
                    'old_login_time' => $check->login_time ? date('h:i:s A d-m-Y', strtotime($check->login_time)) : '-',
                    'new_login_time' => $combinedlogintime ? date('h:i:s A d-m-Y', strtotime($combinedlogintime)) : '-',
                    'old_logout_time' => $check->logout_time ? date('h:i:s A d-m-Y', strtotime($check->logout_time)) : '-',
                    'new_logout_time' => $combinedlogouttime ? date('h:i:s A d-m-Y', strtotime($combinedlogouttime)) : '-',
                    'old_working_time' => $check->working_hours ?? '-',
                    'new_working_hours' => $workingHours ?? '-',
                    'reason' => $req->reason,
                ];
                $to =  env('HR_EMAIL');
                $cc =  env('ADMIN_EMAIL');
                $msg = "Update Attendance";
                $this->emailService->sendMail($to, $msg, 'ims/mail/admin-mail/update-attendance', ['data' => $emailData], $cc);
                session()->flash('notification', ['type' => 'success', 'message' => "Time updated successfully."]);
                return redirect('employee');
            } else {
                session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
                return redirect(url('overview'));
            }
        } else {
            $attendance = new Attendance();
            $attendance->e_id = $req->id;
            $attendance->date = $formattedDate;
            $attendance->login_time = $combinedlogintime;
            $attendance->logout_time = $combinedlogouttime;
            $attendance->working_hours = $workingHours;
            $attendance->presence = $presence;
            $attendance->update_reason = $req->reason;
            $sava = $attendance->save();
            if ($sava) {
                $name = Employee::selectRaw("CONCAT(fname, ' ', lname) as name")
                    ->where('e_id', $req->id)->first();
                $Emaildata = [
                    'name' => $name->name,
                    'update_by' => $updateBy->update_by,
                    'login_time' => $combinedlogintime ? date('h:i:s d-m-Y', strtotime($combinedlogintime)) : '-',
                    'logout_time' => $combinedlogouttime ? date('h:i:s d-m-Y', strtotime($combinedlogouttime)) : '-',
                    'working_hours' => $workingHours ?? '-',
                    'reason' =>   $req->reason ?? '-',
                ];
                $to =  env('HR_EMAIL');
                $cc =  env('ADMIN_EMAIL');
                $msg = "Insert New Attendance";
                $this->emailService->sendMail($to, $msg, 'ims/mail/admin-mail/new-attendance', ['data' => $Emaildata], $cc);
                session()->flash('notification', ['type' => 'success', 'message' => "Time recorded successfully."]);
                return redirect('employee');
            } else {
                session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
                return redirect(url('overview'));
            }
        }
    }
    public function admin_view_attedance($id)
    {
        $empLogin = session('emp_login');
        // log entry
        $clientIp = get_client_ip();
        $browser = browser_info();
        $currentTime = now()->format('Y-m-d h:i:s A');
        $username = Employee::where('e_id', $empLogin['e_id'])->select(DB::raw("CONCAT(fname, ' ', lname) as name"))->first();
        $logText = "-------------------\n Open View Employee Attendance \n[" . $currentTime . "] || User: " . $username->name .
            " || Action: Open View Employee Attendance Page  || IP Address: " . $clientIp .
            " || Browser: " . $browser[1] . " " . $browser[2];
        $logFilePath = storage_path('logs/Admin.log');

        if (!file_exists(dirname($logFilePath))) {
            mkdir(dirname($logFilePath), 0755, true);
        }
        file_put_contents($logFilePath, $logText . PHP_EOL, FILE_APPEND);

        $data = Employee::where('e_id', $id)->select('e_id', 'fname', 'lname')->first();
        return view('ims/admin/view-attendance/admin-view-attendance', ['empInfo' => $data]);
    }

    public function get_attendance_details(Request $req)
    {
        $year = $req->year;
        $month = $req->month;
        $day = $req->day;
        $e_id = $req->e_id;
        $date = Carbon::createFromDate($year, $month, $day);
        $formattedDate = $date->format('Y-m-d');
        $data = getAttendanceDetails($formattedDate, $e_id);
        if (!$data) {
            return response()->json(['error' => 'No data found for this date'], 404);
        }
        return response()->json(['data' => $data]);
    }

    public function admin_emp_salary($id)
    {
        $empLogin = session('emp_login');
        // log entry
        $clientIp = get_client_ip();
        $browser = browser_info();
        $currentTime = now()->format('Y-m-d h:i:s A');
        $username = Employee::where('e_id', $empLogin['e_id'])->select(DB::raw("CONCAT(fname, ' ', lname) as name"))->first();
        $logText = "-------------------\n Open Add Employee Salary \n[" . $currentTime . "] || User: " . $username->name .
            " || Action: Open Add Employee Salary Page  || IP Address: " . $clientIp .
            " || Browser: " . $browser[1] . " " . $browser[2];
        $logFilePath = storage_path('logs/Admin.log');

        if (!file_exists(dirname($logFilePath))) {
            mkdir(dirname($logFilePath), 0755, true);
        }
        file_put_contents($logFilePath, $logText . PHP_EOL, FILE_APPEND);

        $salaryDetails = Salary::where('e_id', $id)->first();
        return view('ims/admin/employee/salary', ['sDetails' => $salaryDetails, 'e_id' => $id]);
    }
    public function updateSalary(Request $req)
    {
        // return $req;
        $precheck = Salary::where('e_id', $req->e_id)->first();
        if ($precheck) {
            $update = array(
                'start_date' => date('Y-m-d', strtotime($req->start_date)),
                'end_date' => date('Y-m-d', strtotime($req->end_date)),
                'amount' => $req->amount,
                'tds' => $req->tds,
                'pt' => $req->pt,
                'allowance' => $req->allowance,
                'bonus' => $req->bonus
            );
            Salary::where('e_id', $req->e_id)->update($update);
        } else {
            $salary = new Salary();
            $salary->e_id = $req->e_id;
            $salary->start_date = date('Y-m-d', strtotime($req->start_date));
            $salary->end_date = date('Y-m-d', strtotime($req->end_date));
            $salary->amount = $req->amount;
            $salary->tds = $req->tds;
            $salary->pt = $req->pt;
            $salary->allowance = $req->allowance;
            $salary->bonus = $req->bonus;
            $save = $salary->save();
        }
        session()->flash('notification', ['type' => 'success', 'message' => "Salary updated successfully."]);
        return redirect('/employee');
    }
}
