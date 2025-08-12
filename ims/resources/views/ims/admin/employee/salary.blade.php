<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="Employee Salary" />
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
                                                    <h1 class= "">Salary</h1>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <button onclick="goBack()" class="btn btn-primary"><i
                                                            class="fa fa-arrow-left me-2"
                                                            aria-hidden="true"></i>Back</button>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form action="{{ url('/update-salary') }}" method="post"
                                                        id="myForm">
                                                        @csrf
                                                        <div class="row">

                                                            {{-- Start Date --}}
                                                            <div class="col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label class="required" for="start_date">Start
                                                                        Date</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="start_date"
                                                                            name="start_date" class="form-control"
                                                                            required
                                                                            value="<?= @$sDetails->start_date ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- End Date --}}
                                                            <div class="col-md-3 mt-2">
                                                                <div class="form-group">
                                                                    <label class="required" for="end_date">End
                                                                        Date</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="end_date"
                                                                            name="end_date" class="form-control"
                                                                            value="<?= @$sDetails->end_date ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- Salary --}}
                                                            <div class="col-md-4 mt-2">
                                                                <div class="form-group">
                                                                    <label class="required"
                                                                        for="amount">Salary</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="amount"
                                                                            name="amount" class="form-control"
                                                                            value="<?= @$sDetails->amount ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- TDS --}}
                                                            <div class="col-md-2 mt-2">
                                                                <div class="form-group">
                                                                    <label class="required" for="tds">TDS (in
                                                                        %)</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="tds"
                                                                            name="tds" class="form-control"
                                                                            value="<?= @$sDetails->tds ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- Professional Tax --}}
                                                            <div class="col-md-4 mt-2">
                                                                <div class="form-group">
                                                                    <label class="required" for="pt">Professional
                                                                        Tax</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="pt"
                                                                            name="pt" class="form-control"
                                                                            value="<?= @$sDetails->pt ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- allowance --}}
                                                            <div class="col-md-4 mt-2">
                                                                <div class="form-group">
                                                                    <label class="required"
                                                                        for="allowance">Allowance</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="allowance"
                                                                            name="allowance" class="form-control"
                                                                            value="<?= @$sDetails->allowance ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- bonus --}}
                                                            <div class="col-md-4 mt-2">
                                                                <div class="form-group">
                                                                    <label class="required" for="bonus">Bonus</label>
                                                                    <div class="col-md-12">
                                                                        <input type="text" id="bonus"
                                                                            name="bonus" class="form-control"
                                                                            value="<?= @$sDetails->bonus ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-3 d-flex justify-content-end">
                                                            <input type="hidden" name="e_id" value="<?= $e_id ?>">
                                                            <button type="submit"
                                                                class="btn btn-primary">Update</button>
                                                        </div>
                                                    </form>
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

        $("#start_date").flatpickr({
            dateFormat: "Y-m-d",
            // maxDate: "today",
        });
        $("#end_date").flatpickr({
            dateFormat: "Y-m-d",
            // maxDate: "today",
        });
    </script>
</body>

</html>
