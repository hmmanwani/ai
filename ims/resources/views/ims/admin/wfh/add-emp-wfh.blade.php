<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="" />
    <style>
        .select-employee .select2-selection {
            height: 48px !important;
            /* overflow: auto !important; */
        }
    </style>
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
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h2 class= "">Add Employee Work From Home</h2>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end"><button
                                                        onclick="goBack()" class="btn btn-primary"><i
                                                            class="fa fa-arrow-left me-2"
                                                            aria-hidden="true"></i>Back</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-body">
                                                <form action="{{ url('submit-add-emp-wfh') }}" method="POST" id="wfh">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label required">Apply
                                                                    For</label>
                                                                <select data-plugin-selectTwo name="apply_for"
                                                                    id="apply_for" class="form-select">
                                                                    <option value="">Apply For
                                                                    </option>
                                                                    <option value="first-half">First Half</option>
                                                                    <option value="second-half">Second Half</option>
                                                                    <option value="full-day">Full Day</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4 select-employee">
                                                            <div class="form-group">
                                                                <?php $groupedEmployees = $emp->groupBy('team'); ?>
                                                                <div class="d-flex justify-content-between">
                                                                    <label class="required control-label"
                                                                        for="wfhBy">Select Employee</label>
                                                                    <div>
                                                                        <label class="control-label"
                                                                            for="all">All</label>
                                                                        <input class="form-check-input me-2"
                                                                            type="checkbox" id="selectAllEmployees">
                                                                    </div>
                                                                </div>

                                                                <!-- Select2 multi-select -->
                                                                <select name="wfhBy[]" id="wfhBy"
                                                                    class="form-select select2" multiple>
                                                                    @foreach ($groupedEmployees as $team => $employees)
                                                                        <optgroup label="{{ $team }}">
                                                                            @foreach ($employees as $emps)
                                                                                <option value="{{ $emps->e_id }}">
                                                                                    {{ $emps->name }}</option>
                                                                            @endforeach
                                                                        </optgroup>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class=" control-label required">WFH
                                                                    Date</label>
                                                                <input type="text" id="wfh_date" name="wfh_date"
                                                                    class="form-control" title="wfh Date"
                                                                    placeholder="d-m-Y" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label required">WFH
                                                                    Reason</label>
                                                                <textarea class="form-control h-100" name="apply_reason" rows="5"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
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
        $(document).ready(function() {
            // Initialize Select2
            $('#wfhBy').select2({
                placeholder: "Select Employee"
            });

            function updateOverflow() {
                const selection = $('#wfhBy').val();
                const $selectionBox = $('.select-employee .select2-selection');

                if (selection && selection.length > 0) {
                    $selectionBox.css({
                        'overflow': 'auto',
                        'height': 'auto',
                        'max-height': '100px' // adjust as needed
                    });
                } else {
                    $selectionBox.css({
                        'overflow': 'hidden',
                        'height': '48px'
                    });
                }
            }

            // Call on load (if editing form)
            updateOverflow();

            // Call on change
            $('#wfhBy').on('change', function() {
                updateOverflow();
            });

            // Select All Checkbox Logic
            $('#selectAllEmployees').change(function() {
                if (this.checked) {
                    // Select all options
                    let allVals = $('#wfhBy option').map(function() {
                        return $(this).val();
                    }).get();
                    $('#wfhBy').val(allVals).trigger('change');
                } else {
                    // Deselect all options
                    $('#wfhBy').val(null).trigger('change');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#wfh_date").flatpickr({
                mode: "range",
                dateFormat: "d-m-Y",
                disable: [
                    function(date) {
                        // Disable Monday (1), Sunday (0)
                        var day = date.getDay();
                        return day === 0 ||  day === 6;
                    }
                ],
            });
        });
    </script>
    <script>
        function goBack() {
            history.go(-1);
        }
    </script>
</body>

</html>
