<?php

namespace App\Http\Controllers\ims;

use App\Http\Controllers\Controller;
use App\Models\HrPolicy;
use Illuminate\Http\Request;

class HrPolicyController extends Controller
{
    public function hr_policy()
    {
        return view('ims/hr-policy/hr-policy');
    }

    public function get_hr_policy_list(Request $request)
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
            $TotalRecord = HrPolicy::gethrpolicyList($post, $sort_field, $orderBy, 0);
            $hrpolicy = HrPolicy::gethrpolicyList($post, $sort_field, $orderBy, 1);
            $iTotalRecords = $TotalRecord['NumRecords'];
            $records = array();
            $records['data'] = array();
            $desc = '';
            foreach ($hrpolicy as $key => $value) {
                $action = '<div class="d-flex f-18 justify-content-start"><a href="' . URL('') . '/storage/' . $value->document  . ' "target="_blank" class="f-base"><i class="fa fa-download" aria-hidden="true"></i></a></div>';
                $document = '<div><a href="' . URL('') . '/storage/' . $value->document  . ' "target="_blank" class="f-base f-700"><p>HR-Policy-' . $value->year . '</p></a></div>';
                $records['data'][] = array(
                       ($iTotalRecords - (($post['start'] ?? 0) + $key)),
                    $document,
                    $value->year,
                    date('d-m-Y', strtotime($value->updated_at)),
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

    /* ---------------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function :  edit hr policy
     use for :  Submit the hr policy
     -------------------------------------------------------------------------------------------------------------*/
    public function submit_edit_hr_policy(Request $req)
    {
        $hrpolicy = new HrPolicy();
        if ($req->hasFile('document')) {
            $image = $req->file('document')->store(
                'hr/policy/' . $req->year,
                'public'
            );
            $hrpolicy->document = $image;
        }
        $save = $hrpolicy::where('hp_id', $req->id)->update(['document' => $hrpolicy->document]);
        if ($save) {
            session()->flash('notification', ['type' => 'success', 'message' => "HR Policy Update"]);
            return redirect('admin-hr-policy');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect('overview');
        }
    }
}
