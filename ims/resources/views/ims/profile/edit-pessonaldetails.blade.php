<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Edit-PersonalDetails" />
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
                                            <form action="{{ url('/update-personal-details') }}" method="POST"
                                                enctype="multipart/form-data" id="myForm">
                                                @csrf
                                                <div class="row">
                                                    <input type="hidden" name="id" value="{{ $data->e_id }}">
                                                    <div class="col-md-4 mt-2">
                                                        <div class="form-group">
                                                            <label class="required" for="fname">First Name</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="fname" name="fname"
                                                                    class="form-control" value="{{ $data->fname }}"
                                                                    pattern="[A-Za-z]+"
                                                                    title="Please enter alphabets only.">
                                                                <div class="invalid-feedback" id="fname-error"></div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-4 mt-2">
                                                        <div class="form-group">
                                                            <label class="required" for="mname">Middle Name</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="mname" name="mname"
                                                                    class="form-control" value="{{ $data->mname }}"
                                                                    pattern="[A-Za-z]+"
                                                                    title="Please enter alphabets only.">
                                                                <div class="invalid-feedback" id="mname-error"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 mt-2">
                                                        <div class="form-group">
                                                            <label class="required" for="lname">Last Name</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="lname" name="lname"
                                                                    class="form-control" value="{{ $data->lname }}"
                                                                    pattern="[A-Za-z]+"
                                                                    title="Please enter alphabets only.">
                                                                <div class="invalid-feedback" id="lname-error"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required"
                                                                for="nationality">Nationality</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="nationality"
                                                                    name="nationality" class="form-control"
                                                                    value="{{ $data->nationality }}" pattern="[A-Za-z]+"
                                                                    title="Please enter alphabets only.">
                                                                <div class="invalid-feedback" id="nationality-error">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="dob">Date of Birth</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="dob" name="dob"
                                                                    class="form-control" placeholder="dd-mm-yyyy"
                                                                    value="{{ $data->dob }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="marital_status">Marital
                                                                Status</label>
                                                            <select name="marital_status" id="marital_status"
                                                                class="form-select form-control f-black">
                                                                <option value="">-Select Marital Status-</option>
                                                                <option value="Single" <?php echo $data->marital_status == 'Single' ? 'selected' : ''; ?>>Single
                                                                </option>
                                                                <option value="Married" <?php echo $data->marital_status == 'Married' ? 'selected' : ''; ?>>Married
                                                                </option>
                                                                <option value="Divorced" <?php echo $data->marital_status == 'Divorced' ? 'selected' : ''; ?>>Divorced
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="gender">Gender</label>
                                                            <select name="gender" id="gender"
                                                                class="form-select form-control f-black">
                                                                <option value="">-Select Your Gender-</option>
                                                                <option value="Male" <?php echo $data->gender == 'Male' ? 'selected' : ''; ?>>
                                                                    Male</option>
                                                                <option value="Female" <?php echo $data->gender == 'Female' ? 'selected' : ''; ?>>
                                                                    Female</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" foadr="bloodtype">Blood
                                                                Type</label>
                                                            <select name="bloodtype" id="bloodtype"
                                                                class="form-select form-control f-black">
                                                                <option value="">-Select Your Blood Type-
                                                                </option>
                                                                <option value="A+" <?php echo $data->bloodtype == 'A+' ? 'selected' : ''; ?>> A+
                                                                </option>
                                                                <option value="A-" <?php echo $data->bloodtype == 'A-' ? 'selected' : ''; ?>>A- </option>
                                                                <option value="B+" <?php echo $data->bloodtype == 'B+' ? 'selected' : ''; ?>>B+ </option>
                                                                <option value="B-" <?php echo $data->bloodtype == 'B-' ? 'selected' : ''; ?>>B- </option>
                                                                <option value="AB+" <?php echo $data->bloodtype == 'AB+' ? 'selected' : ''; ?>> AB+
                                                                </option>
                                                                <option value="AB-" <?php echo $data->bloodtype == 'AB-' ? 'selected' : ''; ?>>
                                                                    AB-</option>
                                                                <option value="O+" <?php echo $data->bloodtype == 'O+' ? 'selected' : ''; ?>>O+
                                                                </option>
                                                                <option value="O-" <?php echo $data->bloodtype == 'O-' ? 'selected' : ''; ?>>O-
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    {{-- contact number --}}
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="phone">Contact
                                                                Number</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="phone" name="phone"
                                                                    class="form-control" value="{{ $data->phone }}"
                                                                    pattern="[6-9][0-9]{9}" minlength="10"
                                                                    maxlength="10"
                                                                    title="Please enter a valid 10-digit phone number.">
                                                                <div class="invalid-feedback" id="phone-error"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- personal email --}}
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="pemail">Personal
                                                                Email</label>
                                                            <div class="col-md-12">
                                                                <input type="email" id="pemail" name="pemail"
                                                                    class="form-control" value="{{ $data->pemail }}"
                                                                    required>
                                                                <div class="invalid-feedback" id="pemail-error"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- aadhar card  --}}
                                                    <div class="col-md-8">
                                                        <div class="mb-3">
                                                            <label for="formFile" class="form-label">Aadhar
                                                                card</label>
                                                            <input class="form-control" type="file"
                                                                id="addharcard" name="addharcard">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=" d-flex justify-content-end ">
                                                    <button type="submit" id="submitBtn"
                                                        class="btn btn-primary">Update</button>
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
            $('#dob').flatpickr({
                dateFormat: "d-m-Y",
                maxDate: 'today',
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#fname,#mname, #lname, #nationality').on('input', function() {
                $(this).val($(this).val().replace(/[^A-Za-z\s]/g, ''));
            });
        });
        $.validator.addMethod("validPhone", function(value, element) {
            return this.optional(element) || /^[6-9][0-9]{9}$/.test(value);
        });
        $(document).ready(function() {
            $("#myForm").validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                rules: {
                    fname: {
                        required: true
                    },
                    mname: {
                        required: true
                    },
                    lname: {
                        required: true
                    },
                    nationality: {
                        required: true
                    },
                    marital_status: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    bloodtype: {
                        required: true
                    },
                    dob: {
                        required: true
                    },
                    phone: {
                        required: true,
                        validPhone: true,
                        minlength: 10,
                        maxlength: 10
                    }
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
