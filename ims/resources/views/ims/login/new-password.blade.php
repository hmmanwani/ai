<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | New Password" />
</head>
<style>
    #login .card {
        background-color: #ededed;
    }
</style>

<body id="login-body">
    <section id="login">
        <div class="login-logo d-flex align-content-center">
            <img class="login-img" src="{{ asset('assets/images/logo/logo.png') }}" alt="">
        </div>

        <div class="container form-container">
            <div class="row form-row align-content-center">
                <div class="col-md-8 ">
                    <div class="main-logo  d-flex justify-content-center">
                        <h1 class="f-base  f-800">New Password</h1>
                    </div>
                    <div class="card mt-5">
                        <div class="card-body">
                            <form method="POST" action="{{ URL('/submit-new-password') }}" id="myForm">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="mb-3">
                                    <label for="password" class="form-label f-600">New Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control" id="password"
                                            placeholder="Enter your new password">
                                        <i class="fa fa-eye toggle-password input-group-text" id="togglePassword1"></i>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label f-600">Confirm
                                        Password</label>
                                    <div class="input-group">
                                        <input type="password" name="confirm_password" class="form-control"
                                            id="confirm_password" placeholder="Please confirm password">
                                        <i class="fa fa-eye toggle-password input-group-text" id="togglePassword2"></i>
                                    </div>
                                </div>
                                <button type="submit" id="submitBtn" class="btn btn-primary ">Change</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
