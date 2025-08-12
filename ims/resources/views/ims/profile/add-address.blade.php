<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Add Address" />
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
                                            <form action="{{ url('submit-address') }}" method="POST" id="myForm">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="type">Address Type</label>
                                                            <div class="col-md-12">
                                                                <select class="form-select" id="address_type"
                                                                    name="address_type"
                                                                    aria-label="Default select example" required>
                                                                    <option disabled>---- Selete Address Type ----
                                                                    </option>
                                                                    <option value="Permanent">Permanent</option>
                                                                    <option value="Current">Current</option>
                                                                </select>
                                                                <div class="invalid-feedback" id="apartment_no-error">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="apartment_no">Apartment
                                                                No</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="apartment_no"
                                                                    name="apartment_no" class="form-control" required>
                                                                <div class="invalid-feedback" id="apartment_no-error">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="apartment_name">Apartment
                                                                Name</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="apartment_name"
                                                                    pattern="[A-Za-z]+" name="apartment_name"
                                                                    class="form-control">
                                                                <div class="invalid-feedback" id="email-error">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="area">Area</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="area" name="area"
                                                                    pattern="[A-Za-z]+" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="country">Country</label>
                                                            <div class="col-md-12">
                                                                <select id="country" name="country"
                                                                    class="form-select">
                                                                    <option value="">Select Country</option>
                                                                    <!-- Countries will be populated here via AJAX -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="state">State</label>
                                                            <div class="col-md-12">
                                                                <select id="state" name="state"
                                                                    class="form-select">
                                                                    <option value="">Select State</option>
                                                                    <!-- States will be populated here via AJAX -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="city">City</label>
                                                            <div class="col-md-12">
                                                                <select id="city" name="city"
                                                                    class="form-select">
                                                                    <option value="">Select City</option>
                                                                    <!-- Cities will be populated here via AJAX -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="required" for="postal_code">Postal
                                                                Code</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="postal_code"
                                                                    name="postal_code" class="form-control"
                                                                    pattern="^\d{5}$" minlength="6" maxlength="6"
                                                                    required>
                                                                <div class="invalid-feedback" id="postal_code-error">
                                                                </div>
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
            // Fetch countries on page load
            $.ajax({
                url: '{{ URl('get-countries') }}',
                method: 'GET',
                success: function(data) {
                    var countrySelect = $('#country');
                    countrySelect.empty().append('<option value="">Select Country</option>');
                    $.each(data, function(key, country) {
                        countrySelect.append('<option value="' + country.id + '">' + country
                            .name + '</option>');
                    });
                }
            });

            // Fetch states based on selected country
            $('#country').change(function() {
                var c_id = $(this).val();
                if (c_id) {
                    $.ajax({
                        url: '{{ url('get-states') }}/' + c_id,
                        method: 'GET',
                        success: function(data) {
                            var stateSelect = $('#state');
                            stateSelect.empty().append(
                                '<option value="">Select State</option>');
                            $.each(data, function(key, state) {
                                stateSelect.append('<option value="' + state.id + '">' +
                                    state.name + '</option>');
                            });
                            stateSelect.focus();
                        }
                    });
                } else {
                    $('#state').empty().append('<option value="">Select State</option>');
                    $('#city').empty().append('<option value="">Select City</option>');
                }
            });

            // Fetch cities based on selected state
            $('#state').change(function() {
                var s_id = $(this).val();
                if (s_id) {
                    $.ajax({
                        url: '{{ url('get-cities') }}/' + s_id,
                        method: 'GET',
                        success: function(data) {
                            var citySelect = $('#city');
                            citySelect.empty().append('<option value="">Select City</option>');
                            $.each(data, function(key, city) {
                                citySelect.append('<option value="' + city.id + '">' +
                                    city.name + '</option>');
                            });
                            citySelect.focus();
                        }
                    });
                } else {
                    $('#city').empty().append('<option value="">Select City</option>');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#apartment_name,#area').on('input', function() {
                $(this).val($(this).val().replace(/[^A-Za-z\s]/g, ''));
            });
        });

        $(document).ready(function() {
            $('#postal_code').on('input', function() {
                const pattern = /^\d{5}$/;
                $('#postal_code-error').text(pattern.test(this.value) ? '' :
                    '');
            });
        });
    </script>
    <script>
        function goBack() {
            window.history.back();
        }

        $(document).ready(function() {
            $.validator.addMethod("lettersOnly", function(value, element) {
                return this.optional(element) || /^[A-Za-z\s]+$/.test(value);
            }, "Please enter only letters.");

            $("#myForm").validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                rules: {
                    apartment_no: {
                        required: true,
                        pattern: /^[A-Za-z0-9\s\-]+$/
                    },
                    apartment_name: {
                        required: true,
                        lettersOnly: true
                    },
                    area: {
                        required: true,
                        lettersOnly: true
                    },
                    city: {
                        required: true,
                    },
                    state: {
                        required: true,
                    },
                    country: {
                        required: true,
                    },
                    postal_code: {
                        required: true,
                        minlength: 3,
                        maxlength: 6
                    }
                },
                errorPlacement: function(error, element) {
                    // Customize error placement if needed
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
