<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Add Eduction Qualification" />
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
                                            <form action="{{ URL('submit-education-qualification') }}" method="POST"
                                                id="myForm">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="required" for="qualification">Name of
                                                                Qualification</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="qualification"
                                                                    name="qualification" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="required" for="starting_year">Starting
                                                                Year</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="starting_year"
                                                                    name="starting_year" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="required" for="ending_year">Ending
                                                                Year</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="ending_year"
                                                                    name="ending_year" class="form-control" readonly>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="required" for="university_name">Name of
                                                                University</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="university_name"
                                                                    pattern="[A-Za-z]+" name="university_name"
                                                                    class="form-control">
                                                                <div class="invalid-feedback" id="email-error">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class=" d-flex justify-content-end ">
                                                        <button type="submit" id="submitBtn"
                                                            class="btn btn-primary">Add</button>
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
            $('#university_name').on('input', function() {
                $(this).val($(this).val().replace(/[^A-Za-z\s]/g, ''));
            });
        });
    </script>

    <script>
        function goBack() {
            window.history.back();
        }

        $(document).ready(function() {
            $("#starting_year, #ending_year").datepicker({
                format: "mm-yyyy",
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                viewMode: "months",
                minViewMode: "months",
                orientation: 'bottom',
                autoclose: true
            });

            $("#starting_year, #ending_year").on('keydown paste', function(e) {
                e.preventDefault();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#myForm").validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                rules: {
                    qualification: {
                        required: true
                    },
                    university_name: {
                        required: true,
                        lettersonlys: true,
                    },
                    starting_year: {
                        required: true
                    },
                    ending_year: {
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
