<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="" />
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
                                                    <h2 class="f-700">Internal Team Access</h2>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <a href="{{ URL('daily-work-report') }}" class="btn btn-primary f-white"><i
                                                            class="fa fa-arrow-left me-2"
                                                            aria-hidden="true"></i>Back</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table id="internalteamlist"
                                                        class="table table-bordered table-striped f-black">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th>No.</th>
                                                                <th>name</th>
                                                                <th>team</th>
                                                                <th>status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
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
    <div class="modal" tabindex="-1" id="ineternal_team_model" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Work View Access</h2>
                    <button type="button" class="btn-close" id="BtnClose" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ URL('update-work-view-access-emp') }}" method="POST" id="work_view_access_emp"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="required control-label f-600" for="sub_emp">Select Employee</label>
                                    <select name="emp[]" id="emp" class="form-select chosen-select" multiple>
                                        <option value="" disabled class="f-black f-700">-Select Members-</option>
                                        @php
                                            $teamWiseEmployees = collect($name)->groupBy('team');
                                        @endphp
                                        @foreach ($teamWiseEmployees as $team => $employees)
                                            <optgroup label="{{ $team }}">
                                                @foreach ($employees as $employee)
                                                    <option value="{{ $employee['e_id'] }}">
                                                        {{ $employee['fullname'] }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="e_id" id="e_id" value="">
                                <input type="hidden" name="l_id" id="l_id" value="">
                                <button type="submit" class="btn btn-primary">Assign</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <x-footer />
    <script>
        $(document).ready(function() {
            assignData();
        });

        $('#BtnClose').click(function() {
            location.reload();
        });

        function assignData() {
            $('#internalteamlist').DataTable().destroy();
            let filter = {};
            ajaxDataTableInit(baseUrl() + '/get-internal-team-list', 'internalteamlist', 0, 0, filter);
        }
    </script>
    <script>
        $(document).ready(function() {
            $('body').on('click', 'a[id^="internal_team_"]', function() {
                let employeeId = $(this).data('id');
                let LeaderId = $(this).data('leader-id');
                $('#e_id').val(employeeId)
                $('#l_id').val(LeaderId)

                $('#ineternal_team_model').modal('show');
                if (!$(".chosen-select").hasClass("chosen-initialized")) {
                    $(".chosen-select").addClass("chosen-initialized").chosen();
                }
                $(".chosen-select option").prop('disabled', false);
                let selectedOption = $(".chosen-select option[value='" + employeeId + "']");
                if (selectedOption.length > 0) {
                    selectedOption.prop('disabled', true);
                }
                $(".chosen-select").trigger("chosen:updated");

                $.ajax({
                    url: '{{ route('get-internal-team-member-emp') }}',
                    type: 'POST',
                    data: {
                        e_id: employeeId,
                        l_id: LeaderId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);

                        if (response.success) {
                            let emp = response.data;
                            let empIds = emp.map(e => e.e_id);
                            $(".chosen-select option").each(function() {
                                if (empIds.includes(parseInt($(this).val()))) {
                                    $(this).prop('selected', true);
                                }
                            });
                            $(".chosen-select").trigger("chosen:updated");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
    
</body>

</html>
