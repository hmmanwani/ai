<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Admin Resignation Details" />
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
                    <section id="">
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
                                                    <h1>Resignation Details</h1>
                                                </div>

                                                <div class="col-md-6">
                                                    @if ($data->status != 'Pending')
                                                        <div class="d-flex justify-content-end me-2">
                                                            @if ($data->status == 'Approve')
                                                                <h3 class="badge f-20 bg-success">Approved</h3>
                                                            @elseif ($data->status == 'Reject')
                                                                <h3 class="badge f-20 bg-warning f-black">Rejected
                                                                </h3>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <input type="hidden" id="r_id"
                                                            value="{{ $data->r_id }}">
                                                        <input type="hidden" id="e_id"
                                                            value="{{ $data->e_id }}">
                                                        <select name="status" id="status" class="form-select">
                                                            <option value="Pending"
                                                                {{ $data->status == 'Pending' ? 'selected' : '' }}>
                                                                Pending</option>
                                                            <option value="Reject"
                                                                {{ $data->status == 'Reject' ? 'selected' : '' }}>
                                                                Reject</option>
                                                            <option value="Approve"
                                                                {{ $data->status == 'Approve' ? 'selected' : '' }}>
                                                                Approve</option>
                                                        </select>
                                                    @endif
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="d-flex mt-2">
                                                        <label class="f-18 f-700">Resignation By :</label>
                                                        <span class="f-18 f-black f-700 ms-2">{{ $data->fname }}
                                                            {{ $data->lname }}</span>
                                                    </div>
                                                    <div class="d-flex mt-2">
                                                        <label class="f-18 f-700">Resignation Date :</label>
                                                        <span
                                                            class="f-18 f-black f-700 ms-2">{{ date('d-m-Y', strtotime($data->date)) }}</span>
                                                    </div>
                                                    <div class="d-flex mt-2">
                                                        <label class="f-18 f-700">Resignation reason :</label>
                                                        <span class="f-18 f-black f-700 ms-2">{{ $data->reason }}</span>
                                                    </div>
                                                    <div class="d-flex mt-2">
                                                        <label class="f-18 f-700"> description:</label>
                                                        <span
                                                            class="f-18 f-black f-700 ms-2">{{ $data->description }}</span>
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
    <script>
        function goBack() {
            history.go(-1);
        }

        $("#status").on("change", function() {
            $status = $(this).val();
            $id = $('#r_id').val();
            $.ajax({
                url: baseUrl() + "/approve-resignation",
                type: "post",
                data: {
                    _token: csrf(),
                    status: $status,
                    r_id: $id,
                },
                success: function(res) {
                    location.reload();
                }
            });
        });
    </script>
</body>

</html>
