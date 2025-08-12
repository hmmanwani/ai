<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Resignation " />
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
                    <section id="resignation">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-12 align-self-center">
                                                    <h2 class=" mx-3 f-800 mb-0">Resignation</h2>
                                                    <p class="mx-3 f-red f-500">You can't edit after submitting your
                                                        resignation
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ URL('submit-resignation') }}" method="POST"
                                                id="myForm">
                                                @csrf
                                                {{-- reason  --}}
                                                <div class="row">
                                                    <div class="offset-md-2 col-md-8">
                                                        <div class="row ">
                                                            <div class="form-group">
                                                                <label class="col-sm-3 f-600 control-label required">
                                                                    Reason</label>
                                                                <input class="form-control" id="reason"
                                                                    name="reason"></input>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Description --}}
                                                    <div class="offset-md-2 col-md-8">
                                                        <div class="row ">
                                                            <div class="form-group">
                                                                <label class="col-sm-3 f-600 control-label required">
                                                                    Description</label>
                                                                <textarea class="form-control h-100" name="description" id="description" rows="6"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="offset-md-2 col-md-8 d-flex justify-content-end mt-4">
                                                        <button type="submit" id="submitBtn"
                                                            class="btn btn-primary">Send</button>
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
            $("#myForm").validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                rules: {
                    reason: {
                        required: true
                    },
                    description: {
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
