<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Add Project" />
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
                    <section>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card f-black">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h2 class="f-700 f-black">Add Project</h2>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end"><button
                                                        onclick="goBack()" class="btn btn-primary"><i
                                                            class="fa fa-arrow-left me-2"
                                                            aria-hidden="true"></i>Back</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <form id="MyForm" action="{{ url('submit-project') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label f-600 required">Project
                                                                Title</label>
                                                            <input type="text" id="project_title"
                                                                name="project_title" class="form-control"
                                                                placeholder="Enter Project Title">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label f-600 required">Start
                                                                Date</label>
                                                            <input type="text" id="start_date" name="start_date"
                                                                class="form-control" placeholder="select start date">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label f-600 required">End Date</label>
                                                            <input type="text" id="end_date" name="end_date"
                                                                class="form-control" placeholder="select end date">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="required control-label f-600"
                                                                for="emp">Project Leader</label>
                                                            <select name="emp[]" id="emp"
                                                                class="form-select chosen-select" multiple>
                                                                <option value="" disabled class="f-black f-700">
                                                                    -Select Members-</option>
                                                                @foreach ($emp as $emps)
                                                                    <option value="{{ $emps->e_id }}">
                                                                        {{ $emps->fname }} {{ $emps->lname }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label f-600 required">Project
                                                                Description</label>
                                                            <input type="hidden" id="project_description_hidden"
                                                                name="project_description_hidden">
                                                            <textarea id="project_description" name="project_description" class="form-control" placeholder="Enter Project Title"></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="submit" id="submitBtn"
                                                        class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
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
            $(".chosen-select").chosen();
        });
    </script>
    <script>
        flatpickr("#start_date", {
            dateFormat: "d-m-Y",
        });

        flatpickr("#end_date", {
            dateFormat: "d-m-Y",
            minDate: "today"
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#project_description').summernote({
                height: 150,
                codemirror: {
                    theme: 'monokai'
                }
            });

            // // Handle form submission
            // $('#your_form_id').submit(function(event) {
            //     // Get Summernote content
            //     var content = $('#project_description').summernote('code');
            //     // Set Summernote content to hidden input
            //     $('#project_description_hidden').val(content);
            // });
        });
    </script>
    <script>
        function goBack() {
            window.history.back();
        }
        $("#MyForm").validate({
            errorElement: 'div',
            errorClass: 'invalid-feedback',
            rules: {
                project_title: {
                    required: true
                },
                start_date: {
                    required: true
                },
                end_date: {
                    required: true
                },
                emp: {
                    required: true
                },
                'emp[]': {
                    required: true
                },
                project_description_hidden: {
                    required: true
                },
            },
            messages: {

            },
            errorPlacement: function(error, element) {
                //  error.insertAfter(element);
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
    </script>
</body>

</html>
