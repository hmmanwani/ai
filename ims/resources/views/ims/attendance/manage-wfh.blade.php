<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Manage Work From Home" />
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
                    <section>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h2 class="card-title mb-0 f-24">Explore Work From Home</h2>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <a href="{{ url('work-from-home') }}">
                                                        <button type="button" class="btn btn-primary f-700">
                                                            Add WFH</button></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="startDate"
                                                                    class="f-black f-18 f-700">From:</label>
                                                                <input type="text" id="startDate"
                                                                    class="form-select flatpickr">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="endDate"
                                                                    class="f-black f-18 f-700">To:</label>
                                                                <input type="text" id="endDate"
                                                                    class="form-select flatpickr">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-md-12 d-flex align-items-center justify-content-center ">
                                                    <div class="form-group mb-0 d-flex">
                                                        <div class="Sreach">
                                                            <a href="javascript:void(0)" id="search"
                                                                class="btn btn-skyblue f-black">Search</a>
                                                            <a onclick="reload()" id="reset"
                                                                class="btn btn-danger f-black" style="display: none;">
                                                                Reset
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="e_id" value="<?= $e_id ?>">
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body ">
                                            <table id="table_wfh" class="table table-bordered table-striped f-black ">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>WFH Type</th>
                                                        <th>WFH Date</th>
                                                        <th>WFH Details</th>
                                                        <th>Responsible person</th>
                                                        <th>WFH Status</th>
                                                        <th>WFH Requested at</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    {{-- End Start Design --}}
                </div>
                <!-- partial:partials/_footer.html -->
                <x-footer-con />
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    {{-- WFH details modal  --}}
    <div class="modal" tabindex="-1" id="WFHDetails" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">WFH Details : <span class="f-black f-700" id="date"></span> </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex mb-3">
                                        <label class="f-18 f-600">Apply For :</label>
                                        <span class="f-18 f-700 f-black ms-2" id="ApplyFor"></span>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <label class="f-18 f-600">Responsible Person :</label>
                                        <span class="f-18 f-700 f-black ms-2" id="resPonsible"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex mb-3">
                                        <label class="f-18 f-600">Request At :</label>
                                        <span class="f-18 f-700 f-black ms-2" id="requestAt"></span>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <label class="f-18 f-600">Status :</label>
                                        <span class="f-18 f-700 f-black ms-2" id="StatUs"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <label class="f-18 f-600">WFH Reason :</label>
                                <span class="f-18 f-700 f-black ms-2" id="reAson"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-footer />
    {{-- wfh details code  --}}
    <script>
        $('body').on('click', 'a[id^="wfh-details_"]', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '{{ url('wfh-info') }}',
                method: 'POST',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // starting time
                    console.log(response.data);

                    if (response.data) {
                        $('#date').text(response.data.wfh_date);
                        $('#ApplyFor').text(response.data.apply_for);
                        $('#resPonsible').text(response.data.responsible);
                        $('#requestAt').text(response.data.created);
                        $('#reAson').text(response.data.apply_reason);
                        $('#StatUs').text(response.data.status);

                        // Show the modal
                        $('#WFHDetails').modal('show');
                    } else {
                        console.error('No data found in response');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var today = new Date();
            flatpickr('.flatpickr', {
                dateFormat: 'd-m-Y',
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            let toDatePicker = $('#endDate').flatpickr({
                dateFormat: "d-m-Y"
            });

            $('#startDate').flatpickr({
                dateFormat: "d-m-Y",
                onChange: function(selectedDates, dateStr, instance) {
                    let minDate = dateStr;
                    toDatePicker.set('minDate', minDate);
                }
            });

            assignData();
        });
    </script>
    {{-- filter and datatable  --}}
    <script>
        function toggleResetButton() {
            if ($('#startDate').val() || $('#endDate').val()) {
                $('#reset').show();
            } else {
                $('#reset').hide();
            }
        }

        function reload() {
            $('#startDate').val('');
            $('#endDate').val('');
            assignData();
            toggleResetButton();
        }

        $('#search').click(function() {
            assignData();
            toggleResetButton();
        });
        $(document).ready(function() {
            assignData();
        });

        function assignData() {
            $('#table_wfh').DataTable().destroy();
            let filter = {};
            filter['e_id'] = $('#e_id').val();
            filter['s_date'] = $('#startDate').val();
            filter['e_date'] = $('#endDate').val();
           ajaxDataTableInit(baseUrl() + '/get-user-wfh', 'table_wfh', 0, 0, filter, "", false);
        }
        
    </script>
</body>


</html>
