<?php

namespace App\Http\Controllers\ims;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\SalarySlip;
use App\Services\MailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;

use function Laravel\Prompts\select;

class SalarySlipController extends Controller
{
    protected $emailService;

    public function __construct(MailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function salary_slip_request()
    {
        $empLogin = session('emp_login');
        $e_id = $empLogin['e_id'];
        $employee = Employee::where('e_id', $e_id)->select('download_ss')->first();
        return view('ims/salary-slip/salary-slip-request', ['employee' => $employee]);
    }
    public function submit_salary_slip_requests(Request $req)
    {
        $empLogin = session('emp_login');
        $e_id = $empLogin['e_id'];
        $date = $req->year . '-' . sprintf('%02d', $req->month);
        $salary = SalarySlip::where('date', $date)->where('e_id', $e_id)->where('status','Active')->first();
        if ($salary) {
            $employee = Employee::where('e_id', $e_id)->select('download_ss')->first();
            return view('ims/salary-slip/salary-slip-request', ['employee' => $employee, 'salary' => $salary]);
        } else {
            $assignby = Employee::where('e_id', $empLogin['e_id'])
                ->select(DB::raw("CONCAT(fname, ' ', lname) as name"))
                ->first();
            $salaryslipdata = [
                'name' => $assignby->name,
                'year' => $date,
            ];
            $to =  env('ADMIN_EMAIL');
            $cc =  env('HR_EMAIL');
            $msg = "Salary Slip Request";
            // $this->emailService->sendMail($to, $msg, 'ims/mail/salarysliprequest', ['data' => $salaryslipdata], $cc);
            session()->flash('notification', ['type' => 'success', 'message' => "Request generated successfully."]);
            return redirect('salary-slip-request');
        }
    }
    public function generatePDF($id)
    {
        // return $id;
        $salary = SalarySlip::where('ss_id', $id)->first();
        $html = view('ims/pdf/salary-slip', compact('salary'))->render();
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        return $mpdf->Output('salary-slip.pdf', 'D');
    }
}
