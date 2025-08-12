<?php

namespace App\Http\Controllers\ims;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\ProjectDetails;
use App\Models\Team;
use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    protected $emailService;

    public function __construct(MailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function project()
    {
        $empLogin = session()->get('emp_login');
        $data['team_name'] = Team::where('t_id', $empLogin['team'])->first();
        if ($empLogin['team'] == 1 || $empLogin['team'] == 2) {
            $data['team_emp'] = Employee::select('e_id', 'fname', 'lname', 'teams.team')->where('e_id', '!=', $empLogin['e_id'])->join('teams', 'teams.t_id', '=', 'employee.team')->where('status', 'Active')->get();
        } else {
            $data['team_emp'] = Employee::select('e_id', 'fname', 'lname')->where('team', $empLogin['team'])->where('e_id', '!=', $empLogin['e_id'])->where('status', 'Active')->get();
        }
        // Grouping employees by team
        $teamWiseEmployees = [];
        foreach ($data['team_emp'] as $employee) {
            $teamWiseEmployees[$employee->team][] = $employee;
        }
        return view('ims/project/project', ['data' => $data, 'teamWiseEmployees' => $teamWiseEmployees]);
    }

    public function add_project()
    {
        $emp = Employee::select('fname', 'lname', 'e_id')
            ->where('status', 'Active')->where('team_lead', 1)->get();
        return view('ims/manage-project/add-project', (['emp' => $emp]));
    }

    public function submit_project(Request $req)
    {

        $empLogin = $req->session()->get('emp_login');
        $project = new ProjectDetails();
        $project->project_title = $req->project_title;
        $project->supportive_link = null;
        $project->start_date = date('Y-m-d', strtotime($req->start_date));
        $project->end_date = date('Y-m-d', strtotime($req->end_date));
        $project->project_description = $req->project_description;
        $project->create_by = $empLogin['e_id'];
        $project->emp = json_encode($req->emp);
        $save = $project->save();
        if ($save) {
            $id = $project->id;
            $rowinfo = ProjectDetails::where('p_id', $id)
                ->join('employee as em', 'em.e_id', '=', 'project_details.create_by')
                ->select('project_details.*', DB::raw("CONCAT(em.fname, ' ', em.lname) as name"))
                ->first();
            $empArray = json_decode($rowinfo->emp, true);
            $empNames = Employee::whereIn('e_id', $empArray)
                ->select(DB::raw("CONCAT(fname, ' ', lname) as name"))
                ->pluck('name');
            $projectDetails = [
                'project_title' => $rowinfo->project_title,
                'project_description' => $rowinfo->project_description,
                'start_date' => $req->start_date,
                'end_date' => $req->end_date,
                'emp' => $empNames->implode(', '),
                'create_by' => $rowinfo->name,
            ];
            $email = Employee::whereIn('e_id', $req->emp)
                ->pluck('email');
            $to =  env('HR_EMAIL');
            $cc =  env('ADMIN_EMAIL');
            $msg = "New Project";
            // $this->emailService->sendMail($to, $msg, 'ims/mail/addprojectmail', ['data' => $projectDetails], $cc);
            session()->flash('notification', ['type' => 'success', 'message' => "Project added successfully."]);
            return redirect('project');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('dashboard'));
        }
    }

    /* ------------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : project list (admin, project manager, user)
     use for : Fetch the project details in datatable using Ajax
     ------------------------------------------------------------------------------------------------------------*/
    public function get_project_list(Request $request)
    {
        $post = $request->input();
        if ($post) {
            $field_pos = array('p_id' => '0', 'project_title' => '1', 'start_date' => '2', 'end_date' => '3');
            $sort_field = array_search($post['order']['0']['column'], $field_pos);

            if ($post['order']['0']['dir'] == 'asc') {
                $orderBy = "ASC";
            } else {
                $orderBy = 'DESC';
            }
            $TotalRecord = ProjectDetails::getprojectlist($post, $sort_field, $orderBy, 0);
            $manageproject = ProjectDetails::getprojectlist($post, $sort_field, $orderBy, 1);
            $iTotalRecords = $TotalRecord['NumRecords'];
            $records = array();
            $records['data'] = array();
            $desc = '';
            foreach ($manageproject as $key => $value) {
                $empLogin = session()->get('emp_login');
                $editbutton = '';
                $statusupdate = '';
                $sendaccess = '';
                if ($empLogin['team_lead'] == 1) {
                    $sendaccess = '<div class="d-flex f-18 justify-content-start"><a href="javascript:void(0)" id="ass_sub_emp_' . $key . '" data-id="' . $value->p_id . '"><i class="fa fa-plus" aria-hidden="true"></i></a></div>';
                }
                if ($empLogin['team'] == 1 || $empLogin['team'] == 2) {
                    $statusupdate = 'onclick="toggleStatus(' . $value->p_id . ', \'' . $value->status . '\')"';
                    $editbutton = '<div class="d-flex f-18 justify-content-start"><a href="' . URL('') . '/edit-project-details/' . $value->p_id  . '"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>';
                }
                $status = $value->status == 'Active'
                    ? '<span class="badge bg-success f-14" ' . $statusupdate . '>Active</span>'
                    : '<span class="badge f-black bg-danger f-white f-14" ' . $statusupdate . '>Inactive</span>';
                $action = '<div class="gap-3 d-flex">' .
                    '<div class="d-flex f-18 justify-content-start"><a href="' . URL('') . '/project-details/' . $value->p_id . '"><i class="fa fa-eye" aria-hidden="true"></i></a></div>' .
                    $editbutton .
                    $sendaccess .
                    '</div>';
                $records['data'][] = array(
                     ($iTotalRecords - (($post['start'] ?? 0) + $key)),
                    $value->project_title,
                    date('d-m-Y', strtotime($value->start_date)),
                    date('d-m-Y', strtotime($value->end_date)),
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

    public function update_project_status(Request $request)
    {
        $project = ProjectDetails::where('p_id', $request->p_id)->first();
        if ($project) {
            if ($project->status == 'Active') {
                $project->status = 'Inactive';
            } elseif ($project->status == 'Inactive') {
                $project->status = 'Active';
            }
            $save = ProjectDetails::where('p_id', $request->p_id)->update(['status' => $project->status]);
        }
        return response()->json(['success' => true]);
    }
    public function project_details($id)
    {
        $data = ProjectDetails::where('p_id', $id)->first();
        $emp = Employee::select('fname', 'lname', 'e_id')
            ->where('status', 'Active')->get();
        $emp_id = json_decode($data->emp, true) ?? [];;
        $sub_emp_id = json_decode($data->sub_emp, true) ?? [];;

        $employe = Employee::select('employee.e_id', 'teams.team', 'employee.fname', 'employee.lname')
            ->join('teams', 'teams.t_id', '=', 'employee.team')
            ->whereIn('employee.e_id', $emp_id)
            ->get();
        $subemploye = Employee::select('employee.e_id', 'teams.team', 'employee.fname', 'employee.lname')
            ->join('teams', 'teams.t_id', '=', 'employee.team')
            ->whereIn('employee.e_id', $sub_emp_id)
            ->get();
        $groupedEmployees = $employe->groupBy('team');
        $sub_groupedEmployees = $subemploye->groupBy('team');

        return view('ims/manage-project/project-details', (['data' => $data, 'emp' => $emp, 'employe' => $employe, 'sub_emp' => $subemploye, 'groupedEmployees' => $groupedEmployees, 'sub_groupedEmployees' => $sub_groupedEmployees]));
    }
    public function edit_project_details($id)
    {
        $data = ProjectDetails::where('p_id', $id)->first();
        $emp = Employee::select('fname', 'lname', 'e_id')
            ->where('status', 'Active')->where('team_lead', 1)->get();
        // return $emp;
        $employee = json_decode($data->emp, true);
        return view('ims/manage-project/edit-project-details', (['data' => $data, 'emp' => $emp, 'employee' => $employee]));
    }
    public function submit_edit_project_details(Request $req)
    {
        $updatedata = [
            'project_title' => $req->project_title,
            'start_date' => date('Y-m-d', strtotime($req->start_date)),
            'end_date' => date('Y-m-d', strtotime($req->end_date)),
            'project_description' => $req->project_description,
            'emp' => $req->emp,
        ];
        $update = ProjectDetails::where('p_id', '=', $req->p_id)->update($updatedata);
        if ($update) {
            $empNames = Employee::whereIn('employee.e_id', $req->emp)
                ->select(DB::raw("CONCAT(employee.fname, ' ', employee.lname) as name"))
                ->pluck('name');
            $CreateBy = ProjectDetails::where('p_id', '=', $req->p_id)
                ->join('employee as em', 'em.e_id', '=', 'project_details.create_by')
                ->select('project_details.*', DB::raw("CONCAT(em.fname, ' ', em.lname) as name"))
                ->first();
            $projectDetails = [
                'project_title' => $req->project_title,
                'project_description' => $req->project_description,
                'start_date' =>  $req->start_date,
                'end_date' => $req->end_date,
                'emp' => $empNames->implode(', '),
                'create_by' => $CreateBy->name,
            ];
            $email = Employee::whereIn('e_id', $req->emp)
                ->pluck('email');
            $to =  env('HR_EMAIL');
            $cc =  env('ADMIN_EMAIL');
            $msg = "New Project";
            // $this->emailService->sendMail($to, $msg, 'ims/mail/addprojectmail', ['data' => $projectDetails], $cc);
            session()->flash('notification', ['type' => 'success', 'message' => "Project details updated successfully."]);
            return redirect('project');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('edit-project-details'));
        }
    }
    public function update_assign_sub_emp(Request $req)
    {

        $empLogin = session()->get('emp_login');
        $update = ProjectDetails::where('p_id', '=', $req->p_id)->update(['sub_emp' => json_encode($req->sub_emp)]);
        if ($update) {
            $rowinfo = ProjectDetails::where('p_id', $req->p_id)->first();
            $assignby = Employee::where('e_id', $empLogin['e_id'])
                ->select(DB::raw("CONCAT(fname, ' ', lname) as name"))
                ->first();
            $empArray = json_decode($rowinfo->emp, true);
            $empNames = Employee::whereIn('e_id', $empArray)
                ->select(DB::raw("CONCAT(fname, ' ', lname) as name"))
                ->pluck('name');
            $subject = [
                'project_title' => $rowinfo->project_title,
                'project_description' => $rowinfo->project_description,
                'start_date' => $rowinfo->start_date,
                'end_date' => $rowinfo->end_date,
                'emp' => $empNames->implode(', '),
                'assignby' => $assignby->name,
            ];
            $email = Employee::whereIn('e_id', $req->sub_emp)
                ->pluck('email');
            $to =  env('HR_EMAIL');
            $cc =  env('ADMIN_EMAIL');
            $msg = "Assign Project";
            // $this->emailService->sendMail($to, $msg, 'ims/mail/assignprojectmail', ['data' => $subject], $cc);
            session()->flash('notification', ['type' => 'success', 'message' => "Project assigned successfully."]);
            return redirect('project');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('edit-project-details'));
        }
    }

    public function get_assign_sub_emp(Request $req)
    {
        $details = ProjectDetails::select('sub_emp')->where('p_id', $req->p_id)->first();
        return $details;
    }
}