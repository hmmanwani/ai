<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Dashboard" />

</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_horizontal-navbar.html -->
        <x-header />
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="row mb-3" id="Progress">
                            <div class="d-flex justify-content-between">
                                @if ($displayData['education_display'] === 1)
                                    <div class="col">
                                        <div class="card">
                                            <p class="f-black f-18 f-700">Education Qualification</p>
                                            <div class="education-qualification progress-bar"><span>Incomplete</span>
                                            </div>
                                            <a href="{{ URL('profile') }}" class="stretched-link"></a>
                                        </div>
                                    </div>
                                @endif
                                @if ($displayData['address_display'] === 1)
                                    <div class="col">
                                        <div class="card">
                                            <p class="f-black f-18 f-700">Address</p>
                                            <div class="address progress-bar"><span>Incomplete</span></div>
                                            <a href="{{ URL('profile') }}#contact-details" class="stretched-link"></a>
                                        </div>
                                    </div>
                                @endif

                                @if ($displayData['emergency_display'] === 1)
                                    <div class="col">
                                        <div class="card">
                                            <p class="f-black f-18 f-700">Emergency Contact</p>
                                            <div class="emergency-contact progress-bar"><span>Incomplete</span></div>
                                            <a href="{{ URL('profile') }}#emergency-contacts"
                                                class="stretched-link"></a>
                                        </div>
                                    </div>
                                @endif
                                @if ($displayData['bank_display'] === 1)
                                    <div class="col">
                                        <div class="card">
                                            <p class="f-black f-18 f-700">Bank Information</p>
                                            <div class="bank-information progress-bar"><span>Incomplete</span></div>
                                            <a href="{{ URL('profile') }}#bank-information" class="stretched-link"></a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Time at Work  --}}
                        <div class="col grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-md-6 a-center">
                                            <div class="d-flex gap-2 ">
                                                <i class="fa fa-clock-o fa-lg f-black"></i>
                                                <h3 class="f-black">Time at Work</h3>
                                            </div>
                                        </div>
                                        <div class="col-md-6 d-flex justify-content-end">
                                            <a href="{{ URL('add-work-report') }}" class="me-2">
                                                <button type="button" class="btn btn-primary">
                                                    <i class="fa fa-plus me-2" aria-hidden="true"></i>Add Work
                                                    Report</button></a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="card-profile d-flex align-items-center mb-2">
                                        <img src="{{ URL('assets/images/logo/logo.png') }}" class="time-work-img"
                                            alt="time-at-work">
                                        <div class="card-profile-record ms-3">
                                            <p class="attendance-card-state ">Clock-In :
                                                <strong>{{ $data->formatted_login_time }}</strong>
                                            </p>
                                            <p class="attendance-card-details ">Clock-Out :
                                                <strong>{{ $data->formatted_logout_time }}</strong>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-md-8">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="current-time ">
                                                        <p class="f-black f-16 f-700">Current Time </p>
                                                        <div class="f-22 f-800" id="printTime"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 working-time">
                                                    <div class="current-time">
                                                        @if (is_null($data->logout_time))
                                                            <div>
                                                                <div class="f-black f-16 f-700">Working Hours:</div>
                                                                <span class="f-22 f-800" id="working-hours">00:00:00</span>
                                                            </div>
                                                        @else
                                                            <p class="f-black f-16 f-700">Working Time:</p>
                                                            <h4 class="f-22 f-800">
                                                                {{ $data->total_working_hours }}
                                                            </h4>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 align-self-center j-end">
                                            <a href="javascript:void(0)" class="btn btn-primary  f-white"
                                                id="clockOut">Clock
                                                Out</a>
                                        </div>
                                        <p class="f-red text-end">Please refresh the page before clocking out.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- leave summary --}}
                        <div class="col grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body pb-0">
                                    <div class="d-flex gap-2 align-items-center ">
                                        <i class="fa fa-bars fa-lg f-black" aria-hidden="true"></i>
                                        <h3 class="f-black">Leave Summary </h3>
                                    </div>
                                    <hr>
                                    <div class="card-profile d-flex align-items-center mb-2">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="card-title">Leave Type</th>
                                                    <th scope="col" class="card-title">Total Leaves</th>
                                                    <th scope="col" class="card-title">Remaining Leaves </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($leavesummary as $data)
                                                    <tr class="mt-1">
                                                        <td class="f-600">{{ $data['leave_type'] }}</td>
                                                        <td>{{ $data['total_leave'] }}</td>
                                                        <td class="{{ $data['reamingleave'] < 0 ? 'f-red' : '' }}">
                                                            {{ $data['reamingleave'] }}
                                                            @if ($loop->first)
                                                                <span class="ms-2">(Monthly)</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-lg-2 grid-margin stretch-card">
                            <a href="javascript:void(0)">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="control-label f-16 f-700 ">Total Employee
                                        </h3>
                                        <div class="text-center">
                                            <p class="f-800 mt-3">Assign by Akshay.</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div> --}}
                    </div>
                    {{-- upcomin holiday --}}
                    <div class="row">
                        <div class="col-md-5  ">
                            <div class="card">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="d-flex gap-2 align-items-center ">
                                                        <i class="fa fa-anchor fa-lg f-black" aria-hidden="true"></i>
                                                        <h3 class="f-black">Upcoming Holiday</h3>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php
                                                if (session()->get('emp_login')['team'] == 1 || session()->get('emp_login')['team'] == 2) { ?>
                                                    <a href="{{ URL('holiday') }}"
                                                        class="d-flex justify-content-end">
                                                        <i class="fa fa-plus f-18 f-black" aria-hidden="true"></i>
                                                    </a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <hr class="mt-3">
                                            @if ($upcomingHolidays)
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h2 class="f-600">
                                                            {{ Str::ucfirst($upcomingHolidays->holiday) }}</h2>
                                                    </div>
                                                    <div class="col-md-6 text-end">
                                                        <h3 class="mb-3 mt-1">
                                                            {{ $upcomingHolidays->date }}
                                                        </h3>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row mb-3">
                                                    <div class="col-md-12 text-center">
                                                        <h3 class="f-600">Full steam ahead, no holidays soon!!</h3>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            {{-- work from home on today  --}}
                            <div class="card mt-4">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="d-flex gap-2 align-items-center ">
                                                <i class="fa fa-home fa-lg f-black" aria-hidden="true"></i>
                                                <h3 class="f-black">On WFH</h3>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <?php
                                                if (session()->get('emp_login')['team'] == 1 || session()->get('emp_login')['team'] == 2) { ?>
                                            @if ($pendingwfh > 0)
                                                <a href="{{ URL('pending-wfh') }}"
                                                    class="d-flex justify-content-end">
                                                    <div class="position-relative ">
                                                        <i class="fa fa-bell f-20 f-black" aria-hidden="true"></i>
                                                        <span
                                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger f-10">
                                                            {{ $pendingwfh }}+
                                                        </span>
                                                    </div>
                                                </a>
                                            @endif
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="row">
                                                @foreach ($permanentwfh as $ptwfh)
                                                    <div class="col-md-3 text-center" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                        data-bs-html="true"
                                                        data-bs-title=" <strong>Permanent</strong> Work From Home">
                                                        <img src="{{ URL('assets/images/logo/logo.png') }}"
                                                            class="img-30 mb-1" alt="work-from-home">
                                                        <p class="f-16">{{ Str::ucfirst($ptwfh->fname) }}
                                                            {{ Str::ucfirst($ptwfh->lname) }}</p>
                                                    </div>
                                                @endforeach
                                                @foreach ($wfhonToday as $todaywfh)
                                                    <div class="col-md-3 text-center" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                        data-bs-html="true"
                                                        data-bs-title="{{ Str::ucfirst($todaywfh->apply_for) }}">
                                                        <img src="{{ URL('assets/images/logo/logo.png') }}"
                                                            class="img-30 mb-1" alt="work-from-home">
                                                        <p class="f-16">{{ Str::ucfirst($todaywfh->fname) }}
                                                            {{ Str::ucfirst($todaywfh->lname) }}</p>
                                                    </div>
                                                @endforeach
                                                @if ($permanentwfh->isEmpty() && $wfhonToday->isEmpty())
                                                    <div class="row mb-3">
                                                        <div class="col-md-12 text-center">
                                                            <h3 class="f-600">No one is working from home!!</h3>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- leave on today  --}}
                            <div class="card mt-4">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="d-flex gap-2 align-items-center ">
                                                <i class="fa fa-sign-out fa-lg f-black" aria-hidden="true"></i>
                                                <h3 class="f-black">On Leave</h3>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                                if (session()->get('emp_login')['team'] == 1 || session()->get('emp_login')['team'] == 2) { ?>
                                            @if ($pendingleave > 0)
                                                <a href="{{ URL('pending-leave') }}"
                                                    class="d-flex justify-content-end">
                                                    <div class="position-relative">
                                                        <i class="fa fa-bell f-20 f-black" aria-hidden="true"></i>
                                                        <span
                                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger f-10">
                                                            {{ $pendingleave }}+
                                                        </span>
                                                    </div>
                                                </a>
                                            @endif
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="row">
                                                @forelse ($leaveonToday as $todayleave)
                                                    <div class="col-md-3 mb-3 text-center" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                        data-bs-html="true"
                                                        data-bs-title="{{ Str::ucfirst($todayleave->leave_for) }}">
                                                        <img src="{{ URL('assets/images/logo/logo.png') }}"
                                                            class="img-30 mb-1" alt="leave-on-today">
                                                        <p class="f-16">{{ Str::ucfirst($todayleave->fname) }}
                                                            {{ Str::ucfirst($todayleave->lname) }}</p>
                                                    </div>
                                                @empty
                                                    <div class="row mb-3">
                                                        <div class="col-md-12 text-center">
                                                            <h3 class="f-600"> It's all hands on deck today!!!</h3>
                                                        </div>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="row">
                                @if ($showtask == 1)
                                    <div class="col-md-12 mb-3">
                                        <a href="{{ URL('manage-task') }}">
                                            <div class="card">
                                                <div class="card-body pb-0">
                                                    <div class="d-flex gap-2 align-items-center ">
                                                        <i class="fa fa-bars fa-lg f-black" aria-hidden="true"></i>
                                                        <h3 class="f-black">Assign Task</h3>
                                                    </div>
                                                    <hr>
                                                    <div class="card-profile text-center mb-3">
                                                        <h3>You have assign new task.</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                                <div class="col" id="nav-tabe">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs myTab" id="myTab" role="tablist">
                                                <!-- Upcoming tab -->
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="today-tab"
                                                        data-bs-toggle="tab" data-bs-target="#today-tab-pane"
                                                        type="button" role="tab" aria-controls="today-tab-pane"
                                                        aria-selected="true">
                                                        <h3>Today</h3>
                                                    </button>
                                                </li>
                                                <!-- Today tab -->
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link " id="upcoming-tab" data-bs-toggle="tab"
                                                        data-bs-target="#upcoming-tab-pane" type="button"
                                                        role="tab" aria-controls="upcoming-tab-pane"
                                                        aria-selected="false">
                                                        <h3>Upcoming</h3>
                                                    </button>
                                                </li>
                                            </ul>
                                            <!-- Tab content -->
                                            <div class="tab-content" id="myTabContent">
                                                <!-- Today tab content -->
                                                <div class="tab-pane fade show active" id="today-tab-pane"
                                                    role="tabpanel" aria-labelledby="today-tab" tabindex="0">
                                                    <div>
                                                        <ul class="nav nav-tabs tab-no-active-fill" role="tablist">
                                                            <li class="nav-item">
                                                                <a class="nav-link active ps-2 pe-2 f-600"
                                                                    id="today-birthdays-tab" data-bs-toggle="tab"
                                                                    href="#today-birthdays" role="tab"
                                                                    aria-controls="today-birthdays"
                                                                    aria-selected="true">Birthdays</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link ps-2 pe-2 f-600"
                                                                    id="work-anniversary-tab" data-bs-toggle="tab"
                                                                    href="#work-anniversary" role="tab"
                                                                    aria-controls="work-anniversary"
                                                                    aria-selected="false">Work
                                                                    Anniversary</a>
                                                            </li>
                                                        </ul>
                                                        <div class="tab-content tab-no-active-fill-tab-content p-0">
                                                            <!-- Birthdays tab -->
                                                            <div class="tab-pane fade show active"
                                                                id="today-birthdays" role="tabpanel"
                                                                aria-labelledby="today-birthdays-tab">
                                                                <div class="row">
                                                                    <!-- Display today's birthdays -->
                                                                    @forelse ($employees as $employee)
                                                                        <div class="col-md-3 text-center">
                                                                            <img src="{{ URL('assets/images/logo/logo.png') }}"
                                                                                class="img-30 mb-1"
                                                                                alt="today-birthday">
                                                                            <p class="f-16">
                                                                                {{ $employee->fname }}
                                                                                {{ $employee->lname }}
                                                                            </p>
                                                                        </div>
                                                                        @if ($loop->last)
                                                                            <!-- Last employee message -->
                                                                            <h3
                                                                                class="d-flex justify-content-center mt-3 mb-3 f-600">
                                                                                Yay!&#129395; You may get a party today.
                                                                            </h3>
                                                                        @endif
                                                                    @empty
                                                                        <!-- No birthdays message -->
                                                                        <h3
                                                                            class="d-flex he-100 justify-content-center align-items-center f-600">
                                                                            Oh no,&#128546; there will be no party
                                                                            today!!
                                                                        </h3>
                                                                    @endforelse
                                                                </div>
                                                            </div>
                                                            <!-- Work anniversary tab -->
                                                            <div class="tab-pane fade" id="work-anniversary"
                                                                role="tabpanel"
                                                                aria-labelledby="work-anniversary-tab">
                                                                <div class="row">
                                                                    <!-- Display work anniversaries -->
                                                                    @forelse ($workanniversaryes as $workanniversary)
                                                                        <div class="col-md-3 text-center">
                                                                            <img src="{{ URL('assets/images/logo/logo.png') }}"
                                                                                class="img-30 mb-1"
                                                                                alt="today-workanniversary">
                                                                            <p class="f-16">
                                                                                {{ $workanniversary->fname }}
                                                                                {{ $workanniversary->lname }}
                                                                            </p>
                                                                        </div>
                                                                    @empty
                                                                        <!-- No work anniversaries message -->
                                                                        <h3
                                                                            class="d-flex he-100 justify-content-center align-items-center f-600">
                                                                            No Work Anniversary Today!!
                                                                        </h3>
                                                                    @endforelse
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Upcoming tab content -->
                                                <div class="tab-pane fade " id="upcoming-tab-pane" role="tabpanel"
                                                    aria-labelledby="upcoming-tab" tabindex="0">
                                                    <div>
                                                        <ul class="nav nav-tabs tab-no-active-fill" role="tablist">
                                                            <li class="nav-item">
                                                                <a class="nav-link active ps-2 pe-2 f-600"
                                                                    id="upcoming-birthdays-tab" data-bs-toggle="tab"
                                                                    href="#upcoming-birthdays" role="tab"
                                                                    aria-controls="upcoming-birthdays"
                                                                    aria-selected="true">Birthdays</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link ps-2 pe-2 f-600"
                                                                    id="upcoming-work-anniversary-tab"
                                                                    data-bs-toggle="tab"
                                                                    href="#upcoming-work-anniversary" role="tab"
                                                                    aria-controls="upcoming-work-anniversary"
                                                                    aria-selected="false">Work Anniversary</a>
                                                            </li>
                                                        </ul>

                                                        <div class="tab-content tab-no-active-fill-tab-content p-0">
                                                            <div class="tab-pane fade show active"
                                                                id="upcoming-birthdays" role="tabpanel"
                                                                aria-labelledby="upcoming-birthdays-tab">
                                                                <div class="row">
                                                                    <!-- Display upcoming birthdays -->
                                                                    @if ($upcomingBirthdays)
                                                                        <!-- Check if there is a result -->
                                                                        <div
                                                                            class="col-md-3 text-center employee-card">
                                                                            <span class="custom-tooltip"
                                                                                data-toggle="tooltip"
                                                                                data-placement="bottom"
                                                                                title="{{ $upcomingBirthdays->dob }}">
                                                                                <img src="{{ URL('assets/images/logo/logo.png') }}"
                                                                                    class="img-30 mb-1 blur-image"
                                                                                    alt="upcoming-birthday">
                                                                                <p class="f-16 blur-image">
                                                                                    {{ $upcomingBirthdays->fname }}
                                                                                    {{ $upcomingBirthdays->lname }}
                                                                                </p>
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <!-- No upcoming birthdays message -->
                                                                        <h3
                                                                            class="d-flex he-100 justify-content-center align-items-center f-600">
                                                                            Oh no,&#128546; there will be no party
                                                                            upcoming!!
                                                                        </h3>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="tab-pane fade" id="upcoming-work-anniversary"
                                                                role="tabpanel"
                                                                aria-labelledby="upcoming-work-anniversary-tab">
                                                                <div class="row">
                                                                    @if ($upcomingworkanniversary)
                                                                        <div class="col-md-3 text-center">
                                                                            <span class="custom-tooltip"
                                                                                data-toggle="tooltip"
                                                                                data-placement="bottom"
                                                                                title="{{ $upcomingworkanniversary->formatted_join_date }}">
                                                                                <img src="{{ URL('assets/images/logo/logo.png') }}"
                                                                                    class="img-30 mb-1"
                                                                                    alt="upcoming-workanniversary">
                                                                                <p class="f-16">
                                                                                    {{ $upcomingworkanniversary->fname }}
                                                                                    {{ $upcomingworkanniversary->lname }}
                                                                                </p>
                                                                            </span>
                                                                        </div>
                                                                    @else
                                                                        <h3
                                                                            class="d-flex he-100 justify-content-center align-items-center f-600">
                                                                            No Work Anniversary Upcoming!!
                                                                        </h3>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    <div class="modal" tabindex="-1" id="clockOutModal" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title f-800">Clock Out</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('clockout') }}" method="POST" id="myForm">
                    @csrf
                    <div class="modal-body">
                        <p class="f-22 mb-3">Are you sure you want to clock out? This action can't be reversed.</p>
                        <div class="d-flex">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="leave_option" id="checkboxOption1" value="2">
                                <label class="f-18 f-500 form-check-label" for="checkboxOption1">
                                    Early Leave
                                </label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" type="checkbox" name="leave_option" id="checkboxOption2" value="1">
                                <label class="f-18 f-500 form-check-label" for="checkboxOption2">
                                    Fun Friday
                                </label>
                            </div>
                        </div>
                        <div class="form-group mb-3" id="reason-container" style="display: none;">
                            <label class="control-label required">
                                Reason</label>
                            <textarea class="form-control h-100" name="reason" id="reason" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary f-white">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-footer />
    <script>
        // Ensure correct format and treat as a real past datetime
        let loginTime = new Date("{{ $time }}");
        
        setInterval(() => {
            let now = new Date();
            let totalSeconds = Math.floor((now - loginTime) / 1000); // Difference in seconds
    
            let hours = String(Math.floor(totalSeconds / 3600)).padStart(2, '0');
            let minutes = String(Math.floor((totalSeconds % 3600) / 60)).padStart(2, '0');
            let seconds = String(totalSeconds % 60).padStart(2, '0');
    
            document.getElementById('working-hours').innerText = `${hours}:${minutes}:${seconds}`;
        }, 1000);
    </script>
    <script>
        $(document).ready(function() {
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
    </script>
    <script>
        function closeBirthdayPopup() {
            var modalElement = document.getElementById('birthdayModal');
            var modal = new bootstrap.Modal(modalElement);
            modal.hide();

            // Ajax request to destroy session
            fetch("{{ route('destroyBirthdayPopupSession') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({}),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        console.log('Session destroyed successfully.');
                    } else {
                        console.error('Failed to destroy session.');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip({});
        });
    </script>
    <script>
        var date = new Date();
        const elementTime = document.getElementById("printTime");

        function printTime() {
            date = new Date();
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var seconds = date.getSeconds();
            if (seconds < 10) {
                seconds = "0" + seconds;
            }
            if (minutes < 10) {
                minutes = "0" + minutes;
            }
            if (hours > 12) {
                hours = hours - 12;
                elementTime.innerHTML = hours + ":" + minutes + ":" + seconds + " PM ";
            } else if (hours < 12) {
                elementTime.innerHTML = hours + ":" + minutes + ":" + seconds + " AM ";
            } else if (hours = 12) {
                elementTime.innerHTML = hours + ":" + minutes + ":" + seconds + " PM ";
            }
        }
        setInterval(function() {
            printTime();
        }, 1000);
    </script>
    <script>
        $('#clockOut').click(function() {
            $('#clockOutModal').modal('show');
        })

        // Check the state of the checkbox and show/hide the reason field
        $(document).ready(function() {
    $('input[name="leave_option"]').change(function() {
        $('input[name="leave_option"]').not(this).prop('checked', false); // Uncheck other checkboxes

        if ($('#checkboxOption1').prop('checked')) {
            $('#reason-container').show();
        } else {
            $('#reason-container').hide();
            $('textarea[name="reason"]').val('');
        }
    });
});

    </script>
    <script>
        function goBack() {
            window.history.back();
        }

        $(document).ready(function() {
            $("#myForm").validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                rules: {
                    starting_time: {
                        required: true
                    },
                    ending_time: {
                        required: true
                    },
                    reason: {
                        required: true
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
                    form.submit();
                }
            });
        });
    </script>
</body>

</html>
