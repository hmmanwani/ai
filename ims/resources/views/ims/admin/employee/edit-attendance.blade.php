<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Edit Attendance" />
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
                    <section id="edit-personaldeatil">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end  mb-3 ">
                                        <button onclick="goBack()" class="btn btn-primary"><i
                                                class="fa fa-arrow-left me-2" aria-hidden="true"></i>Back</button>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="{{ url('/update-employee-time') }}" method="POST"
                                                id="myForm">
                                                @csrf
                                                <div class="row">
                                                    <input type="hidden" name="id" value="{{ $id }}">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="date" class="required">select
                                                                date</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="date" name="date"
                                                                    class="form-control" placeholder="dd-mm-yyyy">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="text" class="required">Login Time</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="login_time" name="login_time"
                                                                    class="form-control" placeholder="00:00:00 ">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="text" class="required">Logout Time</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="logout_time"
                                                                    name="logout_time" class="form-control"
                                                                    placeholder="00:00:00 ">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="col-sm-3 control-label required">Reason
                                                                :</label>
                                                            <textarea class="form-control  h-100" name="reason" id="reason" rows="3"></textarea>
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
        flatpickr('#date', {
            dateFormat: 'd-m-Y',
            // defaultDate: 'today',
            maxDate: 'today',
            position: 'below',
            appendTo: document.body
        });

        $(document).ready(function() {
            flatpickr("#login_time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i:S",
                // time_24hr: true,
                enableSeconds: true,
                minuteIncrement: 1,
                secondIncrement: 1,
            });
        });
        $(document).ready(function() {
            flatpickr("#logout_time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i:S",
                // time_24hr: true,
                enableSeconds: true,
                minuteIncrement: 1,
                secondIncrement: 1
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#date').change(function() {
                var selectedDate = $(this).val();
                var id = $('input[name="id"]').val();
                if (selectedDate) {
                    $.ajax({
                        url: "{{ url('autocomplete-time') }}",
                        type: 'POST',
                        data: {
                            id: id,
                            date: selectedDate
                        },
                        success: function(response) {
                            if (response && response.login_time && response.logout_time &&
                                response.reason) {
                                $('#login_time').val(response.login_time);
                                $('#logout_time').val(response.logout_time);
                                $('#reason').val(response.reason);

                            } else {
                                $('#login_time').val('');
                                $('#logout_time').val('');
                                $('#reason').val('');
                            }

                            flatpickr("#login_time", {
                                enableTime: true,
                                noCalendar: true,
                                dateFormat: "H:i:S",
                                // time_24hr: true,
                                enableSeconds: true,
                                minuteIncrement: 1,
                                secondIncrement: 1,
                                defaultDate: response ? response.login_time : null
                            });

                            flatpickr("#logout_time", {
                                enableTime: true,
                                noCalendar: true,
                                dateFormat: "H:i:S",
                                // time_24hr: true,
                                enableSeconds: true,
                                minuteIncrement: 1,
                                secondIncrement: 1,
                                defaultDate: response ? response.logout_time : null
                            });
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                            $('#login_time').val('');
                            $('#logout_time').val('');
                        }
                    });
                }
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
                    date: {
                        required: true
                    },
                    login_time: {
                        required: true
                    },
                    reason: {
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
