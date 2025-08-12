<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Add Emergency Contact" />
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
                                            <form action="{{ URL('submit-emergency-contect') }}" method="POST"
                                                id="myForm">
                                                @csrf
                                                <div class="row">
                                                    {{-- <input type="hidden" name="id" value="{{ $data->e_id }}"> --}}
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="name">Name of
                                                                Person</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="name" name="name"
                                                                    class="form-control" pattern="[A-Za-z]+">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="relationship">Relationship</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="relationship"
                                                                    name="relationship" class="form-control"
                                                                    pattern="[A-Za-z]+">
                                                                <div class="invalid-feedback" id="email-error">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="phone">Contact
                                                                Number</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="phone" name="phone"
                                                                    class="form-control" pattern="[0-9]{10}"
                                                                    minlength="10" maxlength="10">
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
            $('#name,#relationship').on('input', function() {
                $(this).val($(this).val().replace(/[^A-Za-z\s]/g, ''));
            });
        });

        $(document).ready(function() {
            $('#phone').on('input', function() {
                this.value = this.value.replace(/\D/g, '');
                $('#phone-error').text(/^\d{10}$/.test(this.value) ? '' :
                    'Please enter a valid 10-digit mobile number.');
            });
        });

        $(document).ready(function() {
            $("#myForm").validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                rules: {
                    name: {
                        required: true
                    },
                    relationship: {
                        required: true
                    },
                    phone: {
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

        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>
