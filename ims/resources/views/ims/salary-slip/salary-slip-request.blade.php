<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | Salary Slip Request" />
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
                    <section id="addemployee admin">
                        <div class="conatiner">
                            <div class="card mb-5">
                                <div class="card-body">
                                    @if ($employee && $employee->download_ss == 1)
                                        <form action="{{ URL('submit-salary-slip-request') }}" method="POST"
                                            id="myForm">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 align-self-center">
                                                    <h2>Salary Slip</h2>
                                                </div>
                                                <div class="col-md-6 d-flex justify-content-end">
                                                    <button type="button" onclick="goBack()" class="btn btn-primary">
                                                        <i class="fa fa-arrow-left me-2" aria-hidden="true"></i>Back
                                                    </button>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row my-3">
                                                <div class="col-md-4">
                                                    <select class="form-select" id="year" name="year">
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <select class="form-select" name="month" id="month">
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-6 align-self-center">
                                                            <a href="javascript:void(0)">
                                                                <button class="btn btn-primary f-16 f-white"
                                                                    type="submit">Request for salary slip</button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    @else
                                        <h2 class="f-red">You do not have permission to download the salary slip.</h2>
                                    @endif
                                </div>
                            </div>
                            @if (isset($salary))
                                <div class="row">
                                    <div class="col-md-12  d-flex justify-content-end mb-2">
                                        <a href="{{ URl('generate-pdf', $salary->ss_id) }}" id="downloadLink">
                                            <button class="btn btn-primary">Download

                                            </button>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            @if (isset($salary))
                                <div class="card">
                                    <div class="card-body">
                                        <section id="pay-slip" class="f-black">
                                            <div class="container">
                                                <table border="0" align="center" width=100%>
                                                    <tr>
                                                        <td align="left" colspan="2">
                                                            <p class="name">HMMBiz Web Solutions</p>
                                                            <p class="address">A-513 Dev Aurum Complex,<br>
                                                                Prahladnagar Road,<br>
                                                                Ahmedabad, 380015<br>
                                                                Gujarat, INDIA</p>
                                                        </td>
                                                        <td align="left" colspan="2">
                                                            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/images/logo/HMMBiz-Logo.png'))) }}"
                                                                class="logo-image">

                                                        </td>
                                                    </tr>
                                                </table>

                                                <table border="0" align="center" width=100%>
                                                    <tr class="border_bottom">
                                                        <td colspan="4">
                                                            <p><strong
                                                                    style="text-transform: uppercase;">{{ $salary->name }}
                                                                    </storng>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr class="border_bottom_gray">
                                                        <td class="w-25">
                                                            <span class="f-gray">Employee ID</span>
                                                            <p class="f-700">{{ $salary->emp_id }}
                                                            </p>
                                                        </td>
                                                        <td class="w-25">
                                                            <span class="f-gray">Department</span>
                                                            <p class="f-700">{{ $salary->department }}</p>
                                                        </td>
                                                        <td class="w-25">
                                                            <span class="f-gray">Designation</span>
                                                            <p class="f-700">{{ $salary->designation }}</p>
                                                        </td>
                                                        <td class="w-25">
                                                            <span class="f-gray">Joining Date</span>
                                                            <p class="f-700">{{ $salary->join_date }}
                                                            </p>
                                                        </td>
                                                    </tr>

                                                    <tr class="border_bottom">
                                                        <td class="w-25">
                                                            <span class="f-gray">Bank Name</span>
                                                            <p class="f-700">{{ $salary->bank_name }}</p>
                                                        </td>
                                                        <td class="w-25">
                                                            <span class="f-gray">Bank IFSC</span>
                                                            <p class="f-700">{{ $salary->ifsc }}</p>
                                                        </td>
                                                        <td class="w-25">
                                                            <span class="f-gray">Bank Account</span>
                                                            <p class="f-700">{{ $salary->account_no }}</p>
                                                        </td>
                                                        <td class="w-25">
                                                            <span class="f-gray">PAN</span>
                                                            <p class="f-700">{{ $salary->pan }}
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table border="0" align="center" width=100% id="salary-table">
                                                    <tr class="border_bottom">
                                                        <td colspan="4"
                                                            style="padding-bottom: 0px; padding-left: 0px;">
                                                            <p class="f-18"><strong>SALARY DETAILS</strong></p>
                                                        </td>
                                                    </tr>

                                                    <tr class="border_bottom_gray">
                                                        <td class="w-25">
                                                            <span class="f-gray f-15">ACTUAL PAYABLE DAYS </span>
                                                            <p class="f-700">{{ $salary->actual_payable_days }}</p>
                                                        </td>
                                                        <td class="w-25">
                                                            <span class="f-gray f-15">TOTAL WORKING DAYS</span>
                                                            <p class="f-700">{{ $salary->total_working_days }}</p>
                                                        </td>
                                                        <td class="w-25">
                                                            <span class="f-gray f-15">LOSS OF PAY DAYS</span>
                                                            <p class="f-700">{{ $salary->loss_of_pay_days }} </p>
                                                        </td>
                                                        <td class="w-25">
                                                            <span class="f-gray  f-15">DAYS PAYABLE</span>
                                                            <p class="f-700">{{ $salary->days_payable }}</p>
                                                        </td>
                                                    </tr>
                                                    {{-- @endforeach --}}
                                                </table>
                                                <table align="center" width=100% class="earning-table">
                                                    <tr>
                                                        <td colspan="2" class="border-right">
                                                            <p class="f-700">EARNINGS </p>
                                                        </td>
                                                        <td colspan="2">
                                                            <p class="f-700">TAXES & DEDUCTIONS</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="w-25">
                                                            <p class="f-700">Basic</p>
                                                        </td>
                                                        <td class="w-25 border-right" align="right">
                                                            <p class="f-700">{{ $salary->basic }}</p>
                                                        </td>
                                                        <td class="w-25">
                                                            <p class="f-700">Professional Tax</p>
                                                        </td>
                                                        <td class="w-25" align="right">
                                                            <p class="f-700">{{ $salary->professional_tax }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="w-25">
                                                            <p class="f-700">City Comp. Allowance</p>
                                                        </td>
                                                        <td class="w-25 border-right" align="right">
                                                            <p class="f-700">{{ $salary->city_comp_allowance }}</p>
                                                        </td>
                                                        <td class="w-25"></td>
                                                        <td class="w-25" align="right"></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="w-25">
                                                            <p class="f-700">Bonus.</p>
                                                        </td>
                                                        <td class="w-25 border-right" align="right">
                                                            <p class="f-700">{{ $salary->bonus }}</p>
                                                        </td>
                                                        <td class="w-25">
                                                            <p class="f-700">Total Deductions (C)</p>
                                                        </td>
                                                        <td class="w-25" align="right">
                                                            <p class="f-700">{{ $salary->total_deductions_c }}</p>
                                                        </td>
                                                    </tr>
                                                    <tr class="border_bottom">
                                                        <td class="w-25">
                                                            <p class="f-700">Total Earnings (A)</p>
                                                        </td>
                                                        <td class="w-25 border-right" align="right">
                                                            <p class="f-700">{{ $salary->total_earnings_a }}</p>
                                                        </td>
                                                        <td class="w-25"></td>
                                                        <td class="w-25" align="right"></td>
                                                    </tr>
                                                </table>

                                                <table style="margin-top: 10px;">
                                                    <tr>
                                                        <td width="350">
                                                            <table width="350">
                                                                <tr>
                                                                    <td>
                                                                        Net Salary Payable ( A - C )
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        Net Salary in words
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td width="450">
                                                            <table width="450">
                                                                <tr>
                                                                    <td>{{ $salary->net_salary_payable_a_c }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>{{ $salary->net_alary_in_words }},
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <p class="note" style="margin-top: 40px;">**Note : All amounts
                                                    displayed in this payslip
                                                    are in INR</p>
                                                <p class="note">* This is computer generated statement, and does
                                                    not require a signature</p>

                                            </div>
                                        </section>
                                    </div>
                                </div>
                            @endif
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
    {{-- <script>
        $('#downloadLink').on('click', function() {
            setTimeout(function() {
                window.location.href = '/salary-slip-request';
            }, 5000);
        });
    </script> --}}


    <script>
        // back button
        function goBack() {
            window.history.back();
        }
        // dropdown code
        document.addEventListener("DOMContentLoaded", function() {
            var selectYear = document.getElementById("year");
            var selectMonth = document.getElementById("month");
            var currentYear = new Date().getFullYear();
            var currentMonth = new Date().getMonth() + 1;

            for (var i = 0; i < 5; i++) {
                var optionYear = document.createElement("option");
                optionYear.text = currentYear - i;
                optionYear.value = currentYear - i;
                selectYear.add(optionYear);
            }

            selectYear.addEventListener("change", function() {
                selectMonth.innerHTML = "";
                var selectedYear = parseInt(selectYear.value);
                if (selectedYear === currentYear) {
                    for (var i = 1; i < currentMonth; i++) {
                        var optionMonth = document.createElement("option");
                        var monthValue = i < 10 ? "0" + i : i;
                        var monthNames = ["January", "February", "March", "April", "May", "June", "July",
                            "August", "September", "October", "November", "December"
                        ];
                        optionMonth.text = monthNames[i - 1];
                        optionMonth.value = monthValue;
                        selectMonth.add(optionMonth);
                    }
                } else {
                    for (var i = 1; i <= 12; i++) {
                        var optionMonth = document.createElement("option");
                        var monthValue = i < 10 ? "0" + i : i;
                        var monthNames = ["January", "February", "March", "April", "May", "June", "July",
                            "August", "September", "October", "November", "December"
                        ];
                        optionMonth.text = monthNames[i - 1];
                        optionMonth.value = monthValue;
                        selectMonth.add(optionMonth);
                    }
                }
            });

            for (var i = 1; i < currentMonth; i++) {
                var optionMonth = document.createElement("option");
                var monthValue = i < 10 ? "0" + i : i;
                var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August",
                    "September", "October", "November", "December"
                ];
                optionMonth.text = monthNames[i - 1];
                optionMonth.value = monthValue;
                selectMonth.add(optionMonth);
            }
        });
    </script>

</body>

</html>
