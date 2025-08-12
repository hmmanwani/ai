<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Daily Work Report" />
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
                                    <div class="card f-black">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h2 class="f-700">Daily Work Report</h2>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <a href="{{ URL('add-work-report') }}" class="me-2">
                                                        <button type="button" class="btn btn-primary">
                                                            <i class="fa fa-plus me-2"
                                                                aria-hidden="true"></i>Add</button></a>
                                                    @if ($show_project_task == 1)
                                                        <a href="{{ URL('internal-team-access') }}">
                                                            <button type="button" class="btn btn-primary">
                                                                <i class="fa fa-users"
                                                                    aria-hidden="true"></i></button></a>
                                                        <a href="{{ URL('work-email-setting') }}" class="ms-2">
                                                            <button type="button" class="btn btn-primary">
                                                                <i class="fa fa-cog"
                                                                    aria-hidden="true"></i></button></a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row mb-5">
                                                        @if ($emp && !$emp->isEmpty())
                                                            <div class="col-md-6">
                                                                <label for="name" class="f-black f-18 f-700">Select
                                                                    Employee:</label>
                                                                <select class="form-select mt-2 " id="Empdata"
                                                                    aria-label="Default select example">
                                                                    <option value="">Select Employee
                                                                    </option>
                                                                    @foreach ($emp as $emps)
                                                                        <option class="f-18"
                                                                            value="{{ $emps->e_id }}">
                                                                            {{ $emps->full_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endif

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="f-black f-18 f-700">Select
                                                                    Date</label>
                                                                <div class="col-md-12">
                                                                    <input type="text" id="date" name="date"
                                                                        class="form-control" title="Leave Date"
                                                                        placeholder="d-m-Y">
                                                                </div>
                                                            </div>
                                                        </div>
                                                                <div
                                                                    class="col-md-6 d-flex align-items-center justify-content-center">
                                                        <div class="form-group mb-0">
                                                            <div class="Sreach">
                                                                <a href="javascript:void(0)" id="search"
                                                                    class="btn btn-skyblue f-black">Search</a>
                                                                <a onclick="reload()" id="reset"
                                                                    class="btn btn-danger f-black">Reset</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                {{-- table  --}}
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <table id="Worklist"
                                                            class="table table-bordered table-striped f-black">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th>No.</th>
                                                                    <th>Name</th>
                                                                    <th>Team</th>
                                                                    <th>Date</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="WorkDetails">

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
        $(document).on('click', '#reset', function() {
            $('#WorkDetails').html('');
        });
        $(document).on('click', '#search', function() {
            $('#WorkDetails').html('');
        });

        $(document).on('click', 'a[id^="Work-details_"]', function() {
            var id = $(this).data('id');
            var date = $(this).data('date');

            $.ajax({
                url: '{{ url('work-info') }}', // Make sure the route is correct
                method: 'POST',
                data: {
                    id: id,
                    date: date,
                    _token: '{{ csrf_token() }}'
                },

                success: function(response) {
                    if (response.data && response.data.length > 0) {
                        var htmlContent = '';
                        // Loop through the response data array
                        response.data.forEach(function(item) {
                            htmlContent += `
                                <div class="record" style="border: 1px solid #ccc; padding: 15px; margin-bottom: 15px; border-radius: 5px; position: relative;">
                                    <div style="position: absolute; top: -7px; left: 70%; background: white; padding: 0 5px; font-weight: bold;">
                                        ${item.formatted_created_at}
                                    </div>
                                    <div style="padding-top: 20px;">${item.description}</div>
                                </div>`;
                        });

                        $('#WorkDetails').html(htmlContent);
                    } else {
                        $('#WorkDetails').html('<p>No data available for the selected date.</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    $('#WorkDetails').html('<p>Something went wrong. Please try again later.</p>');
                }
            });
        });
    </script>
    <script>
        $("#date").flatpickr({
            dateFormat: "d-m-Y",
        });
    </script>
    <script>
        $(document).ready(function() {
            assignData();
        });
        $('#search').click(function() {
            assignData();
        });

        function reload() {
            $('#Empdata').val('');
            $('#date').val('');
            assignData();
            // toggleResetButton();
        }

        function assignData() {
            $('#Worklist').DataTable().destroy();
            let filter = {};
            filter['e_id'] = $('#Empdata').val();
            filter['date'] = $('#date').val();
            ajaxDataTableInit(baseUrl() + '/get-work-list', 'Worklist', 0, 0, filter);
        }
    </script>
    
</body>

</html>
{{-- work report details modal code  --}}
{{-- <div class="modal" tabindex="-1" id="WorkDetails" data-bs-backdrop="static">
        <div class="modal-dialog  modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title f-800">Work Report</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex mb-3">
                                        <label class="f-18 f-600">Name :</label>
                                        <span class="f-18 f-700 f-black ms-2" id="name"></span>
                                    </div>
                                    <div class="d-flex mb-3">
                                        <label class="f-18 f-600">Date & Time :</label>
                                        <span class="f-18 f-700 f-black ms-2" id="Date"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-flex mb-3">
                                        <label class="f-18 f-600">Team :</label>
                                        <span class="f-18 f-700 f-black ms-2" id="team"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="f-18 f-600 mb-2">Description :</label>
                                        <span class="f-18 f-700 f-black ms-2" id="description"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
