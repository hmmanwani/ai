<html lang="en">

<head>
    <x-head title="IMS | Change Password" />
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
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 d-flex  justify-content-center">
                                    <div class="card mt-2 w-50">
                                        <div class="card-header">
                                            <h2>Change Password</h2>
                                        </div>
                                        <div class="card-body">
                                            <form method="POST" action="{{ URL('/submit-change-password') }}"
                                                id="myForm">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="password" class="form-label f-600 required">New
                                                        Password</label>
                                                    <div class="input-group">
                                                        <input type="password" name="password" class="form-control"
                                                            id="password" placeholder="Enter your new password">
                                                        <i class="fa fa-eye toggle-password input-group-text"
                                                            id="togglePassword1"></i>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="confirm_password"
                                                        class="form-label f-600 required">Confirm
                                                        Password</label>
                                                    <div class="input-group">
                                                        <input type="password" name="confirm_password"
                                                            class="form-control" id="confirm_password"
                                                            placeholder="Please confirm password">
                                                        <i class="fa fa-eye toggle-password input-group-text"
                                                            id="togglePassword2"></i>
                                                    </div>
                                                </div>
                                                <button type="submit" id="submitBtn"
                                                    class="btn btn-primary">Change</button>
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
            $("#myForm").validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                rules: {
                    password: {
                        required: true,
                        // minlength: 8
                    },
                    confirm_password: {
                        required: true,
                        equalTo: "[name='password']"
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
