<?php

namespace App\Http\Controllers\ims;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Team;
use Illuminate\Http\Request;

class ManageNotificationController extends Controller
{
    public function manage_notification()
    {
        $data['team'] = Team::get();
        return view('ims.manage-notification.manage-notification', $data);
    }
    public function get_notification_list(Request $request)
    {
        $post = $request->input();
        if ($post) {
            $field_pos = array('e_id' => '0', 'name' => '1',  'teamName' => '2');
            $sort_field = array_search($post['order']['0']['column'], $field_pos);
            if ($post['order']['0']['dir'] == 'asc') {
                $orderBy = "ASC";
            } else {
                $orderBy = 'DESC';
            }
            $TotalRecord = Employee::getempList($post, $sort_field, $orderBy, 0);
            $employees = Employee::getempList($post, $sort_field, $orderBy, 1);
            $iTotalRecords = $TotalRecord['NumRecords'];
            $records = array();
            $records['data'] = array();
            $desc = '';
            foreach ($employees as $key => $value) {
                $action = '';
                $checked = $value->email_notification == 1 ? 'checked' : '';
                $status = '<div><input type="checkbox" class="js-switch" data-id="' . $value->e_id . '" ' . $checked . ' /></div>';
                $records['data'][] = array(
                    $value->e_id,
                    ucfirst($value->fname) . ' ' . $value->lname,
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

    public function update_employee_notification_status(Request $req)
    {
        $emp = Employee::where('e_id', $req->e_id)->first();
        if ($emp) {
            $emp->email_notification = $req->status;
            $emp->save();
            return response()->json(['message' => 'success']);
        } else {
            return response()->json(['message' => 'error']);
        }
        //     session()->flash('notification', ['type' => 'success', 'message' => "Email notification change successfully"]);
        //     return response()->json(['message' => 'success']);
        // } else {
        //     session()->flash('notification', ['type' => 'danger', 'message' => "Something Went Wrong"]);
        //     return response()->json();
        // }
    }
}
// $action = '<div class="d-flex gap-4"><div class="d-flex f-18 justify-content-center"><a href="' . URL('') . '/employee-detail/' . $value->e_id . '"><i class="fa fa-eye" aria-hidden="true"></i></a></div>
//          <div class="d-flex f-18 justify-content-center"><a href="' . URL('') . '/edit-employee/' . $value->e_id . '"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
//          <div class="d-flex f-18 justify-content-center"><a href="' . URL('') . '/edit-attendance/' . $value->e_id . '"><i class="fa fa-clock-o" aria-hidden="true"></i></a></div>
//          <div class="d-flex f-18 justify-content-center"><a href="' . URL('') . '/admin-view-attendance/' . $value->e_id . '"><i class="fa fa-calendar" aria-hidden="true"></i></a></div></div>';
