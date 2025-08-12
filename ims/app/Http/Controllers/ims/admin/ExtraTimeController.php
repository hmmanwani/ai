<?php

namespace App\Http\Controllers\ims\admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\ExtraHours;
use App\Models\ProjectDetails;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ExtraTimeController extends Controller
{
    public function approve_extra_time()
    {
        return view('ims/admin/extra-time/approve-extra-time');
    }
    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : Approve Extra Time List
     use for  : Fetch the pending extra time details in datatable using Ajax
     ---------------------------------------------------------------------------------------------------------*/
    public function get_approve_extra_time(Request $request)
    {
        $post = $request->input();
        if ($post) {
            $field_pos = array('ex_id' => '0', 'employeeName' => '1', 'starting_time' => '2', 'ending_time' => '3', 'working_hours' => '4', 'status' => '5');
            $sort_field = array_search($post['order']['0']['column'], $field_pos);
            if ($post['order']['0']['dir'] == 'asc') {
                $orderBy = "ASC";
            } else {
                $orderBy = 'DESC';
            }
            $TotalRecord = ExtraHours::getApproveExtraTimeAdmin($post, $sort_field, $orderBy, 0);
            $extra_time = ExtraHours::getApproveExtraTimeAdmin($post, $sort_field, $orderBy, 1);
            $iTotalRecords = $TotalRecord['NumRecords'];
            $records = array();
            $records['data'] = array();
            $desc = '';
            foreach ($extra_time as $key => $value) {
                $starting_date_time = new \DateTime($value->starting_time);
                $starting_date = $starting_date_time->format('Y-m-d');
                $starting_time = $starting_date_time->format('h:i A');
                $ending_date_time = new \DateTime($value->ending_time);
                $ending_date = $starting_date_time->format('Y-m-d');
                $ending_time = $ending_date_time->format('h:i A');
                $status = '<span class="badge bg-danger f-14 approve-status" data-id="' . $value->ex_id . '">Pending</span>';
                $action = '<div class="d-flex f-18 justify-content-start"><a href="javascript:void(0)" id="extra-time-details_' . $value->ex_id  . '" data-id="' . $value->ex_id . '"><i class="fa fa-eye" aria-hidden="true"></i></a></div>';
                $records['data'][] = array(
                    $value->ex_id,
                    $value->fname . ' ' . $value->lname,
                    date('d-m-Y', strtotime($starting_date)),
                    $starting_time,
                    date('d-m-Y', strtotime($ending_date)),
                    $ending_time,
                    $value->working_hour,
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
    public function approveExtraTime(Request $request)
    {
        $ex_id = $request->ex_id;
        $data = ExtraHours::where('ex_id', $ex_id)->first();
        $e_id = $data->e_id;
        $formattedDate = Carbon::parse($data->starting_time)->format('Y-m-d');
        $attendance = Attendance::where('e_id', $e_id)->where('date', $formattedDate)->first();
        if ($attendance) {
            $updateattendance = Attendance::where('e_id', $e_id)->where('date', $formattedDate)->update(['ex_id' => $ex_id]);
            $update = ExtraHours::where('ex_id', $ex_id)->update(['status' => 'Approve']);
            session()->flash('notification', ['type' => 'success', 'message' => "Extra time updated successfully."]);
            return response()->json();
        } else {
            $attendance = new Attendance();
            $attendance->e_id = $e_id;
            $attendance->ex_id = $ex_id;
            $attendance->date = $formattedDate;
            $attendance->login_time = null;
            $attendance->logout_time = null;
            $attendance->working_hours = null;
            $attendance->presence = 4;
            $sava = $attendance->save();
            $update = ExtraHours::where('ex_id', $ex_id)->update(['status' => 'Approve']);
            if ($sava) {
                session()->flash('notification', ['type' => 'success', 'message' => "Status updated and record saved successfully."]);
                return response()->json();
            }
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return response()->json();
        }
        echo 'success';
    }

    public function extra_time_details(Request $req)
    {
        $data = ExtraHours::select('extra_hours.*', 'em.fname', 'em.lname')->where('ex_id', $req->id)
            ->join('employee as em', 'em.e_id', '=', 'extra_hours.e_id')
            ->first();
        $project = '';
        if (!is_null($data->p_id)) {
            $project = ProjectDetails::select('project_title')
                ->where('p_id', $data->p_id)
                ->first();
        }
        return response()->json(['data' => $data, 'project' => $project]);
    }
}
