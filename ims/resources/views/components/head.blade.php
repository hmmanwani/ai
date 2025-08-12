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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/md-date-time-picker@2.3.0/dist/css/mdDateTimePicker.min.css">
{{-- vendoes and template css  --}}
<link rel="stylesheet" href="{{ asset('vendors/base/vendor.bundle.base.css') }}">
<link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/panel.css?v1') }}">
{{-- jnoty css  --}}
<link rel="stylesheet" href="{{ asset('assets/css/jnoty.min.css') }}">
{{-- custom css --}}
<link rel="stylesheet" href="{{ asset('assets/css/mystyle.css?v8') }}">
{{-- popper js  --}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
{{-- title  --}}
<title>{{ $title }}</title>
<x-headanalytics />
