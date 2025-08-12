<?php

namespace App\Http\Controllers\ims;

use App\Http\Controllers\Controller;
use App\Models\ExtraHours;
use App\Models\ProjectDetails;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ManageExtraTimeController extends Controller
{
    public function manage_extra_time()
    {
        return view('ims/extra-time/manage-extra-time');
    }
    public function add_extra_time()
    {
        $empLogin = session()->get('emp_login');
        $e_id = $empLogin['e_id'];
        $project = ProjectDetails::select('p_id', 'project_title')
            ->where('status', 'Active')
            ->where('emp', 'LIKE', '%' . $e_id . '%')
            ->orWhere('sub_emp', 'LIKE', '%' . $e_id . '%')
            ->get();
        return view('ims/extra-time/add-extra-time', (['project' => $project]));
    }
    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : Submit Extra Hours(Overtime)
     use for : Submit the Overtime data into the database.
     ---------------------------------------------------------------------------------------------------------*/
    public function submit_extra_hours(Request $req)
    {
        $empLogin = session('emp_login');
        $e_id = $empLogin['e_id'];

        // create starting date format
        $combined_starting_date = Carbon::createFromFormat('d-m-Y H:i', $req->starting_date . ' ' .  $req->starting_time);
        $starting = $combined_starting_date->format('Y-m-d H:i');

        // create ending date format
        $combined_ending_date = Carbon::createFromFormat('d-m-Y H:i', $req->ending_date . ' ' .  $req->ending_time);
        $ending = $combined_ending_date->format('Y-m-d H:i');

        // calculate the difference (using Carbon instances)
        $totalHours = $combined_starting_date->diffInHours($combined_ending_date);
        $totalMinutes = $combined_starting_date->diffInMinutes($combined_ending_date) % 60;
        $totalSeconds = $combined_starting_date->diffInSeconds($combined_ending_date) % 60;

        // format working hours as HH:mm:ss
        $workingHours = sprintf('%02d:%02d:%02d', $totalHours, $totalMinutes, $totalSeconds);

        // save to the database
        $extratime = new ExtraHours();
        $extratime->e_id = $e_id;
        $extratime->p_id = $req->p_id;
        $extratime->starting_time = $starting;
        $extratime->ending_time = $ending;
        $extratime->working_hour = $workingHours;
        $extratime->task_description = $req->task_description;
        $save = $extratime->save();

        if ($save) {
            session()->flash('notification', ['type' => 'success', 'message' => "Extra time logged successfully."]);
            return redirect('manage-extra-time');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect('add-extra-time');
        }
    }

    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : extra time List (user side)
     use for  : Fetch the extra time details in datatable using Ajax
     ---------------------------------------------------------------------------------------------------------*/
    public function extra_time_list(Request $request)
    {
        $post = $request->input();
        if ($post) {
            $field_pos = array('ex_id' => '0', 'starting_time' => '1', 'ending_time' => '2', 'working_hour' => '3');
            $sort_field = array_search($post['order']['0']['column'], $field_pos);

            if ($post['order']['0']['dir'] == 'asc') {
                $orderBy = "ASC";
            } else {
                $orderBy = 'DESC';
            }
            $TotalRecord = ExtraHours::getextratimelist($post, $sort_field, $orderBy, 0);
            $extrahours = ExtraHours::getextratimelist($post, $sort_field, $orderBy, 1);
            $iTotalRecords = $TotalRecord['NumRecords'];
            $records = array();
            $records['data'] = array();
            $desc = '';
            foreach ($extrahours as $key => $value) {
                $action = '<div class="d-flex f-18 justify-content-start"><a href="javascript:void(0)" id="extra-time-details_' . $value->ex_id  . '" data-id="' . $value->ex_id . '"><i class="fa fa-eye" aria-hidden="true"></i></a></div>';
                if ($value->status != 'Approve') {
                    $action = '<div class="d-flex f-18 justify-content-start"><a href="javascript:void(0)" class="me-3" id="extra-time-details_' . $value->ex_id  . '" data-id="' . $value->ex_id . '"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a href="' . URL('') . '/delete-extra-time/' . $value->ex_id  . '"><i class="fa fa-trash" aria-hidden="true"></i></a></div>';
                }
                $starting_date_time = new \DateTime($value->starting_time);
                $starting_date = $starting_date_time->format('Y-m-d h:i A');
                $ending_date_time = new \DateTime($value->ending_time);
                $ending_date = $ending_date_time->format('Y-m-d h:i A');
                $records['data'][] = array(
                   ($iTotalRecords - (($post['start'] ?? 0) + $key)),
                    date('d-m-Y h:i A', strtotime($starting_date)),
                    date('d-m-Y h:i A', strtotime($ending_date)),
                    $value->working_hour,
                    $value->status,
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
    public function user_extra_time_details(Request $req)
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

    public function delete_extra_time($id)
    {
        $data = ExtraHours::where('ex_id', $id)->first();
        if ($data) {
            $save = ExtraHours::where('ex_id', $id)->where('status', 'Pending')->delete();
            if ($save) {
                session()->flash('notification', ['type' => 'success', 'message' => "Request deleted successfully."]);
                return redirect('manage-extra-time');
            }
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect('dashboard');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect('dashboard');
        }
    }
}
