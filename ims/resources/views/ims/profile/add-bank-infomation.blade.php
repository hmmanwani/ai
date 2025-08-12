<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Add Bank Information" />
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
                                            <form action="{{ URL('submit-bank-information') }}" method="POST"
                                                id="myForm">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="bank_name">Bank Name</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="bank_name" name="bank_name"
                                                                    class="form-control">
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="branch">Branch</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="branch" name="branch"
                                                                    class="form-control">
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="account_no">Account No</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="account_no" name="account_no"
                                                                    class="form-control">
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="ifsc_code">IFSC Code</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="ifsc_code" name="ifsc_code"
                                                                    class="form-control">
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="pan_no">Pan-Card
                                                                Number</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="pan_no" name="pan_no"
                                                                    class="form-control">
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="uan_no">UAN Number</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="uan_no" name="uan_no"
                                                                    class="form-control">
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="pf_no">PF Number</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="pf_no" name="pf_no"
                                                                    class="form-control">
                                                                <div class="invalid-feedback"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
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
        function goBack() {
            window.history.back();
        }

        $(document).ready(function() {

            $.validator.addMethod("ifscCode", function(value, element) {
                return this.optional(element) || /^[A-Z]{4}0[A-Z0-9]{6}$/.test(value);
            }, "Please enter a valid IFSC code.");

            $("#myForm").validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                highlight: function(element, errorClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element, errorClass) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                },
                rules: {
                    bank_name: {
                        required: true,
                    },
                    branch: {
                        required: true,
                    },
                    account_no: {
                        required: true,
                        minlength: 9,
                        maxlength: 18
                    },
                    ifsc_code: {
                        required: true,
                        ifscCode: true
                    },
                    pan_no: {
                        required: true,
                    },

                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
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
