<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | LogIn" />
</head>
<style>
    #login .card {
        background-color: #ededed;
    }

    .mob-section {
        font-family: Arial, sans-serif;
        text-align: center;
        padding: 50px;
        background-color: #ffffff !important;
    }

    .mob-section h1 {
        font-size: 24px;
    }

    .mob-section p {
        font-size: 18px;
    }
</style>

<body id="login-body">
    <section id="login" class="desk-section">
        <div class="login-logo d-flex align-content-center">
            <img class="login-img" src="{{ asset('assets/images/logo/logo.png') }}" alt="">
        </div>
        <div class="container form-container">
            <div class="row form-row align-content-center">
                <div class="col-md-8 ">
                    <div class="main-logo  d-flex justify-content-center">
                        <h1 class="f-base  f-800">Login</h1>
                    </div>
                    <div class="card mt-5">
                        <div class="card-body">
                            <form method="POST" action="{{ URL('/auth') }}" id="myForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label f-600">Email address</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                        aria-describedby="emailHelp" placeholder="Enter your email">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label f-600">Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control" id="password"
                                            placeholder="Enter your new password">
                                        <i class="fa fa-eye toggle-password input-group-text" id="togglePassword1"></i>
                                    </div>
                                </div>
                                <div class="login-button d-flex justify-content-between align-items-center">
                                    <a class="text-decoration-none  " href="{{ URL('forgot-password') }}">forgot
                                        password?</a>
                                    <button type="submit" class="btn btn-primary " id="submitBtn">Login</button>
                                </div>
                                <input type="hidden" name="url" value="{{ $url }}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="mob-section">
        <h1>Access Restricted</h1>
        <p>This website is not accessible on mobile devices. Please use a desktop browser to access the site.</p>
    </div>
    <x-footer />

    <script>
        function detectMobile() {
            const isMobile = window.innerWidth <= 800 && window.innerHeight <= 600;
            if (isMobile) {
                window.location.href = '/no-mobile';
            }
        }

        window.onload = function() {
            fetch('/check-mobile')
                .then(response => response.json())
                .then(data => {
                    if (data.isMobile) {
                        detectMobile();
                    }
                });
        };
    </script>
    <script>
        $(document).ready(function() {
            $("#myForm").validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                rules: {
                    password: {
                        required: true,
                        minlength: 8
                    },
                    email: {
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
