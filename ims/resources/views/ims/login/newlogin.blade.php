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

<body>
    {{-- <section>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p class="main-heading h1">Welcome</p>
            </div>
            <div class="col-md-6"></div>
        </div>
    </div>
</section> --}}

    <section id="login-section">
        <img class="circle-1" src="{{ asset('assets/images/login-svg-1.svg') }}" alt="">
        <img class="circle-2" src="{{ asset('assets/images/login-svg-2.svg') }}" alt="">
        <img class="newlogin-logo" src="{{ asset('assets/images/logo/logo.png') }}" alt="">

        <div class="container-fluid">
            <div class="row ">
                <div class="col-md-6 welcome-card">
                    <p class="main-heading">Welcome</p>
                    <h1 class="mt-5">To Employee Portal</h1>
                </div>
                <div class="col-md-6 offset-md-6 login-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="text-center f-logo f-700 f-50 mb-5">Login</p>
                            <form method="POST" action="#" id="myForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label f-logo2 f-18 f-600">Email</label>
                                    <div class="input-group">
                                        <i class="fa fa-envelope input-group-text login-icon f-22"></i>
                                        <input type="email" name="email" class="form-control"
                                            id="exampleInputEmail1" aria-describedby="emailHelp"
                                            placeholder="Enter your email">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="exampleInputPassword1" class="form-label f-18 f-600">Password</label>
                                    <div class="input-group">
                                        <i class="fa fa-lock input-group-text login-icon f-26"></i>
                                        <input type="password" name="password" class="form-control lock-input"
                                            id="password" placeholder="Enter your new password">
                                        <i class="fa fa-eye toggle-password input-group-text" id="togglePassword1"></i>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-lg btn-primary login-btn"
                                        id="submitBtn">Login</button>
                                </div>
                                <div class="login-button text-center">
                                    <a class="text-decoration-none  " href="#">Forgot
                                        password?</a>

                                </div>
                                <input type="hidden" name="url" value="{{ $url }}">
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <img class="circle-3" src="{{ asset('assets/images/login-svg-3.svg') }}" alt="">
    </section>
    <x-footer />

</body>

</html>
