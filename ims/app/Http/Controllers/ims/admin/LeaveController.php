<?php

namespace App\Http\Controllers\ims\admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\LeaveType;
use App\Models\Leaves;
use App\Models\Wfh;
use App\Services\MailService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\MockObject\ReturnValueNotConfiguredException;

class LeaveController extends Controller
{
    protected $emailService;

    public function __construct(MailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function leavetype()
    {
        $data = LeaveType::all();
        return view('ims/admin/leave/leave-type', ['data' => $data]);
    }
    public function leavtype_list(Request $request)
    {
        /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : Pending leave type List
     use for  : Fetch the Leave type details in datatable using Ajax
    ---------------------------------------------------------------------------------------------------------*/
        $post = $request->input();
        if ($post) {
            $field_pos = array('lt_id' => '0', 'leave_type' => '1', 'total_leave' => '2');
            $sort_field = array_search($post['order']['0']['column'], $field_pos);
            if ($post['order']['0']['dir'] == 'asc') {
                $orderBy = "ASC";
            } else {
                $orderBy = 'DESC';
            }
            $TotalRecord = LeaveType::getleavetypelist($post, $sort_field, $orderBy, 0);
            $leavetype = LeaveType::getleavetypelist($post, $sort_field, $orderBy, 1);
            $iTotalRecords = $TotalRecord['NumRecords'];
            $records = array();
            $records['data'] = array();
            $desc = '';
            foreach ($leavetype as $key => $value) {
                $action = '<div class="d-flex gap-4"><div class="d-flex f-18 justify-content-start f-black"><a href="' . URL('') . '/edit-leave-type/' . $value->lt_id  . '"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
                <div class="d-flex f-18 justify-content-start f-black"><a href="' . URL('') . '/delete-leave-type/' . $value->lt_id  . '"><i class="fa fa-trash" aria-hidden="true"></i></a>
                </div></div>';
                $records['data'][] = array(
                    $value->lt_id,
                    $value->leave_type,
                    $value->total_leave,
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
    public function leave_details($id)
    {
        $details = Leaves::leaveDetails($id);
        if ($details) {
            return view('ims/admin/leave/leave-details', ['details' => $details]);
        } else {
            return redirect('/overview');
        }
    }
    public function pendingleave()
    {
        return view('ims/admin/leave/pending-leave');
    }
    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : Pending leave List
     use for  : Fetch the Pending Leave details in datatable using Ajax
     ---------------------------------------------------------------------------------------------------------*/
    public function pending_leave_list(Request $request)
    {
        $post = $request->input();
        if ($post) {
            $field_pos = array('lv_id' => '0', 'leaveName' => '1', 'leave_date' => '2', 'leave_reason' => '3', 'fname' => '4', 'status' => '5', 'created_at' => '6');
            $sort_field = array_search($post['order']['0']['column'], $field_pos);
            if ($post['order']['0']['dir'] == 'asc') {
                $orderBy = "ASC";
            } else {
                $orderBy = 'DESC';
            }
            $TotalRecord = Leaves::getPendingLeaveAdmin($post, $sort_field, $orderBy, 0);
            $leaves = Leaves::getPendingLeaveAdmin($post, $sort_field, $orderBy, 1);
            $iTotalRecords = $TotalRecord['NumRecords'];
            $records = array();
            $records['data'] = array();
            $desc = '';
            foreach ($leaves as $key => $value) {
                // click to approve code 
                // $status = '<span class="pending-leave-span badge bg-danger f-14 approve-status" data-id="' . $value->lv_id . '" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="Click here to <b>approve.</b> ">Pending</span>';
                $status = '<div class="pending-leave-span badge bg-danger f-16"><a href="' . URL('') . '/leave-details/' . $value->lv_id . '">Pending</a></div>';
                $action = '<div class="d-flex f-18 justify-content-center"><a href="' . URL('') . '/leave-details/' . $value->lv_id . '"><i class="fa fa-eye" aria-hidden="true"></i></a></div>';
                $records['data'][] = array(
                    $value->lv_id,
                    $value->leaveName,
                    date('d-m-Y', strtotime($value->leave_date)),
                    $value->leave_for,
                    $value->leave_reason,
                    $value->e_fname . ' ' . $value->e_lname,
                    $value->r_fname . ' ' . $value->r_lname,
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
    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : update the leave status List
     use for  : Update the leave status and if the sandwich leaves and reject delete the record and approve
                so calculate the sandwich leave using Ajax
     ---------------------------------------------------------------------------------------------------------*/
    public function update_leave_status(Request $req)
    {
        $empLogin = session('emp_login');
        if ($req->status == 'Approve') {
            $save = Leaves::where('lv_id', $req->lv_id)->update([
                'approve_by' => $empLogin['e_id'],
                'status' => $req->status]);
            if ($save) {
                $rowinfo = Leaves::where('lv_id', $req->lv_id)
                    ->join('employee as em', 'em.e_id', '=', 'leaves.e_id')
                    ->join('employee as em2', 'em2.e_id', '=', 'leaves.leave_responsible_person')
                    ->join('leaves_type as lt', 'lt.lt_id', '=', 'leaves.leave_type')
                    ->select('leaves.*', 'lt.leave_type', DB::raw("CONCAT(em.fname, ' ', em.lname) as name"), DB::raw("CONCAT(em2.fname, ' ', em2.lname) as responsible"), 'em.email')
                    ->first();
                $approveby = Employee::where('e_id', $empLogin['e_id'])
                    ->select(DB::raw("CONCAT(fname, ' ', lname) as approveby"))
                    ->first();

                $approveleavedata = [
                    'leave_for' => $rowinfo->leave_for,
                    'leave_type' => $rowinfo->leave_type,
                    'leave_date' => Carbon::createFromFormat('Y-m-d', $rowinfo->leave_date)->format('d-m-Y'),
                    'leaveby' => $rowinfo->name,
                    'responsible' => $rowinfo->responsible,
                    'approveby' => $approveby->approveby,
                    'leave_reason' => $rowinfo->leave_reason,
                ];

                $to =  $rowinfo->email;
                $msg = "Leave Request Approved";
                $this->emailService->sendMail($to, $msg, 'ims/mail/admin-mail/approveleavemail', ['data' => $approveleavedata]);
                session()->flash('notification', ['type' => 'success', 'message' => "Leave approved successfully."]);
                return response()->json(['message' => 'success']);
            } else {
                session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
                return response()->json();
            }
        } else {
            if ($req->status == 'Reject') {
                $save = Leaves::where('lv_id', $req->lv_id)->update([
                    'approve_by' => $empLogin['e_id'],
                    'status' => $req->status]);
                if ($save) {
                    $rowinfo = Leaves::where('lv_id', $req->lv_id)
                        ->join('employee as em', 'em.e_id', '=', 'leaves.e_id')
                        ->join('employee as em2', 'em2.e_id', '=', 'leaves.leave_responsible_person')
                        ->join('leaves_type as lt', 'lt.lt_id', '=', 'leaves.leave_type')
                        ->select('leaves.*', 'lt.leave_type', DB::raw("CONCAT(em.fname, ' ', em.lname) as name"), DB::raw("CONCAT(em2.fname, ' ', em2.lname) as responsible"), 'em.email')
                        ->first();
                    $approveby = Employee::where('e_id', $empLogin['e_id'])
                        ->select(DB::raw("CONCAT(fname, ' ', lname) as approveby"))
                        ->first();
                    $approveleavedata = [
                        'leave_for' => $rowinfo->leave_for,
                        'leave_type' => $rowinfo->leave_type,
                        'leave_date' => Carbon::createFromFormat('Y-m-d', $rowinfo->leave_date)->format('d-m-Y'),
                        'leaveby' => $rowinfo->name,
                        'responsible' => $rowinfo->responsible,
                        'approveby' => $approveby->approveby,
                        'leave_reason' => $rowinfo->leave_reason,
                    ];


                    $to =  $rowinfo->email;
                    $msg = "Leave Request Rejected";
                    $this->emailService->sendMail($to, $msg, 'ims/mail/admin-mail/rejectleavemail', ['data' => $approveleavedata]);
                    session()->flash('notification', ['type' => 'success', 'message' => "Leave rejected successfully."]);
                    return response()->json(['message' => 'success']);
                } else {
                    session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
                    return response()->json();
                }
            } else {
                session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
                return response()->json();
            }
        }
    }
    public function approvedleave()
    {
        return view('ims/admin/leave/approved-leave');
    }
    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : Approve and Reject leave List
     use for  : Fetch the approve and reject leave details in datatable using Ajax
     ---------------------------------------------------------------------------------------------------------*/
    public function approved_leave_list(Request $request)
    {
        $post = $request->input();
        if ($post) {
            $field_pos = array('lv_id' => '0', 'leaveName' => '1', 'leave_date' => '2', 'leave_reason' => '3', 'fname' => '4', 'status' => '5', 'created_at' => '6');
            $sort_field = array_search($post['order']['0']['column'], $field_pos);
            $orderBy = $post['order']['0']['dir'] == 'asc' ? 'ASC' : 'DESC';
            $TotalRecord = Leaves::getApprovedLeaveAdmin($post, $sort_field, $orderBy, 0);
            $leaves = Leaves::getApprovedLeaveAdmin($post, $sort_field, $orderBy, 1);
            $iTotalRecords = $TotalRecord['NumRecords'];
            $records = array();
            $records['data'] = array();
            $desc = '';
            foreach ($leaves as $key => $value) {
                $status = $value->status == 'Approve' ? '<span class="badge bg-success f-14">Approved</span>' : '<span class="badge f-black bg-warning  f-14">Reject</span>';
                $action = '<div class="d-flex f-18 gap-3 justify-content-center"><a href="' . URL('') . '/leave-details/' . $value->lv_id . '"><i class="fa fa-eye" aria-hidden="true"></i></a>
                              <a id="delete_approve_Leave_' . $value->lv_id  . '" data-id="' . $value->lv_id . '" href="javascript:void(0)"><i class="fa fa-trash" aria-hidden="true"></i></a></div>';
                $records['data'][] = array(
                    $value->lv_id,
                    $value->leaveName,
                    date('d-m-Y', strtotime($value->leave_date)),
                    $value->leave_for,
                    $value->leave_reason,
                    $value->e_fname . ' ' . $value->e_lname,
                    $value->r_fname . ' ' . $value->r_lname,
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
    public function delete_approve_leave($id)
    {
        $empLogin = session('emp_login');
        // log entry
        $clientIp = get_client_ip();
        $browser = browser_info();
        $currentTime = now()->format('Y-m-d h:i:s A');
        $username = Employee::where('e_id', $empLogin['e_id'])->select(DB::raw("CONCAT(fname, ' ', lname) as name"))->first();
        $logdata = Leaves::where('lv_id', $id)->first();
        $logText = "-------------------\nDelete " . $logdata->status . " Leave \n[" . $currentTime . "] || User: " . $username->name .
            " || Action: Delete " . $logdata->status . " Leave || Leave Date : " . $logdata->leave_date . "|| leave for: " . $logdata->leave_for . " || Status :" . $logdata->status . " || IP Address: " . $clientIp .
            " || Browser: " . $browser[1] . " " . $browser[2];
        $logFilePath = storage_path('logs/Admin.log');

        if (!file_exists(dirname($logFilePath))) {
            mkdir(dirname($logFilePath), 0755, true);
        }
        file_put_contents($logFilePath, $logText . PHP_EOL, FILE_APPEND);
        // end log entry

        $data = Leaves::where('lv_id', $id)->delete();
        if ($data) {

            session()->flash('notification', ['type' => 'success', 'message' => "Leave Delete successfully."]);
            return redirect('approved-leave');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('overview'));
        }
    }
    public function addleavetype()
    {
        return view('ims/admin/leave/add-leave-type');
    }
    public function submitleavetype(Request $req)
    {
        $leavetype = new LeaveType();
        $leavetype->leave_type = $req->leave_type;
        $leavetype->total_leave = $req->total_leave;
        $save =  $leavetype->save();
        if ($save) {
            session()->flash('notification', ['type' => 'success', 'message' => "Leave type added successfully."]);
            return redirect('leave-type');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('add-leave-type'));
        }
    }
    public function editleavetype($id)
    {
        $leavetype = LeaveType::where('lt_id', '=', $id)->first();
        return view('ims/admin/leave/edit-leave-type', ['leavetype' => $leavetype]);
    }
    public function updateleavetype(Request $req)
    {
        $updateleavetype = [
            'leave_type' => $req->leave_type,
            'total_leave' => $req->total_leave,
        ];
        $leavetype = LeaveType::where('lt_id', '=', $req->id)->update($updateleavetype);
        if ($leavetype) {
            session()->flash('notification', ['type' => 'success', 'message' => "leave type Update successfully"]);
            return redirect('leave-type');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('add-leave-type'));
        }
    }
    public function delete_leavetype($id)
    {
        $check = LeaveType::where('lt_id', $id)->delete();
        if ($check) {
            session()->flash('notification', ['type' => 'success', 'message' => "Item deleted successfully."]);
            return redirect('leave-type');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('overview'));
        }
    }
    public function add_emp_leave()
    {
        $leavetypes = LeaveType::where('total_leave', '>', 0)->get();
        $emp = Employee::selectRaw("CONCAT(fname, ' ', lname) as name, e_id, teams.team")
            ->where('status', 'Active')
            ->join('teams', 'teams.t_id', '=', 'employee.team')
            ->get();
        return view('ims.admin.leave.add-emp-leave', ['leavetypes' => $leavetypes, 'emp' => $emp]);
    }
    public function submit_add_emp_leave(Request $req)
    {
        $sessionData = session('emp_login');
        $e_id = $sessionData['e_id'];
        $leave_date = trim($req->leave_date);

        $save = false;

        foreach ($req->leaveby as $selectedEmpId) {

            if (strpos($leave_date, ' to ') === false) {
                // Single Date
                $leaveDate = Carbon::createFromFormat('d-m-Y', $leave_date);

                if ($leaveDate->isWeekend()) {
                    continue; // skip weekends
                }

                $already = Leaves::where('leave_date', $leaveDate->format('Y-m-d'))
                    ->where('e_id', $selectedEmpId)
                    ->first();

                if ($already) {
                    continue; // skip already applied
                }

                $leave = new Leaves();
                $leave->e_id = $selectedEmpId;
                $leave->leave_for = $req->leave_for;
                $leave->leave_type = $req->leave_type;
                $leave->leave_responsible_person = $e_id;
                $leave->leave_reason = $req->leave_reason;
                $leave->leave_date = $leaveDate->format('Y-m-d');
                $leave->leave_date_type = 0;
                $leave->is_sandwich = 0;
                $leave->ss_dates = null;
                $leave->u_date = null;
                $leave->is_display = 1;
                $leave->l_identity = null;
                $leave->status = 'Approve';
                $leave->approve_by = null;
                $leave->action_date = null;
                $leave->insert_by = $sessionData['empid'];

                if ($req->hasFile('document')) {
                    $image = $req->file('document')->store(
                        'leave/' . $selectedEmpId . '-' . $leaveDate->format('Y-m-d'),
                        'public'
                    );
                    $leave->document = $image;
                }

                $save = $leave->save() || $save;
            } else {
                // Date Range
                $rowdates = explode(' to ', $leave_date);
                $startDate = Carbon::createFromFormat('d-m-Y', $rowdates[0]);
                $endDate = Carbon::createFromFormat('d-m-Y', $rowdates[1]);

                for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {

                    if ($date->isWeekend()) {
                        continue;
                    }

                    $already = Leaves::where('leave_date', $date->format('Y-m-d'))
                        ->where('e_id', $selectedEmpId)
                        ->first();

                    if ($already) {
                        continue;
                    }

                    $leave = new Leaves();
                    $leave->e_id = $selectedEmpId;
                    $leave->leave_for = $req->leave_for;
                    $leave->leave_type = $req->leave_type;
                    $leave->leave_responsible_person = $e_id;
                    $leave->leave_reason = $req->leave_reason;
                    $leave->leave_date = $date->format('Y-m-d');
                    $leave->leave_date_type = 1;
                    $leave->is_sandwich = 0;
                    $leave->ss_dates = null;
                    $leave->u_date = null;
                    $leave->is_display = 1;
                    $leave->l_identity = null;
                    $leave->status = 'Approve';
                    $leave->approve_by = null;
                    $leave->action_date = null;
                    $leave->insert_by = $sessionData['empid'];

                    if ($req->hasFile('document')) {
                        $image = $req->file('document')->store(
                            'leave/' . $selectedEmpId . '-' . $date->format('Y-m-d'),
                            'public'
                        );
                        $leave->document = $image;
                    }

                    $save = $leave->save() || $save;
                }
            }
        }

        if ($save) {
            session()->flash('notification', ['type' => 'success', 'message' => "Leave request(s) submitted successfully."]);
            return redirect(url('overview'));
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "No leave was submitted. Possibly due to weekends or duplicate entries."]);
            return redirect(url('/add-emp-leave'));
        }
    }

    public function pending_wfh()
    {
        return view('ims/admin/wfh/pending-wfh');
    }
    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : Pending Work-from-Home List
     use for  : Fetch the pending work-from-home details in datatable using Ajax
     ---------------------------------------------------------------------------------------------------------*/
    public function pending_wfh_list(Request $request)
    {
        $post = $request->input();
        if ($post) {
            $field_pos = array('wfh_id' => '0', 'apply_for' => '1', 'wfh_date' => '2', 'apply_reason' => '3', 'fname' => '4', 'status' => '5', 'created_at' => '6');
            $sort_field = array_search($post['order']['0']['column'], $field_pos);
            if ($post['order']['0']['dir'] == 'asc') {
                $orderBy = "ASC";
            } else {
                $orderBy = 'DESC';
            }
            $TotalRecord = Wfh::getWfhLeaveAdmin($post, $sort_field, $orderBy, 0);
            $wfh = Wfh::getWfhLeaveAdmin($post, $sort_field, $orderBy, 1);
            $iTotalRecords = $TotalRecord['NumRecords'];
            $records = array();
            $records['data'] = array();
            $desc = '';
            foreach ($wfh as $key => $value) {
                // click to approve 
                // $status = '<span class="pending-leave-span badge bg-danger f-14 approve-status" data-id="' . $value->wfh_id . '" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="Click here to <b>approve.</b> ">Pending</span>';
                $status = '<div class="pending-leave-span badge bg-danger f-16"><a href="' . URL('') . '/wfh-details/' . $value->wfh_id  . '">Pending</a></div>';
                $action = '<div class="d-flex f-18 justify-content-center"><a href="' . URL('') . '/wfh-details/' . $value->wfh_id  . '"><i class="fa fa-eye" aria-hidden="true"></i></a></div>';
                $records['data'][] = array(
                    $value->wfh_id,
                    $value->apply_for,
                    date('d-m-Y', strtotime($value->wfh_date)),
                    $value->apply_reason,
                    $value->e_fname . ' ' . $value->e_lname,
                    $value->r_fname . ' ' . $value->r_lname,
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
    public function wfh_details($id)
    {
        $details = Wfh::wfhDetails($id);
        if ($details) {
            return view('ims/admin/wfh/wfh-details', ['details' => $details]);
        } else {
            return redirect('/overview');
        }
    }
    public function update_wfh_status(Request $req)
    {
        $empLogin = session('emp_login');
        if ($req->status == 'Approve') {
            $save = Wfh::where('wfh_id', $req->wfh_id)->update([
                'approve_by' => $empLogin['e_id'],
                'status' => $req->status]);
            if ($save) {
                // email info 
                $rowinfo = wfh::where('wfh_id', $req->wfh_id)
                    ->join('employee as em', 'em.e_id', '=', 'wfh.e_id')
                    ->join('employee as em2', 'em2.e_id', '=', 'wfh.wfh_responsible_person')
                    ->select('wfh.*', DB::raw("CONCAT(em.fname, ' ', em.lname) as name"), DB::raw("CONCAT(em2.fname, ' ', em2.lname) as responsible"), 'em.email')
                    ->first();
                    $approveby = Employee::where('e_id', $empLogin['e_id'])
                    ->select(DB::raw("CONCAT(fname, ' ', lname) as approveby"))
                    ->first();
                $approvewfhdetails = [  
                    'wfh_for' => $rowinfo->apply_for,
                    'wfh_date' => Carbon::createFromFormat('Y-m-d', $rowinfo->wfh_date)->format('d-m-Y'),
                    'wfhby' => $rowinfo->name,
                    'responsible' => $rowinfo->responsible,
                    'wfh_reason' => $rowinfo->apply_reason,
                    'approveby' => $approveby->approveby,
                ];
                $to = $rowinfo->email;
                $msg = "Work From Home Request Approved";
                $this->emailService->sendMail($to, $msg, 'ims/mail/admin-mail/approvewfhmail', ['data' => $approvewfhdetails]);
                session()->flash('notification', ['type' => 'success', 'message' => "Work-from-home request approved successfully."]);
                return response()->json(['message' => 'success']);
            } else {
                session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
                return response()->json();
            }
        } else {
            if ($req->status == 'Reject') {
                $save = Wfh::where('wfh_id', $req->wfh_id)->update([
                    'approve_by' => $empLogin['e_id'],
                    'status' => $req->status]);
                if ($save) {
                    // email info 
                    $rowinfo = wfh::where('wfh_id', $req->wfh_id)
                        ->join('employee as em', 'em.e_id', '=', 'wfh.e_id')
                        ->join('employee as em2', 'em2.e_id', '=', 'wfh.wfh_responsible_person')
                        ->select('wfh.*', DB::raw("CONCAT(em.fname, ' ', em.lname) as name"), DB::raw("CONCAT(em2.fname, ' ', em2.lname) as responsible"), 'em.email')
                        ->first();
                    $approveby = Employee::where('e_id', $empLogin['e_id'])
                        ->select(DB::raw("CONCAT(fname, ' ', lname) as approveby"))
                        ->first();
                    $approvewfhdetails = [
                        'wfh_for' => $rowinfo->apply_for,
                        'wfh_date' => Carbon::createFromFormat('Y-m-d', $rowinfo->wfh_date)->format('d-m-Y'),
                        'wfhby' => $rowinfo->name,
                        'responsible' => $rowinfo->responsible,
                        'wfh_reason' => $rowinfo->apply_reason,
                        'approveby' => $approveby->approveby,
                    ];
                    $to =  $rowinfo->email;
                    $msg = "Work From Home Request Rejected";
                    $this->emailService->sendMail($to, $msg, 'ims/mail/admin-mail/rejectwfhmail', ['data' => $approvewfhdetails]);
                    session()->flash('notification', ['type' => 'success', 'message' => "Work-from-home request rejected successfully."]);
                    return response()->json(['message' => 'success']);
                } else {
                    session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
                    return response()->json();
                }
            }
        }
    }
    public function approved_wfh()
    {
        return view('ims/admin/wfh/approved-wfh');
    }
    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : Approve and Reject work-from-home List
     use for  : Fetch the approve and reject work-from-home details in datatable using Ajax
     ---------------------------------------------------------------------------------------------------------*/
    public function approved_wfh_list(Request $request)
    {
        $post = $request->input();
        if ($post) {
            $field_pos = array('wfh_id' => '0', 'apply_for' => '1', 'wfh_date' => '2', 'apply_reason' => '3', 'fname' => '4', 'status' => '5', 'created_at' => '6');
            $sort_field = array_search($post['order']['0']['column'], $field_pos);
            $orderBy = $post['order']['0']['dir'] == 'asc' ? 'ASC' : 'DESC';
            $TotalRecord = Wfh::getApprovedwfhAdmin($post, $sort_field, $orderBy, 0);
            $wfh = Wfh::getApprovedwfhAdmin($post, $sort_field, $orderBy, 1);
            $iTotalRecords = $TotalRecord['NumRecords'];
            $records = array();
            $records['data'] = array();
            $desc = '';
            foreach ($wfh as $key => $value) {
                $status = $value->status == 'Approve' ? '<span class="badge bg-success f-14">Approved</span>' : '<span class="badge f-black bg-warning  f-14">Reject</span>';
                $action = '<div class="f-18"><a href="' . URL('') . '/wfh-details/' . $value->wfh_id  . '"><i class="fa fa-eye" aria-hidden="true"></i></a>
                <a class="ms-1"id="deleteWfh_' . $value->wfh_id  . '" data-id="' . $value->wfh_id . '" href="javascript:void(0)"><i class="fa fa-trash" aria-hidden="true"></i></a></div>';
                $records['data'][] = array(
                    $value->wfh_id,
                    $value->apply_for,
                    date('d-m-Y', strtotime($value->wfh_date)),
                    $value->apply_reason,
                    $value->e_fname . ' ' . $value->e_lname,
                    $value->r_fname . ' ' . $value->r_lname,
                    $status,
                    $action,
                );
            }
            $records['draw'] = intval($post['draw']);
            $records['recordsTotal'] = $iTotalRecords;
            $records['recordsFiltered'] = $iTotalRecords;
            return $records;
            echo json_encode($records);
            exit();
        }
    }
    public function Delete_wfh($id)
    {
        $empLogin = session('emp_login');
        // log entry
        $clientIp = get_client_ip();
        $browser = browser_info();
        $currentTime = now()->format('Y-m-d h:i:s A');
        $username = Employee::where('e_id', $empLogin['e_id'])->select(DB::raw("CONCAT(fname, ' ', lname) as name"))->first();
        $logdata = Wfh::where('wfh_id', $id)->first();
        $logText = "-------------------\nDelete " . $logdata->status . " work-from-home \n[" . $currentTime . "] || User: " . $username->name .
            " || Action: Delete " . $logdata->status . " work-from-home || WFH Date : " . $logdata->wfh_date . "|| WFH for: " . $logdata->apply_for . " || Status :" . $logdata->status . " || IP Address: " . $clientIp .
            " || Browser: " . $browser[1] . " " . $browser[2];
        $logFilePath = storage_path('logs/Admin.log');

        if (!file_exists(dirname($logFilePath))) {
            mkdir(dirname($logFilePath), 0755, true);
        }
        file_put_contents($logFilePath, $logText . PHP_EOL, FILE_APPEND);
        // end log entry

        $data = Wfh::where('wfh_id', $id)->delete();
        if ($data) {
            session()->flash('notification', ['type' => 'success', 'message' => "Work-form-home Delete successfully."]);
            return redirect(url('approved-wfh'));
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('overview'));
        }
    }
    public function add_employee_wfh()
    {
        $empLogin = session('emp_login');
        $e_id = $empLogin['e_id'];
        $team = $empLogin['team'];
       $emp = Employee::selectRaw("CONCAT(fname, ' ', lname) as name, e_id, teams.team")
            ->where('e_id', '!=', $e_id)
            ->join('teams', 'teams.t_id', '=', 'employee.team')
            ->where('status', 'Active')
            ->get();
        return view('ims.admin.wfh.add-emp-wfh', ['emp' => $emp]);
    }
    public function submit_add_emp_wfh(Request $req)
    {
        // return $req;
        $dateRanges = explode(',', $req->wfh_date);
        $sessionData = session('emp_login');

        foreach ($req->wfhBy as $empId) {
            foreach ($dateRanges as $range) {
                if (strpos($range, ' to ') !== false) {
                    $rowdates = explode(' to ', $range);
                    $startDate = Carbon::createFromFormat('d-m-Y', $rowdates[0]);
                    $endDate = Carbon::createFromFormat('d-m-Y', $rowdates[1]);
                    for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                        if ($date->isWeekend()) {
                            continue;
                        }

                        $already = Wfh::where('wfh_date', $date->format('Y-m-d'))
                            ->where('e_id', $empId)
                            ->first();

                        if ($already) {
                            continue;
                        } else {
                            $wfh = new Wfh();
                            $wfh->e_id = $empId;
                            $wfh->apply_for = $req->apply_for;
                            $wfh->wfh_responsible_person = $sessionData['e_id'];
                            $wfh->apply_reason = $req->apply_reason;
                            $wfh->wfh_date = $date->format('Y-m-d');
                            $wfh->insert_by = $sessionData['empid'];
                            $wfh->status = 'Approve';
                            $save = $wfh->save();
                        }
                    }
                } else {
                    $singleDate = Carbon::createFromFormat('d-m-Y', trim($range));
                    if (!$singleDate->isWeekend()) {
                        $already = Wfh::where('wfh_date', $singleDate->format('Y-m-d'))
                            ->where('e_id', $empId)
                            ->first();

                        if ($already) {
                            session()->flash('notification', [
                                'type' => 'danger',
                                'message' => "Leave request for this date has already been submitted for employee ID: $empId."
                            ]);
                            return redirect(url('/overview'));
                        } else {
                            $wfh = new Wfh();
                            $wfh->e_id = $empId;
                            $wfh->apply_for = $req->apply_for;
                            $wfh->wfh_responsible_person = $sessionData['e_id'];
                            $wfh->apply_reason = $req->apply_reason;
                            $wfh->wfh_date = $singleDate->format('Y-m-d');
                            $wfh->insert_by = $sessionData['empid'];
                            $wfh->status = 'Approve';
                            $save = $wfh->save();
                        }
                    } else {
                        session()->flash('notification', [
                            'type' => 'danger',
                            'message' => "Please select a valid weekday date."
                        ]);
                        return redirect(url('/dashboard'));
                    }
                }
            }
        }

        if (isset($save) && $save) {
            session()->flash('notification', [
                'type' => 'success',
                'message' => "Work-from-home request submitted successfully."
            ]);
            return redirect('overview');
        } else {
            session()->flash('notification', [
                'type' => 'danger',
                'message' => "An error occurred. Please try again."
            ]);
            return redirect(url('/dashboard'));
        }
    }
}
