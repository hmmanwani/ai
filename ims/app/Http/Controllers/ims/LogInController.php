<?php

namespace App\Http\Controllers\ims;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\BankInformation;
use App\Models\Education_Qualification;
use App\Models\EmergencyContact;
use App\Models\ProjectDetails;
use App\Services\MailService;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LogInController extends Controller
{
    protected $emailService;

    public function __construct(MailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function login(Request $request)
    {
        $lastUrlData = $request->session()->get('previous_url', ['url' => null, 'user_agent' => null]);

        if ($lastUrlData['user_agent'] == $request->header('User-Agent')) {
            $url = $lastUrlData['url'];
            if (strpos($url, 'forgot-password') !== false) {
                $url = URL('/');
            }
        } else {
            $url = null;
        }

        return view('ims/login/modern-login', ['url' => $url]);
    }
    public function new_login(Request $request)
    {
        $lastUrlData = $request->session()->get('previous_url', ['url' => null, 'user_agent' => null]);

        if ($lastUrlData['user_agent'] == $request->header('User-Agent')) {
            $url = $lastUrlData['url'];
        } else {
            $url = null;
        }
        return view('ims/login/newlogin', ['url' => $url]);
    }

    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : Auth (Login)
     use for  : Check if the requested email and Password are the same and if they are the same so create a session
     ---------------------------------------------------------------------------------------------------------*/
    public function auth(Request $req)
    {
        $url = $req->url;
        $email = $req->email;
        $password = md5($req->password);
        $emp = Employee::where('email', $email)->where('password', $password)->first();
        if ($emp) {
            if ($emp->status == 'Inactive') {
                session()->flash('notification', ['type' => 'danger', 'message' => "Your account has been deactivated by the administrator."]);
                return redirect()->back();
            } else {
                $projects  = ProjectDetails::select('emp')->where('status', 'Active')->get();
                $empIdsInProjects = [];
                foreach ($projects as $project) {
                    $empIds = json_decode($project->emp, true);
                    $empIdsInProjects = array_merge($empIdsInProjects, $empIds);
                }

                $display_project = in_array($emp->e_id, $empIdsInProjects) ? 1 : 0;
                $logindata = array(
                    'e_id' => $emp->e_id,
                    'empid' => $emp->empid,
                    'email' => $email,
                    'fname' =>  $emp->fname,
                    'lname' => $emp->lname,
                    'role'  => $emp->role,
                    'team' => $emp->team,
                    'team_lead' => $emp->team_lead,
                    'display_project' => $display_project,
                );
                $check = Attendance::where('e_id', $emp->e_id)->where('date', date('Y-m-d'))->first();
                if ($check) {
                    session()->put('emp_login', $logindata);
                    session()->flash('notification', ['type' => 'success', 'message' => "Login successful."]);
                    return $url ? redirect($url) : redirect('dashboard');
                } else {
                    $attendance = new Attendance();
                    $attendance->e_id = $emp->e_id;
                    $attendance->date = now()->toDateString();
                    $attendance->login_time = date('Y-m-d H:i:s');
                    $attendance->f_login_time = date('Y-m-d H:i:s');
                    $attendance->ips_login = getUserCountry();
                    $save = $attendance->save();
                    if ($save) {
                        session()->put('emp_login', $logindata);
                        session()->flash('notification', ['type' => 'success', 'message' => "Login successful."]);
                        return $url ? redirect($url) : redirect('dashboard');
                    } else {
                        session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
                        return redirect('');
                    }
                }
            }
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "Invalid email or password. Please check your credentials."]);
            return redirect('/');
        }
    }
    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : LogOut(clockout)
     use for : Insert the logout_time and calculate the working hours Check the if FullDay, HalfDay, Leave
      ---------------------------------------------------------------------------------------------------------*/
    public function clockout(Request $req)
    {
        $empLogin = session('emp_login');
        if (!empty($empLogin)) {
            $e_id = $empLogin['e_id'];
            $attendance = Attendance::where('e_id', $e_id)->where('date', date('Y-m-d'))->first();
            $formatedloginTime = Carbon::parse($attendance->login_time);
            if ($attendance) {
                if (empty($attendance->logout_time)) {
                    $logoutTime = date('Y-m-d H:i:s');
                    $formatedlogoutTime = Carbon::parse($logoutTime);
                    $diffInHours = $formatedlogoutTime->diffInHours($formatedloginTime);
                    $diffTime = $formatedlogoutTime->diff($formatedloginTime);
                    $diffTime = $diffTime->format('%H:%I:%S');
                    $attendance->logout_time = $logoutTime;
                    $attendance->f_logout_time = $logoutTime;
                    $attendance->working_hours = $diffTime;
                    $attendance->ips_logout = getUserCountry();
                    if ($req->leave_option == 1) {
                        // fun friday 
                        $attendance->presence = 0;
                        $attendance->reason = "Fun Friday";
                    } else if ($req->leave_option == 2) {
                        // erly leave
                        $attendance->presence = 0;
                        $attendance->is_early_leave = "1";
                        $attendance->reason = $req->reason;
                        // email integration
                        $name = Employee::where('e_id', $empLogin['e_id'])
                            ->select(DB::raw("CONCAT(fname, ' ', lname) as name"))
                            ->first();
                        $data = [
                            'name' => $name->name,
                            'login_time' =>   date('h:i:s d-m-Y', strtotime($attendance->login_time)),
                            'logout_time' => date('h:i:s d-m-Y', strtotime($attendance->f_logout_time)),
                            'working_hours' => $attendance->working_hours,
                            'reason' => $req->reason,
                        ];
                        $to =  env('HR_EMAIL');
                        $cc =  env('ADMIN_EMAIL');
                        $msg = 'Early Leave Alert - ' . $name->name;
                        $this->emailService->sendMail($to, $msg, 'ims/mail/earlyleave', ['data' =>  $data], $cc);
                    } else {
                        // normal logout 
                        if ($diffInHours >= 8) {
                            $attendance->presence = 0;
                        } else if ($diffInHours >= 4 && $diffInHours < 8) {
                            $attendance->presence = 1;
                        } else {
                            $attendance->presence = 3;
                        }
                    }
                    $attendance->save();
                    session()->flash('notification', ['type' => 'success', 'message' => "You have successfully clocked out."]);
                } else {
                    session()->flash('notification', ['type' => 'warning', 'message' => "You have already clocked out today."]);
                }
            } else {
                session()->flash('notification', ['type' => 'danger', 'message' => "No clock-in record found for today. Unable to process clock-out."]);
            }
            return redirect('dashboard');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "You must be logged in to clock out."]);
            return redirect('login');
        }
        // }
    }
    public function change_password()
    {
        return view('ims/change-password/change-password');
    }
    public function submit_change_password(Request $req)
    {
        $empLogin = session('emp_login');
        $e_id = $empLogin['e_id'];
        $password = md5($req->password);
        $emp = Employee::where('e_id', '=', $e_id)->update(['password' => $password]);
        if ($emp) {
            session()->flash('notification', ['type' => 'success', 'message' => "Password updated successfully."]);
            return redirect('dashboard');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "Something Went Wrong"]);
            return redirect(url('change-password'));
        }
    }
    public function logout(Request $req)
    {
        if (session()->get('emp_login') != "") {
            $req->session()->forget('emp_login');
            $req->session()->forget('current_url');
            $req->session()->forget('previous_url');
            return redirect('/');
        }
    }
    public function forgot_password()
    {
        return view('ims/login/modern-forgot-password');
    }
    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : Submit Forgot Password (Before Login)
     use for  : Generate the Renadom String to Forgot Password
     ---------------------------------------------------------------------------------------------------------*/
    public function submit_forgot_password(Request $req)
    {

        $email = $req->email;
        $emp = Employee::where('email', $email)->first();
        if ($emp) {
            if ($emp->status == 'Inactive') {
                session()->flash('notification', ['type' => 'danger', 'message' => "Your account has been deactivated by the administrator."]);
                return redirect('/');
            } else {
                $randomString = Str::random(32);
                $randomString = Employee::generateUniquerandomString();
                $emp->pass_token = $randomString;
                $save =  $emp->save();
                $resetLink = url('new-password/' . $randomString);
                if ($save) {
                    $emp = Employee::where('email', $email)
                        ->select('email', DB::raw("CONCAT(fname, ' ', lname) as name"))
                        ->first();
                    $forgotpassworddata = [
                        'name' => $emp->name,
                        'email' => $email,
                        'link' => $resetLink,
                    ];
                    $to =  $email;
                    $msg = "Forgot Password";
                    $this->emailService->sendMail($to, $msg, 'ims/mail/forgotpassword', ['data' => $forgotpassworddata]);
                    session()->flash('notification', ['type' => 'success', 'message' => "A password reset link has been sent to your email."]);
                    $req->session()->forget('current_url');
                    $req->session()->forget('previous_url');
                    return redirect('/');
                    return redirect()->route('new-password', ['token' => $randomString]);
                } else {
                    session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
                    return redirect('/');
                }
            }
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "Email not recognized. Please check and try again."]);
            return redirect('/');
        }
    }
    // new password (before login code)
    public function new_password($token)
    {
        $check = Employee::where('pass_token', $token)->first();
        if ($check) {
            return view('ims/login/new-password', ['token' => $token]);
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "Password reset link has expired."]);
            return redirect('/');
        }
    }
    /* --------------------------------------------------------------------------------------------------------
     Devloper : Utsav Savaliya
     function : Submit New Password (Before LogIn)
     use for  : Store the Password IF token matches the after setting the new password null the random string
     ---------------------------------------------------------------------------------------------------------*/
    public function submit_new_password(Request $req)
    {
        $employee = Employee::where('pass_token', $req->token)->first();
        $employee->password =  md5($req->password);
        $employee->pass_token = null;
        $save = $employee->save();
        if ($save) {
            $req->session()->forget('current_url');
            $req->session()->forget('previous_url');
            session()->flash('notification', ['type' => 'success', 'message' => "Password updated successfully."]);
            return redirect('/');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "Something Went Wrong"]);
            return redirect(url('forgot-password'));
        }
    }
}
