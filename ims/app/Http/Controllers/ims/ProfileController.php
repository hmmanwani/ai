<?php

namespace App\Http\Controllers\ims;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Education_Qualification;
use App\Models\Address;
use App\Models\AddressChange;
use App\Models\EmergencyContact;
use App\Models\BankInformation;
use App\Models\BankInformationChange;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\EducationQualificationChange;
use App\Models\EmergencyContactChange;
use App\Models\EmployeeChange;
use App\Models\States;
use App\Services\MailService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use function Clue\StreamFilter\remove;

class ProfileController extends Controller
{
    protected $emailService;

    public function __construct(MailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function profile(Request $request)
    {
        $empLogin = $request->session()->get('emp_login');
        $employee = Employee::select('employee.*', 'teams.team')->where('e_id', $empLogin['e_id'])->join('teams', 'teams.t_id', '=', 'employee.team')->first();
        $education_qualifications = Education_Qualification::where('e_id', '=', $empLogin['e_id'])->get();
        $addresses = Address::select('address.*', 'cities.name as city', 'states.name as state', 'countries.name as country')
            ->where('e_id', '=', $empLogin['e_id'])
            ->join('cities', 'cities.id', '=', 'address.city')
            ->join('states', 'states.id', '=', 'address.state')
            ->join('countries', 'countries.id', '=', 'address.country')
            ->get();
        $emergencycontactes = EmergencyContact::where('e_id', '=', $empLogin['e_id'])->get();
        $bankinformation = BankInformation::where('e_id', '=', $empLogin['e_id'])->first();
        if ($employee) {
            return view('ims/profile/profile', [
                'employee' => $employee,
                'education_qualifications' => $education_qualifications,
                'addresses' => $addresses,
                'emergencycontactes' => $emergencycontactes,
                'bankinformation' => $bankinformation,
            ]);
        } else {
            return redirect()->back()->withErrors('Employee not found.');
        }
    }
    public function editpersonaldetails($id)
    {
        $data = Employee::where('e_id', $id)->first();
        $data->dob = Carbon::parse($data->dob)->format('d-m-Y');
        return view('ims/profile/edit-pessonaldetails', ['data' => $data]);
    }
    public function updatepersonaldetails(Request $req)
    {
        $empLogin = $req->session()->get('emp_login');

        $dataToUpdate = [
            'fname' => $req->fname,
            'mname' => $req->mname,
            'lname' => $req->lname,
            'nationality' => $req->nationality,
            'dob' => date('Y-m-d', strtotime($req->dob)),
            'marital_status' => $req->marital_status,
            'gender' => $req->gender,
            'bloodtype' => $req->bloodtype,
            'phone' => $req->phone,
            'pemail' => $req->pemail,
        ];
        if ($req->hasFile('addharcard')) {
            $image = $req->file('addharcard')->store(
                'AddharCard/' . $req->id,
                'public'
            );
            $dataToUpdate['aadhaarcard'] = $image;
        }
        if ($req->id) {
            $update = EmployeeChange::where('e_id', '=', $req->id)->update($dataToUpdate);
        }else {
            $dataToUpdate['e_id'] = $req->id;
            $update = EmployeeChange::create($dataToUpdate);
        }
        if ($update) {
            $chenge = Employee::where('e_id', $req->id)->update(['p_details_status' => 'Pending']);
            // send mail
            $data = Employee::where('e_id', $empLogin['e_id'])
                ->select(DB::raw("CONCAT(fname, ' ', lname) as name"))
                ->first();
            $data['url'] = baseUrl() . '/employee-detail/' . $empLogin['e_id'];
            $to =  env('HR_EMAIL');
            $cc =  env('ADMIN_EMAIL');
            $msg = "User Profile Update Pending Approval";
            $this->emailService->sendMail($to, $msg, 'ims/mail/profile/personaldetails', ['data' => $data], $cc);

            session()->flash('notification', ['type' => 'success', 'message' => "Request submitted successfully."]);
            return redirect('profile');
        } else {
            $dataToUpdate['e_id'] = $empLogin['e_id'];
            EmployeeChange::create($dataToUpdate);
            $chenge = Employee::where('e_id', $req->id)->update(['p_details_status' => 'Pending']);
            session()->flash('notification', ['type' => 'success', 'message' => "Request created and submitted successfully."]);
            return redirect('profile');
        }
        session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
        return redirect(url('profile'));
    }
    public function change_personal_details(Request $req)
    {
        $new = EmployeeChange::where('e_id', $req->id)->first();
        if ($req->status == 'approve') {
            // Approve
            $data = [
                'fname' => $new->fname,
                'lname' => $new->lname,
                'mname' => $new->mname,
                'dob' =>  date('Y-m-d', strtotime($new->dob)),
                'nationality' => $new->nationality,
                'marital_status' => $new->marital_status,
                'gender' => $new->gender,
                'bloodtype' => $new->bloodtype,
                'phone' => $new->phone,
                'pemail' => $new->pemail,
                'aadhaarcard' => $new->aadhaarcard,
                'p_details_status' => 'Approve',
            ];
            $save = Employee::where('e_id', $req->id)->where('p_details_status', 'Pending')->update($data);
            if ($save) {
                session()->flash('notification', ['type' => 'success', 'message' => "Details updated successfully."]);
                return response()->json(['message' => 'success']);
            } else {
                session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
                return response()->json(['message' => 'An error occurred. Please try again.']);
            }
        } else {
            // Reject
            $save = Employee::where('e_id', $req->id)->where('p_details_status', 'Pending')->update(['p_details_status' => 'Reject']);
            if ($save) {
                session()->flash('notification', ['type' => 'success', 'message' => "Request rejected successfully."]);
                return response()->json(['message' => 'success']);
            } else {
                session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
                return response()->json(['message' => 'An error occurred. Please try again.']);
            }
        }
    }

    public function addeducationqualification()
    {
        return view('ims/profile/add-educationqualification');
    }
    public function submiteducationqualification(Request $req)
    {
        $empLogin = $req->session()->get('emp_login');
        $data = [
            'e_id' => $empLogin['e_id'],
            'qualification' => $req->qualification,
            'university_name' => $req->university_name,
            'starting_year' => Carbon::createFromFormat('m-Y', $req->starting_year)->format('Y-m'),
            'ending_year' => Carbon::createFromFormat('m-Y', $req->ending_year)->format('Y-m'),
        ];
        $save = Education_Qualification::create($data);
        if ($save) {
            $data['edq_id'] = $save->id;
            $insert = EducationQualificationChange::create($data);
            session()->flash('notification', ['type' => 'success', 'message' => "Education qualification added successfully."]);
            return redirect('profile');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('profile'));
        }
    }
    public function editeducationqualification($id)
    {
        $data = Education_Qualification::where('edq_id', $id)->first();
        $data->starting_year = Carbon::parse($data->starting_year)->format('m-Y');
        $data->ending_year = Carbon::parse($data->ending_year)->format('m-Y');
        return view('ims/profile/edit-educationqualification', ['data' => $data]);
    }
    public function updateeducationqualification(Request $req)
    {
        $empLogin = $req->session()->get('emp_login');
        $updateeducation = [
            'edq_id' => $req->id,
            'e_id' => $req->e_id,
            'qualification' => $req->qualification,
            'university_name' => $req->university_name,
            'starting_year' => Carbon::createFromFormat('m-Y', $req->starting_year)->format('Y-m'),
            'ending_year' => Carbon::createFromFormat('m-Y', $req->ending_year)->format('Y-m'),
        ];

        $educationqualification = EducationQualificationChange::where('edq_id', '=', $req->id)->update($updateeducation);
        $change = Education_Qualification::where('edq_id', $req->id)->update(['status' => 'Pending']);
        if ($educationqualification) {

            // send mail
            $data = Employee::where('e_id', $empLogin['e_id'])
                ->select(DB::raw("CONCAT(fname, ' ', lname) as name"))
                ->first();
            $data['url'] = baseUrl() . '/employee-detail/' . $empLogin['e_id'];
            $to =  env('HR_EMAIL');
            $cc =  env('ADMIN_EMAIL');
            $msg = "Education Information Update Pending Approval";
            $this->emailService->sendMail($to, $msg, 'ims/mail/profile/educationdetails', ['data' => $data], $cc);

            session()->flash('notification', ['type' => 'success', 'message' => "Request sent successfully."]);
            return redirect('profile');
        } else {
            $save =  EducationQualificationChange::create($updateeducation);
            $data = Employee::where('e_id', $empLogin['e_id'])
                ->select(DB::raw("CONCAT(fname, ' ', lname) as name"))
                ->first();
            $data['url'] = baseUrl() . '/employee-detail/' . $empLogin['e_id'];
            $to =  env('ADMIN_EMAIL');
            $cc =  env('HR_EMAIL');
            $msg = "Education Information Update Pending Approval";
            $this->emailService->sendMail($to, $msg, 'ims/mail/profile/educationdetails', ['data' => $data], $cc);

            session()->flash('notification', ['type' => 'success', 'message' => "Request sent successfully."]);
            return redirect(url('profile'));
        }
        session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
        return redirect(url('profile'));
    }

