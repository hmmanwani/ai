<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Manage Task" />
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
                                                    <h2 class="f-700">Manage Task</h2>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <a href="{{ URL('add-task') }}">
                                                        <button type="button" class="btn btn-primary">
                                                            Add Task</button></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">

                                                    {{-- <div class="row">
                                                        <!-- Status Filter -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="filterStatus"
                                                                    class="control-label f-18 f-600">Status</label>
                                                                <select name="status" id="filterStatus"
                                                                    class="form-select ">
                                                                    <option value="">All</option>
                                                                    <option value="to_do">To Do</option>
                                                                    <option value="in_progress">In Progress</option>
                                                                    <option value="hold">Hold</option>
                                                                    <option value="complete">Complete</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- Task Type Filter -->
                                                        <div
                                                            class="col-md-12 d-flex align-items-center justify-content-center ">
                                                            <div class="form-group mb-0">
                                                                <div class="Sreach ">
                                                                    <a href="javascript:void(0)" id="search"
                                                                        class="btn btn-skyblue f-black">Search</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>

                                            {{-- table  --}}
                                            <table id="Task"
                                                class="table table-bordered table-striped f-black f-600">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Task Type</th>
                                                        <th>Date</th>
                                                        <th>Task Title</th>
                                                        <th>Assign By</th>
                                                        <th>Assign to</th>
                                                        <th>Deadline</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="taskTableBody">
                                                    <!-- Rows will be appended here -->
                                                </tbody>
                                            </table>
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
        $('#search').click(function() {
            assignData();
        });

        $(document).ready(function() {
            assignData();
        });

        function assignData() {
            $('#Task').DataTable().destroy();
            let filter = {};
            // filter['status'] = $('#filterStatus').val();
            ajaxDataTableInit(baseUrl() + '/get-task-list', 'Task', 0, 0, filter,true,false);
        }
        
    </script>
</body>

</html>
