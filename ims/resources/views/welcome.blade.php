{{-- This demo page is used to create a demo for testing purposes. --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    {{-- icon  --}}
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/logo.png') }}" />
    {{-- google font  --}}
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    {{-- chosen css  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
    {{-- select2 (multi-select) --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- fa fa icon css  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- datatable css  --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" />
    {{-- gsap css  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    {{-- summernote css  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css">
    {{-- switchery css  --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css" rel="stylesheet">
    {{-- datepicker css  --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" />
    {{-- timepicker css  --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.14.1/jquery.timepicker.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempus-dominus/6.2.7/js/tempus-dominus.min.js"></script>
    {{-- flatpickr css  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/md-date-time-picker@2.3.0/dist/css/mdDateTimePicker.min.css">
    {{-- vendoes and template css  --}}
    <link rel="stylesheet" href="{{ URL('vendors/base/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ URL('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/panel.css?v1') }}">
    {{-- jnoty css  --}}
    <link rel="stylesheet" href="{{ asset('assets/css/jnoty.min.css') }}">
    {{-- custom css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/mystyle.css?v8') }}">
    {{-- popper js  --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    {{-- title  --}}

</head>

<body>
    <div class="col-md-4">
        <div class="mb-3">
            <label for="starting_time" class="f-600 f-black form-label">From Time:</label>
            <input type="text" class="form-control" id="starting_time" name="starting_time" placeholder="h:m">
        </div>
    </div>


    <!-- container-scroller -->
    <script src="{{ URl('vendors/base/vendor.bundle.base.js') }}"></script>
    {{-- min js --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- datatable js --}}
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    {{-- jquery validation  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
    {{-- chosen js  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    {{-- selec2 (multi-select) --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- jquery ui min jjs --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.3/jquery-ui.min.js"></script>
    {{-- bootstrap js  --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    {{-- datepicker js  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js">
    </script>
    {{-- summernote js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js"></script>
    {{-- timepicker js  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.14.1/jquery.timepicker.min.js"></script>
    {{-- flatpicker js --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/confirmDate/confirmDate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/md-date-time-picker@2.3.0/dist/js/mdDateTimePicker.min.js"></script>
    {{-- switchery js  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>
    <!-- Ensure correct order and URLs for intl-tel-input -->
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.3/build/js/intlTelInput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@16.0.3/build/js/utils.js"></script>
    <script src="{{ URl('vendors/justgage/raphael-2.1.4.min.js') }}"></script>
    <script src="{{ URl('vendors/justgage/justgage.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <!-- Custom js for this page-->
    {{-- <script src="{{ asset ('assets/js/dashboard.js') }}"></script> --}}
    <script src="{{ asset('assets/js/jnoty.min.js') }}"></script>
    <script src="{{ asset('assets/js/admin-datatable.js') }}"></script>

    <!-- Initialize Flatpickr -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#starting_time", {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
            });
        });
    </script>

</body>

</html>
