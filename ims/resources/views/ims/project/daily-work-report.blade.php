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
                                                    <h2 class="f-700">Daily Work Report</h2>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <a href="{{ URL('work-email-setting') }}">
                                                        <button type="button" class="btn btn-primary">
                                                            <i class="fa fa-cog" aria-hidden="true"></i></button></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body"></div>
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

</body>

</html>
