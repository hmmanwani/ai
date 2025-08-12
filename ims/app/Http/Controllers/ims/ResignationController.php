<?php

namespace App\Http\Controllers\ims;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Resignation;
use App\Services\MailService;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\returnCallback;

class ResignationController extends Controller
{
    protected $emailService;

    public function __construct(MailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function resignation()
    {
        return view('ims/resignation/resignation');
    }

    public function submitresignation(Request $req)
    {
        $empLogin = session('emp_login');
        $e_id = $empLogin['e_id'];
        $today = now()->format('Y-m-d');
        $resignation = new Resignation();
        $resignation->e_id = $e_id;
        $resignation->date = $today;
        $resignation->reason = $req->reason;
        $resignation->description = $req->description;
        $save = $resignation->save();
        if ($save) {
            $assignby = Employee::where('e_id', $e_id)
                ->select(DB::raw("CONCAT(fname, ' ', lname) as name"))
                ->first();
            $resignationdata = [
                'name' => $assignby->name,
                'reason' => $req->reason,
                'description' => $req->description,
            ];
            $to =  env('HR_EMAIL');
            $cc =  env('ADMIN_EMAIL');
            $msg = "Resignation Submitted";
            $this->emailService->sendMail($to, $msg, 'ims/mail/resignationmail', ['data' => $resignationdata], $cc);
            session()->flash('notification', ['type' => 'success', 'message' => "Resignation submit successfully "]);
            return redirect(url('dashboard'));
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('resignation'));
        }
    }
}