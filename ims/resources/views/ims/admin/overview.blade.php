<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | OverView" />

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
                    <section id="admin">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-3">
                                    <x-admin-sidebar />
                                </div>
                                <div class="col-md-9">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="heading">
                                                <h2>Overview</h2>
                                            </div>
                                            <hr>
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <a href="{{ URl('employee') }}">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h3 class="control-label f-16 f-700 ">Total Employee
                                                                </h3>
                                                                <div class="text-center">
                                                                    <h1 class="f-800 mt-3">{{ $totalEmployees }}</h1>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col-md-3">
                                                    <a href="{{ URl('pending-leave') }}">
                                                        <div class="card ">
                                                            <div class="card-body">
                                                                <h3 class="control-label f-16 f-700">Pending Leave</h3>
                                                                <div class="text-center">
                                                                    <h1 class="f-800 mt-3">{{ $pendingleave }}</h1>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col-md-3">
                                                    <a href="{{ URl('pending-wfh') }}">
                                                        <div class="card ">
                                                            <div class="card-body">
                                                                <h3 class="control-label f-16 f-700">Pending WFH
                                                                </h3>
                                                                <div class="text-center">
                                                                    <h1 class="f-800 mt-3">{{ $pendingwfh }}</h1>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col-md-3">
                                                    <a href="{{ URl('approve-extra-time') }}">
                                                        <div class="card ">
                                                            <div class="card-body">
                                                                <h3 class="control-label f-16 f-700">Pending Overtime
                                                                </h3>
                                                                <div class="text-center">
                                                                    <h1 class="f-800 mt-3">{{ $pendingextratime }}
                                                                    </h1>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class=" row col-md-3">
                                                <a href="{{ URl('team') }}">
                                                    <div class="card ">
                                                        <div class="card-body">
                                                            <h3 class="control-label f-16 f-700">Total Team</h3>
                                                            <div class="text-center">
                                                                <h1 class="f-800 mt-3">{{ $totalTeam }}</h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
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
</body>

</html>