    public function education_details(Request $req)
    {
        $new = EducationQualificationChange::where('edq_id', $req->id)->first();
        if ($req->status == 'approve') {
            $data = [
                'edq_id' => $req->id,
                'e_id' => $new->e_id,
                'qualification' => $new->qualification,
                'university_name' => $new->university_name,
                'starting_year' =>  $new->starting_year,
                'ending_year' =>  $new->ending_year,
                'status' => 'Approve'
            ];
            $save = Education_Qualification::where('edq_id', $req->id)->where('status', 'Pending')->update($data);
            if ($save) {
                session()->flash('notification', ['type' => 'success', 'message' => "Details updated successfully."]);
                return response()->json(['message' => 'success']);
            } else {
                session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
                return response()->json(['message' => 'An error occurred. Please try again.']);
            }
        } else {
            // Reject
            $save = Education_Qualification::where('edq_id', $req->id)->where('status', 'Pending')->update(['status' => 'Reject']);
            if ($save) {
                session()->flash('notification', ['type' => 'success', 'message' => "Request rejected successfully."]);
                return response()->json(['message' => 'success']);
            } else {
                session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
                return response()->json(['message' => 'An error occurred. Please try again.']);
            }
        }
    }
    public function get_countries()
    {
        $countries = Countries::all();
        return response()->json($countries);
    }

