<?php

namespace App\Http\Controllers\ims;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Leaves;
use App\Models\Wfh;
use App\Models\LeaveType;
use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ManageLeavesController extends Controller
{
    protected $emailService;

    public function __construct(MailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function manageleave()
    {
        $empLogin = session('emp_login');
        $e_id = $empLogin['e_id'];
        $leavetypes = LeaveType::where('total_leave', '>', 0)->get();
        return view('ims/attendance/manage-leave',  ['leavetypes' => $leavetypes, 'e_id' => $e_id]);
    }
    public function addleave()
    {
        $empLogin = session('emp_login');
        $employees = Employee::select('e_id', 'fname', 'lname')
        ->where('e_id', '!=', $empLogin['e_id'])
        ->where(function ($query) use ($empLogin) {
            $query->where('team', $empLogin['team'])
            ->orWhere('team', 1);
        })
        ->where('status', 'active')
        ->get();

        if ($employees->isEmpty()) {
            $employees = Employee::select('e_id', 'fname', 'lname')
            ->where('team', 1)
            ->where('e_id', '!=', $empLogin['e_id'])
            ->where('status', 'active')
            ->get();
        }
        $leavetypes = LeaveType::where('total_leave', '>', 0)->get();
        return view('ims/attendance/add-leave', ['employees' => $employees, 'leavetypes' => $leavetypes]);
    }
    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : Submit Leave
     use for  : Add leave request for one day and multiday.
     ---------------------------------------------------------------------------------------------------------*/
     public function submitleave(Request $req)
     {
        // return $req;
        $sessionData = session('emp_login');
        $e_id = $sessionData['e_id'];
        $leave_date = trim($req->leave_date);
        // return $leave_date; 
        // Check if ' , ' exists in $req->leave_date
        if (strpos($req->leave_date,  ',')  !== false) {
            $dates = explode(',', $req->leave_date);
            //   return $leaveDate;    
            foreach ($dates as $dateStr) {
                $dateStr = trim($dateStr);
                $leaveDate = Carbon::createFromFormat('d-m-Y', $dateStr);
                if ($leaveDate->isWeekend()) {
                    continue;
                }

                $already = Leaves::where('leave_date', $leaveDate->format('Y-m-d'))->where('e_id', $e_id)->first();
                if ($already) {
                    continue;
                }

                $leave = new Leaves();
                $leave->e_id = $e_id;
                $leave->leave_for = $req->leave_for;
                $leave->leave_type = $req->leave_type;
                $leave->leave_responsible_person = $req->leave_responsible_person;
                $leave->leave_reason = $req->leave_reason;
                $leave->leave_date = $leaveDate->format('Y-m-d');
                $leave->leave_date_type = 1;
                $leave->is_sandwich = 0;
                $leave->ss_dates = null;
                $leave->u_date = null;
                $leave->is_display = 1;
                $leave->l_identity = null;
                $leave->status = 'Pending';
                $leave->approve_by = null;
                $leave->action_date = null;
                $leave->insert_by = $sessionData['empid'];
                if ($req->hasFile('document')) {
                    $image = $req->file('document')->store(
                        'leave/' . $e_id . '-' . $leaveDate->format('Y-m-d'),
                        'public'
                    );
                    $leave->document = $image;
                }
                $save = $leave->save();
            }
        } else {
            $leaveDate = Carbon::createFromFormat('d-m-Y', $leave_date);
            // $startDate = Carbon::createFromFormat('d-m-Y', $rowdates[0]);
            // $endDate = Carbon::createFromFormat('d-m-Y', $rowdates[1]);

            if ($leaveDate->isWeekend()) {
                session()->flash('notification', ['type' => 'danger', 'message' => "Please select a valid (non-weekend) date."]);
                return redirect(url('/add-leave'));
            }

            $already = Leaves::where('leave_date', $leaveDate->format('Y-m-d'))->where('e_id', $e_id)->first();
            if ($already) {
                session()->flash('notification', ['type' => 'danger', 'message' => "You have already applied for leave on this date."]);
                return redirect(url('/add-leave'));
            } else {
                $leave = new Leaves();
                $leave->e_id = $e_id;
                $leave->leave_for = $req->leave_for;
                $leave->leave_type = $req->leave_type;
                $leave->leave_responsible_person = $req->leave_responsible_person;
                $leave->leave_reason = $req->leave_reason;
                $leave->leave_date =  $leaveDate->format('Y-m-d');
                $leave->leave_date_type = 1;
                $leave->is_sandwich = 0;
                $leave->ss_dates = null;
                $leave->u_date = null;
                $leave->is_display = 1;
                $leave->l_identity = null;
                $leave->status = 'Pending';
                $leave->approve_by = null;
                $leave->action_date = null;
                $leave->insert_by = $sessionData['empid'];
                if ($req->hasFile('document')) {
                    $image = $req->file('document')->store(
                        'leave/' . $e_id . '-' . $leaveDate->format('Y-m-d'),
                        'public'
                    );
                    $leave->document = $image;
                }
                $save = $leave->save();
            }
        }

        if ($save) {
            $id = $leave->id;
            $rowinfo = Leaves::where('lv_id', $id)
            ->join('employee as em', 'em.e_id', '=', 'leaves.e_id')
            ->join('employee as em2', 'em2.e_id', '=', 'leaves.leave_responsible_person')
            ->join('leaves_type as lt', 'lt.lt_id', '=', 'leaves.leave_type')
            ->select('leaves.*', 'lt.leave_type', DB::raw("CONCAT(em.fname, ' ', em.lname) as name"), DB::raw("CONCAT(em2.fname, ' ', em2.lname) as responsible"))
            ->first();
            $leaveDetails = [
                'leave_for' => ucfirst($rowinfo->leave_for),
                'leave_type' => ucfirst($rowinfo->leave_type),
                'leave_date' => $req->leave_date,
                'leaveby' => $rowinfo->name,
                'responsible' => $rowinfo->responsible,
                'leave_reason' => $rowinfo->leave_reason,
            ];
            $team_member = Employee::where('team', $sessionData['team'])->where('team_lead', 1)->select('email', 'e_id')->get();
            $leaveDetails['url'] =  url('pending-leave/');
            $to = env('HR_EMAIL');

            // leave mail not sent if the leave is applied by team lead
            if ($team_member->pluck('e_id')->contains($e_id)) {
                $other_team_leads = $team_member->filter(function ($lead) use ($e_id) {
                    return $lead->e_id != $e_id;
                });
                $cc = array_merge([env('ADMIN_EMAIL')], $other_team_leads->pluck('email')->toArray());
            } else {
                $cc = array_merge([env('ADMIN_EMAIL')], $team_member->pluck('email')->toArray());
            }

            $msg = 'Leave Request from ' . $rowinfo->name;
            $this->emailService->sendMail($to, $msg, 'ims/mail/leaverequest', ['data' => $leaveDetails], $cc);
            session()->flash('notification', ['type' => 'success', 'message' => "Leave request submitted successfully."]);
            return redirect(url('/manage-leave'));
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('/add-leave'));
        }
        
    }
    public function leave_info(Request $req)
    {
        $data = Leaves::selectRaw("CONCAT(em.fname, ' ', em.lname) as name, CONCAT(rsp.fname, ' ', rsp.lname) as responsible , lt.leave_type as leaveName ,leaves.*")->where('lv_id', $req->id)
        ->join('employee as em', 'em.e_id', '=', 'leaves.e_id')
        ->join('employee as rsp', 'rsp.e_id', '=', 'leaves.leave_responsible_person')
        ->join('leaves_type as lt', 'lt.lt_id', '=', 'leaves.leave_type')
        ->first();
        $data->leave_date =  date('d-m-Y', strtotime($data->leave_date));
        $data->created  = date('d-m-Y', strtotime($data->created_at));
        return response()->json(['data' => $data]);
    }
    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : Leave List
     use for  : Fetch the Leave details in datatable using Ajax
     ---------------------------------------------------------------------------------------------------------*/
     public function leave_list(Request $request)
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
            $TotalRecord = Leaves::getLeavelist($post, $sort_field, $orderBy, 0);
            $leaves = Leaves::getLeavelist($post, $sort_field, $orderBy, 1);
            $iTotalRecords = $TotalRecord['NumRecords'];
            $records = array();
            $records['data'] = array();
            $desc = '';
            foreach ($leaves as $key => $value) {
                if ($value->status == 'Pending') {
                    $action = '<div class="d-flex f-18 justify-content-start gap-2"><a href="javascript:void(0)" id="leave-details_' . $value->lv_id  . '" data-id="' . $value->lv_id . '"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    <a href="' . URL('') . '/delete-leave/' . $value->lv_id  . '"><i class="fa fa-trash" aria-hidden="true"></i></a> </div>';
                } else {
                    $action = '<div class="d-flex f-18 justify-content-start"><a href="javascript:void(0)" id="leave-details_' . $value->lv_id  . '" data-id="' . $value->lv_id . '"><i class="fa fa-eye" aria-hidden="true"></i></a></div>';
                }
                $records['data'][] = array(
                 ($iTotalRecords - (($post['start'] ?? 0) + $key)),
                 $value->leave_for,
                 $value->leaveName,
                 date('d-m-Y', strtotime($value->leave_date)),
                 $value->status,
                 date('d-m-Y', strtotime($value->created_at)),
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

    public function delete_leave($id)
    {
        $data = Leaves::where('lv_id', $id)->first();
        if ($data) {
            $save = Leaves::where('lv_id', $id)->where('status', 'Pending')->delete();
            if ($save) {
                session()->flash('notification', ['type' => 'success', 'message' => "Leave deleted successfully."]);
                return redirect('manage-leave');
            }
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect('dashboard');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect('dashboard');
        }
    }
    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : Submit Leave
     use for  : Submit leave request and calculate the sandwich leave.
     ---------------------------------------------------------------------------------------------------------*/
    // public function  submitleave_backup(Request $req)
    // {
    //     $sessionData = session('emp_login');
    //     $Dates = explode('to', $req->leave_date);
    //     $identifier = Leaves::generateUniqueIdentifier();
    //     $all_dates = [];
    //     $insertData = [];
    //     if (count($Dates) == 1) {
    //         // 'single day';
    //         $leaveDate = $Dates[0];
    //         $carbonDate = Carbon::parse($leaveDate);
    //         if ($carbonDate->isFriday()) {
    //             // day is friday
    //             for ($i = 1; $i <= 3; $i++) {
    //                 $all_dates[] = $carbonDate->copy()->addDays($i)->toDateString();
    //             }
    //             $all_dates = array_values(array_reverse($all_dates));
    //             $CheckLeaveDate = $all_dates[0];
    //             $precheck  = Leaves::where('e_id', $sessionData['e_id'])->where('leave_for', 'Full Day')->wheredate('leave_date', $CheckLeaveDate)->where('status', 'Approve')->first();
    //             if ($precheck) {
    //                 unset($all_dates[0]);
    //                 $ss_date = json_encode($all_dates);
    //                 $sandwich = 1;
    //                 foreach ($all_dates as $dkey => $dvalue) {
    //                     $dvalue = Carbon::parse($dvalue);
    //                     if ($dvalue->isSaturday() || $dvalue->isSunday()) {
    //                         $tempdata = array(
    //                             'e_id' => $sessionData['e_id'],
    //                             'leave_for' => $req->leave_for,
    //                             'leave_type' => $req->leave_type,
    //                             'leave_responsible_person' => $req->leave_responsible_person,
    //                             'leave_reason' => $req->leave_reason,
    //                             'leave_date_type' => 0,
    //                             'leave_date' => date('Y-m-d', strtotime($dvalue)),
    //                             'is_sandwich' => $sandwich,
    //                             'status' => 'Approve',
    //                             'is_display' => 0,
    //                             'l_identity' => $identifier
    //                         );
    //                         array_push($insertData, $tempdata);
    //                     }
    //                 }
    //             } else {
    //                 $CheckLeaveDate = null;
    //                 $ss_date = null;
    //                 $sandwich = 0;
    //             }
    //             $tempdata = array(
    //                 'e_id' => $sessionData['e_id'],
    //                 'leave_for' => $req->leave_for,
    //                 'leave_type' => $req->leave_type,
    //                 'leave_responsible_person' => $req->leave_responsible_person,
    //                 'leave_reason' => $req->leave_reason,
    //                 'leave_date_type' => 0,
    //                 'leave_date' => date('Y-m-d', strtotime($leaveDate)),
    //                 'is_sandwich' => $sandwich,
    //                 'ss_dates' => $ss_date,
    //                 'u_date' => $CheckLeaveDate,
    //                 'l_identity' => $identifier
    //             );
    //             array_push($insertData, $tempdata);
    //         } elseif ($carbonDate->isMonday()) {
    //             // day is monday check all 3 day dates
    //             for ($i = 1; $i <= 3; $i++) {
    //                 $all_dates[] = $carbonDate->copy()->subDays($i)->toDateString();
    //             }
    //             $all_dates = array_values(array_reverse($all_dates));
    //             $CheckLeaveDate = $all_dates[0];
    //             $precheck  = Leaves::where('e_id', $sessionData['e_id'])->where('leave_for', 'Full Day')->wheredate('leave_date', $CheckLeaveDate)->where('status', 'Approve')->first();
    //             if ($precheck) {
    //                 unset($all_dates[0]);
    //                 $ss_date = json_encode($all_dates);
    //                 $sandwich = 1;
    //                 foreach ($all_dates as $dkey => $dvalue) {
    //                     $dvalue = Carbon::parse($dvalue);
    //                     if ($dvalue->isSaturday() || $dvalue->isSunday()) {
    //                         $tempdata = array(
    //                             'e_id' => $sessionData['e_id'],
    //                             'leave_for' => $req->leave_for,
    //                             'leave_type' => $req->leave_type,
    //                             'leave_responsible_person' => $req->leave_responsible_person,
    //                             'leave_reason' => $req->leave_reason,
    //                             'leave_date_type' => 0,
    //                             'leave_date' => date('Y-m-d', strtotime($dvalue)),
    //                             'is_sandwich' => $sandwich,
    //                             'status' => 'Approve',
    //                             'is_display' => 0,
    //                             'l_identity' => $identifier
    //                         );
    //                         array_push($insertData, $tempdata);
    //                     }
    //                 }
    //             } else {
    //                 $CheckLeaveDate = null;
    //                 $ss_date = null;
    //                 $sandwich = 0;
    //             }
    //             $tempdata = array(
    //                 'e_id' => $sessionData['e_id'],
    //                 'leave_for' => $req->leave_for,
    //                 'leave_type' => $req->leave_type,
    //                 'leave_responsible_person' => $req->leave_responsible_person,
    //                 'leave_reason' => $req->leave_reason,
    //                 'leave_date_type' => 0,
    //                 'leave_date' => date('Y-m-d', strtotime($leaveDate)),
    //                 'is_sandwich' => $sandwich,
    //                 'ss_dates' => $ss_date,
    //                 'u_date' => $CheckLeaveDate,
    //                 'l_identity' => $identifier
    //             );
    //             array_push($insertData, $tempdata);
    //         } else {
    //             $sandwich = 0;
    //             $tempdata = array(
    //                 'e_id' => $sessionData['e_id'],
    //                 'leave_for' => $req->leave_for,
    //                 'leave_type' => $req->leave_type,
    //                 'leave_responsible_person' => $req->leave_responsible_person,
    //                 'leave_reason' => $req->leave_reason,
    //                 'leave_date_type' => 0,
    //                 'leave_date' => date('Y-m-d', strtotime($leaveDate)),
    //                 'is_sandwich' => $sandwich,
    //                 'ss_dates' => null,
    //                 'u_date' => null,
    //                 'l_identity' => $identifier
    //             );
    //             array_push($insertData, $tempdata);
    //         }
    //         foreach ($insertData as $ikey => $ivalue) {
    //             $save = Leaves::insert($ivalue);
    //         }
    //         if ($save) {
    //             session()->flash('notification', ['type' => 'success', 'message' => "Leave Request send"]);
    //             return redirect(url('/manage-leave'));
    //         } else {
    //             session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
    //             return redirect(url('/add-leave'));
    //         }
    //     } else {
    //         // 'multiple day';
    //         $startDate = $Dates[0];
    //         $endDate = $Dates[1];
    //         $all_app_leave_date = $this->getDatesBetween($startDate, $endDate);
    //         $formatedStartDate = Carbon::parse($startDate);
    //         $formatedEndDate = Carbon::parse($endDate);
    //         $weekend = 0;
    //         $ssDates = [];
    //         for ($date = $formatedStartDate->copy()->addDay(); $date->lt($formatedEndDate); $date->addDay()) {
    //             if ($date->isSaturday() || $date->isSunday()) {
    //                 $ssDates[] = date('Y-m-d', strtotime($date));
    //                 $weekend = 1; // Return true if a Saturday or Sunday is found
    //             }
    //         }
    //         if ($formatedStartDate->isMonday()) {
    //             // apply for the start day was monday.
    //             for ($i = 1; $i <= 3; $i++) {
    //                 $all_dates[] = $formatedStartDate->copy()->subDays($i)->toDateString();
    //             }
    //             $all_dates = array_values(array_reverse($all_dates));
    //             $CheckLeaveDate = $all_dates[0];
    //             $precheck  = Leaves::where('e_id', $sessionData['e_id'])->where('leave_for', 'Full Day')->wheredate('leave_date', $CheckLeaveDate)->where('status', 'Approve')->first();
    //             if ($precheck) {
    //                 unset($all_dates[0]);
    //                 $ss_date = json_encode($all_dates);
    //                 $sandwich = 1;
    //                 foreach ($all_dates as $dkey => $dvalue) {
    //                     $dvalue = Carbon::parse($dvalue);
    //                     if ($dvalue->isSaturday() || $dvalue->isSunday()) {
    //                         $tempdata = array(
    //                             'e_id' => $sessionData['e_id'],
    //                             'leave_for' => $req->leave_for,
    //                             'leave_type' => $req->leave_type,
    //                             'leave_responsible_person' => $req->leave_responsible_person,
    //                             'leave_reason' => $req->leave_reason,
    //                             'leave_date_type' => 0,
    //                             'leave_date' => date('Y-m-d', strtotime($dvalue)),
    //                             'is_sandwich' => $sandwich,
    //                             'status' => 'Approve',
    //                             'is_display' => 0,
    //                             'l_identity' => $identifier
    //                         );
    //                         array_push($insertData, $tempdata);
    //                     }
    //                 }
    //             } else {
    //                 $CheckLeaveDate = null;
    //                 $ss_date = null;
    //                 $sandwich = 0;
    //             }
    //             foreach ($all_app_leave_date as $lkey => $lvalue) {
    //                 $tempdata = array(
    //                     'e_id' => $sessionData['e_id'],
    //                     'leave_for' => $req->leave_for,
    //                     'leave_type' => $req->leave_type,
    //                     'leave_responsible_person' => $req->leave_responsible_person,
    //                     'leave_reason' => $req->leave_reason,
    //                     'leave_date_type' => 0,
    //                     'leave_date' => date('Y-m-d', strtotime($lvalue)),
    //                     'is_sandwich' => $sandwich,
    //                     'ss_dates' => $ss_date,
    //                     'u_date' => $CheckLeaveDate,
    //                     'l_identity' => $identifier
    //                 );
    //                 array_push($insertData, $tempdata);
    //             }
    //         } else if ($weekend == 1) {
    //             foreach ($all_app_leave_date as $alkey => $alvalue) {
    //                 if (in_array($alvalue, $ssDates)) {
    //                     $tempdata = array(
    //                         'e_id' => $sessionData['e_id'],
    //                         'leave_for' => $req->leave_for,
    //                         'leave_type' => $req->leave_type,
    //                         'leave_responsible_person' => $req->leave_responsible_person,
    //                         'leave_reason' => $req->leave_reason,
    //                         'leave_date_type' => 0,
    //                         'leave_date' => date('Y-m-d', strtotime($alvalue)),
    //                         'is_sandwich' => 1,
    //                         'ss_dates' => null,
    //                         'u_date' => null,
    //                         'is_display' => 0,
    //                         'status' => 'Approve',
    //                         'l_identity' => $identifier
    //                     );
    //                 } else {
    //                     $tempdata = array(
    //                         'e_id' => $sessionData['e_id'],
    //                         'leave_for' => $req->leave_for,
    //                         'leave_type' => $req->leave_type,
    //                         'leave_responsible_person' => $req->leave_responsible_person,
    //                         'leave_reason' => $req->leave_reason,
    //                         'leave_date_type' => 0,
    //                         'leave_date' => date('Y-m-d', strtotime($alvalue)),
    //                         'is_sandwich' => 1,
    //                         'ss_dates' => json_encode($ssDates),
    //                         'u_date' => null,
    //                         'l_identity' => $identifier
    //                     );
    //                 }
    //                 array_push($insertData, $tempdata);
    //             }
    //         } else {
    //             foreach ($all_app_leave_date as $alkey => $alvalue) {
    //                 $tempdata = array(
    //                     'e_id' => $sessionData['e_id'],
    //                     'leave_for' => $req->leave_for,
    //                     'leave_type' => $req->leave_type,
    //                     'leave_responsible_person' => $req->leave_responsible_person,
    //                     'leave_reason' => $req->leave_reason,
    //                     'leave_date_type' => 0,
    //                     'leave_date' => date('Y-m-d', strtotime($alvalue)),
    //                     'is_sandwich' => 0,
    //                     'ss_dates' => null,
    //                     'u_date' => null,
    //                     'l_identity' => $identifier
    //                 );
    //                 array_push($insertData, $tempdata);
    //             }
    //         }
    //         foreach ($insertData as $ikey => $ivalue) {
    //             $save = Leaves::insert($ivalue);
    //         }
    //         if ($save) {
    //             session()->flash('notification', ['type' => 'success', 'message' => "Leave Request send"]);
    //             return redirect(url('/manage-leave'));
    //         } else {
    //             session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
    //             return redirect(url('/add-leave'));
    //         }
    //     }
    // }
    // function getDatesBetween($start_date, $end_date)
    // {
    //     $startDate = Carbon::parse($start_date);
    //     $endDate = Carbon::parse($end_date);
    //     $dates = [];
    //     for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
    //         $dates[] = $date->toDateString();
    //     }
    //     return $dates;
    // }

     public function managewfh()
     {
        $empLogin = session('emp_login');
        $e_id = $empLogin['e_id'];
        $leavetypes = LeaveType::where('total_leave', '>', 0)->get();
        return view('ims/attendance/manage-wfh', ['leavetypes' => $leavetypes, 'e_id' => $e_id]);
    }

    public function workformhome()
    {
        $empLogin = session('emp_login');
        $employees = Employee::select('e_id', 'fname', 'lname')
        ->where('e_id', '!=', $empLogin['e_id'])
        ->where(function ($query) use ($empLogin) {
            $query->where('team', $empLogin['team'])
            ->orWhere('team', 1);
        })
        ->where('status', 'active')
        ->get();
        if ($employees->isEmpty()) {
            $employees = Employee::select('e_id', 'fname', 'lname')
            ->where('status', 'active')
            ->where('team', 1)
            ->where('e_id', '!=', $empLogin['e_id'])
            ->get();
        }
        return view('ims/attendance/work-from-home', ['employees' => $employees]);
    }
    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : Submit Work from home
     use for  : add work from home request (one day and multiple day request).
     ---------------------------------------------------------------------------------------------------------*/
     public function submitwfh(Request $req)
     {

        $sessionData = session('emp_login');
        $e_id = $sessionData['e_id'];
        $dateRanges = explode(',', $req->wfh_date);
        foreach ($dateRanges as $range) {
            if (strpos($range, ' to ') !== false) {
                $rowdates = explode(' to ', $range);

                $startDate = Carbon::createFromFormat('d-m-Y', $rowdates[0]);
                $endDate = Carbon::createFromFormat('d-m-Y', $rowdates[1]);
                for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                    if ($date->isWeekend()) {
                        continue;
                    }
                    $allready = Wfh::where('wfh_date', $date->format('Y-m-d'))->where('e_id', $sessionData['e_id'])->first();
                    if ($allready) {
                        continue;
                    } else {
                        $wfh = new Wfh();
                        $wfh->e_id = $sessionData['e_id'];
                        $wfh->apply_for = $req->apply_for;
                        $wfh->wfh_responsible_person = $req->wfh_responsible_person;
                        $wfh->apply_reason = $req->apply_reason;
                        $wfh->wfh_date = $date->format('Y-m-d');
                        $wfh->insert_by = $sessionData['empid'];
                        $save = $wfh->save();
                    }
                }
            } else {
                $singleDate = Carbon::createFromFormat('d-m-Y', trim($range));

                if (!$singleDate->isWeekend()) {
                    $allready = Wfh::where('wfh_date',  $singleDate->format('Y-m-d'))->where('e_id', $sessionData['e_id'])->first();
                    if ($allready) {
                        session()->flash('notification', ['type' => 'danger', 'message' => "Leave request for this date has already been submitted."]);
                        return redirect(url('/work-from-home'));
                    } else {
                        $wfh = new Wfh();
                        $wfh->e_id = $sessionData['e_id'];
                        $wfh->apply_for = $req->apply_for;
                        $wfh->wfh_responsible_person = $req->wfh_responsible_person;
                        $wfh->apply_reason = $req->apply_reason;
                        $wfh->wfh_date = $singleDate->format('Y-m-d');
                        $wfh->insert_by = $sessionData['empid'];
                        $save = $wfh->save();
                    }
                } else {
                    session()->flash('notification', ['type' => 'danger', 'message' => "Please select a valid date."]);
                    return redirect(url('/work-from-home'));
                }
            }
        }
        if ($save) {
            $id = $wfh->id;
            $rowinfo = wfh::where('wfh_id', $id)
            ->join('employee as em', 'em.e_id', '=', 'wfh.e_id')
            ->join('employee as em2', 'em2.e_id', '=', 'wfh.wfh_responsible_person')
            ->select('wfh.*', DB::raw("CONCAT(em.fname, ' ', em.lname) as name"), DB::raw("CONCAT(em2.fname, ' ', em2.lname) as responsible"))
            ->first();
            $wfhDetails = [
                'wfh_for' => ucfirst($rowinfo->apply_for),
                'wfh_date' => $req->wfh_date,
                'wfhby' => $rowinfo->name,
                'responsible' =>  ucfirst($rowinfo->responsible),
                'wfh_reason' => $rowinfo->apply_reason,
            ];
            $team_member = Employee::where('team', $sessionData['team'])->where('team_lead', 1)->select('email', 'e_id')->get();
            $wfhDetails['url'] =  url('pending-wfh/');
            $to = env('HR_EMAIL');
            // leave mail not sent if the leave is applied by team lead
            if ($team_member->pluck('e_id')->contains($e_id)) {
                $other_team_leads = $team_member->filter(function ($lead) use ($e_id) {
                    return $lead->e_id != $e_id;
                });
                $cc = array_merge([env('ADMIN_EMAIL')], $other_team_leads->pluck('email')->toArray());
            } else {
                $cc = array_merge([env('ADMIN_EMAIL')], $team_member->pluck('email')->toArray());
            }
            $msg = "Work From Home Request";
            $this->emailService->sendMail($to, $msg, 'ims/mail/wfhrequest', ['data' => $wfhDetails], $cc);
            session()->flash('notification', ['type' => 'success', 'message' => "Work-from-home request submitted successfully."]);
            return redirect('manage-wfh');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('/work-from-home'));
        }
    }
    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : Leave List
     use for  : Fetch the Work form Home details in datatable using Ajax
     ---------------------------------------------------------------------------------------------------------*/
     public function wfhlist(Request $request)
     {
        $post = $request->input();
        if ($post) {
            $field_pos = array('wfh_id' => '0', 'apply_for' => '1', 'wfh_date' => '2', 'apply_reason' => '3', 'fname' => '4', 'lname' => '5', 'created_at' => '6');
            $sort_field = array_search($post['order']['0']['column'], $field_pos);
            if ($post['order']['0']['dir'] == 'asc') {
                $orderBy = "ASC";
            } else {
                $orderBy = 'DESC';
            }
            $totalRecord = Wfh::getWfhList($post, $sort_field, $orderBy, 0);
            $wfhList = Wfh::getWfhList($post, $sort_field, $orderBy, 1);
            $totalRecords = $totalRecord['NumRecords'];
            $records = array();
            $records['data'] = array();
            foreach ($wfhList as $key => $value) {
                if ($value->status == 'Pending') {
                    $action = '<div class="d-flex f-18 justify-content-start gap-2">
                    <a  href="javascript:void(0)" id="wfh-details_' . $value->wfh_id  . '" data-id="' . $value->wfh_id . '"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    <a href="' . URL('') . '/delete-wfh/' . $value->wfh_id . '"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </div>';
                } else {
                    $action = '<div class="d-flex f-18 justify-content-start gap-2">
                    <a  href="javascript:void(0)" id="wfh-details_' . $value->wfh_id  . '" data-id="' . $value->wfh_id . '"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    </div>';
                }
                $records['data'][] = array(
                    ($totalRecords - (($post['start'] ?? 0) + $key)),
                    $value->apply_for,
                    date('d-m-Y', strtotime($value->wfh_date)),
                    $value->apply_reason,
                    $value->fname . ' ' . $value->lname,
                    $value->status,
                    date('d-m-Y', strtotime($value->created_at)),
                    $action,
                );
            }
            $records['draw'] = intval($post['draw']);
            $records['recordsTotal'] = $totalRecords;
            $records['recordsFiltered'] = $totalRecords;
            echo json_encode($records);
            exit();
        }
    }

    public function wfh_info(Request $req)
    {
        // return $req;
        $data = Wfh::selectRaw(" CONCAT(em.fname, ' ', em.lname) as responsible ,wfh.*")
        ->where('wfh_id', $req->id)
        ->join('employee as em', 'em.e_id', '=', 'wfh.wfh_responsible_person')
        ->first();
        $data->wfh_date =  date('d-m-Y', strtotime($data->wfh_date));
        $data->created  = date('d-m-Y', strtotime($data->created_at));
        return response()->json(['data' => $data]);
    }
    public function delete_wfh($id)
    {
        $data = wfh::where('wfh_id', $id)->first();
        if ($data) {
            $save = wfh::where('wfh_id', $id)->where('status', 'Pending')->delete();
            if ($save) {
                session()->flash('notification', ['type' => 'success', 'message' => "Request deleted successfully."]);
                return redirect('manage-wfh');
            }
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect('dashboard');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect('dashboard');
        }
    }
}
