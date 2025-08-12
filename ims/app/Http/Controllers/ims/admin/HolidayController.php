<?php

namespace App\Http\Controllers\ims\admin;

use App\Http\Controllers\Controller;
use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function holiday()
    {
        $data = Holiday::all();
        return view('ims/admin/holiday/holiday', ['data' => $data]);
    }
    public function add_holiday()
    {
        return view('ims/admin/holiday/add-holiday');
    }
    public function submit_holiday(Request $req)
    {
        $empLogin = session('emp_login');
        $e_id = $empLogin['e_id'];
        $holiday = new Holiday();
        $holiday->holiday = $req->holiday;
        $holiday->date = date('Y-m-d', strtotime($req->date));
        $holiday->weekday = $req->weekday;
        $holiday->created_by = $e_id;
        $save =  $holiday->save();
        if ($save) {
            session()->flash('notification', ['type' => 'success', 'message' => "Holiday added successfully."]);
            return redirect('holiday');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('add-holiday'));
        }
    }
    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : Employee List
     use for  : Fetch the Employee details in datatable using Ajax
     ---------------------------------------------------------------------------------------------------------*/
    public function holiday_list(Request $request)
    {
        $post = $request->input();
        if ($post) {
            $field_pos = array('h_id' => '0', 'holiday' => '1', 'date' => '2', 'weekday' => '3');
            $sort_field = array_search($post['order']['0']['column'], $field_pos);
            if ($post['order']['0']['dir'] == 'asc') {
                $orderBy = "ASC";
            } else {
                $orderBy = 'DESC';
            }
            $TotalRecord = Holiday::getholidaylist($post, $sort_field, $orderBy, 0);
            $holiday = Holiday::getholidaylist($post, $sort_field, $orderBy, 1);
            $iTotalRecords = $TotalRecord['NumRecords'];
            $records = array();
            $records['data'] = array();
            $desc = '';
            foreach ($holiday as $key => $value) {
                $action = '<div class="d-flex f-18 justify-content-start"><a href="' . URL('') . '/delete-holiday/' . $value->h_id  . '"><i class="fa fa-trash" aria-hidden="true"></i></a></div>';
                $records['data'][] = array(
                    $value->h_id,
                    $value->holiday,
                    date('d-m-Y', strtotime($value->date)),
                    $value->weekday,
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

    public function deleteholiday($id)
    {
        $holiday = Holiday::where('h_id', '=', $id)->first();
        if ($holiday) {
            Holiday::where('h_id', '=', $id)->delete();
            session()->flash('notification', ['type' => 'success', 'message' => "Holiday deleted successfully."]);
            return redirect('holiday');
        } else {
            return redirect()->back()->with('error', 'Holiday not found.');
        }
    }
}
