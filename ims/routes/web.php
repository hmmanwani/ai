<?php

use App\Http\Controllers\Cronjobs;
use App\Http\Controllers\ims\admin\OverViewController;
use App\Http\Controllers\ims\LogInController;
use App\Http\Controllers\ims\DashboardController;
use App\Http\Controllers\ims\ManageLeavesController;
use App\Http\Controllers\ims\ViewAttendanceController;
use App\Http\Controllers\ims\ProfileController;
use App\Http\Controllers\ims\ResignationController;
use App\Http\Controllers\ims\SalarySlipController;
use App\Http\Controllers\ims\HrPolicyController;
use App\Http\Controllers\ims\admin\EmployeeController;
use App\Http\Controllers\ims\admin\HolidayController;
use App\Http\Controllers\ims\admin\LeaveController;
use App\Http\Controllers\ims\admin\TeamController;
use App\Http\Controllers\ims\admin\DocumentController;
use App\Http\Controllers\ims\admin\ExtraTimeController;
use App\Http\Controllers\ims\admin\ManageEmailController;
use App\Http\Controllers\ims\admin\ResignationAdminController;
use App\Http\Controllers\ims\DailyWorkReportController;
use App\Http\Controllers\ims\ManageExtraTimeController;
use App\Http\Controllers\ims\ManageNotificationController;
use App\Http\Controllers\ims\ManagerTaskController;
use App\Http\Controllers\ims\ProjectController;
use App\Http\Controllers\NoMobileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['check.mobile'])->group(function () {
    Route::get('/', [LogInController::class, 'login'])->middleware('emplogin');
    Route::get('new-login', [LogInController::class, 'new_login']);
    Route::get('auth', [LogInController::class, 'auth']);
    Route::post('auth', [LogInController::class, 'auth']);
    Route::get('forgot-password', [LogInController::class, 'forgot_password']);
    Route::post('submit-forgot-password', [LogInController::class, 'submit_forgot_password']);
    Route::get('new-password/{token}', [LogInController::class, 'new_password'])->name('new-password');
    Route::post('submit-new-password', [LogInController::class, 'submit_new_password']);
    Route::middleware(['emplogout'])->group(function () {

        Route::get('logout', [LogInController::class, 'logout']);
        Route::get('dashboard', [DashboardController::class, 'index']);
        Route::post('clockout', [LogInController::class, 'clockout']);
        Route::get('view-attendance', [ViewAttendanceController::class, 'viewattendance']);
        Route::post('/send-date', [ViewAttendanceController::class, 'sendDate']);
        Route::post('/destroyBirthdayPopupSession', [DashboardController::class, 'destroyBirthdayPopupSession'])->name('destroyBirthdayPopupSession');


        // Leave Management
        Route::get('manage-leave', [ManageLeavesController::class, 'manageleave']);
        Route::post('get-user-leave', [ManageLeavesController::class, 'leave_list']);
        Route::get('add-leave', [ManageLeavesController::class, 'addleave']);
        Route::post('submit-leave', [ManageLeavesController::class, 'submitleave']);
        Route::post('leave-info', [ManageLeavesController::class, 'leave_info']);
        Route::get('delete-leave/{id}', [ManageLeavesController::class, 'delete_leave']);

        // WHF Management
        Route::get('manage-wfh', [ManageLeavesController::class, 'managewfh']);
        Route::get('work-from-home', [ManageLeavesController::class, 'workformhome']);
        Route::post('submit-wfh', [ManageLeavesController::class, 'submitwfh']);
        Route::post('get-user-wfh', [ManageLeavesController::class, 'wfhlist']);
        Route::post('wfh-info', [ManageLeavesController::class, 'wfh_info']);
        Route::get('delete-wfh/{id}', [ManageLeavesController::class, 'delete_wfh']);

        // Manage Extra Time
        Route::get('manage-extra-time', [ManageExtraTimeController::class, 'manage_extra_time']);
        Route::get('add-extra-time', [ManageExtraTimeController::class, 'add_extra_time']);
        Route::post('submit-extra-hours', [ManageExtraTimeController::class, 'submit_extra_hours']);
        Route::post('get-extra-time', [ManageExtraTimeController::class, 'extra_time_list']);
        Route::post('user-extra-time-details', [ManageExtraTimeController::class, 'user_extra_time_details']);
        Route::get('delete-extra-time/{id}', [ManageExtraTimeController::class, 'delete_extra_time']);

        // profile
        Route::get('profile', [ProfileController::class, 'profile']);
        Route::get('/get-countries', [ProfileController::class, 'get_countries']);
        Route::get('/get-states/{c_id}', [ProfileController::class, 'get_states']);
        Route::get('/get-cities/{s_id}', [ProfileController::class, 'get_cities']);

        // change password
        Route::get('change-password', [LogInController::class, 'change_password']);
        Route::post('submit-change-password', [LogInController::class, 'submit_change_password']);

        // edit personal details
        Route::get('edit-personal-details/{id}', [ProfileController::class, 'editpersonaldetails']);
        Route::post('update-personal-details', [ProfileController::class, 'updatepersonaldetails']);
        Route::post('change-personal-details', [ProfileController::class, 'change_personal_details']);

        // edit contact details
        Route::get('edit-contact-details/{id}', [ProfileController::class, 'editcontactdetails']);
        Route::post('update-contact-details', [ProfileController::class, 'updatecontactdetails']);

        // add & edit education qualification
        Route::get('add-education-qualification', [ProfileController::class, 'addeducationqualification']);
        Route::post('submit-education-qualification', [ProfileController::class, 'submiteducationqualification']);
        Route::get('edit-education-qualification/{id}', [ProfileController::class, 'editeducationqualification']);
        Route::post('update-education-qualification', [ProfileController::class, 'updateeducationqualification']);
        Route::post('education-details', [ProfileController::class, 'education_details']);

        // add & edit address
        Route::get('add-address', [ProfileController::class, 'addaddress']);
        Route::post('submit-address', [ProfileController::class, 'submitaddress']);
        Route::get('edit-address/{id}', [ProfileController::class, 'editaddress']);
        Route::post('update-address', [ProfileController::class, 'updateaddress']);
        Route::post('address-details-update', [ProfileController::class, 'address_details_update']);

        // add & edit emergency contacts
        Route::get('add-emergency-contect', [ProfileController::class, 'addemergencycontact']);
        Route::post('submit-emergency-contect', [ProfileController::class, 'submitemergencycontect']);
        Route::post('change-emergency-contacts', [ProfileController::class, 'change_emergency_contacts']);
        Route::get('edit-emergency-contact/{id}', [ProfileController::class, 'editemergencycontact']);
        Route::post('update-emergency-contact', [ProfileController::class, 'updatemergencycontact']);

        // add & edit bank information
        Route::get('add-bank-information', [ProfileController::class, 'addbankinformation']);
        Route::post('submit-bank-information', [ProfileController::class, 'submitbankinformation']);
        Route::get('edit-bank-information/{id}', [ProfileController::class, 'editbankinformation']);
        Route::post('update-bank-information', [ProfileController::class, 'updatebankinformation']);
        Route::post('bank-info-change', [ProfileController::class, 'bank_info_change']);

        // manage Project manager and admin
        Route::post('submit-project', [ProjectController::class, 'submit_project']);
        Route::get('add-project', [ProjectController::class, 'add_project']);
        Route::post('/update-project-status', [ProjectController::class, 'update_project_status'])->name('update-project-status');
        Route::get('project-details/{id}', [ProjectController::class, 'project_details'])->name('project-details');
        Route::get('edit-project-details/{id}', [ProjectController::class, 'edit_project_details']);
        Route::post('submit-edit-project-details', [ProjectController::class, 'submit_edit_project_details']);
        Route::post('get-project-list', [ProjectController::class, 'get_project_list']);
        Route::get('project', [ProjectController::class, 'project']);
        Route::post('/get-assign-sub-emp', [ProjectController::class, 'get_assign_sub_emp'])->name('get-assign-sub-emp');
        Route::post('update-assign-sub-emp', [ProjectController::class, 'update_assign_sub_emp']);

        // Manage Task
        Route::get('manage-task', [ManagerTaskController::class, 'manage_task']);
        Route::get('add-task', [ManagerTaskController::class, 'add_task']);
        Route::post('submit-task', [ManagerTaskController::class, 'submit_task']);
        Route::post('get-task-list', [ManagerTaskController::class, 'get_task_list']);
        Route::post('fetch-project-member', [ManagerTaskController::class, 'fetch_project_member']);
        Route::get('task-details/{id}', [ManagerTaskController::class, 'task_details']);
        Route::get('edit-task/{id}', [ManagerTaskController::class, 'edit_task']);
        Route::post('submit-edit-task', [ManagerTaskController::class, 'submit_edit_task']);
        Route::post('submit-task-comment', [ManagerTaskController::class, 'submit_task_comment']);
        Route::get('delete-task/{id}', [ManagerTaskController::class, 'delete_task']);
        Route::post('update-task-status', [ManagerTaskController::class, 'update_task_status']);

        // Manage Notification
        Route::get('manage-notification', [ManageNotificationController::class, 'manage_notification']);
        Route::post('get-employee-notification-list', [ManageNotificationController::class, 'get_notification_list']);
        Route::post('/update-employee-notification-status', [ManageNotificationController::class, 'update_employee_notification_status']);

        //daily-work-report
        Route::get('daily-work-report',[DailyWorkReportController::class,'daily_work_report']);
        Route::get('work-email-setting',[DailyWorkReportController::class,'work_email_setting']);
        Route::post('get-team-emp-list', [DailyWorkReportController::class, 'get_team_emp_list']);
        Route::get('internal-team-access',[DailyWorkReportController::class,'internal_team_access']);
        Route::post('get-internal-team-list', [DailyWorkReportController::class, 'get_internal_team_list']);
        Route::post('update-work-view-access-emp', [DailyWorkReportController::class, 'update_work_view_access_emp']);
        Route::post('/get-internal-team-member-emp', [DailyWorkReportController::class, 'get_internal_team_member_emp'])->name('get-internal-team-member-emp');
        Route::get('add-work-report',[DailyWorkReportController::class,'add_work_report']);
        Route::post('submit-add-work-report',[DailyWorkReportController::class,'submit_add_work_report']);
        Route::post('get-work-list',[DailyWorkReportController::class,'get_work_list']);
        Route::post('work-info', [DailyWorkReportController::class, 'work_info']);
        Route::post('/update-work-report-setting-status', [DailyWorkReportController::class, 'update_work_report_setting_status']);
        

        // Resignation
        Route::get('resignation', [ResignationController::class, 'resignation']);
        Route::post('submit-resignation', [ResignationController::class, 'submitresignation']);

        // Hr Policy
        Route::get('hr-policy', [HrPolicyController::class, 'hr_policy']);
        Route::post('get-hr-policy-user', [HrPolicyController::class, 'get_hr_policy_list']);
        Route::post('submit-edit-hr-policy', [HrPolicyController::class, 'submit_edit_hr_policy']);

        // Salary Slip
        Route::get('salary-slip-request', [SalarySlipController::class, 'salary_slip_request']);
        Route::post('submit-salary-slip-request', [SalarySlipController::class, 'submit_salary_slip_requests']);
        Route::get('generate-pdf/{id}', [SalarySlipController::class, 'generatePDF']);
        Route::get('salary-slip/{salary}', [SalarySlipController::class, 'generatePDF']);






        // admin Side
        Route::middleware('AdminPageCheck:1|2')->group(function () {
            Route::get('overview', [OverViewController::class, 'overview']);
            Route::get('employee', [EmployeeController::class, 'employee']);
            Route::post('get-employee-list', [EmployeeController::class, 'get_emp_list']);
            Route::post('/update-employee-status', [EmployeeController::class, 'updateEmployeeStatus'])->name('update_employee_status');
            Route::get('addemployee', [EmployeeController::class, 'addemployee']);

            // Add Employee Form
            Route::post('submit-employee', [EmployeeController::class, 'submitemployee']);
            Route::get('employee-detail/{id}', [EmployeeController::class, 'employee_details']);
            Route::get('edit-employee/{id}', [EmployeeController::class, 'edit_employee']);
            Route::post('submit-admin-employee', [EmployeeController::class, 'submit_admin_employee']);
            Route::get('edit-attendance/{id}', [EmployeeController::class, 'edit_attendance']);
            Route::post('update-employee-time', [EmployeeController::class, 'update_employee_time']);
            Route::post('autocomplete-time', [EmployeeController::class, 'autocomplete']);

            // View Attedance
            Route::get('admin-view-attendance/{id}', [EmployeeController::class, 'admin_view_attedance']);
            Route::post('get-attendance-details', [EmployeeController::class, 'get_attendance_details']);

            // salary Management
            Route::get('admin-emp-salary/{id}', [EmployeeController::class, 'admin_emp_salary']);
            Route::post('/update-salary', [EmployeeController::class, 'updateSalary']);


            // pending leave
            Route::get('pending-leave', [LeaveController::class, 'pendingleave']);
            Route::post('get-pending-leave', [LeaveController::class, 'pending_leave_list']);
            Route::get('leave-details/{id}', [LeaveController::class, 'leave_details']);
            Route::post('update-leave-status', [LeaveController::class, 'update_leave_status']);
            Route::post('approve-leave', [LeaveController::class, 'update_leave_status']);
            Route::get('delete-approve-leave/{id}',[LeaveController::class,'delete_approve_leave']);

            // Approved leave
            Route::get('approved-leave', [LeaveController::class, 'approvedleave']);
            Route::post('get-approved-leave', [LeaveController::class, 'approved_leave_list']);

            // leave type add & edit
            Route::get('leave-type', [LeaveController::class, 'leavetype']);
            Route::post('get-leavetype', [LeaveController::class, 'leavtype_list']);
            Route::get('add-leave-type', [LeaveController::class, 'addleavetype']);
            Route::post('submit-leave-types', [LeaveController::class, 'submitleavetype']);
            Route::get('edit-leave-type/{id}', [LeaveController::class, 'editleavetype']);
            Route::post('update-leave-types', [LeaveController::class, 'updateleavetype']);
            Route::get('delete-leave-type/{id}', [LeaveController::class, 'delete_leavetype']);

            // app employee leave
            Route::get('manage-emp-leave', [LeaveController::class, 'manage_emp_leave']);
            Route::get('add-emp-leave', [LeaveController::class, 'add_emp_leave']);
            Route::post('submit-add-emp-leave', [LeaveController::class, 'submit_add_emp_leave']);

            // Pending Work Form Home
            Route::get('pending-wfh', [LeaveController::class, 'pending_wfh']);
            Route::post('get-pending-wfh', [LeaveController::class, 'pending_wfh_list']);
            Route::get('wfh-details/{id}', [LeaveController::class, 'wfh_details']);
            Route::post('update-wfh-status', [LeaveController::class, 'update_wfh_status']);
            Route::Post('approve-wfh', [LeaveController::class, 'update_wfh_status']);

            // Approved Work Form Home
            Route::get('approved-wfh', [LeaveController::class, 'approved_wfh']);
            Route::post('get-approved-wfh', [LeaveController::class, 'approved_wfh_list']);
            Route::get('/DeleteWfh/{id}', [LeaveController::class, 'Delete_wfh']);

            // add-employee-wfh
            Route::get('add-employee-wfh',[LeaveController::class,'add_employee_wfh']);
            Route::post('submit-add-emp-wfh',[LeaveController::class,'submit_add_emp_wfh']);

            // approve extra time
            Route::get('approve-extra-time', [ExtraTimeController::class, 'approve_extra_time']);
            Route::post('submit-approve-extra-time', [ExtraTimeController::class, 'approveExtraTime']);
            Route::post('get-approve-extra-time', [ExtraTimeController::class, 'get_approve_extra_time']);
            Route::post('extra-time-details', [ExtraTimeController::class, 'extra_time_details']);

            // holiday
            Route::get('holiday', [HolidayController::class, 'holiday']);
            Route::get('add-holiday', [HolidayController::class, 'add_holiday']);
            Route::post('submit-holiday', [HolidayController::class, 'submit_holiday']);
            Route::post('get-holiday', [HolidayController::class, 'holiday_list']);
            Route::get('delete-holiday/{id}', [HolidayController::class, 'deleteholiday']);

            // Documents
            Route::get('admin-hr-policy', [DocumentController::class, 'admin_hr_policy']);
            Route::post('submit-hr-policy', [DocumentController::class, 'submit_hr_policy']);
            Route::post('get-hr-policy', [DocumentController::class, 'Hr_policy_list']);
            Route::get('delete-hr-policy/{id}', [DocumentController::class, 'delete_hr_policy']);
            Route::post('getSalaryDetails', [DocumentController::class, 'getSalaryDetails']);

            // salary slip
            Route::get('admin-salary-slip', [DocumentController::class, 'admin_salary_slip']);

            // upload
            Route::post('submit-salary-slip', [DocumentController::class, 'submit_salary_slip']);
            Route::post('/update-salary-slip-status', [DocumentController::class, 'updateSalarySlipStatus'])->name('update_salary_slip_status');

            // add salary slip
            Route::get('admin-add-salary-slip', [DocumentController::class, 'admin_add_salary_slip']);
            Route::post('submit-salary-slip-details', [DocumentController::class, 'submit_salary_slip_details']);
            Route::post('get-salary-slip-detials', [DocumentController::class, 'salary_slip_details_list']);
            Route::get('edit-salary-slip-detials/{id}', [DocumentController::class, 'edit_salary_slip_details']);
            Route::post('submit-edit-salary-slip-details', [DocumentController::class, 'submit_edit_salary_slip_details']);
            Route::get('/autocomplete-employee', [DocumentController::class, 'autocomplete']);

            // team
            Route::get('team', [TeamController::class, 'team']);
            Route::post('submit-team', [TeamController::class, 'submit_team']);
            Route::post('get-team', [TeamController::class, 'get_team']);
            Route::get('delete-team/{id}', [TeamController::class, 'deleteteam']);
            Route::get('/team/{id}/count', [TeamController::class, 'getTeamMemberCount']);
            Route::post('/edit-team', [TeamController::class, 'edit_team']);

            //Team Member
            Route::get('view-team-member/{id}', [TeamController::class, 'view_team_member'])->name('view-team-member');
            Route::post('submit-team-member', [TeamController::class, 'submit_team_member']);

            // resignation
            Route::get('admin-resignation', [ResignationAdminController::class, 'admin_resignation']);
            Route::post('get-resignation', [ResignationAdminController::class, 'get_resignation_list']);
            Route::get('admin-resignation-details/{id}', [ResignationAdminController::class, 'admin_resignation_details']);
            Route::post('approve-resignation', [ResignationAdminController::class, 'update_resignation_status']);
            // Route::post

            // manage email
            Route::get('manage-email', [ManageEmailController::class, 'manage_email']);
            Route::get('add-email-type', [ManageEmailController::class, 'add_email_type']);
            Route::post('submit-email-type', [ManageEmailController::class, 'submit_email_type']);
            Route::post('get-email-type', [ManageEmailController::class, 'get_email_type']);
            Route::get('edit-email-type/{id}', [ManageEmailController::class, 'edit_email_type']);
            Route::post('submit-edit-email-type', [ManageEmailController::class, 'submit_edit_email_type']);
        });
    });
});
// cron jobs
Route::get('/update-leave-count', [Cronjobs::class, 'updateLeaveCount']);
//mobile
Route::get('/no-mobile', [NoMobileController::class, 'no_mobile']);
