<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Edit Employee" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_horizontal-navbar.html -->
        <x-header />
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    {{-- Start Design --}}
                    <section id="edit-employee">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end  mb-3 ">
                                        <button onclick="goBack()" class="btn btn-primary"><i
                                                class="fa fa-arrow-left me-2" aria-hidden="true"></i>Back</button>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 f-black f-500">
                                                    <form action="{{ url('/submit-admin-employee') }}" method="post"
                                                        id="myForm">
                                                        @csrf
                                                        <div class="row">
                                                            <input type="hidden" name="id"
                                                                value="{{ $data->e_id }}">
                                                            {{-- First Name --}}
                                                            <div class="col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label class="required" for="fname">First
                                                                        Name</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="fname"
                                                                            name="fname" class="form-control"
                                                                            value="{{ $data->fname }}" required>
                                                                        <div class="invalid-feedback" id="fname-error">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- Middel Name --}}
                                                            <div class="col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label class="required" for="mname">Middle
                                                                        Name</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="mname"
                                                                            name="mname" class="form-control"
                                                                            value="{{ $data->mname }}">
                                                                        <div class="invalid-feedback" id="mname-error">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- Last Name --}}
                                                            <div class="col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label class="required" for="lname">Last
                                                                        Name</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="lname"
                                                                            name="lname" class="form-control"
                                                                            value="{{ $data->lname }}">
                                                                        <div class="invalid-feedback" id="lname-error">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- Email --}}
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="required" for="email">Email</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="email"
                                                                            name="email" class="form-control"
                                                                            value="{{ $data->email }}">
                                                                        <div class="invalid-feedback" id="email-error">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- Nationality --}}
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="required"
                                                                        for="nationality">Nationality</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="nationality"
                                                                            name="nationality" class="form-control"
                                                                            value="{{ $data->nationality }}">
                                                                        <div class="invalid-feedback"
                                                                            id="nationality-error">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- Marital Status --}}
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="required" for="marital_status">Marital
                                                                        Status</label>
                                                                    <select name="marital_status" id="marital_status"
                                                                        class="form-select"
                                                                        value="{{ $data->marital_status }}">
                                                                        <option value="">-Select Marital Status-
                                                                        </option>
                                                                        <option value="Single" <?php echo $data->marital_status == 'Single' ? 'selected' : ''; ?>>
                                                                            Single
                                                                        </option>
                                                                        <option value="Married" <?php echo $data->marital_status == 'Married' ? 'selected' : ''; ?>>
                                                                            Married
                                                                        </option>
                                                                        <option value="Divorced" <?php echo $data->marital_status == 'Divorced' ? 'selected' : ''; ?>>
                                                                            Divorced
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            {{-- Gender --}}
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="required"
                                                                        for="lname">Gender</label>
                                                                    <select name="gender" id="gender"
                                                                        class="form-select"
                                                                        value="{{ $data->gender }}">
                                                                        <option value="">-Select Your Gender-
                                                                        </option>
                                                                        <option value="Male" <?php echo $data->gender == 'Male' ? 'selected' : ''; ?>>
                                                                            Male</option>
                                                                        <option value="Female" <?php echo $data->gender == 'Female' ? 'selected' : ''; ?>>
                                                                            Female</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            {{-- Bloodtype --}}
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="required" for="bloodtype">Blood
                                                                        Type</label>
                                                                    <select name="bloodtype" id="bloodtype"
                                                                        class="form-select"
                                                                        value="{{ $data->bloodtype }}">
                                                                        <option value="">-Select Your bloodtype-
                                                                        </option>
                                                                        <option value="A+" <?php echo $data->bloodtype == 'A+' ? 'selected' : ''; ?>> A+
                                                                        </option>
                                                                        <option value="A-" <?php echo $data->bloodtype == 'A-' ? 'selected' : ''; ?>>A-
                                                                        </option>
                                                                        <option value="B+" <?php echo $data->bloodtype == 'B+' ? 'selected' : ''; ?>>B+
                                                                        </option>
                                                                        <option value="B-" <?php echo $data->bloodtype == 'B-' ? 'selected' : ''; ?>>B-
                                                                        </option>
                                                                        <option value="AB+" <?php echo $data->bloodtype == 'AB+' ? 'selected' : ''; ?>> AB+
                                                                        </option>
                                                                        <option value="AB-" <?php echo $data->bloodtype == 'AB-' ? 'selected' : ''; ?>>
                                                                            AB-</option>
                                                                        <option value="O+" <?php echo $data->bloodtype == 'O+' ? 'selected' : ''; ?>>O+
                                                                        </option>
                                                                        <option value="O-" <?php echo $data->bloodtype == 'O-' ? 'selected' : ''; ?>>O-
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            {{-- Contact number --}}
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="required" for="phone">Contact
                                                                        number</label>
                                                                    <div class="col-md-12">
                                                                        <input type="number" id="phone"
                                                                            value="{{ $data->phone }}"
                                                                            name="phone" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- Personal Email --}}
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="required" for="pemail">Personal
                                                                        Email</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="pemail"
                                                                            name="pemail" class="form-control"
                                                                            value="{{ $data->pemail }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- Date of Birth --}}
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="required" for="dob">Date of
                                                                        Birth</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="dob"
                                                                            name="dob" class="form-control"
                                                                            placeholder="dd-mm-yyyy"
                                                                            value="{{ $data->dob }}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- Team --}}
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="required"
                                                                        for="team">Team</label>
                                                                    <select name="team" id="team"
                                                                        class="form-select"
                                                                        value="{{ $data->team }} ">
                                                                        <option value="">-Select team-</option>
                                                                        @foreach ($team as $teams)
                                                                            <option value="{{ $teams->t_id }}"
                                                                                {{ $teams->t_id == $data->team ? 'selected' : '' }}>
                                                                                {{ $teams->team }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            {{-- team leader --}}
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label class="required f-16" for="team_lead">
                                                                        Leader</label>
                                                                    <div class="">
                                                                        <input type="checkbox" name="team_lead"
                                                                            class="js-switch-team-leader mt-5"
                                                                            <?php echo $data->team_lead == 1 ? 'checked' : ''; ?>>
                                                                        <input type="hidden" name="team_lead_hidden"
                                                                            value="<?php echo $data->team_lead; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- daily work report --}}
                                                            <div class="col-md-4" id="work-report-team-container"
                                                                style="display: none;">
                                                                <div class="form-group">
                                                                    <label class="required" for="workreportteam">Daily
                                                                        Work Report Team</label>
                                                                    <select name="workreportteam[]"
                                                                        id="WorkReportTeam"
                                                                        class="form-select select2" multiple>
                                                                        <option value="" disabled>-Select Work
                                                                            Report Team-</option>
                                                                        @foreach ($team as $teams)
                                                                            <option value="{{ $teams->t_id }}"
                                                                                {{ in_array($teams->t_id, json_decode($data->work_report_team, true) ?? []) ? 'selected' : '' }}>
                                                                                {{ $teams->team }}
                                                                            </option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            {{-- Designation --}}
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="required"
                                                                        for="designations">Designation</label>
                                                                    <div class="col-md-12">
                                                                        <select id="designation" name="designation"
                                                                            class="form-select">
                                                                            <option value="">Choose a Role
                                                                            </option>
                                                                            <option value="CEO"
                                                                                @selected($data->designation == 'CEO')>CEO
                                                                            </option>
                                                                            <option value="Project Manager - Intern"
                                                                                @selected($data->designation == 'Project Manager - Intern')>
                                                                                Project Manager - Intern</option>
                                                                            <option value="Jr. Project Manager"
                                                                                @selected($data->designation == 'Jr. Project Manager')>
                                                                                Jr. Project Manager</option>
                                                                            <option value="Project Manager"
                                                                                @selected($data->designation == 'Project Manager')>
                                                                                Project Manager</option>
                                                                            <option value="Sr. Project Manager"
                                                                                @selected($data->designation == 'Sr. Project Manager')>
                                                                                Sr. Project Manager</option>
                                                                            <option value="HR Executive - Intern"
                                                                                @selected($data->designation == 'HR Executive - Intern')>
                                                                                HR Executive - Intern</option>
                                                                            <option value="Jr. HR Executive"
                                                                                @selected($data->designation == 'Jr. HR Executive')>
                                                                                Jr. HR Executive</option>
                                                                            <option value="Sr. HR Executive"
                                                                                @selected($data->designation == 'Sr. HR Executive')>
                                                                                Sr. HR Executive</option>
                                                                            <option value="HR Manager"
                                                                                @selected($data->designation == 'HR Manager')>
                                                                                HR Manager</option>
                                                                            <option value="PHP - Intern"
                                                                                @selected($data->designation == 'PHP - Intern')>
                                                                                PHP - Intern</option>
                                                                            <option value="Jr. PHP Developer"
                                                                                @selected($data->designation == 'Jr. PHP Developer')>
                                                                                Jr. PHP Developer</option>
                                                                            <option value="PHP Developer"
                                                                                @selected($data->designation == 'PHP Developer')>
                                                                                PHP Developer</option>
                                                                            <option value="Sr. PHP Developer"
                                                                                @selected($data->designation == 'Sr. PHP Developer')>
                                                                                Sr. PHP Developer</option>
                                                                            <option value="PHP Team Leader"
                                                                                @selected($data->designation == 'PHP Team Leader')>
                                                                                PHP Team Leader</option>
                                                                            <option value="Digital Marketing - Intern"
                                                                                @selected($data->designation == 'Digital Marketing - Intern')>
                                                                                Digital Marketing - Intern</option>
                                                                            <option value="Jr. Digital Marketer"
                                                                                @selected($data->designation == 'Jr. Digital Marketer')>
                                                                                Jr. Digital Marketer</option>
                                                                            <option value="Digital Marketing Executive"
                                                                                @selected($data->designation == 'Digital Marketing Executive')>
                                                                                Digital Marketing Executive</option>
                                                                            <option value="Sr. Digital Marketer"
                                                                                @selected($data->designation == 'Sr. Digital Marketer')>
                                                                                Sr. Digital Marketer</option>
                                                                            <option value="SEO Executive"
                                                                                @selected($data->designation == 'SEO Executive')>
                                                                                SEO Executive</option>
                                                                            <option value="Social Media Manager"
                                                                                @selected($data->designation == 'Social Media Manager')>
                                                                                Social Media Manager</option>
                                                                            <option
                                                                                value="Digital Marketing Strategist"
                                                                                @selected($data->designation == 'Digital Marketing Strategist')>
                                                                                Digital Marketing Strategist</option>
                                                                            <option value="Jr. Accountant"
                                                                                @selected($data->designation == 'Jr. Accountant')>
                                                                                Jr. Accountant</option>
                                                                            <option value="Accountant"
                                                                                @selected($data->designation == 'Accountant')>
                                                                                Accountant</option>
                                                                            <option value="Sr. Accountant"
                                                                                @selected($data->designation == 'Sr. Accountant')>
                                                                                Sr. Accountant</option>
                                                                            <option value="Cloud Engineer - Intern"
                                                                                @selected($data->designation == 'Cloud Engineer - Intern')>
                                                                                Cloud Engineer - Intern</option>
                                                                            <option value="Jr. Cloud Engineer"
                                                                                @selected($data->designation == 'Jr. Cloud Engineer')>
                                                                                Jr. Cloud Engineer</option>
                                                                            <option value="Cloud Engineer"
                                                                                @selected($data->designation == 'Cloud Engineer')>
                                                                                Cloud Engineer</option>
                                                                            <option value="UI/UX Designer - Intern"
                                                                                @selected($data->designation == 'UI/UX Designer - Intern')>
                                                                                UI/UX Designer - Intern</option>
                                                                            <option value="Graphic Designer - Intern"
                                                                                @selected($data->designation == 'Graphic Designer - Intern')>
                                                                                Graphic Designer - Intern</option>
                                                                            <option value="Jr. UI/UX Designer"
                                                                                @selected($data->designation == 'Jr. UI/UX Designer')>
                                                                                Jr. UI/UX Designer</option>
                                                                            <option value="Jr. Graphic Designer"
                                                                                @selected($data->designation == 'Jr. Graphic Designer')>
                                                                                Jr. Graphic Designer</option>
                                                                            <option value="Graphic Designer"
                                                                                @selected($data->designation == 'Graphic Designer')>
                                                                                Graphic Designer</option>
                                                                            <option value="UI/UX Designer"
                                                                                @selected($data->designation == 'UI/UX Designer')>
                                                                                UI/UX Designer</option>
                                                                            <option
                                                                                value="Graphic Designer & UI/UX Designer"
                                                                                @selected($data->designation == 'Graphic Designer & UI/UX Designer')>
                                                                                Graphic Designer & UI/UX Designer
                                                                            </option>
                                                                            <option value="Sr. UI/UX Designer"
                                                                                @selected($data->designation == 'Sr. UI/UX Designer')>
                                                                                Sr. UI/UX Designer</option>
                                                                            <option value="Sr. Graphic Designer"
                                                                                @selected($data->designation == 'Sr. Graphic Designer')>
                                                                                Sr. Graphic Designer</option>
                                                                            <option
                                                                                value="UI/UX Designer & Graphic Team Leader"
                                                                                @selected($data->designation == 'UI/UX Designer & Graphic Team Leader')>
                                                                                UI/UX Designer & Graphic Team Leader
                                                                            </option>
                                                                            <option value="WordPress - Intern"
                                                                                @selected($data->designation == 'WordPress - Intern')>
                                                                                WordPress - Intern</option>
                                                                            <option value="Jr. WordPress Developer"
                                                                                @selected($data->designation == 'Jr. WordPress Developer')>
                                                                                Jr. WordPress Developer</option>
                                                                            <option value="WordPress Developer"
                                                                                @selected($data->designation == 'WordPress Developer')>
                                                                                WordPress Developer</option>
                                                                            <option value="Sr. WordPress Developer"
                                                                                @selected($data->designation == 'Sr. WordPress Developer')>
                                                                                Sr. WordPress Developer</option>
                                                                            <option value="WordPress Team Leader"
                                                                                @selected($data->designation == 'WordPress Team Leader')>
                                                                                WordPress Team Leader</option>
                                                                        </select>

                                                                        {{-- <input type="text" id="designation"
name="designation" class="form-control"> --}}
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                            {{-- Experience --}}
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="required"
                                                                        for="emp_experience">Experience</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="emp_experience"
                                                                            name="emp_experience" class="form-control"
                                                                            value="{{ $data->emp_experience }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- Select Role --}}
                                                            <div class="col-md-4">
                                                                <label class="required" for="role"
                                                                    class="">Select
                                                                    Role</label>
                                                                <select class="form-select" id="role"
                                                                    name="role" aria-label="Default select example"
                                                                    value="{{ $data->role }}">
                                                                    <option value="">-Select Role-</option>
                                                                    <option value="1" <?php echo $data->role == '1' ? 'selected' : ''; ?>>Admin
                                                                    </option>
                                                                    <option value="2" <?php echo $data->role == '2' ? 'selected' : ''; ?>>Hr
                                                                    </option>
                                                                    <option value="3" <?php echo $data->role == '3' ? 'selected' : ''; ?>>
                                                                        Employee</option>
                                                                </select>
                                                            </div>
                                                            {{-- Join Date --}}
                                                            <div class="col-md-4">
                                                                <label class="required" for="join_date">Join
                                                                    Date</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" name="join_date"
                                                                        id="join_date" class="form-control"
                                                                        placeholder="dd-mm-yyyy"
                                                                        value="{{ $data->join_date }}">
                                                                </div>
                                                            </div>
                                                            {{-- download slary slip --}}
                                                            <div class="col-md-2">
                                                                <label class="required"
                                                                    for="download_salary_slip">Download
                                                                    Salary Slip</label>
                                                                <div class="col-md-12">
                                                                    <input type="checkbox" name="download_ss"
                                                                        class="js-switch-download mt-5"
                                                                        <?php echo $data->download_ss == 1 ? 'checked' : ''; ?>>
                                                                    <input type="hidden" name="download_ss_hidden"
                                                                        value="<?php echo $data->download_ss; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="required"
                                                                    for="is_wfh_permanent">Permanent WFH</label>
                                                                <div class="col-md-12">
                                                                    <input type="checkbox"
                                                                        id="is_wfh_permanent_checkbox"
                                                                        class="js-switch-wfh-permanent mt-5"
                                                                        <?php echo $data->is_wfh_permanent == 1 ? 'checked' : ''; ?>>
                                                                    <input type="hidden" id="is_wfh_permanent_hidden"
                                                                        name="is_wfh_permanent"
                                                                        value="<?php echo $data->is_wfh_permanent; ?>">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="mt-3 d-flex justify-content-end">
                                                            <button type="submit" id="submitBtn"
                                                                class="btn btn-primary">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    {{-- End Start Design --}}
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <x-footer-con />

                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <x-footer />
    {{--  can't type the alphabet  in contact number --}}
    <script>
        $(document).ready(function() {
            $('#phone').on('keypress', function(event) {
                var charCode = (event.which) ? event.which : event.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return false;
                }
                return true;
            });
        });
    </script>
    <script>
        $("#dob").flatpickr({
            dateFormat: "d-m-Y",
            maxDate: "today",
        });

        $("#join_date").flatpickr({
            dateFormat: "d-m-Y",
            maxDate: "today",
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            //  Team Leader
            var elemTeamLeader = document.querySelector('.js-switch-team-leader');
            var switcheryTeamLeader = new Switchery(elemTeamLeader, {
                color: '#2bf503',
                secondaryColor: '#f51303',
                disabled: false
            });
            $('#work-report-team-container').toggle(elemTeamLeader.checked);
            elemTeamLeader.addEventListener('change', function() {
                var hiddenInputTeamLeader = document.querySelector('[name="team_lead_hidden"]');
                hiddenInputTeamLeader.value = elemTeamLeader.checked ? 1 : 0;
                // Show or hide
                $('#work-report-team-container').toggle(elemTeamLeader.checked);
            });

            //  Download Salary Slip
            var elemDownloadSS = document.querySelector('.js-switch-download');
            var switcheryDownloadSS = new Switchery(elemDownloadSS, {
                color: '#2bf503',
                secondaryColor: '#f51303',
                disabled: false
            });
            elemDownloadSS.addEventListener('change', function() {
                var hiddenInputDownloadSS = document.querySelector('[name="download_ss_hidden"]');
                hiddenInputDownloadSS.value = elemDownloadSS.checked ? 1 : 0;
            });

            //  is wfh permanent
            var elemDownloadSS = document.querySelector('.js-switch-wfh-permanent');
            var switcheryDownloadSS = new Switchery(elemDownloadSS, {
                color: '#2bf503',
                secondaryColor: '#f51303',
                disabled: false
            });
            elemDownloadSS.addEventListener('change', function() {
                var hiddenInputDownloadSS = document.querySelector('[name="is_wfh_permanent"]');
                hiddenInputDownloadSS.value = elemDownloadSS.checked ? 1 : 0;
            });
        });

        // Daily Work Report Team Select 2
        $(document).ready(function() {
            // Initialize Select2
            $("#WorkReportTeam").select2({
                placeholder: "-Select Work Report Team-", // Optional: Custom placeholder
                allowClear: true // Optional: Enable clear button
            });

            // Show or hide the container based on the checkbox state
            var elemTeamLeader = document.querySelector('.js-switch-team-leader');
            $('#work-report-team-container').toggle(elemTeamLeader.checked);

            elemTeamLeader.addEventListener('change', function() {
                $('#work-report-team-container').toggle(elemTeamLeader.checked);
            });
        });
    </script>
    <script>
        function goBack() {
            history.go(-1);
        }


        $(document).ready(function() {
            $("#myForm").validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                rules: {
                    fname: {
                        required: true
                    },
                    mname: {
                        required: true
                    },
                    lname: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 15
                    },
                    nationality: {
                        required: true
                    },
                    pemail: {
                        required: true
                    },
                    designation: {
                        required: true
                    },
                    emp_experience: {
                        required: true
                    },
                    team: {
                        required: true
                    },
                    marital_status: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    bloodtype: {
                        required: true
                    },
                    role: {
                        required: true
                    },
                    dob: {
                        required: true
                    },
                    join_date: {
                        required: true
                    },
                },
                errorPlacement: function(error, element) {
                    // error.insertAfter(element);
                },
                highlight: function(element, errorClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element, errorClass) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    $("#submitBtn").prop('disabled', true);
                    form.submit();
                }
            });
        });
    </script>


    <script>
        document.getElementById('togglePassword1').addEventListener('click', function(e) {
            const password = document.getElementById('password');
            if (password.type === 'password') {
                password.type = 'text';
                e.target.classList.remove('fa-eye');
                e.target.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                e.target.classList.remove('fa-eye-slash');
                e.target.classList.add('fa-eye');
            }
        });

        document.getElementById('togglePassword2').addEventListener('click', function(e) {
            const confirmPassword = document.getElementById('confirm_password');
            if (confirmPassword.type === 'password') {
                confirmPassword.type = 'text';
                e.target.classList.remove('fa-eye');
                e.target.classList.add('fa-eye-slash');
            } else {
                confirmPassword.type = 'password';
                e.target.classList.remove('fa-eye-slash');
                e.target.classList.add('fa-eye');
            }
        });
    </script>
</body>

</html>
