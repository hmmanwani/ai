<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pay Slip</title>
    <style type="text/css">
        body {
            font-family: "Red Hat Display", sans-serif;
        }

        h1,
        h2,
        p {
            margin: 0;
        }

        #pay-slip {
            display: flex;
            justify-content: center;
        }

        .f-700 {
            font-weight: 700 !important;
        }

        .logo-image {
            float: right !important;
            width: 230px;
            height: 80px !important;
        }

        .earning-table {
            border-bottom: 2px solid black;
        }

        .name {
            margin-top: 30px;
        }

        .address {
            margin-top: 20px;
        }

        .note {
            margin-top: 15px;
        }

        .f-gray {
            color: gray;
            font-size: 13px;
        }

        .f-16 {
            font-size: 16px;
        }

        .f-15 {
            font-size: 15px;
        }

        .f-18 {
            font-size: 18px;
        }

        .inner-table tr {
            border: 0 !important;
            padding: 0 !important;
        }

        td {
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 8px;
            padding-right: 8px;
        }

        tr.border_bottom td {
            border-bottom: 2px solid black;
        }

        tr.border_bottom_gray td {
            border-bottom: 2px solid #E8E8E8;
        }

        tr.border_top td {
            border-top: 2px solid #E8E8E8;
        }

        tr.border_bottom .border-td {
            border-bottom: 2px solid black;
        }

        .pb-0 {
            padding-bottom: 0px !important;
        }

        .border-right {
            border-right: 2px solid #E8E8E8;
        }

        .line {
            margin-top: 30px;
        }

        .w-25 {
            width: 25%;
        }

        #salary-table {
            margin-top: 20px;
            border-bottom: 2px solid black;

        }

        table {
            border-collapse: collapse !important;
        }
    </style>

</head>

<body>
    <section id="pay-slip">
        <div class="container">
            <table border="0" align="center" width=100%>
                <tr>
                    <td align="left" colspan="2">
                        {{-- @foreach ($groupedData as $month => $data)
                            <h1>PAYSLIP {{ $data['year'] }}</h1>
                            <!-- Other content -->
                        @endforeach  --}}



                        <p class="name">HMMBiz Web Solutions</p>
                        <p class="address">A-513 Dev Aurum Complex,<br>
                            Prahladnagar Road,<br>
                            Ahmedabad, 380015<br>
                            Gujarat, INDIA</p>
                    </td>
                    <td align="right" style="display: flex; justify-content: end;" colspan="2">
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/images/logo/HMMBiz-Logo.png'))) }}"
                            class="logo-image">
                    </td>
                </tr>
            </table>

            <table border="0" align="center" width=100%>
                <tr class="border_bottom">
                    <td colspan="4">
                        <p><strong style="text-transform: uppercase;">{{ $salary->name }}</storng>
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
                <tr class="border_bottom mb-0">
                    <td colspan="4" style="padding-bottom: 0px; padding-left: 0px;">
                        <p class=""><strong>SALARY DETAILS</strong></p>
                    </td>
                </tr>

                <tr class="border_bottom_gray">
                    <td class="w-25">
                        <span class="f-gray f-15">ACTUAL PAYABLE DAYS </span>
                        <p>{{ $salary->actual_payable_days }}</p>
                    </td>
                    <td class="w-25">
                        <span class="f-gray f-15">TOTAL WORKING DAYS</span>
                        <p>{{ $salary->total_working_days }}</p>
                    </td>
                    <td class="w-25">
                        <span class="f-gray f-15">LOSS OF PAY DAYS</span>
                        <p>{{ $salary->loss_of_pay_days }} </p>
                    </td>
                    <td class="w-25">
                        <span class="f-gray  f-15">DAYS PAYABLE</span>
                        <p>{{ $salary->days_payable }}</p>
                    </td>
                </tr>
                {{-- @endforeach --}}
            </table>
            <table align="center" width=100% class="earning-table">
                <tr>
                    <td colspan="2" class="border-right">
                        <p>EARNINGS </p>
                    </td>
                    <td colspan="2">
                        <p>TAXES & DEDUCTIONS</p>
                    </td>
                </tr>
                <tr>
                    <td class="w-25">
                        <p>Basic</p>
                    </td>
                    <td class="w-25 border-right" align="right">
                        <p>{{ $salary->basic }}</p>
                    </td>
                    <td class="w-25">
                        <p>Professional Tax</p>
                    </td>
                    <td class="w-25" align="right">
                        <p>{{ $salary->professional_tax }}</p>
                    </td>
                </tr>
                <tr>
                    <td class="w-25">
                        <p>City Comp. Allowance</p>
                    </td>
                    <td class="w-25 border-right" align="right">
                        <p>{{ $salary->city_comp_allowance }}</p>
                    </td>
                    <td class="w-25"></td>
                    <td class="w-25" align="right"></td>
                </tr>
                <tr>
                    <td class="w-25">
                        <p>Bonus.</p>
                    </td>
                    <td class="w-25 border-right" align="right">
                        <p>{{ $salary->bonus }}</p>
                    </td>
                    <td class="w-25">
                        <p>Total Deductions (C)</p>
                    </td>
                    <td class="w-25" align="right">
                        <p>{{ $salary->total_deductions_c }}</p>
                    </td>
                </tr>
                <tr class="border_bottom">
                    <td class="w-25">
                        <p>Total Earnings (A)</p>
                    </td>
                    <td class="w-25 border-right" align="right">
                        <p>{{ $salary->total_earnings_a }}</p>
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
            <p class="note" style="margin-top: 40px;">**Note : All amounts displayed in this payslip are in INR</p>
            <p class="note">* This is computer generated statement, and does not require a signature</p>

        </div>
    </section>
</body>

</html>
