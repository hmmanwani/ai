<?php

namespace App\Http\Controllers\ims\admin;

use App\Http\Controllers\Controller;
use App\Models\Resignation;
use Illuminate\Http\Request;

class ResignationAdminController extends Controller
{
    public function admin_resignation()
    {
        return view('ims/admin/resignation/admin-resignation');
    }

    public function get_resignation_list(Request $request)
    {
        $post = $request->input();
        if ($post) {
            $field_pos = array('r_id' => '0', 'request by' => '1', 'date' => '2', 'reason' => '3');
            $sort_field = array_search($post['order']['0']['column'], $field_pos);
            if ($post['order']['0']['dir'] == 'asc') {
                $orderBy = "ASC";
            } else {
                $orderBy = 'DESC';
            }
            $TotalRecord = Resignation::gethresignationslist($post, $sort_field, $orderBy, 0);
            $resignation = Resignation::gethresignationslist($post, $sort_field, $orderBy, 1);
            $iTotalRecords = $TotalRecord['NumRecords'];
            $records = array();
            $records['data'] = array();
            $desc = '';
            foreach ($resignation as $key => $value) {
                $status = '';
                if ($value->status == 'Approve') {
                    $status = '<span class="badge bg-success f-14">Approved</span>';
                } elseif ($value->status == 'Reject') {
                    $status = '<span class="badge bg-warning f-14 text-white">Rejected</span>';
                } else {
                    $status = '<span class="badge f-white bg-danger f-14 approve-status" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="You must upload in <b>.CSV</b> file" data-value="' . $value->r_id . '">Pending</span>';
                }

                $action = '<div class="d-flex f-18 justify-content-center"><a href="' . URL('') . '/admin-resignation-details/' . $value->r_id  . '"><i class="fa fa-eye" aria-hidden="true"></i></a></div>';
                $records['data'][] = array(
                    $value->r_id,
                    ucfirst($value->fname) . ' ' . $value->lname,
                    date('d-m-Y', strtotime($value->date,)),
                    $value->reason,
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
    public function admin_resignation_details($id)
    {
        $data = Resignation::select('resignation.*', 'em.fname', 'em.lname')->where('r_id', $id)->join('employee as em', 'em.e_id', '=', 'resignation.e_id')->first();

        return view('ims/admin/resignation/admin-resignation-details', ['data' => $data]);
    }
    public function update_resignation_status(Request $request)
    {
        $update = Resignation::where('r_id', $request->r_id)->update(['status' => $request->status]);
        if ($update) {
            session()->flash('notification', ['type' => 'success', 'message' => "Status updated successfully."]);
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
        }
        echo 'success';
    }
}
