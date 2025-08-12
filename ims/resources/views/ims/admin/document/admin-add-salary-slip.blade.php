<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Add Salary Slip" />
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
                                                                aria-hidden="true"></i>Back</button></div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <form id="myForm" action="{{ url('/submit-salary-slip-details') }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="name">Full Name:</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="name" name="name"
                                                                        class="form-control" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="emp_id">EMP Id:</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="emp_id" name="emp_id"
                                                                        class="form-control" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="date">Date :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="date" name="date"
                                                                        class="form-control" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="department">Team :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="department"
                                                                        name="department" class="form-control" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="designation">Designation :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="designation"
                                                                        name="designation" class="form-control"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="join_date">Join Date :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="join_date"
                                                                        name="join_date" class="form-control" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="bank_name">Bank Name :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="bank_name"
                                                                        name="bank_name" class="form-control" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="ifsc">IFSC Code :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="ifsc" name="ifsc"
                                                                        class="form-control" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="account_no">Account No :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="account_no"
                                                                        name="account_no" class="form-control" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="pan">Pan No :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="pan"
                                                                        name="pan" class="form-control" required>
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
                                                                        class="form-control" required>
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
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="basic">Basic :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="basic"
                                                                        name="basic" class="form-control" required>
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
                                                                        class="form-control" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="bonus">Bonus :</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="bonus"
                                                                        name="bonus" class="form-control" required>
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
                                                                        class="form-control" required>
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
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="e_id" id="e_id">
                                                    <div class="mt-3 d-flex justify-content-end">
                                                        <button type="submit" id="submitBtn"
                                                            class="btn btn-primary">Add</button>
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
        function goBack() {
            window.history.back();
        }

        $(document).ready(function() {
            $('#name').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ url('autocomplete-employee') }}",
                        method: 'GET',
                        dataType: 'json',
                        data: {
                            term: request.term
                        },
                        success: function(data) {
                            if (data.length === 0) {
                                // If no data is found, push a "no results" message
                                response([{
                                    label: "Data not found",
                                    value: ""
                                }]);
                            } else {
                                response(data);
                            }
                        }
                    });
                },
                minLength: 2
            }).data('ui-autocomplete')._renderItem = function(ul, item) {
                var listItem = $('<a>').addClass('dropdown-item f-black')
                    .append(item.label);
                return $('<li>').append(listItem).appendTo(ul);
            };

            $('#name').on('autocompleteselect', function(event, ui) {
                if (ui.item.value !== "") {
                    $('#e_id').val(ui.item.details.e_id);
                    $('#emp_id').val(ui.item.details.emp_id);
                    $('#join_date').val(ui.item.details.join_date);
                    $('#designation').val(ui.item.details.designation);
                    $('#department').val(ui.item.details.department);
                    $('#bank_name').val(ui.item.details.bank_name);
                    $('#account_no').val(ui.item.details.account_no);
                    $('#ifsc').val(ui.item.details.ifsc);
                    $('#pan').val(ui.item.details.pan);
                }
            });

            $('#name').autocomplete().data('ui-autocomplete')._renderMenu = function(ul, items) {
                var that = this;
                $.each(items, function(index, item) {
                    that._renderItemData(ul, item);
                });
                $(ul).addClass('dropdown-menu');
            };

            $('#date').change(function() {
                var selectedDate = $(this).val();
                var id = $('input[name="id"]').val();
                if (selectedDate) {
                    $.ajax({
                        url: "{{ url('getSalaryDetails') }}",
                        type: 'POST',
                        data: {
                            id: $('#e_id').val(),
                            date: selectedDate,
                            _token: csrf()
                        },
                        success: function(response) {
                            console.log(response);

                        }
                    })
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#date').datepicker({
                format: "yyyy-mm",
                startView: "months",
                minViewMode: "months",
                autoclose: true
            });
            $('#join_date').datepicker({
                format: "yyyy-mm-dd",
                autoclose: true
            });
        });
    </script>
    <script>
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