    public function get_states($c_id)
    {
        $states = States::where('country_id', $c_id)->get();
        return response()->json($states);
    }

    public function get_cities($s_id)
    {
        $cities = Cities::where('state_id', $s_id)->get();
        return response()->json($cities);
    }

    public function addaddress()
    {
        return view('ims/profile/add-address');
    }
    public function submitaddress(Request $req)
    {
        $empLogin = $req->session()->get('emp_login');
        $data = [
            'e_id' => $empLogin['e_id'],
            'address_type' => $req->address_type,
            'apartment_no' => $req->apartment_no,
            'apartment_name' => $req->apartment_name,
            'area' => $req->area,
            'city' => $req->city,
            'state' => $req->state,
            'country' => $req->country,
            'postal_code' => $req->postal_code,
        ];
        $save = Address::create($data);
        if ($save) {
            $data['ad_id'] = $save->id;
            $save = AddressChange::create($data);
            session()->flash('notification', ['type' => 'success', 'message' => "Address added successfully."]);
            return redirect('profile#contact-details');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('profile'));
        }
    }
    public function editaddress($id)
    {
        $data =   Address::where('ad_id', $id)->first();
        return view('ims/profile/edit-address', ['data' => $data]);
    }
    public function updateaddress(Request $req)
    {
        $empLogin = $req->session()->get('emp_login');
        $updateaddress = [
            'e_id' => $empLogin['e_id'],
            'address_type' => $req->address_type,
            'apartment_no' => $req->apartment_no,
            'apartment_name' => $req->apartment_name,
            'area' => $req->area,
            'city' => $req->city,
            'state' => $req->state,
            'country' => $req->country,
            'postal_code' => $req->postal_code,
        ];
        $address = AddressChange::where('ad_id', '=', $req->id)->update($updateaddress);
        $change = Address::where('ad_id', $req->id)->update(['status' => 'Pending']);
        if ($address) {
            // send mail
            $data = Employee::where('e_id', $empLogin['e_id'])
                ->select(DB::raw("CONCAT(fname, ' ', lname) as name"))
                ->first();
            $data['url'] = baseUrl() . '/employee-detail/' . $empLogin['e_id'];

            $to =  env('HR_EMAIL');
            $cc =  env('ADMIN_EMAIL');
            $msg = "Address Update Pending Approval";
            $this->emailService->sendMail($to, $msg, 'ims/mail/profile/addressdetails', ['data' => $data], $cc);

            session()->flash('notification', ['type' => 'success', 'message' => "Update request submitted successfully."]);
            return redirect('profile#contact-details');
        } else {
            $updateaddress['ad_id'] = $req->id;
            $save = AddressChange::create($updateaddress);
            session()->flash('notification', ['type' => 'success', 'message' => "Update request submitted successfully."]);
            return redirect('profile#contact-details');
        }
        session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
        return redirect(url('profile'));
    }

    public function address_details_update(Request $req)
    {
        $new = AddressChange::where('ad_id', $req->id)->first();
        if ($req->status == 'approve') {
            $data = [
                'apartment_no' => $new->apartment_no,
                'address_type' => $new->address_type,
                'apartment_name' => $new->apartment_name,
                'area' => $new->area,
                'city' => $new->city,
                'state' => $new->state,
                'country' => $new->country,
                'postal_code' => $new->postal_code,
                'status' => 'Approve'
            ];
            $save = Address::where('ad_id', $req->id)->where('status', 'Pending')->update($data);
            if ($save) {
                session()->flash('notification', ['type' => 'success', 'message' => "Details updated successfully."]);
                return response()->json(['message' => 'success']);
            } else {
                session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
                return response()->json(['message' => 'An error occurred. Please try again.']);
            }
        } else {
            // Reject
            $save = Address::where('ad_id', $req->id)->where('status', 'Pending')->update(['status' => 'Reject']);
            if ($save) {
                session()->flash('notification', ['type' => 'success', 'message' => "Request rejected successfully."]);
                return response()->json(['message' => 'success']);
            } else {
                session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
                return response()->json(['message' => 'An error occurred. Please try again.']);
            }
        }
    }


    public function addemergencycontact()
    {
        return view('ims/profile/add-emergencycontact');
    }
    public function submitemergencycontect(Request $req)
    {
        $empLogin = $req->session()->get('emp_login');
        $data = [
            'e_id' => $empLogin['e_id'],
            'name' => $req->name,
            'relationship' => $req->relationship,
            'phone' => $req->phone,
            'status' => 'Approve',
        ];
        $save =  EmergencyContact::create($data);
        if ($save) {
            unset($data['status']);
            $data['ec_id'] = $save->id;
            $sec_save = EmergencyContactChange::create($data);
            session()->flash('notification', ['type' => 'success', 'message' => "Contact Add successfully"]);
            return redirect('profile#emergency-contacts');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('profile'));
        }
    }
    public function change_emergency_contacts(Request $req)
    {
        $new = EmergencyContactChange::where('ec_id', $req->id)->first();
        if ($req->status == 'approve') {
            $data = [
                'name' => $new->name,
                'relationship' => $new->relationship,
                'phone' => $new->phone,
                'status' => 'Approve'
            ];
            $save = EmergencyContact::where('ec_id', $req->id)->where('status', 'Pending')->update($data);
            if ($save) {
                session()->flash('notification', ['type' => 'success', 'message' => "Details Change Successfully"]);
                return response()->json(['message' => 'success']);
            } else {
                session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
                return response()->json(['message' => 'An error occurred. Please try again.']);
            }
        } else {
            // Reject
            $save = EmergencyContact::where('ec_id', $req->id)->where('status', 'Pending')->update(['status' => 'Reject']);
            if ($save) {
                $delete = EmergencyContactChange::where('ec_id', $req->id)->delete();
                session()->flash('notification', ['type' => 'success', 'message' => "Request rejected successfully."]);
                return response()->json(['message' => 'success']);
            } else {
                session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
                return response()->json(['message' => 'An error occurred. Please try again.']);
            }
        }
    }
    public function editemergencycontact($id)
    {
        $data = EmergencyContact::where('ec_id', $id)->first();
        return view('ims/profile/edit-emergency-contact', ['data' => $data]);
    }
    public function updatemergencycontact(Request $req)
    {
        $empLogin = $req->session()->get('emp_login');
        $updatedata = [
            'ec_id' => $req->id,
            'e_id' => $req->e_id,
            'name' => $req->name,
            'relationship' => $req->relationship,
            'phone' => $req->phone,
        ];
        $save = EmergencyContactChange::where('ec_id', $req->id)->update($updatedata);
        $change = EmergencyContact::where('ec_id', $req->id)->update(['status' => 'Pending']);
        if ($save) {
            // send mail
            $data = Employee::where('e_id', $empLogin['e_id'])
                ->select(DB::raw("CONCAT(fname, ' ', lname) as name"))
                ->first();
            $data['url'] = baseUrl() . '/employee-detail/' . $empLogin['e_id'];

            $to =  env('HR_EMAIL');
            $cc =  env('ADMIN_EMAIL');
            $msg = "Emergency Contact Update Pending Approval";
            $this->emailService->sendMail($to, $msg, 'ims/mail/profile/emergencycontact', ['data' => $data], $cc);

            session()->flash('notification', ['type' => 'success', 'message' => "Update Request Send successfully"]);
            return redirect('profile#emergency-contacts');
        } else {
            EmergencyContactChange::create($updatedata);
            session()->flash('notification', ['type' => 'success', 'message' => "Update Request Send successfully"]);
            return redirect('profile#emergency-contacts');
        }
        session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
        return redirect(url('profile'));
    }
    public function addbankinformation()
    {
        return view('ims/profile/add-bank-infomation');
    }
    public function submitbankinformation(Request $req)
    {
        $empLogin = $req->session()->get('emp_login');
        $employee = Employee::where('e_id', $empLogin['e_id'])->first();
        $data = [
            'e_id' => $employee->e_id,
            'bank_name' => $req->bank_name,
            'branch' => $req->branch,
            'account_no' => $req->account_no,
            'ifsc_code' => $req->ifsc_code,
            'pan_no' => $req->pan_no,
            'uan_no' => $req->uan_no,
            'pf_no' => $req->pf_no,
        ];
        $save = BankInformation::create($data);
        if ($save) {
            $data['bi_id'] = $save->id;
            $save = BankInformationChange::create($data);
            session()->flash('notification', ['type' => 'success', 'message' => "Information Add successfully"]);
            return redirect('profile#bank-information');
        } else {
            session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
            return redirect(url('profile'));
        }
    }

    public function editbankinformation($id)
    {
        $data = BankInformation::where('bi_id', $id)->first();
        return view('ims/profile/edit-bank-information', ['data' => $data]);
    }
    public function updatebankinformation(Request $req)
    {
        $empLogin = $req->session()->get('emp_login');
        $updateinformation = [
            'e_id' => $req->e_id,
            'bank_name' => $req->bank_name,
            'branch' => $req->branch,
            'account_no' => $req->account_no,
            'ifsc_code' => $req->ifsc_code,
            'pan_no' => $req->pan_no,
            'uan_no' => $req->uan_no,
            'pf_no' => $req->pf_no,
        ];
        $information = BankInformationChange::where('bi_id', '=', $req->id)->update($updateinformation);
        $change = BankInformation::where('bi_id', $req->id)->update(['status' => 'Pending']);
        if ($information) {
            // send mail
            $data = Employee::where('e_id', $empLogin['e_id'])
                ->select(DB::raw("CONCAT(fname, ' ', lname) as name"))
                ->first();
            $data['url'] = baseUrl() . '/employee-detail/' . $empLogin['e_id'];

            $to =  env('HR_EMAIL');
            $cc =  env('ADMIN_EMAIL');
            $msg = "Bank Information Update Pending Approval";
            $this->emailService->sendMail($to, $msg, 'ims/mail/profile/bankinformation', ['data' => $data], $cc);

            session()->flash('notification', ['type' => 'success', 'message' => "Approve request generate successfully"]);
            return redirect('profile#bank-information');
        } else {
            $updateinformation['bi_id'] = $req->id;
            BankInformationChange::create($updateinformation);
            session()->flash('notification', ['type' => 'success', 'message' => "Approve request generate successfully"]);
            return redirect('profile#bank-information');
        }
        session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
        return redirect(url('profile'));
    }

    public function bank_info_change(Request $req)
    {
        $new = BankInformationChange::where('e_id', $req->id)->first();
        if ($req->status == 'approve') {
            $data = [
                'bank_name' => $new->bank_name,
                'branch' => $new->branch,
                'account_no' => $new->account_no,
                'ifsc_code' => $new->ifsc_code,
                'pan_no' => $new->pan_no,
                'uan_no' => $new->uan_no,
                'pf_no' => $new->pf_no,
                'status' => 'Approve',
            ];
            $save = BankInformation::where('e_id', $req->id)->where('status', 'Pending')->update($data);
            if ($save) {
                session()->flash('notification', ['type' => 'success', 'message' => "Details Change Successfully"]);
                return response()->json(['message' => 'success']);
            } else {
                session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
                return response()->json(['message' => 'An error occurred. Please try again.']);
            }
        } else {
            // Reject
            $save = BankInformation::where('e_id', $req->id)->where('status', 'Pending')->update(['status' => 'Reject']);
            if ($save) {
                session()->flash('notification', ['type' => 'success', 'message' => "Request Reject Successfully"]);
                return response()->json(['message' => 'success']);
            } else {
                session()->flash('notification', ['type' => 'danger', 'message' => "An error occurred. Please try again."]);
                return response()->json(['message' => 'An error occurred. Please try again.']);
            }
        }
    }
}
