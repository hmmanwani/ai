<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Add Leave" />
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
                    <section>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card f-black">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h2 class="card-title mb-0 f-24">Add Leave</h2>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end"><button
                                                        onclick="goBack()" class="btn btn-primary"><i
                                                            class="fa fa-arrow-left me-2"
                                                            aria-hidden="true"></i>Back</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form id="addLeave" name="addLeave" action="{{ url('/submit-leave') }}"
                                                method="POST" enctype="multipart/form-data">
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
                                                                    <option value="first-half">First Half</option>
                                                                    <option value="second-half">Second Half</option>
                                                                    <option value="full-day">Full Day</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label required">Leave
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
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="col-sm-10 control-label required">Responsible
                                                                Person in your Absence</label>
                                                            <div class="col-sm-12">
                                                                <select data-plugin-selectTwo
                                                                    name="leave_responsible_person"
                                                                    id="leave_responsible_person" class="form-select "
                                                                    required>
                                                                    <option value="">Select Employee</option>
                                                                    @foreach ($employees as $employee)
                                                                        <option value="{{ $employee->e_id }}">
                                                                            {{ $employee->fname }}
                                                                            {{ $employee->lname }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label required">Leave
                                                                Reason</label>
                                                            <textarea class="form-control  h-100" name="leave_reason" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group" id="leave_date_box">
                                                            <label class="col-sm-3 control-label required">Leave
                                                                Date</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="leave_date" name="leave_date"
                                                                    class="form-control" title="Leave Date"
                                                                    placeholder="d-m-Y">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label">Document</label>
                                                            <div class="col-md-12">
                                                                <input type="file" id="document" name="document"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 align-self-center text-end">
                                                        <button type="submit" class="btn btn-primary" id="submitBtn">Add
                                                            Leave</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    {{-- End Start Design --}}
                </div>
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
                $("#submitBtn").prop('disabled', true);
                form.submit();
            }
        });
    </script>
    <script>
        $("#leave_date").flatpickr({
            mode: "multiple",
            dateFormat: "d-m-Y",
            minDate: "today",
            disable: [
                    function(date) {
                        // Disable  Saturday (6), Sunday (0)
                        var day = date.getDay();
                        return day === 0 ||  day === 6;
                    }
                ],
        });
        
    </script>
</body>

</html>
