<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Add Daily Work Report" />
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
                                                    <h2 class="f-700">Add Work Report</h2>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <a href="{{ URL('daily-work-report') }}" class="me-2">
                                                        <button type="button" class="btn btn-primary">
                                                            <i class="fa fa-arrow-left me-2"
                                                                aria-hidden="true"></i>Back</button></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form id="workreport" action="{{ URL('submit-add-work-report') }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <textarea id="Add-Work-Report" name="workreport" class="form-control" placeholder="Enter Report"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex justify-content-end">
                                                                <button type="submit" id="submitBtn"
                                                                    class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
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
            $('#Add-Work-Report').summernote({
                height: 450,
                codemirror: {
                    theme: 'monokai'
                },
                toolbar: [
                    ['font', ['fontsize']], // No font family option
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                ],

                
                fontSizes: ['10', '12', '14', '16', '18', '20', '24', '28', '32', '36',
                    '48'
                ], // Custom font sizes
                codeviewFilter: true,
                codeviewIframe: false,
                pleaceholder: 'Write report here...',
                callbacks: {
                    onInit: function() {
                        $('.note-editable').css('font-family',
                            'Arial'); // Set Arial as default font
                    },
                    onChange: function(contents, $editable) {
                        $('.note-editable .table').css({
                            'border': '1px solid #000',
                            'border-collapse': 'collapse'
                        });
                        $('.note-editable .table th, .note-editable .table td').css({
                            'border': '1px solid #000'
                        });
                    }
                }
            });

            @if ($showtask == 0)
                const currentHour = new Date().getHours();
                let greeting;

                if (currentHour < 12) {
                    greeting = "Good Morning!";
                } else if (currentHour < 18) {
                    greeting = "Good Afternoon!";
                } else {
                    greeting = "Good Evening!";
                }

                const loginTime = `{{ $loginTime }}`;

                const suggestionText = `
                    <div contenteditable="false" id="suggestionText">
                        Dear Sir,<br><br>

                        ${greeting}<br><br>

                        Please note that my Login time today is <b>${loginTime}.</b><br><br>

                        The following are my tasks for the day:<br><br>
                    </div>
                `;
                $('#Add-Work-Report').summernote('code', suggestionText + $('#Add-Work-Report').summernote('code'));
            @endif

            $('#workreport').submit(function(e) {
                let content = $('#Add-Work-Report').summernote('code').trim();
                content = content.replace($('#suggestionText').prop('outerHTML'), '').trim();
                content = content.replace(/&nbsp;/g, '').replace(/\s+/g, '').trim();
                if (content === '' || content === '<p><br></p>') {
                    alert('Please enter a report.');
                    e.preventDefault();
                }
            });
        });
    </script>
    <script>
        function goBack() {
            history.go(-1);
        }
    </script>
    <script>
        $("#workreport").validate({
            errorElement: 'div',
            errorClass: 'invalid-feedback',
            rules: {

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
