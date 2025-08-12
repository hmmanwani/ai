<!DOCTYPE html>
<html lang="en">

<head>
    <x-head />
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
                                            <form action="{{ url('/update-contact-details') }}" method="POST"
                                                id="myForm">
                                                @csrf
                                                <div class="row">
                                                    <input type="hidden" name="id" value="{{ $data->e_id }}">


                                                    {{-- email --}}
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="email">Email</label>
                                                            <div class="col-md-12">
                                                                <input type="email" id="email" name="email"
                                                                    class="form-control" value="{{ $data->email }}"
                                                                    readonly>
                                                                <div class="invalid-feedback" id="email-error"></div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class=" d-flex justify-content-end ">
                                                        <button type="submit" id="submitBtn"
                                                            class="btn btn-primary">Update</button>
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
            $('#phone').on('input', function() {
                this.value = this.value.replace(/\D/g, '');
                const isValid = /^\d{10}$/.test(this.value);
                $('#phone-error').text(isValid ? '' :
                    'Please enter a valid 10-digit mobile number.');
            });
        });

        $(document).ready(function() {
            $('#pemail').on('input', function() {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                $('#pemail-error').text(emailPattern.test(this.value) ? '' :
                    'Please enter a valid email address.');
            });
        });
    </script>
    <script>
        function goBack() {
            window.history.back();
        }

        $(document).ready(function() {
            $("#myForm").validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                rules: {
                    phone: {
                        required: true
                    },
                    email: {
                        required: true
                    },
                    pemail: {
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
