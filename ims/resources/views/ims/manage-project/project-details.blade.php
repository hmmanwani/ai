<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Project Details" />
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
                    {{-- {{ $data }} --}}
                    <section>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h2 class="f-700">Project Details</h2>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end"><button
                                                        onclick="goBack()" class="btn btn-primary"><i
                                                            class="fa fa-arrow-left me-2"
                                                            aria-hidden="true"></i>Back</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mt-2">
                                                        <label class="control-label f-18  f-600">Project Title
                                                            :</label>
                                                        <p class="f-20 f-black f-700  ">{{ $data->project_title }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mt-2">
                                                        <label class="control-label f-18  f-600">Start Date
                                                            :</label>
                                                        <p class="f-20 f-black f-700">
                                                            {{ date('d-m-Y', strtotime($data->start_date)) }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="mt-2">
                                                        <label class="control-label f-18  f-600">End Date
                                                            :</label>
                                                        <p class="f-20 f-black f-700">
                                                            {{ date('d-m-Y', strtotime($data->end_date)) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                @if ($data->supportive_link)
                                                    <div class="col-md-6">
                                                        <div class="mt-2">
                                                            <label class="control-label f-18  f-600">Supportive
                                                                Link
                                                                :</label>
                                                            <p class="f-20 f-black f-700">
                                                                {{ $data->supportive_link }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="col-md-12 mt-3">
                                                    <div class="form-group">
                                                        <label class="control-label f-18  f-600">Project
                                                            Description</label>
                                                        <div class="f-black f-600">
                                                            <?php echo $data->project_description; ?> </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mt-3">
                                                    <label class="control-label f-18  f-600">Project
                                                        Leads:</label>
                                                    <div class="row ">
                                                        <div class="col-md-12">
                                                            @if ($groupedEmployees->isNotEmpty())
                                                                <ul class="list-unstyled mb-1">
                                                                    @foreach ($groupedEmployees as $team => $employees)
                                                                        @foreach ($employees as $emp)
                                                                            <li>
                                                                                <div class="f-16 f-black f-700">
                                                                                    {{ $emp->fname }}
                                                                                    {{ $emp->lname }} - <b
                                                                                        class="f-title2">{{ $team }}</b>
                                                                                </div>
                                                                            </li>
                                                                        @endforeach
                                                                    @endforeach
                                                                </ul>
                                                            @else
                                                                <p>Not assigned to anyone.</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <div class="row">
                                                        <label class="control-label f-18  f-600">Other Project
                                                            Members:</label>
                                                        <div class="col-md-12">
                                                            @if ($sub_groupedEmployees->isNotEmpty())
                                                                @foreach ($sub_groupedEmployees as $steam => $semployees)
                                                                    <ul class="list-unstyled mb-1">
                                                                        @foreach ($semployees as $semp)
                                                                            <li>
                                                                                <div class="f-16 f-black f-700">
                                                                                    {{ $semp->fname }}
                                                                                    {{ $semp->lname }} - <b
                                                                                        class="f-title2">{{ $steam }}</b>
                                                                                </div>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endforeach
                                                            @else
                                                                <p>Not assigned to anyone.</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <span
                                                class="f-18 f-700 f-black ms-2">{!! strip_tags($data->project_description) !!}</span> --}}
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
        function goBack() {
            window.history.back();
        }
    </script>

</body>

</html>
