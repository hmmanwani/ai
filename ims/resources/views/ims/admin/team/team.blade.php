<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Team" />
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
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h1>Team</h1>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <a href="javascript:void(0)" id="add-team" class="btn btn-primary">
                                                        <i class="fa fa-plus f-24 f-white" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-body ">
                                                            <table id="teamtable"
                                                                class="table table-bordered table-striped f-black">
                                                                <thead>
                                                                    <tr class="text-center">
                                                                        <th>No.</th>
                                                                        <th>Team</th>
                                                                        <th>Action</th>
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

    {{-- add modal  --}}
    <div class="modal" tabindex="-1" id="addteammodel" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ url('/submit-team') }}" method="POST" id="myForm">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Team</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row ">
                                    <div class="form-group">
                                        <label class="col-sm-3 f-600 control-label required">
                                            Team name</label>
                                        <input class="form-control" id="team" name="team"></input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit modal  --}}
    <div class="modal" tabindex="-1" id="EditTeam" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ url('/edit-team') }}" method="POST" id="editForm">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Team</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row ">
                                    <div class="form-group">
                                        <label class="col-sm-3 f-600 control-label required">
                                            Team name</label>
                                        <input class="form-control" id="teamname" name="team"></input>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="teamidedit" name="id">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- - delete POP-Up --}}
    <div class="modal" tabindex="-1" id="DeleteModal" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title f-800">Delete Team</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="f-22" id="delete-modal-message"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <a href="javascript:void(0)" id="confirm-delete" class="btn btn-primary f-white">Yes</a>
                </div>
            </div>
        </div>
    </div>
    <x-footer />
    <script>
        $('#add-team').click(function() {
            $('#addteammodel').modal('show');
        });

        $('body').on('click', 'a[id^="edit-team_"]', function() {
            var teamId = $(this).data('id');
            var teamName = $(this).data('value');
            $('#teamidedit').val(teamId);
            $('#teamname').val(teamName);
            $('#EditTeam').modal('show');
        });
    </script>
    <script>
        $(document).ready(function() {
            assignData();
        });

        function assignData() {
            $('#teamtable').DataTable().destroy();
            let filter = {};
            ajaxDataTableInit(baseUrl() + '/get-team', 'teamtable', 0, 0, filter);
        }
    </script>
    <script>
        $(document).on('click', '.delete-check', function() {
            var teamId = $(this).data('id');
            var deleteUrl = '{{ url('delete-team') }}/' + teamId;

            $.ajax({
                url: baseUrl() +
                    '/team/' + teamId + '/count',
                method: 'GET',
                success: function(response) {
                    if (response.count == 0) {
                        $('#delete-modal-message').text('Are you sure you want to delete this team?');
                    } else {
                        $('#delete-modal-message').html('This team has <span class="f-base f-600">' +
                            response.count +
                            ' members</span>. All members will be deactivated. Are you sure you want to delete this team?'
                        );
                    }
                    $('#confirm-delete').attr('href', deleteUrl);
                    $('#DeleteModal').modal('show');
                },
                error: function() {
                    alert('Unable to fetch team member count.');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#myForm").validate({
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                rules: {
                    team: {
                        required: true
                    },
                },
                errorPlacement: function(error, element) {},
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
