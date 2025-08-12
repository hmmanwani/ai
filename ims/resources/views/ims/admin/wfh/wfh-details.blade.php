<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Admin WFH Details" />
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
                                                    <h1 class= "">WFH Details</h1>
                                                </div>

                                                <div class="col-md-6">
                                                    @if ($details[0]->status != 'Pending')
                                                        <div class="d-flex justify-content-end me-2">
                                                            @if ($details[0]->status == 'Approve')
                                                                <h3 class="badge f-20 bg-success">Approved</h3>
                                                            @elseif ($details[0]->status == 'Reject')
                                                                <h3 class="badge f-20 bg-warning f-black">Rejected</h3>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <input type="hidden" id="wfh_id"
                                                            value="{{ $details[0]->wfh_id }}">
                                                        <select name="status" id="status" class="form-select">
                                                            <option value="Pending"
                                                                {{ $details[0]->status == 'Pending' ? 'selected' : '' }}>
                                                                Pending</option>
                                                            <option value="Reject"
                                                                {{ $details[0]->status == 'Reject' ? 'selected' : '' }}>
                                                                Reject</option>
                                                            <option value="Approve"
                                                                {{ $details[0]->status == 'Approve' ? 'selected' : '' }}>
                                                                Approve</option>
                                                            <input type="hidden" id="wfh_date"
                                                                value="{{ $details[0]->wfh_date }}">
                                                        </select>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr>

                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="d-flex mt-2">
                                                        <label class="f-18 f-700">Request By :</label>
                                                        <span class="f-18 f-700 f-black ms-2">{{ $details[0]->e_fname }}
                                                            {{ $details[0]->e_lname }} </span>
                                                    </div>
                                                    <div class="d-flex mt-2">
                                                        <label class="f-18 f-700">WFH Date :</label>
                                                        <span
                                                            class="f-18 f-700 f-black ms-2">{{ date('d-m-Y', strtoTime($details[0]->wfh_date)) }}</span>
                                                    </div>
                                                    <div class="d-flex mt-2">
                                                        <label class="f-18 f-700">Apply For :</label>
                                                        <span
                                                            class="f-18 f-700 f-black ms-2">{{ $details[0]->apply_for }}</span>
                                                    </div>
                                                    <div class="d-flex mt-2">
                                                        <label class="f-18 f-700">Responsible Person :</label>
                                                        <span class="f-18 f-700 f-black ms-2">{{ $details[0]->r_fname }}
                                                            {{ $details[0]->r_lname }}</span>
                                                    </div>
                                                    <div class="d-flex mt-2">
                                                        <label class="f-18 f-700">Reason :</label>
                                                        <span
                                                            class="f-18 f-700 f-black ms-2">{{ $details[0]->apply_reason }}</span>
                                                    </div>
                                                    @if ($details[0]->document != null)
                                                        <div class="d-flex mt-2">
                                                            <label class="f-18 f-700">Document :</label>
                                                            <a href="{{ URL('storage/' . $details[0]->document) }}"
                                                                target="_blank"><i class="fa fa-eye"
                                                                    aria-hidden="true"></i></a>
                                                        </div>
                                                    @endif
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
        function goBack() {
            window.history.back();
        }

        $("#status").on("change", function() {
            $status = $(this).val();
            $id = $('#wfh_id').val();
            $date = $('#wfh_date').val();
            $.ajax({
                url: baseUrl() + "/update-wfh-status",
                type: "post",
                data: {
                    _token: csrf(),
                    status: $status,
                    wfh_id: $id,
                    date: $date,
                },
                success: function(res) {
                    location.reload();
                }
            });
        });
    </script>
</body>

</html>
