<?php

namespace App\Http\Controllers\ims\admin;

use App\Http\Controllers\Controller;
use App\Models\ManageEmailModel;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnCallback;
use function PHPUnit\Framework\returnSelf;

class ManageEmailController extends Controller
{
    public function manage_email()
    {
        return view('ims.admin.manage-email.manage-email');
    }

    public function add_email_type()
    {
        return view('ims.admin.manage-email.add-email-type');
    }
    public function submit_email_type(Request $req)
    {
        $emailtype = new ManageEmailModel();
        $emailtype->type = $req->type;
        $emailtype->email_to = implode(',', $req->email_to);
        $emailtype->email_cc = implode(',', $req->email_cc);
        $save = $emailtype->save();
        if ($save) {
            session()->flash('notification', ['type' => 'success', 'message' => "Email Type Add Successfully"]);
            return redirect('manage-email');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect('add-email-type');
        }
    }
    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : Email Type List
     use for  : Fetch the Employee details in datatable using Ajax
     ---------------------------------------------------------------------------------------------------------*/
    public function get_email_type(Request $request)
    {
        $post = $request->input();
        if ($post) {
            $field_pos = array('me_id' => '0', 'type' => '1', 'email_to' => '2', 'email_cc' => '3');
            $sort_field = array_search($post['order']['0']['column'], $field_pos);
            if ($post['order']['0']['dir'] == 'asc') {
                $orderBy = "ASC";
            } else {
                $orderBy = 'DESC';
            }
            $TotalRecord = ManageEmailModel::getemailtypelist($post, $sort_field, $orderBy, 0);
            $emailtype = ManageEmailModel::getemailtypelist($post, $sort_field, $orderBy, 1);
            $iTotalRecords = $TotalRecord['NumRecords'];
            $records = array();
            $records['data'] = array();
            $desc = '';
            foreach ($emailtype as $key => $value) {
                // $action = 'Coming Soon';
                $action = '<div class="d-flex f-18 justify-content-start"><a href="' . URL('') . '/edit-email-type/' .   $value->me_id  . '"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>';
                $records['data'][] = array(
                    $value->me_id,
                    $value->type,
                    nl2br(str_replace(',', "\n", '<strong>' . str_replace(',', '</strong>, <strong>', $value->email_to) . '</strong>')),
                    nl2br(str_replace(',', "\n", '<strong>' . str_replace(',', '</strong>, <strong>', $value->email_cc) . '</strong>')),
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
    public function edit_email_type($id)
    {
        $data = ManageEmailModel::where('me_id', $id)->first();
        return view('ims.admin.manage-email.edit-email-type', ['data' => $data]);
    }

    public function submit_edit_email_type(Request $req)
    {
        // return $req;
        $updateddata = [
            'type' => $req->type,
            'email_to' => implode(',', $req->email_to),
            'email_cc' => implode(',', $req->email_cc),
        ];
        // return $updateddata;
        $save = ManageEmailModel::where('me_id', $req->id)->update($updateddata);
        if ($save) {
            session()->flash('notification', ['type' => 'success', 'message' => "Email Type Update Successfully"]);
            return redirect('manage-email');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect('add-email-type');
        }
    }
}
