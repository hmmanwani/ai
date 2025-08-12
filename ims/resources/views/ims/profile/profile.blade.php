<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Profile " />
</head>

<body>
    <div class="container-scroller" id="profile-page">
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
                                    <form action="">
                                        <div class="card ">
                                            <div class="row">
                                                <div class="col-md-3 pe-0  mb-4">
                                                    <div class="list-group mx-4" id="list-tab" role="tablist">
                                                        <div class="profile-picture d-flex justify-content-center">
                                                            <img src="{{ URL('assets\images\logo\logo.png') }}"
                                                                class="w-50  me-2 my-4 ms-2" alt="">
                                                        </div>
                                                        <h3 class="text-center  f-700">
                                                            {{ ucfirst(session()->get('emp_login')['fname']) }}
                                                            {{ ucfirst(session()->get('emp_login')['lname']) }}
                                                        </h3>
                                                        <a class="list-group-item list-group-item-action active"
                                                            id="personal-details-list" data-bs-toggle="list"
                                                            href="#personal-details" role="tab"
                                                            aria-controls="personal-details">Personal
                                                            Details</a>
                                                        <a class="list-group-item list-group-item-action"
                                                            id="address-list" data-bs-toggle="list" href="#address"
                                                            role="tab" aria-controls="address">Address</a>
                                                        <a class="list-group-item list-group-item-action"
                                                            id="emergency-contacts-list" data-bs-toggle="list"
                                                            href="#emergency-contact" role="tab"
                                                            aria-controls="emergency-contact">Emergency Contacts</a>
                                                        <a class="list-group-item list-group-item-action"
                                                            id="bank-information-list" data-bs-toggle="list"
                                                            href="#bank-information" role="tab"
                                                            aria-controls="bank-information">Bank Information</a>
                                                        <a class="list-group-item list-group-item-action" id="job-list"
                                                            data-bs-toggle="list" href="#job" role="tab"
                                                            aria-controls="job">Job</a>
                                                    </div>
                                                </div>
                                                <div class="col-md-9 nav-content">
                                                    <div class="tab-content" id="nav-tabContent">
                                                        {{-- Personal  Details --}}
                                                        <div class="tab-pane fade show active" id="personal-details"
                                                            role="tabpanel" aria-labelledby="personal-details-list">
                                                            <div class="card ">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6 align-self-center">
                                                                            <h2 class="mb-0">Personal Details</h2>
                                                                        </div>
                                                                        <div
                                                                            class="col-md-6 d-flex justify-content-end">
                                                                            <?php if ($employee->p_details_status == 'Pending') { ?>
                                                                            <p class="f-red align-self-end me-4">Your
                                                                                request is under
                                                                                approval.</p>
                                                                            <?php } ?>
                                                                            <a href="{{ URL('/edit-personal-details') }}/{{ $employee->e_id }}"
                                                                                class="btn btn-primary">
                                                                                <i class="fa fa-pencil f-24 f-white"
                                                                                    aria-hidden="true"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <input type="hidden" name="e_id"
                                                                            value="{{ $employee->e_id }}">
                                                                        {{-- emp name --}}
                                                                        <div class="col-md-4 form-group">
                                                                            <label class="control-label f-700">Employee
                                                                                Full
                                                                                Name :</label>
                                                                            <p>{{ $employee->fname }}
                                                                                {{ $employee->mname }}
                                                                                {{ $employee->lname }}</p>
                                                                        </div>

                                                                        {{-- emp id --}}
                                                                        <div class="col-md-4 form-group">
                                                                            <label class="control-label f-700">Employee
                                                                                Id :</label>
                                                                            <p>FS-200</p>
                                                                        </div>

                                                                        {{-- date of brith --}}
                                                                        <div class="col-md-4 form-group">
                                                                            <label class="control-label f-700">Date of
                                                                                Birth :</label>
                                                                            <p>{{ date('d-m-Y', strtotime($employee->dob)) }}
                                                                            </p>
                                                                        </div>

                                                                        {{-- Nationality --}}
                                                                        <div class="col-md-4 form-group">
                                                                            <label
                                                                                class="control-label  f-700">Nationality
                                                                                :</label>
                                                                            <p>{{ $employee->nationality }}</p>
                                                                        </div>

                                                                        {{-- Marital status --}}
                                                                        <div class="col-md-4 form-group">
                                                                            <label class="control-label f-700">Marital
                                                                                Status :</label>
                                                                            <p>{{ $employee->marital_status }}</p>
                                                                        </div>

                                                                        {{-- gender --}}
                                                                        <div class="col-md-4 form-group">
                                                                            <label class="control-label f-700">Gender
                                                                                :</label>
                                                                            <p>{{ $employee->gender }}</p>
                                                                        </div>

                                                                        {{-- blood type --}}
                                                                        <div class="col-md-4 form-group">
                                                                            <label class="control-label f-700">Blood
                                                                                Types :</label>
                                                                            <p>{{ $employee->bloodtype }}</p>
                                                                        </div>

                                                                        {{-- contact number --}}
                                                                        <div class="col-md-4 form-group">
                                                                            <label class="control-label f-600">Phone
                                                                                No :</label>
                                                                            <p>{{ $employee->phone }}</p>
                                                                        </div>

                                                                        {{-- Personal Email --}}
                                                                        <div class="col-md-4 form-group">
                                                                            <label class="control-label f-600">Personal
                                                                                Email :</label>
                                                                            <p>{{ $employee->pemail }}
                                                                            <p>
                                                                        </div>
                                                                        @if ($employee->aadhaarcard != null)
                                                                            <div class="col-md-4 form-group">
                                                                                <label
                                                                                    class="control-label f-600">Aadhaar
                                                                                    Card
                                                                                    :</label>
                                                                                <a href="{{ URL('storage/' . $employee->aadhaarcard) }}"
                                                                                    target="_blank"><i
                                                                                        class="fa fa-eye ms-2 f-black"
                                                                                        aria-hidden="true"></i></a>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-md-6 align-self-center">
                                                                            <h2 class="mb-0">Education Qualification
                                                                            </h2>
                                                                        </div>
                                                                        <div
                                                                            class="col-md-6 d-flex justify-content-end align-items-center">
                                                                            <a href="{{ URL('/add-education-qualification') }}"
                                                                                class="btn btn-primary">
                                                                                <i class="fa fa-plus f-24 f-white"
                                                                                    aria-hidden="true"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <hr>

                                                                    <div class="row">
                                                                        @if ($education_qualifications->isEmpty())
                                                                            <div class="col-md-12">
                                                                                <h3>Please add qualifications.</h3>
                                                                            </div>
                                                                        @else
                                                                            @foreach ($education_qualifications as $education_qualification)
                                                                                <div class="col-md-4">
                                                                                    <label
                                                                                        class="control-label f-900"></label>
                                                                                    <p>{{ $education_qualification->qualification }}
                                                                                    </p>
                                                                                    <hr>
                                                                                </div>
                                                                                <div
                                                                                    class="col-md-8 d-flex justify-content-end align-items-center">
                                                                                    <?php if ($education_qualification->status == 'Pending') { ?>
                                                                                    <p
                                                                                        class="f-red align-self-center me-2">
                                                                                        Your
                                                                                        request is under
                                                                                        approval.</p>
                                                                                    <?php } ?>
                                                                                    <a href="{{ URL('/edit-education-qualification') }}/{{ $education_qualification->edq_id }}"
                                                                                        class="btn btn-primary p-1">
                                                                                        <i class="fa fa-pencil f-16 f-white"
                                                                                            aria-hidden="true"></i>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="row mb-0">
                                                                                    <div class="col-md-4 form-group">
                                                                                        <label
                                                                                            class="control-label f-700">University
                                                                                            Name:</label>
                                                                                        <p>{{ $education_qualification->university_name }}
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="col-md-4 form-group">
                                                                                        <label
                                                                                            class="control-label f-700">Starting
                                                                                            Year:</label>
                                                                                        <p>{{ date('m-Y', strtotime($education_qualification->starting_year)) }}
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="col-md-4 form-group">
                                                                                        <label
                                                                                            class="control-label f-700">Ending
                                                                                            Year:</label>
                                                                                        <p>{{ date('m-Y', strtotime($education_qualification->ending_year)) }}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- Address --}}
                                                        <div class="tab-pane fade" id="address" role="tabpanel"
                                                            aria-labelledby="address-list">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    {{-- Address --}}
                                                                    <div class="row">
                                                                        <div class="col-md-6 align-self-center">
                                                                            <h2 class="mb-0">Address
                                                                            </h2>
                                                                        </div>
                                                                        <div
                                                                            class="col-md-6 d-flex justify-content-end align-items-center">
                                                                            <a href="{{ URl('/add-address') }}"
                                                                                class="btn btn-primary">
                                                                                <i class="fa fa-plus f-24 f-white"
                                                                                    aria-hidden="true"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    @if ($addresses->isEmpty())
                                                                        <div class="col-md-12">
                                                                            <h3>Please add your address.</h3>
                                                                        </div>
                                                                    @else
                                                                        @foreach ($addresses as $address)
                                                                            <div class="border p-3 mb-3 p-relative"
                                                                                style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <p
                                                                                            class="f-20 f-black mb-2 f-600">
                                                                                            {{ $address->address_type }}
                                                                                            :
                                                                                        </p>
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-md-11 form-group d-flex ">
                                                                                        <h3>{{ $address->apartment_no }},
                                                                                            {{ $address->apartment_name }},
                                                                                            {{ $address->area }},
                                                                                            {{ $address->city }},
                                                                                            {{ $address->state }},
                                                                                            {{ $address->country }},
                                                                                            {{ $address->postal_code }}
                                                                                        </h3>
                                                                                    </div>
                                                                                    <div class="col-md-1 text-end">
                                                                                        <a href="{{ URL('/edit-address') }}/{{ $address->ad_id }}"
                                                                                            class="btn btn-primary p-1">
                                                                                            <i class="fa fa-pencil f-16 f-white"
                                                                                                aria-hidden="true"></i>
                                                                                        </a>
                                                                                    </div>
                                                                                    <?php if ($address->status == 'Pending') { ?>
                                                                                    <p
                                                                                        class="f-red align-self-center ">
                                                                                        Your
                                                                                        request is under
                                                                                        approval.</p>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- Emergency Contacts --}}
                                                        <div class="tab-pane fade" id="emergency-contact"
                                                            role="tabpanel" aria-labelledby="emergency-contacts-list">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6 align-self-center">
                                                                            <h2 class="mb-0">Emergency Contacts
                                                                            </h2>
                                                                        </div>
                                                                        <div
                                                                            class="col-md-6 d-flex justify-content-end">
                                                                            <a href="{{ URL('/add-emergency-contect') }}"
                                                                                class="btn btn-primary">
                                                                                <i class="fa fa-plus f-24 f-white"
                                                                                    aria-hidden="true"></i>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                    <hr class="mt-2">
                                                                    <div class="row">
                                                                        @if ($emergencycontactes->isEmpty())
                                                                            <div class="col-md-12">
                                                                                <h3>Please add contacts details.
                                                                                </h3>
                                                                            </div>
                                                                        @else
                                                                            @foreach ($emergencycontactes as $emergencycontact)
                                                                                <div class="col-md-6">
                                                                                    <p class="f-18 f-700">
                                                                                        Person {{ $loop->iteration }}:
                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-md-6 text-end">
                                                                                    <?php if ($emergencycontact->status == 'Pending') { ?>
                                                                                    <p class="f-red  ">
                                                                                        Your
                                                                                        request is under
                                                                                        approval.</p>
                                                                                    <?php } ?>
                                                                                </div>

                                                                                <hr>
                                                                                <div class="col-md-4 form-group mt-3">
                                                                                    <label class="control-label f-600">
                                                                                        Name:</label>
                                                                                    <p>{{ $emergencycontact->name }}
                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-md-4 form-group mt-3">
                                                                                    <label
                                                                                        class="control-label f-600">Relationship</label>
                                                                                    <p>{{ $emergencycontact->relationship }}
                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-md-3 form-group mt-3">
                                                                                    <label
                                                                                        class="control-label f-600">Mobile</label>
                                                                                    <p>{{ $emergencycontact->phone }}
                                                                                    </p>
                                                                                </div>
                                                                                <div class="col-md-1 text-end">
                                                                                    <a href="{{ URL('/edit-emergency-contact') }}/{{ $emergencycontact->ec_id }}"
                                                                                        class="btn btn-primary p-1">
                                                                                        <i class="fa fa-pencil f-16 f-white"
                                                                                            aria-hidden="true"></i>
                                                                                    </a>
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- Bank Information --}}
                                                        <div class="tab-pane fade" id="bank-information"
                                                            role="tabpanel" aria-labelledby="bank-information-list">
                                                            <div class="card ">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-6 align-self-center">
                                                                            <h2 class="mb-0">Bank Information</h2>
                                                                        </div>
                                                                        <div
                                                                            class="col-md-6 d-flex justify-content-end">

                                                                            @if (is_null($bankinformation))
                                                                                <a href="{{ URL('/add-bank-information') }}"
                                                                                    class="btn btn-primary">
                                                                                    <i class="fa fa-plus f-24 f-white"
                                                                                        aria-hidden="true"></i>
                                                                                </a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                        @if (is_null($bankinformation))
                                                                            <div class="col-md-12">
                                                                                <h3>Please add the Bank Information.
                                                                                </h3>
                                                                            </div>
                                                                        @else
                                                                            <?php if ($bankinformation->status == 'Pending') { ?>
                                                                            <p class="f-red align-self-center ">
                                                                                Your
                                                                                request is under
                                                                                approval.</p>
                                                                            <?php } ?>
                                                                            <div class="row">
                                                                                <div class="col-md-11">
                                                                                    <div class="row">
                                                                                        <div class="col-md-2">
                                                                                            <label
                                                                                                class="control-label f-700">Bank
                                                                                                Name:</label>
                                                                                        </div>
                                                                                        <div class="col-md-10">
                                                                                            <p>{{ $bankinformation->bank_name }}
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="col-md-2">
                                                                                            <label
                                                                                                class="control-label f-700">Branch:</label>
                                                                                        </div>
                                                                                        <div class="col-md-10">
                                                                                            <p>{{ $bankinformation->branch }}
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="col-md-2">
                                                                                            <label
                                                                                                class="control-label f-700">Account
                                                                                                No:</label>
                                                                                        </div>
                                                                                        <div class="col-md-10">
                                                                                            <p>{{ $bankinformation->account_no }}
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="col-md-2">
                                                                                            <label
                                                                                                class="control-label f-700">IFSC
                                                                                                Code:</label>
                                                                                        </div>
                                                                                        <div class="col-md-10">
                                                                                            <p>{{ $bankinformation->ifsc_code }}
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="col-md-2">
                                                                                            <label
                                                                                                class="control-label f-700">Pan
                                                                                                Card No:</label>
                                                                                        </div>
                                                                                        <div class="col-md-10">
                                                                                            <p>{{ $bankinformation->pan_no }}
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="col-md-2">
                                                                                            <label
                                                                                                class="control-label f-700">UAN
                                                                                                No:</label>
                                                                                        </div>
                                                                                        <div class="col-md-10">
                                                                                            <p>{{ $bankinformation->uan_no }}
                                                                                            </p>
                                                                                        </div>
                                                                                        <div class="col-md-2">
                                                                                            <label
                                                                                                class="control-label f-700">PF
                                                                                                No:</label>
                                                                                        </div>
                                                                                        <div class="col-md-10">
                                                                                            <p>{{ $bankinformation->pf_no }}
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    <a href="{{ URL('/edit-bank-information') }}/{{ $bankinformation->bi_id }}"
                                                                                        class="btn btn-primary">
                                                                                        <i class="fa fa-pencil f-24 f-white"
                                                                                            aria-hidden="true"></i>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- Jobs --}}
                                                        <div class="tab-pane fade" id="job" role="tabpanel"
                                                            aria-labelledby="job-list">
                                                            <div class="card ">
                                                                <div class="card-body">
                                                                    <div class="heading">
                                                                        <h2>Job Details</h2>
                                                                    </div>
                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-md-4 form-group">
                                                                            <label class="control-label f-700">Joined
                                                                                Date :</label>
                                                                            <p>{{ date('d-m-Y', strtotime($employee->join_date)) }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <label class="control-label f-700">Job
                                                                                Category :</label>
                                                                            <p>{{ $employee->team }}</p>
                                                                        </div>
                                                                        <div class="col-md-4 form-group">
                                                                            <label class="control-label f-700">Job
                                                                                Title :</label>
                                                                            <p>{{ $employee->designation }}</p>
                                                                        </div>
                                                                        <div class="col-md-4 form-group d-none">
                                                                            <label
                                                                                class="control-label f-700">Experience</label>
                                                                            <p>{{ $employee->emp_experience }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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
    </div>
    <x-footer />
    {{-- url set  --}}
    <script>
        // contact details
        $(document).ready(function() {
            if (window.location.hash === "#address") {
                var contactDetailsTab = new bootstrap.Tab($('#address-list')[0]);
                contactDetailsTab.show();
            }
        });
        // Emergency Contact
        $(document).ready(function() {
            if (window.location.hash === "#emergency-contacts") {
                var contactDetailsTab = new bootstrap.Tab($('#emergency-contacts-list')[0]);
                contactDetailsTab.show();
            }
        });
        // Bank Infromation
        $(document).ready(function() {
            if (window.location.hash === "#bank-information") {
                var contactDetailsTab = new bootstrap.Tab($('#bank-information-list')[0]);
                contactDetailsTab.show();
            }
        });
    </script>

</body>

</html>
