<?php

namespace App\Http\Controllers\ims;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\ProjectDetails;
use App\Models\TaskManage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ManagerTaskController extends Controller
{
    public function manage_task()
    {
        return view('ims/task/manage-task');
    }

    public function add_task()
    {
        $empLogin = session()->get('emp_login');
        $e_id = $empLogin['e_id'];
        $team = $empLogin['team'];
        $project = ProjectDetails::select('p_id', 'project_title')
            ->where('status', 'Active')
            ->where('emp', 'LIKE', '%' . $e_id . '%')
            ->orWhere('sub_emp', 'LIKE', '%' . $e_id . '%')
            ->get();

        if (session()->get('emp_login')['team'] == 1 || session()->get('emp_login')['team'] == 2 || session()->get('emp_login')['team_lead'] == 1) {
            $show_project_task = 1;
            // $emp = Employee::selectRaw("CONCAT(fname, ' ', lname) as name, e_id, teams.team")
            //     ->where('status', 'Active')
            //     ->where('e_id', '!=', $e_id)
            //     ->join('teams', 'teams.t_id', '=', 'employee.team')
            //     ->get();
        } else {
            $show_project_task = 0;
            // $emp = Employee::selectRaw("CONCAT(fname, ' ', lname) as name, e_id, teams.team")
            //     ->where('employee.status', 'Active')
            //     ->where('employee.e_id', '!=', $e_id)
            //     ->where('employee.team', $team)
            //     ->join('teams', 'teams.t_id', '=', 'employee.team')
            //     ->get();
        }
        $emp = Employee::selectRaw("CONCAT(fname, ' ', lname) as name, e_id, teams.team")
            ->where('status', 'Active')
            ->where('e_id', '!=', $e_id)
            ->join('teams', 'teams.t_id', '=', 'employee.team')
            ->get();
        // return $emp;
        return view('ims/task/add-task', (['project' => $project, 'emp' => $emp, 'show_project_task' => $show_project_task]));
    }

    public function fetch_project_member(Request $req)
    {
        $p_id = $req->p_id;
        $data = ProjectDetails::where('p_id', $p_id)->first();
        if ($data) {
            $subEmpIds = json_decode($data->sub_emp, true);
            if (!empty($subEmpIds)) {
                $employees = Employee::select('e_id', 'fname', 'lname')
                    ->whereIn('e_id', $subEmpIds)
                    ->get();
                return response()->json($employees);
            }
            return response()->json(['message' => 'No employees found']);
        }
        return response()->json(['error' => 'Project not found'], 404);
    }
    public function submit_task(Request $req)
    {
        $empLogin = session()->get('emp_login');
        $task = new TaskManage();
        $task->p_id = $req->p_id;
        $task->task_title = $req->task_title;
        $task->deadline = Carbon::createFromFormat('d-m-Y', $req->deadline)->format('Y-m-d');
        if (empty($req->assign_task)) {
            $task->assign_task = json_encode([(string) $empLogin['e_id']]);
        } else {
            $assignTask = array_map('strval', $req->assign_task);
            $task->assign_task = json_encode($assignTask);
        }
        $task->task_description = $req->task_description;
        $task->task_type = $req->task_type;
        $task->comment = $req->comment;
        $task->date = now()->toDateString();
        $task->created_by = $empLogin['e_id'];
        $task->team = $empLogin['team'];
        $save = $task->save();
        if ($save) {
            session()->flash('notification', ['type' => 'success', 'message' => "Task created successfully."]);
            return redirect('manage-task');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('add-task'));
        }
    }
    /* ------------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : project list (admin, project manager, user)
     use for : Fetch the project details in datatable using Ajax
     ------------------------------------------------------------------------------------------------------------*/
    public function get_task_list(Request $request)
    {
        $empLogin = session()->get('emp_login');
        $post = $request->input();
        if ($post) {
            $field_pos = array('tm_id' => '0', 'task_type' => '1', 'task_title' => '2', 'deadline' => '3');
            $sort_field = array_search($post['order']['0']['column'], $field_pos);

            if ($post['order']['0']['dir'] == 'asc') {
                $orderBy = "ASC";
            } else {
                $orderBy = 'DESC';
            }
            $TotalRecord = TaskManage::gettasklist($post, $sort_field, $orderBy, 0);
            $managetask = TaskManage::gettasklist($post, $sort_field, $orderBy, 1);
            $iTotalRecords = $TotalRecord['NumRecords'];
            $records = array();
            $records['data'] = array();
            foreach ($managetask as $key => $value) {
                if ($value->task_type == 0) {
                    $task_type = 'Project Task';
                } else if ($value->task_type == 1) {
                    $task_type = 'Individual Task';
                } else {
                    $task_type = 'Other Task';
                }

                $assignto = '';
                $edittask = '';
                $deletetask = '';
                if ($value->created_by == $empLogin['e_id'] || $empLogin['team_lead'] == 1 || $empLogin['team'] == 1 || $empLogin['team'] == 2) {
                    $edittask = '<div class="d-flex f-18 justify-content-start"><a href="' . URL('') . '/edit-task/' . $value->tm_id . '"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>';
                    $deletetask = '<div class="d-flex f-18 justify-content-start"><a href="' . URL('') . '/delete-task/' . $value->tm_id . '"><i class="fa fa-trash" aria-hidden="true"></i></a></div>';
                }
                if ($empLogin['team_lead'] == 1 || $empLogin['team'] == 1 || $empLogin['team'] == 2) {
                    if ($value->created_by == $empLogin['e_id']) {
                        $edittask = '<div class="d-flex f-18 justify-content-start"><a href="' . URL('') . '/edit-task/' . $value->tm_id . '"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>';
                        $deletetask = '<div class="d-flex f-18 justify-content-start"><a href="' . URL('') . '/delete-task/' . $value->tm_id . '"><i class="fa fa-trash" aria-hidden="true"></i></a></div>';
                    }
                }
                // assign to and assign by
                $data = TaskManage::selectRaw("CONCAT(em.fname, ' ', em.lname) as name, task_manage.*")
                    ->where('tm_id', $value->tm_id)
                    ->join('employee as em', 'task_manage.created_by', '=', 'em.e_id')
                    ->first();
                $subEmpIds = json_decode($data->assign_task, true);
                if (!empty($subEmpIds)) {
                    $assignto = Employee::selectRaw("CONCAT(fname, ' ', lname) as name")->whereIn('e_id', $subEmpIds)->get()->pluck('name')->implode(', ');
                } else {
                    $assignto = '';
                }
                // check the deaddline
                $deadline = Carbon::createFromFormat('Y-m-d', $value->deadline);
                if ($value->status == 'complete') {
                    $showdate = '<div class="text-success f-900">' . $deadline->format('d-m-Y') . '</div>';
                } elseif ($deadline->isToday()) {
                    $showdate = '<div class="text-warning f-700">' . $deadline->format('d-m-Y') . '</div>';
                } elseif ($deadline->isPast()) {
                    $showdate = '<div class="f-red f-900">' . $deadline->format('d-m-Y') . '</div>';
                } else {
                    $showdate = '<div class="f-black f-700">' . $deadline->format('d-m-Y') . '</div>';
                }

                $action = '<div class="gap-3 d-flex">' . '<div class="d-flex f-18 justify-content-start"><a href="' . URL('') . '/task-details/' . $value->tm_id . '"><i class="fa fa-eye" aria-hidden="true"></i></a></div>' .  $edittask . '  ' . $deletetask . '</div>';
                $records['data'][] = array(
                     ($iTotalRecords - (($post['start'] ?? 0) + $key)),
                    $task_type,
                    $value->created_at->format('d-m-Y'),
                    $value->task_title,
                    $data->name,
                    $assignto,
                    $showdate,
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


    public function task_details($id)
    {
        $empLogin = session()->get('emp_login');
        $data = TaskManage::select('task_manage.*', 'em.fname', 'em.lname', 'pd.project_title')
            ->where('tm_id', $id)
            ->join('employee as em', 'task_manage.created_by', '=', 'em.e_id')
            ->leftJoin('project_details as pd', 'task_manage.p_id', '=', 'pd.p_id')
            ->first();
        $data->deadline = Carbon::createFromFormat('Y-m-d', $data->deadline)->format('d-m-Y');
        $data->complete_date = $data->complete_date ? Carbon::createFromFormat('Y-m-d', $data->complete_date)->format('d-m-Y') : null;
        if ($data->status == 'complete' && (session()->get('emp_login')['team'] == 1 || session()->get('emp_login')['team'] == 2 || session()->get('emp_login')['team_lead'] == 1 || $data->created_by == $empLogin['e_id'])) {
            $show = 1;
        } else {
            $show = 0;
        }
        return view('ims/task/task-details', (['data' => $data, 'show' => $show, 'empLogin' => $empLogin['e_id']]));
    }
    public function edit_task($id)
    {
        $empLogin = session()->get('emp_login');
        $e_id = $empLogin['e_id'];
        $task = TaskManage::where('tm_id', $id)->first();
        if ($task->task_type == 0) {
            $task_type = 'Project Task';
        } else if ($task->task_type == 1) {
            $task_type = 'Individual Task';
        } else {
            $task_type = 'Other Task';
        }
        // fetch the assign task
        $project = '';
        $emp = '';
        $firstEmpId = json_decode($task->assign_task, true);
        if (is_array($firstEmpId) && !empty($firstEmpId)) {
            $empIds = $firstEmpId[0];
        } else {
            $empIds = null;
        }
        if ($task->p_id) {
            $project = TaskManage::select('pd.project_title')
                ->where('tm_id', $id)
                ->join('project_details as pd', 'task_manage.p_id', '=', 'pd.p_id')
                ->first();
            $pro = ProjectDetails::where('p_id', $task->p_id)->first();
            $subEmpIds = json_decode($pro->sub_emp, true);
            $emp = Employee::select('e_id', 'fname', 'lname')
                ->whereIn('e_id', $subEmpIds)
                ->get();
        } else {
            $emp = Employee::select('e_id', 'fname', 'lname')
                ->where('status', 'Active')
                ->get();
        }
        $task->deadline = Carbon::createFromFormat('Y-m-d', $task->deadline)->format('d-m-Y');
        $task->complete_date = $task->complete_date ? Carbon::createFromFormat('Y-m-d', $task->complete_date)->format('d-m-Y') : null;
        return view('ims/task/edit-task', ([
            'task' => $task,
            'task_type' => $task_type,
            'project' => $project,
            'emp' => $emp,
            'empIds' => $empIds,
        ]));
    }

    public function submit_edit_task(Request $req)
    {
        // return $req;
        $empLogin = session()->get('emp_login');
        $assignTask = $req->assign_task;
        if (empty($assignTask)) {
            $assignTask = json_encode([$empLogin['e_id']]);
        } else {
            $assignTask = json_encode($assignTask);
        }
        $comment = '';
        $status = $req->status;
        if ($req->comment) {
            $comment = $req->comment;
        }
        $dataToUpdate = [
            'task_title' => $req->task_title,
            'deadline' =>  Carbon::createFromFormat('d-m-Y', $req->deadline)->format('Y-m-d'),
            'task_description' => $req->task_description,
            'assign_task' => $assignTask,
            'comment' => $comment,
            'status' => $status,
            'update_by' =>  $empLogin['empid'],
        ];
        $update = TaskManage::where('tm_id', $req->id)->update($dataToUpdate);
        if ($update) {
            session()->flash('notification', ['type' => 'success', 'message' => "Task updated successfully."]);
            return redirect('manage-task');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('dashboard'));
        }
    }
    public function submit_task_comment(Request $req)
    {
        // return $req;
        $save = TaskManage::where('tm_id', $req->id)->where('status', 'complete')->update(['comment' => $req->comment, 'status' => 'to_do', 'complete_date' => null]);
        if ($save) {
            session()->flash('notification', ['type' => 'success', 'message' => "Comment submitted and status updated successfully."]);
            return redirect('manage-task');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('dashboard'));
        }
    }
    public function delete_task($id)
    {
        $data = TaskManage::where('tm_id', $id)->delete();
        if ($data) {
            session()->flash('notification', ['type' => 'success', 'message' => "Task deleted successfully."]);
            return redirect('manage-task');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('dashboard'));
        }
    }

    public function update_task_status(Request $req)
    {
        $date = now()->toDateString();
        $data = TaskManage::where('tm_id', $req->id)->first();
        if ($data) {
            if ($req->status !== 'complete' && $data->complete_date !== null) {
                $setnull = TaskManage::where('tm_id', $req->id)->update(['status' => $req->status, 'complete_date' => null]);
                if ($setnull) {
                    session()->flash('notification', ['type' => 'success', 'message' => "Status updated successfully."]);
                    return response()->json(['message' => 'success']);
                } else {
                    session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
                    return response()->json(['message' => 'No employees found']);
                }
            } elseif ($req->status == 'complete') {
                $change = TaskManage::where('tm_id', $req->id)->update(['status' => $req->status, 'complete_date' => $date, 'comment' => null]);
                if ($change) {
                    session()->flash('notification', ['type' => 'success', 'message' => "Status updated successfully."]);
                    return response()->json(['message' => 'success']);
                } else {
                    session()->flash('notification', ['type' => 'danger', 'message' => "Complete date not saved"]);
                    return response()->json(['message' => 'No employees found']);
                }
            } else {
                $change = TaskManage::where('tm_id', $req->id)->update(['status' => $req->status, 'complete_date' => null]);
                session()->flash('notification', ['type' => 'success', 'message' => "Status updated successfully."]);
                return response()->json(['message' => 'success']);
            }
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return response()->json(['message' => 'No employees found']);
        }
    }
}
