<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Forgot Password" />
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
                        <h1 class="f-base  f-800">Forgot Password</h1>
                    </div>
                    <div class="card mt-5">
                        <div class="card-body">
                            <form method="POST" action="{{ URL('/submit-forgot-password') }}" id="myForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label f-600">Email address</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        aria-describedby="emailHelp" placeholder="Enter your email">
                                </div>
                                <div class=" d-flex justify-content-between align-items-center">
                                    <a class="text-decoration-none login-button " href="{{ URL('/') }}">Login?</a>
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
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
                    form.submit();
                }
            });
        });
    </script>
</body>

</html>
