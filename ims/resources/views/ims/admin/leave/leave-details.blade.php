<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS Admin Leave Details" />
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
                                    <div class="d-flex justify-content-end">
                                        <button onclick="goBack()" class="btn btn-primary"><i class="fa fa-arrow-left me-2"
                                                aria-hidden="true"></i>Back</button>
                                    </div>
                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h1 class="f-600 f-base">Leave Details</h1>
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
                                                        <input type="hidden" id="lv_id"
                                                            value="{{ $details[0]->lv_id }}">
                                                        <input type="hidden" id="e_id"
                                                            value="{{ $details[0]->e_id }}">
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
                                                            <input type="hidden" id="leave_date"
                                                                value="{{ $details[0]->leave_date }}">
                                                        </select>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="d-flex mt-2">
                                                        <label class="f-18 f-600">Leave By :</label>
                                                        <span class="f-18 f-700 f-black ms-2">{{ $details[0]->e_fname }}
                                                            {{ $details[0]->e_lname }}</span>
                                                    </div>
                                                    <div class="d-flex mt-2">
                                                        <label class="f-18 f-600">Leave Type :</label>
                                                        <span
                                                            class="f-18 f-700 f-black ms-2">{{ $details[0]->leave_for }}</span>
                                                    </div>
                                                    <div class="d-flex mt-2">
                                                        <label class="f-18 f-600">Leave Date :</label>
                                                        <span
                                                            class="f-18 f-700 f-black ms-2">{{ date('d-m-Y', strtotime($details[0]->leave_date)) }}</span>
                                                    </div>
                                                    <div class="d-flex mt-2">
                                                        <label class="f-18 f-600">Leave Type :</label>
                                                        <span
                                                            class="f-18 f-700 f-black ms-2">{{ $details[0]->leaveName }}</span>
                                                    </div>
                                                    <div class="d-flex mt-2">
                                                        <label class="f-18 f-600">Responsible Person :</label>
                                                        <span
                                                            class="f-18 f-700 f-black ms-2">{{ $details[0]->r_fname }}
                                                            {{ $details[0]->r_lname }}</span>
                                                    </div>
                                                    <div class="d-flex mt-2">
                                                        <label class="f-18 f-600">Reason :</label>
                                                        <span
                                                            class="f-18 f-700 f-black ms-2">{{ $details[0]->leave_reason }}</span>
                                                    </div>
                                                    @if ($details[0]->document != null)
                                                        <div class="d-flex mt-2">
                                                            <label class="f-18 f-600">Document :</label>
                                                            <a href="{{ URL('storage/' . $details[0]->document) }}"
                                                                target="_blank"><i class="fa fa-eye ms-2 f-black"
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
        // back button
        function goBack() {
            history.go(-1);
        }

        $("#status").on("change", function() {
            $status = $(this).val();
            $id = $('#lv_id').val();
            $e_id = $('#e_id').val();
            $date = $('#leave_date').val();
            $.ajax({
                url: baseUrl() + "/update-leave-status",
                type: "post",
                data: {
                    _token: csrf(),
                    status: $status,
                    lv_id: $id,
                    e_id: $e_id,
                    leave_date: $date,
                },
                success: function(res) {
                    location.reload();
                }
            });
        });
    </script>
</body>

</html>
