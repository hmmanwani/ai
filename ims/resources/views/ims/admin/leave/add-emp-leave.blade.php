<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Add Employee Leave" />
    <style>
        .select-employee .select2-selection {
            height: 48px !important;
            /* overflow: auto !important; */
        }
    </style>
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
                    <section id="">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h2 class= "">Add Employee Leave</h2>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end"><button
                                                        onclick="goBack()" class="btn btn-primary"><i
                                                            class="fa fa-arrow-left me-2"
                                                            aria-hidden="true"></i>Back</button>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form id="addLeave" name="addLeave"
                                                        action="{{ url('/submit-add-emp-leave') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            {{-- start form --}}
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="col-md-4 control-label required">Leave
                                                                        For</label>
                                                                    <div class="col-md-12">
                                                                        <select data-plugin-selectTwo name="leave_for"
                                                                            id="leave_for" class="form-select">
                                                                            <option value="">Leave For</option>
                                                                            <option value="first-half">First Half
                                                                            </option>
                                                                            <option value="second-half">Second Half
                                                                            </option>
                                                                            <option value="full-day">Full Day</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label required">Leave
                                                                        Type</label>
                                                                    <div class="col-md-12">
                                                                        <select data-plugin-selectTwo name="leave_type"
                                                                            id="leave_type" name="leave_type"
                                                                            class="form-select">

                                                                            <option value="">Select Leave Type
                                                                            </option>
                                                                            @foreach ($leavetypes as $leavetype)
                                                                                <option value="{{ $leavetype->lt_id }}">
                                                                                    {{ $leavetype->leave_type }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 select-employee">
                                                                <div class="form-group">
                                                                    <?php $groupedEmployees = $emp->groupBy('team'); ?>
                                                                    <div class="d-flex justify-content-between">
                                                                        <label class="required control-label"
                                                                            for="emp">Leave By</label>
                                                                        <div>
                                                                            <label class="control-label"
                                                                                for="all">All</label>
                                                                            <input type="checkbox" id="selectAllEmp" />
                                                                        </div>
                                                                    </div>
                                                                    <select name="leaveby[]" id="leaveby"
                                                                        class="form-select select3" multiple>
                                                                        @foreach ($groupedEmployees as $team => $employees)
                                                                            <optgroup label="{{ $team }}">
                                                                                @foreach ($employees as $emps)
                                                                                    <option value="{{ $emps->e_id }}">
                                                                                        {{ $emps->name }}</option>
                                                                                @endforeach
                                                                            </optgroup>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label class=" control-label required">Leave
                                                                        Reason</label>
                                                                    <textarea class="form-control  h-100" name="leave_reason" rows="3"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group" id="leave_date_box">
                                                                    <label class=" control-label required">Leave
                                                                        Date</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="leave_date"
                                                                            name="leave_date" class="form-control"
                                                                            title="Leave Date" placeholder="d-m-Y">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label class=" control-label">Document</label>
                                                                    <div class="col-md-12">
                                                                        <input type="file" id="document"
                                                                            name="document" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="align-self-center text-end">
                                                            <button type="submit" class="btn btn-primary">Add
                                                                Leave</button>
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

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('#leaveby').select2({
                placeholder: "Select Employee"
            });

            function updateOverflow() {
                const selection = $('#leaveby').val();
                const $selectionBox = $('.select-employee .select2-selection');

                if (selection && selection.length > 0) {
                    $selectionBox.css({
                        'overflow': 'auto',
                        'height': 'auto',
                        'max-height': '100px' // adjust as needed
                    });
                } else {
                    $selectionBox.css({
                        'overflow': 'hidden',
                        'height': '48px'
                    });
                }
            }

            // Call on load (if editing form)
            updateOverflow();

            // Call on change
            $('#leaveby').on('change', function() {
                updateOverflow();
            });

            // Select All Checkbox Logic
            $('#selectAllEmp').change(function() {
                if (this.checked) {
                    // Select all options
                    let allVals = $('#leaveby option').map(function() {
                        return $(this).val();
                    }).get();
                    $('#leaveby').val(allVals).trigger('change');
                } else {
                    // Deselect all options
                    $('#leaveby').val(null).trigger('change');
                }
            });
        });
    </script>
    <script>
        $("#leave_date").flatpickr({
            mode: "range",
            dateFormat: "d-m-Y",
            // minDate: "today",
            disable: [
                    function(date) {
                        // Disable  Saturday (6), Sunday (0)
                        var day = date.getDay();
                        return day === 0 ||  day === 6;
                    }
                ],
        });
    </script>
    <script>
        function goBack() {
            history.go(-1);
        }

        $("#addLeave").validate({
            errorElement: 'div',
            errorClass: 'invalid-feedback',
            rules: {
                leave_type: {
                    required: true
                },
                leave_for: {
                    required: true
                },
                leave_responsible_person: {
                    required: true
                },
                leave_reason: {
                    required: true
                },
                leave_date: {
                    required: true
                },
            },
            messages: {

            },
            errorPlacement: function(error, element) {
                //  error.insertAfter(element);
            },
            highlight: function(element, errorClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function(element, errorClass) {
                $(element).addClass('is-valid').removeClass('is-invalid');
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
</body>

</html>
