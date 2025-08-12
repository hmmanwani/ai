<?php

namespace App\Http\Controllers\ims\admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\HrPolicy;
use Illuminate\Http\Request;
use App\Models\SalarySlip;
use App\Services\MailService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class DocumentController extends Controller
{

    protected $emailService;

    public function __construct(MailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function admin_hr_policy()
    {
        $data = HrPolicy::all();
        return view('ims/admin/document/admin-hr-policy', ['data' => $data]);
    }
    public function submit_hr_policy(Request $req)
    {
        $hrpolicy = new HrPolicy();
        $hrpolicy->year = $req->year;
        if ($req->hasFile('document')) {
            $image = $req->file('document')->store(
                'hr/policy/' . $req->year,
                'public'
            );
            $hrpolicy->document = $image;
        }
        $save = $hrpolicy->save();

        if ($save) {
            session()->flash('notification', ['type' => 'success', 'message' => "HR policy added successfully."]);
            return redirect('admin-hr-policy');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect('overview');
        }
    }
    
    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : Hr Policy List
     use for  : Fetch the Hr Policy details in datatable using Ajax
     ---------------------------------------------------------------------------------------------------------*/
    public function Hr_policy_list(Request $request)
    {
        $post = $request->input();
        if ($post) {
            $field_pos = array('hr_id' => '0', 'document' => '1', 'year' => '2');
            $sort_field = array_search($post['order']['0']['column'], $field_pos);
            if ($post['order']['0']['dir'] == 'asc') {
                $orderBy = "ASC";
            } else {
                $orderBy = 'DESC';
            }
            $TotalRecord = HrPolicy::getadminhrpolicylist($post, $sort_field, $orderBy, 0);
            $hrpolicy = HrPolicy::getadminhrpolicylist($post, $sort_field, $orderBy, 1);
            $iTotalRecords = $TotalRecord['NumRecords'];
            $records = array();
            $records['data'] = array();
            $desc = '';
            foreach ($hrpolicy as $key => $value) {
                $action = '<div class="d-flex gap-3"><div class="d-flex f-18 justify-content-start"><a href="javascript:void(0)" id="edit-hr-policy_' . $value->hp_id  . '" data-id="' . $value->hp_id . '"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
                <div class="d-flex f-18 justify-content-start"><a href="' . URL('') . '/delete-hr-policy/' . $value->hp_id  . '"><i class="fa fa-trash" aria-hidden="true"></i></a></div></div>';
                $document = '<div><a href="' . URL('') . '/storage/' . $value->document  . ' " target="_blank" class="f-base f-700"><p>Hr-Policy-' . $value->year . '</p></a></div>';
                $records['data'][] = array(
                    $value->hp_id,
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
    public function delete_hr_policy($id)
    {
        $hrpolicy = HrPolicy::where('hp_id', '=', $id)->first();
        if ($hrpolicy) {
            HrPolicy::where('hp_id', '=', $id)->delete();
            session()->flash('notification', ['type' => 'success', 'message' => "HR policy deleted successfully."]);
            return redirect('admin-hr-policy');
        } else {
            return redirect()->back()->with('error', 'Holiday not found.');
        }
    }
    public function admin_salary_slip()
    {
        return view('ims/admin/document/admin-salary-slip');
    }

    public function submit_salary_slip(Request $req)
    {
        $filePath = $req->file('file')->store('public/salary-slip');
        $storagePath = Storage::path($filePath);
        $file = fopen($storagePath, 'r');
        $header = fgetcsv($file);
        $escapedHeader = [];
        foreach ($header as $key => $value) {
            $lheader = strtolower($value);
            $escapedItem = preg_replace('/[^a-z]/', '', $lheader);
            array_push($escapedHeader, $escapedItem);
        }
        $data = [];

        while (($row = fgetcsv($file)) !== false) {
            if (empty($row[0])) {
                continue;
            }
            $rowData = [];
            foreach ($row as $key => $value) {
                $rowData[] = $value;
            }
            $combinedData  = array_combine($escapedHeader, $rowData);
            $employee = Employee::where('empid', $combinedData['empid'])
                ->join('teams', 'teams.t_id', '=', 'employee.team')
                ->leftJoin('bank_information as bi', 'bi.e_id', '=', 'employee.e_id')
                ->select('employee.e_id', 'employee.join_date', 'employee.designation', 'teams.team', 'bi.bank_name', 'bi.account_no', 'bi.ifsc_code', 'bi.pan_no', (DB::raw("CONCAT(fname, ' ', mname, ' ' , lname) as name")))
                ->first();
            $salarySlip = new SalarySlip();
            $salarySlip->e_id = $employee->e_id;
            $salarySlip->name = $combinedData['name'];
            $salarySlip->emp_id = $combinedData['empid'];
            $salarySlip->department = $employee->team;
            $salarySlip->designation = $employee->designation;
            $salarySlip->date = $combinedData['date'];
            $salarySlip->join_date = $employee->join_date;
            $salarySlip->bank_name = $employee->bank_name;
            $salarySlip->ifsc = $employee->ifsc_code;
            $salarySlip->account_no = $employee->account_no;
            $salarySlip->pan = $employee->pan_no;
            $salarySlip->actual_payable_days = $combinedData['actualpayabledays'];
            $salarySlip->total_working_days = $combinedData['totalworkingdays'];
            $salarySlip->loss_of_pay_days = $combinedData['lossofpaydays'];
            $salarySlip->days_payable = $combinedData['dayspayable'];
            $salarySlip->basic = $combinedData['basic'];
            $salarySlip->city_comp_allowance = $combinedData['citycompallowance'];
            $salarySlip->bonus = $combinedData['bonus'];
            $salarySlip->total_earnings_a = $combinedData['totalearningsa'];
            $salarySlip->professional_tax = $combinedData['professionaltax'];
            $salarySlip->total_deductions_c = $combinedData['totaldeductionsc'];
            $salarySlip->net_salary_payable_a_c = $combinedData['netsalarypayableac'];
            $salarySlip->net_alary_in_words = $combinedData['netalaryinwords'];
            $salarySlip->save();
            $data[] = $combinedData;
        }
        if ($data) {
            session()->flash('notification', ['type' => 'success', 'message' => "File uploaded successfully."]);
            return redirect('admin-salary-slip');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect('admin-salary-slip');
        }
        // mail integration
        // $empLogin = session('emp_login');
        // $check = Employee::where('e_id', $salarySlip->e_id)->where('download_ss',  1)->where('status', 'Active')->first();
        // $uploadby = Employee::where('e_id', $empLogin['e_id'])
        //     ->select(DB::raw("CONCAT(fname, ' ', lname) as uploadby"))
        //     ->first();
        // if ($check) {
        //     $salaryslipdetails = [
        //         'name' => $salarySlip->name,
        //         'date' => Carbon::createFromFormat('Y-m', $salarySlip->date)->format('m-Y'),
        //         'bank_name' => $salarySlip->bank_name,
        //         'account_no' => $salarySlip->account_no,
        //         'ifsc' => $salarySlip->ifsc,
        //         'uploadby' => $uploadby->uploadby,
        //     ];
        //     $to = "utsav@hmmbiz.com";
        //     $msg = "Upload Salary-Slip - " . $salaryslipdetails['date'];
        //     $this->emailService->sendMail($to, $msg, 'ims/mail/admin-mail/uploadsalaryslipmail', ['data' => $salaryslipdetails]);
    }

    public function admin_add_salary_slip()
    {
        return view('ims/admin/document/admin-add-salary-slip');
    }
    public function submit_salary_slip_details(Request $req)
    {
        $salary = new SalarySlip();
        $salary->e_id =  $req->e_id;
        $salary->name = $req->name;
        $salary->emp_id = $req->emp_id;
        $salary->department = $req->department;
        $salary->designation = $req->designation;
        $salary->date = date('Y-m', strtotime($req->date));
        $salary->join_date = date('Y-m-d', strtotime($req->join_date));
        $salary->bank_name = $req->bank_name;
        $salary->ifsc = $req->ifsc;
        $salary->account_no = $req->account_no;
        $salary->pan = $req->pan;
        $salary->actual_payable_days = $req->actual_payable_days;
        $salary->total_working_days = $req->total_working_days;
        $salary->loss_of_pay_days = $req->loss_of_pay_days;
        $salary->days_payable = $req->days_payable;
        $salary->basic = $req->basic;
        $salary->city_comp_allowance = $req->city_comp_allowance;
        $salary->bonus = $req->bonus;
        $salary->total_earnings_a = $req->total_earnings_a;
        $salary->professional_tax = $req->professional_tax;
        $salary->total_deductions_c = $req->total_deductions_c;
        $salary->net_salary_payable_a_c = $req->net_salary_payable_a_c;
        $salary->net_alary_in_words = $req->net_alary_in_words;
        $salary->status = 'Active';
        $save = $salary->save();
        if ($save) {
            // return $salary;
            session()->flash('notification', ['type' => 'success', 'message' => "Details added successfully."]);
            return redirect('admin-salary-slip');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect('overview');
        }
    }
    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : Salary Slip List
     use for  : Fetch the Salary Slip details in datatable using Ajax
     ---------------------------------------------------------------------------------------------------------*/
    public function salary_slip_details_list(Request $request)
    {
        $post = $request->input();
        if ($post) {
            $field_pos = array('ss_id' => '0', 'name' => '1', 'emp_id' => '2', 'department' => '3', 'designation' => '4', 'date' => '5', 'bank_name' => '6');
            $sort_field = array_search($post['order']['0']['column'], $field_pos);
            if ($post['order']['0']['dir'] == 'asc') {
                $orderBy = "ASC";
            } else {
                $orderBy = 'DESC';
            }
            $TotalRecord = SalarySlip::getsalaryslipdetailsAdmin($post, $sort_field, $orderBy, 0);
            $salaryslip = SalarySlip::getsalaryslipdetailsAdmin($post, $sort_field, $orderBy, 1);
            $iTotalRecords = $TotalRecord['NumRecords'];
            $records = array();
            $records['data'] = array();
            $desc = '';
            foreach ($salaryslip as $key => $value) {
                $status = '<a href="javascript:void(0);" onclick="toggleStatus(' . $value->ss_id . ', \'' . $value->status . '\')">' . ($value->status == 'Active' ? '<span class="badge bg-success f-14">Active</span>' : '<span class="badge bg-danger f-14">Inactive</span>') . '</a>';
                $action = '<div class="d-flex f-18 justify-content-center"><a href="' . URL('') . '/edit-salary-slip-detials/' . $value->ss_id . '"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>';
                $records['data'][] = array(
                    $value->ss_id,
                    $value->name,
                    $value->emp_id,
                    $value->department,
                    $value->designation,
                    date('m-Y', strtotime($value->date)),
                    $value->bank_name,
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
    public function updateSalarySlipStatus(Request $req)
    {
        $data = SalarySlip::where('ss_id', $req->ss_id)->update(['status' => $req->new_status]);
        return response()->json(['success' => true]);
    }

    public function edit_salary_slip_details($id)
    {
        $data = SalarySlip::where('ss_id', $id)->first();
        $data->join_date = date('d-m-Y', strtotime($data->join_date));
        $data->date = date('m-Y', strtotime($data->date));
        return view('ims/admin/document/edit-salary-slip-details', ['data' => $data]);
    }
    public function submit_edit_salary_slip_details(Request $req)
    {
        $updatesalarydetails = [
            'name' => $req->name,
            'emp_id' => $req->emp_id,
            'date' => date('Y-m', strtotime($req->date)),
            'department' => $req->department,
            'designation' => $req->designation,
            'join_date' => date('Y-m-d', strtotime($req->join_date)),
            'bank_name' => $req->bank_name,
            'ifsc' => $req->ifsc,
            'account_no' => $req->account_no,
            'actual_payable_days' => $req->actual_payable_days,
            'total_working_days' => $req->total_working_days,
            'loss_of_pay_days' => $req->loss_of_pay_days,
            'days_payable' => $req->days_payable,
            'basic' => $req->basic,
            'city_comp_allowance' => $req->city_comp_allowance,
            'bonus' =>  $req->bonus,
            'total_earnings_a' => $req->total_earnings_a,
            'professional_tax' => $req->professional_tax,
            'total_deductions_c' => $req->total_deductions_c,
            'net_salary_payable_a_c' => $req->net_salary_payable_a_c,
            'net_alary_in_words' => $req->net_alary_in_words,
            'status' => 'Active'
        ];
        $salarydetails = SalarySlip::where('ss_id', '=', $req->id)->update($updatesalarydetails);
        if ($salarydetails) {
            session()->flash('notification', ['type' => 'success', 'message' => "Salary slip details updated successfully."]);
            return redirect('admin-salary-slip');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('edit-salary-slip-details'));
        }
    }

    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : autocomplete
     use for  : Fetch request name in database and send details using Ajax
     ---------------------------------------------------------------------------------------------------------*/
    public function autocomplete(Request $request)
    {
        $term = $request->term;
        $employees = Employee::where('employee.status', 'Active')
            ->where('fname', 'like', '%' . $term . '%')
            ->orWhere('mname', 'like', '%' . $term . '%')
            ->orWhere('lname', 'like', '%' . $term . '%')
            ->join('teams', 'teams.t_id', '=', 'employee.team')
            ->leftJoin('bank_information as bi', 'bi.e_id', '=', 'employee.e_id')
            ->select('employee.e_id', 'employee.fname', 'employee.mname', 'employee.lname', 'employee.empid', 'employee.join_date', 'employee.designation', 'teams.team as department', 'bi.bank_name', 'bi.account_no', 'bi.ifsc_code', 'bi.pan_no')
            ->get();
        $formattedData = $employees->map(function ($employee) {
            $fullName = trim($employee->fname . ' ' . $employee->mname . ' ' . $employee->lname);
            return [
                'label' => $fullName,
                'value' => $fullName,
                'details' => [
                    'e_id' => $employee->e_id,
                    'emp_id' => $employee->empid,
                    'join_date' => $employee->join_date,
                    'designation' => $employee->designation,
                    'department' => $employee->department,
                    'bank_name' => $employee->bank_name ?? '',
                    'account_no' => $employee->account_no ?? '',
                    'ifsc' => $employee->ifsc_code ?? '',
                    'pan' => $employee->pan_no ?? '',
                ]
            ];
        });
        return response()->json($formattedData);
    }

    public function getSalaryDetails(Request $req)
    {
        $mon = date('n', strtotime($req->date));
        $year = date('Y', strtotime($req->date));
        $salaryData = getSalaryDetails($req->id, $mon, $year);
        return $salaryData;
    }
}
