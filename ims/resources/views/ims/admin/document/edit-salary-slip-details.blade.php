<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Edit Salary Slip" />
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
                    <section id="add-salary-slip-details">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card f-black">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-md-6 align-self-center">
                                                        <h2 class="card-title mb-0 f-24">Add Salary Slip Details</h2>
                                                    </div>
                                                    <div class="col-md-6 d-flex justify-content-end"><button
                                                            onclick="goBack()" class="btn btn-primary"><i
                                                                class="fa fa-arrow-left me-2"
                                                                aria-hidden="true"></i>Back</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <form id="myForm"
                                                    action="{{ url('/submit-edit-salary-slip-details') }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="name">Full Name:</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="name" name="name"
                                                                        class="form-control" value="{{ $data->name }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="emp_id">EMP Id:</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="emp_id" name="emp_id"
                                                                        class="form-control" value="{{ $data->emp_id }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="date">Date :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="date" name="date"
                                                                        class="form-control"value="{{ $data->date }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="department">Team :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="department"
                                                                        name="department"
                                                                        class="form-control"value="{{ $data->department }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="designation">Designation :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="designation"
                                                                        name="designation" class="form-control"
                                                                        value="{{ $data->designation }}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="join_date">Join Date :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="join_date"
                                                                        name="join_date"
                                                                        class="form-control"value="{{ $data->join_date }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="bank_name">Bank Name :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="bank_name"
                                                                        name="bank_name"
                                                                        class="form-control"value="{{ $data->bank_name }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="ifsc">IFSC Code :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="ifsc" name="ifsc"
                                                                        class="form-control"value="{{ $data->ifsc }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="account_no">Account No :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="account_no"
                                                                        name="account_no"
                                                                        class="form-control"value="{{ $data->account_no }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="pan">Pan No :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="pan"
                                                                        name="pan"
                                                                        class="form-control"value="{{ $data->pan }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="actual_payable_days">Actual payable Days
                                                                    :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="actual_payable_days"
                                                                        name="actual_payable_days"
                                                                        class="form-control"value="{{ $data->actual_payable_days }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="total_working_days">Total Working Days
                                                                    :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="total_working_days"
                                                                        name="total_working_days" class="form-control"
                                                                        value="{{ $data->total_working_days }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="loss_of_pay_days">Loss of Pay Days
                                                                    :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="loss_of_pay_days"
                                                                        name="loss_of_pay_days" class="form-control"
                                                                        value="{{ $data->loss_of_pay_days }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="days_payable">Days Payable :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="days_payable"
                                                                        name="days_payable" class="form-control"
                                                                        value="{{ $data->days_payable }}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="basic">Basic :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="basic"
                                                                        name="basic"
                                                                        class="form-control"value="{{ $data->basic }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="city_comp_allowance">City Comp Allowance
                                                                    :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="city_comp_allowance"
                                                                        name="city_comp_allowance"
                                                                        class="form-control"value="{{ $data->city_comp_allowance }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="bonus">Bonus :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="bonus"
                                                                        name="bonus"
                                                                        class="form-control"value="{{ $data->bonus }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="total_earnings_a">Total Earnings (A)
                                                                    :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="total_earnings_a"
                                                                        name="total_earnings_a" class="form-control"
                                                                        value="{{ $data->total_earnings_a }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="professional_tax">Professional Tax
                                                                    :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="professional_tax"
                                                                        name="professional_tax" class="form-control"
                                                                        value="{{ $data->professional_tax }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="total_deductions_c">Total Deductions (C)
                                                                    :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="total_deductions_c"
                                                                        name="total_deductions_c" class="form-control"
                                                                        value="{{ $data->total_deductions_c }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="net_salary_payable_a_c">Net Salary Payable
                                                                    ( A
                                                                    - C )
                                                                    :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="net_salary_payable_a_c"
                                                                        name="net_salary_payable_a_c"
                                                                        class="form-control"value="{{ $data->net_salary_payable_a_c }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="net_alary_in_words">Net Salary in words
                                                                    :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="net_alary_in_words"
                                                                        name="net_alary_in_words" class="form-control"
                                                                        value="{{ $data->net_alary_in_words }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="id"
                                                        value="{{ $data->ss_id }}">
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
    <script>
        $(document).ready(function() {
            $('#date').datepicker({
                format: "mm-yyyy",
                startView: "months",
                minViewMode: "months",
                autoclose: true
            });
            $('#join_date').datepicker({
                format: "dd-mm-yyyy",
                autoclose: true
            });
        });
    </script>
    <script>
        function goBack() {
            window.history.back();
        }

        $(document).ready(function() {
            $("#myForm").validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                rules: {
                    name: {
                        required: true
                    },
                    emp_id: {
                        required: true
                    },
                    department: {
                        required: true
                    },
                    designation: {
                        required: true,
                    },
                    date: {
                        required: true,
                    },
                    join_date: {
                        required: true,
                    },
                    bank_name: {
                        required: true,
                    },
                    ifsc: {
                        required: true
                    },
                    account_no: {
                        required: true
                    },
                    pan: {
                        required: true
                    },
                    actual_payable_days: {
                        required: true
                    },
                    total_working_days: {
                        required: true
                    },
                    loss_of_pay_days: {
                        required: true
                    },
                    days_payable: {
                        required: true
                    },
                    basic: {
                        required: true
                    },
                    city_comp_allowance: {
                        required: true
                    },
                    bonus: {
                        required: true
                    },
                    total_earnings_a: {
                        required: true
                    },
                    professional_tax: {
                        required: true
                    },
                    total_deductions_c: {
                        required: true
                    },
                    net_salary_payable_a_c: {
                        required: true
                    },
                    net_alary_in_words: {
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
</body>

</html>
