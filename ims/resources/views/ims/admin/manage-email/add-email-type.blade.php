<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Add Email type" />
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
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form action="{{ URl('submit-email-type') }}" method="POST">
                                                        @csrf
                                                        <div class="row">
                                                            {{-- type  --}}
                                                            <div class="col-md-12 mt-2">
                                                                <div class="form-group">
                                                                    <label class="required" for="type">Type</label>
                                                                    <input type="text" id="type" name="type"
                                                                        class="form-control" required>
                                                                    <div class="invalid-feedback" id="type-error">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- To  --}}
                                                            <div class="col-md-12">
                                                                <div class="justify-content-end d-flex p-0">
                                                                    <a class="btn btn-primary add-email-input d-none"
                                                                        href="#" id="add-to-input">
                                                                        <i class="fa fa-plus f-18 f-white"
                                                                            aria-hidden="true"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="row email-to-inputs">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label class="required" for="email_to">Email
                                                                                To</label>
                                                                            <input type="email" name="email_to[]"
                                                                                id="email_to" class="form-control"
                                                                                required>
                                                                            <div class="invalid-feedback"
                                                                                id="type-error"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- cc  --}}
                                                            <div class="col-md-12">
                                                                <div class="justify-content-end d-flex p-0">
                                                                    <a class="btn btn-primary add-email-input d-none"
                                                                        href="#" id="add-cc-input">
                                                                        <i class="fa fa-plus f-18 f-white"
                                                                            aria-hidden="true"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="row email-cc-inputs">
                                                                    <div class="col-md-4 email-cc-field">
                                                                        <div class="form-group">
                                                                            <label class="required" for="email_cc">Email
                                                                                CC</label>
                                                                            <input type="email" name="email_cc[]"
                                                                                id="email_cc" class="form-control"
                                                                                required>
                                                                            <div class="invalid-feedback"
                                                                                id="type-error"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class=" d-flex justify-content-end ">
                                                                <button type="submit" id="submitBtn" id="submitBtn"
                                                                    class="btn btn-primary">Submit</button>
                                                            </div>
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

    {{-- email to --}}
    <script>
        $(document).ready(function() {
            $('#email_to').on('input', function() {
                var email = $(this).val();
                var isValidEmail = email.length > 0 && this
                    .checkValidity();

                if (isValidEmail) {
                    $('#add-to-input').removeClass('d-none');
                } else {
                    $('#add-to-input').addClass('d-none');
                }
            });
        });

        // email to
        $(document).ready(function() {
            $('#add-to-input').click(function(e) {
                e.preventDefault();

                var newEmailInput = `
            <div class="col-md-4 email-to-field" style="display:none;">
                <div class="form-group">
                    <label class="required" for="email_to">Email To</label>
                    <div class="d-flex align-items-center">
                        <input type="email" name="email_to[]" id="email_to" class="form-control" required>
                         <a href="#" class="btn f-red btn-sm ml-2 remove-email-to-input">
                            <i class="fa fa-trash"></i>
                        </a>
                        <div class="invalid-feedback" id="type-error"></div>
                    </div>
                </div>
            </div>
        `;
                var firstInput = $('.email-to-inputs .col-md-4').first();
                var newElement = $(newEmailInput).insertAfter(firstInput);
                newElement.hide().fadeIn(500);
            });

            $(document).on('click', '.remove-email-to-input', function(e) {
                e.preventDefault();
                $(this).closest('.email-to-field').fadeOut(500, function() {
                    $(this).remove();
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Show add CC button if email is valid
            $('#email_cc').on('input', function() {
                var email = $(this).val();
                var isValidEmail = email.length > 0 && this.checkValidity();

                if (isValidEmail) {
                    $('#add-cc-input').removeClass('d-none');
                } else {
                    $('#add-cc-input').addClass('d-none');
                }
            });

            $('#add-cc-input').click(function(e) {
                e.preventDefault();

                var newEmailInput = `
            <div class="col-md-4 email-cc-field" style="display:none;">
                <div class="form-group">
                    <label class="required" for="email_cc">Email CC</label>
                    <div class="d-flex align-items-center">
                        <input type="email" name="email_cc[]" class="form-control" required>
                        <a href="#" class="btn f-red btn-sm ml-2 remove-email-cc-input">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                    <div class="invalid-feedback" id="type-error"></div>
                </div>
            </div>
        `;

                var firstInput = $('.email-cc-inputs .col-md-4').first();
                var newElement = $(newEmailInput).insertAfter(firstInput);
                newElement.hide().fadeIn(500);
            });

            $(document).on('click', '.remove-email-cc-input', function(e) {
                e.preventDefault();
                $(this).closest('.email-cc-field').fadeOut(500, function() {
                    $(this).remove();
                });
            });
        });
    </script>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    {{-- <script>
        function goBack() {
            window.history.back();
        }

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
    </script> --}}
</body>

</html>
