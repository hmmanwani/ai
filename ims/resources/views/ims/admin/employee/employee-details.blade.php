<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Admin Employee Details" />
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
                    <section id="overview">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-3">
                                    <x-admin-sidebar />
                                </div>
                                <div class="col-md-9">
                                    <div class="d-flex justify-content-end ">
                                        <button onclick="goBack()" class="btn btn-primary"><i
                                                class="fa fa-arrow-left me-2" aria-hidden="true"></i>Back</button>
                                    </div>
                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h2 class= "f-600">Employee Details</h2>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end align-self-center">
                                                    <label class="control-label f-18 f-600">Emp Id :</label>
                                                    <p class="f-18 ms-2  f-20 f-black f-800">
                                                        {{ $details->empid }} </p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="border p-3 mb-3 p-relative"
                                                style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        @if ($details->p_details_status === 'Pending')
                                                            <span class="badge badge-warning peronal-d-old">Old</span>
                                                            <!-- Badge for old info -->
                                                        @endif
                                                        <div class="mt-2">
                                                            <label class="control-label f-20 f-600">Employee Name
                                                                :</label>
                                                            <p class="f-18">{{ $details->fname }}
                                                                {{ $details->mname }}
                                                                {{ $details->lname }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class=" mt-2">
                                                            <label class="control-label f-20 f-600">Date of Birth
                                                                :</label>
                                                            <p class="f-18">
                                                                {{ date('d-m-Y', strtotime($details->dob)) }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class=" mt-2">
                                                            <label class="control-label f-20 f-600">Nationality
                                                                :</label>
                                                            <p class="f-18">{{ $details->nationality }} </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mt-4">
                                                        <div class=" mt-2">
                                                            <label class="control-label f-20 f-600">Marital Status
                                                                :</label>
                                                            <p class="f-18">{{ $details->marital_status }} </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mt-4">
                                                        <div class=" mt-2">
                                                            <label class="control-label f-20 f-600">Gender :</label>
                                                            <p class="f-18">{{ $details->gender }} </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mt-4">
                                                        <div class=" mt-2">
                                                            <label class="control-label f-20 f-600">Blood Types
                                                                :</label>
                                                            <p class="f-18">{{ $details->bloodtype }} </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mt-4">
                                                        <div class=" mt-2">
                                                            <label class="control-label f-20 f-600">Phone Number
                                                                :</label>
                                                            <p class="f-18">{{ $details->phone }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mt-4">
                                                        <div class=" mt-2">
                                                            <label class="control-label f-20 f-600">Personal Email
                                                                :</label>
                                                            <p class="f-18">{{ $details->pemail }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mt-4">
                                                        <div class="mt-2">
                                                            <label class="control-label f-20 f-600">Aadhaar Card
                                                                :</label>
                                                            @if ($details->aadhaarcard != null)
                                                                <p class="f-18"> <a
                                                                        href="{{ URL('storage/' . $details->aadhaarcard) }}"
                                                                        target="_blank"><i
                                                                            class="fa fa-eye ms-2 f-black"
                                                                            aria-hidden="true"></i></a>
                                                                </p>
                                                            @else
                                                                <p>-</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @foreach ($details_change as $emp_change)
                                                    @if ($details->e_id == $emp_change->e_id)
                                                        <hr>
                                                        <div class="row">
                                                            <span class="badge badge-success peronal-d-new">New</span>
                                                            <div class="col-md-4">
                                                                <div class="mt-2">
                                                                    <label class="control-label f-20 f-600">Employee
                                                                        Name
                                                                        :</label>
                                                                    <p class="f-18">{{ $emp_change->fname }}
                                                                        {{ $emp_change->mname }}
                                                                        {{ $emp_change->lname }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class=" mt-2">
                                                                    <label class="control-label f-20 f-600">Date of
                                                                        Birth
                                                                        :</label>
                                                                    <p class="f-18">
                                                                        {{ date('d-m-Y', strtotime($emp_change->dob)) }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 ">
                                                                <div class=" mt-2">
                                                                    <label class="control-label f-20 f-600">Nationality
                                                                        :</label>
                                                                    <p class="f-18">{{ $emp_change->nationality }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mt-4">
                                                                <div class=" mt-2">
                                                                    <label class="control-label f-20 f-600">Marital
                                                                        Status
                                                                        :</label>
                                                                    <p class="f-18">{{ $emp_change->marital_status }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mt-4">
                                                                <div class=" mt-2">
                                                                    <label class="control-label f-20 f-600">Gender
                                                                        :</label>
                                                                    <p class="f-18">{{ $emp_change->gender }} </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mt-4">
                                                                <div class=" mt-2">
                                                                    <label class="control-label f-20 f-600">Blood Types
                                                                        :</label>
                                                                    <p class="f-18">{{ $emp_change->bloodtype }} </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mt-4">
                                                                <div class=" mt-2">
                                                                    <label class="control-label f-20 f-600">Phone Number
                                                                        :</label>
                                                                    <p class="f-18">{{ $emp_change->phone }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mt-4">
                                                                <div class="mt-2">
                                                                    <label class="control-label f-20 f-600">Personal
                                                                        Email
                                                                        :</label>
                                                                    <p class="f-18">{{ $emp_change->pemail }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mt-4">
                                                                <div class="mt-2">
                                                                    <label class="control-label f-20 f-600">Aadhaar
                                                                        Card
                                                                        :</label>
                                                                    <p class="f-18"> <a
                                                                            href="{{ URL('storage/' . $emp_change->aadhaarcard) }}"
                                                                            target="_blank"><i
                                                                                class="fa fa-eye ms-2 f-black"
                                                                                aria-hidden="true"></i></a>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col-md-12 d-flex align-items-end justify-content-end">
                                                                <span
                                                                    class="badge badge-success personal-details-badge me-2"
                                                                    data-status="approve"
                                                                    data-id={{ $emp_change->e_id }}>
                                                                    <i class="fa fa-check f-14"
                                                                        aria-hidden="true"></i>
                                                                </span>
                                                                <span class="badge badge-danger personal-details-badge"
                                                                    data-status="reject"
                                                                    data-id={{ $emp_change->e_id }}>
                                                                    <i class="fa fa-times f-14"
                                                                        aria-hidden="true"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                            <hr>

                                            {{-- Education Qualification --}}
                                            <div class="row">
                                                <h2 class="f-600">Education Qualification</h2>
                                            </div>
                                            <hr>
                                            @foreach ($eduction as $qualification)
                                                <div class="border p-3 mb-3 p-relative"
                                                    style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">
                                                    <div class="row mt-3">
                                                        <div class="col-md-4 p-relative">
                                                            @if ($qualification->status === 'Pending')
                                                                <span
                                                                    class="badge badge-warning education-badge-old">Old</span>
                                                                <!-- Badge for old info -->
                                                            @endif
                                                            <div class=" mt-2">
                                                                <label class="control-label f-20 f-600">Qualification
                                                                    :</label>
                                                                <p class="f-18 mt-2">
                                                                    {{ $qualification->qualification }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class=" mt-2">
                                                                <label class="control-label f-20 f-600">University Name
                                                                    :</label>
                                                                <p class="f-18 mt-2">
                                                                    {{ $qualification->university_name }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class=" mt-2">
                                                                <label class="control-label f-20 f-600">Starting Year
                                                                    :</label>
                                                                <p class="f-18 mt-2">
                                                                    {{ date('m-Y', strtotime($qualification->starting_year)) }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 ">
                                                            <div class=" mt-2">
                                                                <label class="control-label f-20 f-600">Ending Year
                                                                    :</label>
                                                                <p class="f-18 mt-2">
                                                                    {{ date('m-Y', strtotime($qualification->ending_year)) }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @foreach ($education_changes as $edq_change)
                                                        @if ($qualification->edq_id === $edq_change->edq_id)
                                                            <hr>
                                                            <div class="row mt-3">
                                                                <div class="col-md-4 p-relative">
                                                                    <span
                                                                        class="badge badge-success education-badge-new">New</span>
                                                                    <div class=" mt-2">
                                                                        <label
                                                                            class="control-label f-20 f-600">Qualification
                                                                            :</label>
                                                                        <p class="f-18 mt-2">
                                                                            {{ $edq_change->qualification }}
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class=" mt-2">
                                                                        <label
                                                                            class="control-label f-20 f-600">University
                                                                            Name
                                                                            :</label>
                                                                        <p class="f-18 mt-2">
                                                                            {{ $edq_change->university_name }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class=" mt-2">
                                                                        <label
                                                                            class="control-label f-20 f-600">Starting
                                                                            Year
                                                                            :</label>
                                                                        <p class="f-18 mt-2">
                                                                            {{ $edq_change->starting_year }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 ">
                                                                    <div class=" mt-2">
                                                                        <label class="control-label f-20 f-600">Ending
                                                                            Year
                                                                            :</label>
                                                                        <p class="f-18 mt-2">
                                                                            {{$edq_change->ending_year }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-md-8 d-flex align-items-end justify-content-end">
                                                                    <span
                                                                        class="badge badge-success education-badge me-2"
                                                                        data-status="approve"
                                                                        data-id={{ $edq_change->edq_id }}>
                                                                        <i class="fa fa-check f-14"
                                                                            aria-hidden="true"></i>
                                                                    </span>
                                                                    <span class="badge badge-danger education-badge"
                                                                        data-status="reject"
                                                                        data-id={{ $edq_change->edq_id }}>
                                                                        <i class="fa fa-times f-14"
                                                                            aria-hidden="true"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endforeach
                                            <hr>
                                            {{-- Address --}}
                                            <div class="row">
                                                <h2 class="f-600">Address</h2>
                                            </div>
                                            <hr>

                                            @foreach ($addresses as $address)
                                                <div class="border p-3 mb-3 p-relative"
                                                    style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <p class="f-20 f-black mb-2 f-600">
                                                                {{ $address->address_type }}
                                                                :
                                                            </p>
                                                        </div>
                                                        <div class="col-md-12 ">
                                                            @if ($address->status == 'Pending')
                                                                <span
                                                                    class="badge badge-warning address-badge-old">Old</span>
                                                                <!-- Badge for old info -->
                                                            @endif
                                                            <div class="mt-2">
                                                                <p class="f-20">{{ $address->apartment_no }},
                                                                    {{ $address->apartment_name }},
                                                                    {{ $address->area }},
                                                                    {{ $address->city }},
                                                                    {{ $address->state }},
                                                                    {{ $address->country }},
                                                                    {{ $address->postal_code }}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @foreach ($addresses_changes as $add_change)
                                                        @if ($address->ad_id == $add_change->ad_id)
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <p class="f-20 f-black mb-2 f-600">
                                                                        {{ $add_change->address_type }}
                                                                        :
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <span
                                                                        class="badge badge-warning address-badge-new">New</span>
                                                                    <div class="mt-2">
                                                                        <p class="f-20">
                                                                            {{ $add_change->apartment_no }},
                                                                            {{ $add_change->apartment_name }},
                                                                            {{ $add_change->area }},
                                                                            {{ $add_change->city }},
                                                                            {{ $add_change->state }},
                                                                            {{ $add_change->country }},
                                                                            {{ $add_change->postal_code }}</p>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-md-1 d-flex align-items-end justify-content-end">
                                                                    <span
                                                                        class="badge badge-success address-badge me-2"
                                                                        data-status="approve"
                                                                        data-id={{ $add_change->ad_id }}>
                                                                        <i class="fa fa-check f-14"
                                                                            aria-hidden="true"></i>
                                                                    </span>
                                                                    <span class="badge badge-danger address-badge"
                                                                        data-status="reject"
                                                                        data-id={{ $add_change->ad_id }}>
                                                                        <i class="fa fa-times f-14"
                                                                            aria-hidden="true"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endforeach
                                            <hr>
                                            {{-- Emergency Contacts --}}
                                            <div class="row">
                                                <h2 class="f-600">Emergency Contacts</h2>
                                            </div>
                                            <hr>

                                            @foreach ($contects as $contect)
                                                <div class="border p-3 mb-3"
                                                    style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">
                                                    <div class="row">
                                                        <div class="col-md-4 p-relative">
                                                            <div class="mt-2">
                                                                <label class="control-label f-20 f-600">Name
                                                                    :</label>
                                                                <p class="f-18">
                                                                    {{ $contect->name }}
                                                                    @if ($contect->status === 'Pending')
                                                                        <span
                                                                            class="badge badge-warning emp-details-badge-old">Old</span>
                                                                        <!-- Badge for old info -->
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mt-2">
                                                                <label class="control-label f-20 f-600">Relationship
                                                                    :</label>
                                                                <p class="f-18">{{ $contect->relationship }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 ">
                                                            <div class="mt-2">
                                                                <label class="control-label f-20 f-600">Mobile
                                                                    :</label>
                                                                <p class="f-18">{{ $contect->phone }}</p>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    @foreach ($contects_changes as $change)
                                                        @if ($contect->ec_id === $change->ec_id)
                                                            <div class="row mt-2">
                                                                <div class="col-md-4 p-relative">
                                                                    <div class="mt-2">
                                                                        <label class="control-label f-20 f-600">
                                                                            Name :</label>
                                                                        <p class="f-18">{{ $change->name }}
                                                                            <span
                                                                                class="badge badge-success emp-details-badge-new">New</span>
                                                                        </p> <!-- Badge for new info -->
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="mt-2">
                                                                        <label class="control-label f-20 f-600">
                                                                            Relationship :</label>
                                                                        <p class="f-18">
                                                                            {{ $change->relationship }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <div class="mt-2">
                                                                                <label
                                                                                    class="control-label f-20 f-600">
                                                                                    Mobile :</label>
                                                                                <p class="f-18">
                                                                                    {{ $change->phone }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col d-flex align-items-end">
                                                                            <span
                                                                                class="badge badge-success emp-details-badge me-2"
                                                                                data-status="approve"
                                                                                data-id={{ $change->ec_id }}>
                                                                                <i class="fa fa-check f-14"
                                                                                    aria-hidden="true"></i>
                                                                            </span>
                                                                            <span
                                                                                class="badge badge-danger emp-details-badge"
                                                                                data-status="reject"
                                                                                data-id={{ $change->ec_id }}>
                                                                                <i class="fa fa-times f-14"
                                                                                    aria-hidden="true"></i>
                                                                            </span>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endforeach
                                            <hr>

                                            {{-- Bank Information --}}
                                            <div class="row">
                                                <h2 class="f-600">Bank Information</h2>
                                            </div>
                                            <hr>
                                            @if ($bank)
                                                <div class="border p-3 mb-3"
                                                    style="box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;">
                                                    <div class="row">
                                                        <div class="col-md-4 p-relative">
                                                            @if ($bank->status === 'Pending')
                                                                <span
                                                                    class="badge badge-warning bank-info-old">Old</span>
                                                                <!-- Badge for old info -->
                                                            @endif
                                                            <div class="mt-2">
                                                                <label class="control-label f-20 f-600">Bank
                                                                    Name:</label>
                                                                <p class="f-18">{{ $bank->bank_name }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mt-2">
                                                                <label class="control-label f-20 f-600">Branch:</label>
                                                                <p class="f-18">{{ $bank->branch }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="mt-2">
                                                                <label class="control-label f-20 f-600">Account
                                                                    Number:</label>
                                                                <p class="f-18">{{ $bank->account_no }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 mt-3">
                                                            <div class="mt-2">
                                                                <label class="control-label f-20 f-600">IFSC
                                                                    Code:</label>
                                                                <p class="f-18">{{ $bank->ifsc_code }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 mt-3">
                                                            <div class="mt-2">
                                                                <label class="control-label f-20 f-600">Pan
                                                                    Number:</label>
                                                                <p class="f-18">{{ $bank->pan_no }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 mt-3">
                                                            <div class="mt-2">
                                                                <label class="control-label f-20 f-600">UAN
                                                                    Number:</label>
                                                                <p class="f-18">{{ $bank->uan_no }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 mt-3">
                                                            <div class="mt-2">
                                                                <label class="control-label f-20 f-600">PF
                                                                    Number:</label>
                                                                <p class="f-18">{{ $bank->pf_no }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @foreach ($bank_changes as $b_change)
                                                        @if ($bank->e_id === $b_change->e_id)
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-4 p-relative">
                                                                    <span
                                                                        class="badge badge-success bank-in-new">New</span>
                                                                    <div class="mt-2">
                                                                        <label class="control-label f-20 f-600">Bank
                                                                            Name:</label>
                                                                        <p class="f-18">
                                                                            {{ $b_change->bank_name }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="mt-2">
                                                                        <label
                                                                            class="control-label f-20 f-600">Branch:</label>
                                                                        <p class="f-18">{{ $b_change->branch }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="mt-2">
                                                                        <label class="control-label f-20 f-600">Account
                                                                            Number:</label>
                                                                        <p class="f-18">
                                                                            {{ $b_change->account_no }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 mt-3">
                                                                    <div class="mt-2">
                                                                        <label class="control-label f-20 f-600">IRSC
                                                                            Code:</label>
                                                                        <p class="f-18">
                                                                            {{ $b_change->ifsc_code }}
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4 mt-3">
                                                                    <div class="mt-2">
                                                                        <label class="control-label f-20 f-600">Pan
                                                                            Number:</label>
                                                                        <p class="f-18">{{ $b_change->pan_no }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 mt-3">
                                                                    <div class="mt-2">
                                                                        <label class="control-label f-20 f-600">UAN
                                                                            Number:</label>
                                                                        <p class="f-18">{{ $b_change->uan_no }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 mt-3">
                                                                    <div class="mt-2">
                                                                        <label class="control-label f-20 f-600">PF
                                                                            Number:</label>
                                                                        <p class="f-18">{{ $b_change->pf_no }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-md-8 d-flex align-items-end justify-content-end">
                                                                    <span
                                                                        class="badge badge-success bank-info-badge me-2"
                                                                        data-status="approve"
                                                                        data-id={{ $b_change->e_id }}>
                                                                        <i class="fa fa-check f-14"
                                                                            aria-hidden="true"></i>
                                                                    </span>
                                                                    <span class="badge badge-danger bank-info-badge"
                                                                        data-status="reject"
                                                                        data-id={{ $b_change->e_id }}>
                                                                        <i class="fa fa-times f-14"
                                                                            aria-hidden="true"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @else
                                                <p>No bank information available.</p>
                                            @endif

                                            <hr>
                                            {{-- Job Details --}}
                                            <h2 class="f-600">Job Details</h2>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class=" mt-2">
                                                        <label class="control-label f-20 f-600">Joined Date
                                                            :</label>
                                                        <p class="f-18">
                                                            {{ date('d-m-Y', strtotime($details->join_date)) }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class=" mt-2">
                                                        <label class="control-label f-20 f-600">Job Category
                                                            :</label>
                                                        <p class="f-18">{{ $details->team }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class=" mt-2">
                                                        <label class="control-label f-20 f-600">Job Title
                                                            :</label>
                                                        <p class="f-18">{{ $details->designation }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mt-4">
                                                    <div class=" mt-2">
                                                        <label class="control-label f-20 f-600">Experience
                                                            :</label>
                                                        <p class="f-18">{{ $details->emp_experience }}</p>
                                                    </div>
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

    {{-- personal details change  --}}
    <script>
        $(document).ready(function() {
            $(document).on('click', '.personal-details-badge', function() {
                let status = $(this).data('status');
                let id = $(this).data('id');

                $.ajax({
                    url: baseUrl() + '/change-personal-details',
                    method: 'POST',
                    data: {
                        id: id,
                        status: status
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
    {{-- address changes --}}
    <script>
        $(document).ready(function() {
            $(document).on('click', '.address-badge', function() {
                let status = $(this).data('status');
                let id = $(this).data('id');

                $.ajax({
                    url: baseUrl() + '/address-details-update',
                    method: 'POST',
                    data: {
                        id: id,
                        status: status
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
    {{-- education change  --}}
    <script>
        $(document).ready(function() {
            $(document).on('click', '.education-badge', function() {
                let status = $(this).data('status');
                let id = $(this).data('id');

                $.ajax({
                    url: baseUrl() + '/education-details',
                    method: 'POST',
                    data: {
                        id: id,
                        status: status
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
    {{-- Emergency Contacts change --}}
    <script>
        $(document).ready(function() {
            $(document).on('click', '.emp-details-badge', function() {
                let status = $(this).data('status');
                let id = $(this).data('id');

                $.ajax({
                    url: baseUrl() + '/change-emergency-contacts',
                    method: 'POST',
                    data: {
                        id: id,
                        status: status
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>

    {{-- Bank Details change --}}
    <script>
        $(document).ready(function() {
            $(document).on('click', '.bank-info-badge', function() {
                let status = $(this).data('status');
                let id = $(this).data('id');

                $.ajax({
                    url: baseUrl() + '/bank-info-change',
                    method: 'POST',
                    data: {
                        id: id,
                        status: status
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });

        function goBack() {
            history.go(-1);
        }
    </script>
</body>

</html>
