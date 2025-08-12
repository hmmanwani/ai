<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Work From Home" />
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
                                                    <h2 class="card-title mb-0 f-24"> Apply For Work From Home</h2>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end"><button
                                                        onclick="goBack()" class="btn btn-primary"><i
                                                            class="fa fa-arrow-left me-2"
                                                            aria-hidden="true"></i>Back</button></div>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <form action="{{ url('submit-wfh') }}" method="POST" id="wfh">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label required">Apply
                                                                For</label>
                                                            <select data-plugin-selectTwo name="apply_for"
                                                                id="apply_for" class="form-select">
                                                                <option value="">Apply For
                                                                </option>
                                                                <option value="first-half">First Half</option>
                                                                <option value="second-half">Second Half</option>
                                                                <option value="full-day">Full Day</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="control-label required">Responsible
                                                                Person</label>
                                                            <!--<input type="text" id="leave_reason" name="leave_reason" class="form-control" title="Leave Description" placeholder="" />-->
                                                            <select data-plugin-selectTwo name="wfh_responsible_person"
                                                                id="wfh" class="form-select" required>
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
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class=" control-label required">WFH
                                                                Date</label>
                                                            <input type="text" id="wfh_date" name="wfh_date"
                                                                class="form-control" title="wfh Date"
                                                                placeholder="d-m-Y" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label required">WFH
                                                                Reason</label>
                                                            <textarea class="form-control h-100" name="apply_reason" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
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
            history.go(-1);
        }
   
        $(document).ready(function() {
            $("#wfh_date").flatpickr({
                mode: "multiple",
                dateFormat: "d-m-Y",
                minDate: "today",
                disable: [
                    date => [0, 1, 5, 6].includes(date.getDay()) // Disable Sun, Mon, Fri, Sat
                ],
            });
        });
    </script>
    <script>
        $("#wfh").validate({
            errorElement: 'div',
            errorClass: 'invalid-feedback',
            rules: {
                apply_for: {
                    required: true
                },
                wfh_responsible_person: {
                    required: true
                },
                apply_reason: {
                    required: true
                },
                wfh_date: {
                    required: true
                },
                start_date: {
                    required: true
                },
                end_date: {
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
</body>

</html>
