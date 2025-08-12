<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Holiday" />
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
                    <section id="admin">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-3">
                                    <x-admin-sidebar />
                                </div>
                                <div class="col-md-9">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h1 class= "">Holiday</h1>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <a href="javascript:voild(0)" id="Holiday"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-plus f-24 f-white" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-body ">
                                                            <table id="holiday"
                                                                class="table table-bordered table-striped f-black">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No.</th>
                                                                        <th>Holiday</th>
                                                                        <th>Date</th>
                                                                        <th>Weekday</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    {{-- @foreach ($data as $holiday)
                                                                        <tr>
                                                                            <td>{{ $holiday->holiday }}</td>
                                                                            <td>{{ $holiday->date }}</td>
                                                                            <td>
                                                                                {{ $holiday->weekday }}</td>
                                                                            <td>
                                                                                <a
                                                                                    href="{{ URL('delete-holiday') }}/{{ $holiday->h_id }}"><i
                                                                                        class="fa fa-trash"
                                                                                        aria-hidden="true"></i></a>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach --}}
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
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

    {{-- add modal code  --}}
    <div class="modal" tabindex="-1" id="HoliDayModal" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title f-800">Add Holiday</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/submit-holiday') }}" method="POST" id="myForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="holiday" class="required">Holiday</label>
                                            <div class="col-md-12">
                                                <input type="text" id="holiday" name="holiday"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="date" class="required">Date</label>
                                            <div class="col-md-12">
                                                <input type="date" id="date" name="date"
                                                    class="form-control">
                                                <div class="invalid-feedback" id="date-error"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="weekday">Weekday :</label>
                                            <div class="col-md-12">
                                                <input type="text" name="weekday" id="weekday"
                                                    class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-end">
                                <button type="submit" id="submitBtn" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-footer />

    <script>
        $('#Holiday').click(function() {
            $('#HoliDayModal').modal('show');
        })

        flatpickr("#date", {
            enableTime: false,
            dateFormat: "d-m-Y",
            minDate: "today",
            autoclose: true,
            todayHighlight: true,
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length > 0) {
                    var date = selectedDates[0];
                    var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                    var dayName = days[date.getDay()];
                    document.getElementById("weekday").value = dayName;
                }
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            assignData();
        });

        function assignData() {
            $('#holiday').DataTable().destroy();
            let filter = {};
            ajaxDataTableInit(baseUrl() + '/get-holiday', 'holiday', 0, 0, filter);
        }
    </script>
    <script>
        $(document).ready(function() {
            $.validator.addMethod("valueNotEquals", function(value, element, arg) {
                return arg !== value;
            }, "Value must not equal arg.");
            $("#myForm").validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',

                rules: {
                    holiday: {
                        required: true
                    },
                    date: {
                        required: true
                    },
                    weekday: {
                        valueNotEquals: "default"
                    },
                },
                errorPlacement: function(error, element) {},
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
