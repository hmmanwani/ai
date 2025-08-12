<!DOCTYPE html>
<html lang="en">

<head>
    <x-head title="IMS | View Attendance" />
    <link rel="stylesheet" href="https://unpkg.com/tippy.js/dist/tippy.css">
</head>
<style>
    #attCal {
        width: 100%;
        font-size: 22px;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .table-bordered {
        border-color: #494848 !important;
    }

    #attCal th {
        background: #ededed;
        color: #000;
        font-weight: 700;
        text-align: center;
        height: 55px;
        min-height: 60px;
        border: 1px solid black;
    }

    #attCal a {
        color: inherit !important;
    }

    #attCal td {
        font-weight: 700;
        font-size: 18px;
        height: 80px;
        width: 55px;
        color: #0A4970 !important;
    }

    .today {
        background-color: #87CEEB !important;
        font-size: 20px !important;
        font-weight: 800 !important;
    }

    .click {
        width: 100%;
        height: 55px;
        display: flex;
        text-align: center;
        align-items: center;
        justify-content: space-between;
    }

    .todayLight {
        background-color: #0A4970 !important;
        color: #fff !important;
        border-radius: 50%;
        padding: 10px;
        font-size: 18px;
    }

    .presence {
        padding: 10px;
        background-color: #47a447;
        color: #fff !important;
        border-radius: 15px;
        font-size: 18px;
        position: relative;
    }

    .forget-logout {
        padding: 10px;
        background-color: #47a447;
        border-radius: 15px;
        font-size: 18px;
        position: relative;
        color: red !important;
    }

    .halfday {
        padding: 10px;
        background-image: linear-gradient(-49deg, #47a447 34%, #d2322d 67%);
        border-radius: 15px;
        color: #fff !important;
        font-size: 18px;
        position: relative;

    }

    .holiday {
        padding: 10px;
        background-color: #4488cd;
        border-radius: 15px;
        font-size: 18px;
        position: relative;
        color: #fff !important;
    }

    .weekend {
        padding: 10px;
        background-color: #ed9c28;
        border-radius: 15px;
        font-size: 18px;
        position: relative;
        color: #fff !important;
    }

    .leave {
        padding: 10px;
        background-color: #d2322d;
        border-radius: 15px;
        font-size: 16px;
        position: relative;
        color: #fff !important;
    }

    .WFhLeave {
        padding: 10px;
        background: linear-gradient(to right,
                #d2322d 18%, #47a447 60%,
                #807c79 75%);
        border-radius: 15px;
        font-size: 16px;
        position: relative;
        color: #fff !important;
    }

    .WorkFromHome {
        padding: 10px;
        background-color: #807c79;
        border-radius: 15px;
        font-size: 16px;
        color: #fff !important;
    }



    .early-leave {
        padding: 10px;
        background-color: #A020F0;
        border-radius: 15px;
        font-size: 16px;
        position: relative;
        color: #fff !important;
    }

    .extraDot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        position: absolute;
        top: 0;
        right: 0;
        background-color: #000 !important;
        border: 2px solid white;
    }
</style>

<body>
    <?php
    if (isset($_GET['mon'])) {
        $month = $_GET['mon'];
    } else {
        $month = date('m');
    }
    if (isset($_GET['year'])) {
        $year = $_GET['year'];
    } else {
        $year = date('Y');
    }
    $fullMonthName = date('F', mktime(0, 0, 0, $month, 1));
    ?>
    <div class="container-scroller">
        <x-header />
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    <section>
                        <div class="contianer-fluid">
                            <div class="row my-3">
                                <div class="col-md-4">
                                    <select class="form-select" id="monthSelect">
                                        <option value="1" <?php if ($month == 1) {
                                            echo 'selected';
                                        } ?>>January</option>
                                        <option value="2" <?php if ($month == 2) {
                                            echo 'selected';
                                        } ?>>February</option>
                                        <option value="3" <?php if ($month == 3) {
                                            echo 'selected';
                                        } ?>>March</option>
                                        <option value="4" <?php if ($month == 4) {
                                            echo 'selected';
                                        } ?>>April</option>
                                        <option value="5" <?php if ($month == 5) {
                                            echo 'selected';
                                        } ?>>May</option>
                                        <option value="6" <?php if ($month == 6) {
                                            echo 'selected';
                                        } ?>>June</option>
                                        <option value="7" <?php if ($month == 7) {
                                            echo 'selected';
                                        } ?>>July</option>
                                        <option value="8" <?php if ($month == 8) {
                                            echo 'selected';
                                        } ?>>August</option>
                                        <option value="9" <?php if ($month == 9) {
                                            echo 'selected';
                                        } ?>>September</option>
                                        <option value="10" <?php if ($month == 10) {
                                            echo 'selected';
                                        } ?>>October</option>
                                        <option value="11" <?php if ($month == 11) {
                                            echo 'selected';
                                        } ?>>November</option>
                                        <option value="12" <?php if ($month == 12) {
                                            echo 'selected';
                                        } ?>>December</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select" id="yearSelect">
                                    </select>
                                </div>
                                <div class="col-md-4 align-self-center">
                                    <a href="javascript:void(0)" class="btn btn-primary f-18 f-500 f-white"
                                        id="getAttendance">Get
                                        Attendance</a>
                                    <?php
                                    if(isset($_GET['mon']) || isset($_GET['year']) ){ ?>
                                    <a href="{{ url('view-attendance') }}"
                                        class="btn btn-danger f-18 f-500 f-white">Reset</a>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <?php
                                            $month = sprintf('%02d', $month);
                                            $num_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                                            $first_day = date('N', strtotime("$year-$month-01"));
                                            $current_date = date('j');
                                            ?>
                                            <p class="f-18 mx-auto text-center f-600" style="color: #d2322d">Click on
                                                the date
                                                to view full details.</p>
                                            <table id="attCal" class="table table-bordered">
                                                <tr>
                                                    <td colspan="7" class="text-center"><?= $fullMonthName ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Mon</th>
                                                    <th>Tue</th>
                                                    <th>Wed</th>
                                                    <th>Thu</th>
                                                    <th>Fri</th>
                                                    <th>Sat</th>
                                                    <th>Sun</th>
                                                </tr>

                                                <tr>
                                                    <?php
                                                    for ($i = 1; $i < $first_day; $i++) { ?>
                                                    <td></td>
                                                    <?php }
                                                    $day = 1;
                                                    for ($i = $first_day; $i <= 7; $i++) {
                                                            if($day < 10){
                                                                $day = '0'.$day;
                                                            }
                                                            $data_date = $year . '-' . $month . '-' . $day;
                                                            $data = getAttendance($data_date);
                                                        if ($data_date < date('Y-m-d')) { ?>
                                                    {{-- first row --}}
                                                    <td>
                                                        <a href="javascript:void(0);"
                                                            onclick="sendDate('<?= $day ?>', '<?= $month ?>', '<?= $year ?>')">
                                                            <div class="click"><?= $day ?>
                                                                <?php if(!empty($data)){ ?>
                                                                <div class="<?= $data['class'] ?>">
                                                                    <h4 class="m-0 f-700 f-16 ">
                                                                        <?= $data['content'] ?></h4>
                                                                    <?php if($data['extraInfo'] != ''){ ?>
                                                                    <div class="extraDot"></div>
                                                                    <?php } ?>
                                                                </div>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="HRS mt-1 mb-1">
                                                                <p class="f-14 f-black"><?= $data['HRS'] ?></p>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <?php } else if($data_date == date('Y-m-d')) { ?>
                                                    <td class='today'>
                                                        <a href="javascript:void(0);"
                                                            onclick="sendDate('<?= $day ?>', '<?= $month ?>',  '<?= $year ?>'); scrollToTop();">
                                                            <div class="click" data-value="<?= $data_date ?>">
                                                                <span class="todayLight"><?= $day ?></span>
                                                                <?php if(!empty($data)){ ?>
                                                                <div class="<?= $data['class'] ?>">
                                                                    <h4 class="m-0 f-700 f-16 ">
                                                                        <?= $data['content'] ?></h4>
                                                                    <?php if($data['extraInfo'] != ''){ ?>
                                                                    <div class="extraDot"></div>
                                                                    <?php } ?>
                                                                </div>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="HRS mt-1 mb-1">
                                                                <p class="f-14 f-black"><?= $data['HRS'] ?></p>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <?php }else{ ?>
                                                    <td>
                                                        <div class="click "><?= $day ?>
                                                            <?php if(!empty($data)){ ?>
                                                            <div class="<?= $data['class'] ?>">
                                                                <h4 class="m-0 f-700 f-16 ">
                                                                    <?= $data['content'] ?></h4>
                                                            </div>
                                                            <?php } ?>
                                                        </div>
                                                    </td>
                                                    <?php  }
                                                        $day++;
                                                    } ?>
                                                </tr>
                                                <?php while ($day <= $num_days) { ?>
                                                <tr>
                                                    <?php for ($i = 1; $i <= 7; $i++) {
                                                                                if($day < 10){
                                                                                $day = '0'.$day;
                                                                                }
                                                                                $data_date = $year . '-' . $month . '-' . $day;
                                                                                if ($day <= $num_days) {
                                                                $data = getAttendance($data_date);
                                                              if ($data_date < date('Y-m-d')) { ?>
                                                    <td>
                                                        <a href="javascript:void(0);"
                                                            onclick="sendDate('<?= $day ?>', '<?= $month ?>',  '<?= $year ?>'); scrollToTop();">
                                                            <div class="click">
                                                                <?= $day ?>
                                                                <?php if(!empty($data)){ ?>
                                                                <div class="<?= $data['class'] ?>">
                                                                    <h4 class="m-0 f-700 f-16 ">
                                                                        <?= $data['content'] ?>
                                                                    </h4>
                                                                    <?php if($data['extraInfo'] != ''){ ?>
                                                                    <div class="extraDot"></div>
                                                                    <?php } ?>
                                                                </div>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="HRS mt-1 mb-1">
                                                                <p class="f-14 f-black"><?= $data['HRS'] ?></p>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    {{-- today --}}
                                                    <?php } else if ($data_date == date('Y-m-d')) { ?>
                                                    <td class='today'>
                                                        <a href="javascript:void(0);"
                                                            onclick="sendDate('<?= $day ?>', '<?= $month ?>',  '<?= $year ?>'); scrollToTop();">
                                                            <div class="click" data-value="<?= $data_date ?>">
                                                                <span class="todayLight"><?= $day ?></span>
                                                                <?php if(!empty($data)){ ?>
                                                                <div class="<?= $data['class'] ?>">
                                                                    <h4 class="m-0 f-700 f-16 ">
                                                                        <?= $data['content'] ?></h4>
                                                                    <?php if($data['extraInfo'] != ''){ ?>
                                                                    <div class="extraDot"></div>
                                                                    <?php } ?>
                                                                </div>
                                                                <?php } ?>
                                                            </div>
                                                            <div class="HRS mt-1 mb-1">
                                                                <p class="f-14 f-black"><?= $data['HRS'] ?></p>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <?php  } else { ?>
                                                    <td>
                                                        <?php if(!empty($data)){ ?>
                                                        <div class="click" data-value="<?= $data_date ?>">
                                                            <?= $day ?>
                                                            <div class="<?= $data['class'] ?>">
                                                                <h4 class="m-0 f-700 f-16 ">
                                                                    <?= $data['content'] ?></h4>
                                                            </div>
                                                        </div>
                                                        <?php }else{ ?>
                                                        <div><?= $day ?></div>
                                                        <?php } ?>

                                                    </td>
                                                    <?php } $day++;
                                                            } else { ?>
                                                    <td></td>
                                                    <?php }
                                                        } ?>
                                                </tr>
                                                <?php } ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-12 " id="detailsView" style="display:none;">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-5 a-center">
                                                            <p class="f-20 f-800 f-black" id="dateDisplay">YYYY-MM-DD
                                                            </p>
                                                        </div>
                                                        <div class="col-md-7 j-end">
                                                            <h2><span id="badge"></span></h2>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-12" id="punchInTimeRow"
                                                            style="display:none;">
                                                            <p class="f-600 f-base">Clock-In Time - <strong
                                                                    class="f-black" id="punchInTime">00:00:00</strong>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-12" id="punchOutTimeRow"
                                                            style="display:none;">
                                                            <p class="f-600 f-base">Clock-Out Time - <strong
                                                                    class="f-black"
                                                                    id="punchOutTime">00:00:00</strong>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-12 mb-1" id="workingHoursRow"
                                                            style="display:none;">
                                                            <p class="f-600 f-base">Working Hours - <strong
                                                                    class="f-black"
                                                                    id="workingHours">00:00:00</strong>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-12" id="reasonRow" style="display:none;">
                                                            <p class="f-600 f-base">Reason - <strong class="f-black"
                                                                    id="reason"></strong></p>
                                                        </div>
                                                        <div class="col-md-12 mt-3" id="extra_working"
                                                            style="display:none;">
                                                            <p class="f-black mb-2 f-20 f-700">Extra Working :</p>
                                                            <div class="col-md-12" id="starting_time"
                                                                style="display:none;">
                                                                <p class="f-600 f-base">Starting Time - <strong
                                                                        class="f-black" id="startingTime"></strong>
                                                                </p>
                                                            </div>
                                                            <div class="col-md-12" id="ending_time"
                                                                style="display:none;">
                                                                <p class="f-600 f-base">Ending Time - <strong
                                                                        class="f-black" id="endingTime"></strong></p>
                                                            </div>
                                                            <div class="col-md-12" id="extra_working_hour"
                                                                style="display:none;">
                                                                <p class="f-600 f-base">Extra Working Hours - <strong
                                                                        class="f-black"
                                                                        id="extraWorkingHours"></strong>
                                                                </p>
                                                            </div>
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
                </div>
                <x-footer-con />
            </div>
        </div>
    </div>
    <x-footer />
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>
    <script>
        function sendDate(day, month, year) {
            // Reset all fields to default values or hide them
            $('#punchInTime, #punchOutTime, #workingHours').text('00:00:00');
            $('#reason').text('');
            $('#starting_time, #ending_time, #extra_working_hour').hide();
            $('#punchInTimeRow, #punchOutTimeRow, #workingHoursRow, #reasonRow, #extra_working').hide();

            $.ajax({
                url: '{{ url('send-date') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    day: day,
                    month: month,
                    year: year
                },
                success: function(response) {
                    if (response) {
                        var data = response.data;

                        var showBadge = function(data) {
                            $('#dateDisplay').text(data.data);
                            $('#badge').html(
                                `<div class="${data.class}"><h4 class="m-0 f-700 f-16 f-white">${data.content}</h4></div>`
                            );
                        };

                        if (data.weekend) {
                            var weekend = data.weekend;
                            if (weekend.class === 'leave') {
                                showBadge(weekend);
                                $('#reason').text(weekend.reason || '');
                                $('#reasonRow').show();
                            }
                        }
                        if (data.attendance && data.leave) {
                            var leave = data.leave;
                            var attendance = data.attendance;
                            $('#reason').text(leave.reason || '');
                            $('#punchInTime').text(attendance.login || '00:00:00');
                            $('#punchOutTime').text(attendance.logout || '00:00:00');
                            $('#workingHours').text(attendance.workingh || '00:00:00');
                            $('#punchInTimeRow, #punchOutTimeRow, #workingHoursRow,#reasonRow').show();
                        }

                        if (data.holiday) {
                            var holiday = data.holiday;
                            showBadge(holiday);
                            $('#reason').text(holiday.holiday || '');
                            $('#reasonRow').show();
                        } else if (data.leave) {
                            var leave = data.leave;
                            showBadge(leave);
                            $('#reason').text(leave.reason || '');
                            $('#reasonRow').show();
                        } else if (data.weekend) {
                            var weekend = data.weekend;
                            showBadge(weekend);
                        } else if (data.notfound) {
                            var notfound = data.notfound;
                            showBadge(notfound);
                            $('#reason').text(notfound.reason || '');
                            $('#reasonRow').show();
                        } else if (data.attendance) {
                            var attendance = data.attendance;
                            $('#dateDisplay').text(attendance.data);
                            $('#badge').html(
                                `<div class="${attendance.class}"><h4 class="m-0 f-700 f-16 f-white">${attendance.content}</h4></div>`
                            );
                            if (attendance.class === 'presence' || attendance.class === 'halfday') {
                                $('#punchInTime').text(attendance.login || '00:00:00');
                                $('#punchOutTime').text(attendance.logout || '00:00:00');
                                $('#workingHours').text(attendance.workingh || '00:00:00');
                                $('#punchInTimeRow, #punchOutTimeRow, #workingHoursRow').show();
                            } else if (attendance.class === 'leave') {
                                if (attendance.presence == 3) {
                                    $('#reason').text(attendance.reason || '');
                                    $('#punchInTime').text(attendance.login || '00:00:00');
                                    $('#punchOutTime').text(attendance.logout || '00:00:00');
                                    $('#workingHours').text(attendance.workingh || '00:00:00');
                                    $('#punchInTimeRow, #punchOutTimeRow, #workingHoursRow, #reasonRow').show();
                                } else if (attendance.presence == 4) {
                                    $('#reason').text(attendance.reason || '');
                                    $('#reasonRow').show();
                                    $('#extra_working').show();
                                    $('#starting_time').show().find('strong').text(attendance
                                        .extra_working_starting_time || '');
                                    $('#ending_time').show().find('strong').text(attendance
                                        .extra_working_ending_time || '');
                                    $('#extra_working_hour').show().find('strong').text(attendance
                                        .extra_working_working_hour || '');
                                } else if (attendance.class === 'leave' && attendance.content ===
                                    'presence') {
                                    $('#reason').text(attendance.reason || '');
                                    $('#punchInTime').text(attendance.login || '00:00:00');
                                    $('#punchOutTime').text(attendance.logout || '00:00:00');
                                    $('#workingHours').text(attendance.workingh || '00:00:00');
                                    $('#punchInTimeRow, #punchOutTimeRow, #workingHoursRow, #reasonRow').show();
                                } else {
                                    $('#reason').text(attendance.reason || '');
                                    $('#reasonRow').show();
                                }
                            }
                            if (attendance.presence == 5 || attendance.presence == 6) { // 5=ealry leave, 6=work from home
                                $('#reason').text(attendance.reason || '');
                                $('#punchInTime').text(attendance.login || '00:00:00');
                                $('#punchOutTime').text(attendance.logout || '00:00:00');
                                $('#workingHours').text(attendance.workingh || '00:00:00');
                                $('#punchInTimeRow, #punchOutTimeRow, #workingHoursRow, #reasonRow').show();
                            }
                        }
                        if (data.attendance && data.attendance.presence == 7) {
                            var attendance = data.attendance; // leave and wfh
                            $('#reason').html(attendance.reason || '');
                            $('#punchInTime').text(attendance.login || '00:00:00');
                            $('#punchOutTime').text(attendance.logout || '00:00:00');
                            $('#workingHours').text(attendance.workingh || '00:00:00');
                            $('#punchInTimeRow, #punchOutTimeRow, #workingHoursRow, #reasonRow').show();
                        }
                        // Extra working data handling
                        if (data.extra_working) {
                            var extra_working = data.extra_working;

                            $('#extra_working').show();
                            $('#starting_time').show().find('strong').text(extra_working
                                .extra_working_starting_time || '');
                            $('#ending_time').show().find('strong').text(extra_working
                                .extra_working_ending_time || '');
                            $('#extra_working_hour').show().find('strong').text(extra_working
                                .extra_working_working_hour || '');
                            if (data.weekend) {
                                $('#badge').html(
                                    `<div class="${data.weekend.class}"><h4 class="m-0 f-700 f-16 f-white">${data.weekend.content}</h4></div>`
                                );
                                $('#punchInTimeRow, #punchOutTimeRow, #workingHoursRow').hide();
                            }
                            if (data.leave) {
                                $('#badge').html(
                                    `<div class="${data.leave.class}"><h4 class="m-0 f-700 f-16 f-white">${data.leave.content}</h4></div>`
                                );
                            }
                        }

                        $('#detailsView').show();
                    } else {
                        alert('No data found for this date');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Error fetching data. Please try again.');
                }
            });
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var select = document.getElementById("yearSelect");
            var currentYear = new Date().getFullYear();

            for (var i = 0; i < 2; i++) {
                var option = document.createElement("option");
                option.text = currentYear - i;
                option.value = currentYear - i;
                select.add(option);
            }
        });
    </script>

    <script>
        $('#getAttendance').click(function() {
            var currentURL = window.location.href;
            var cleanURL = currentURL.split('?')[0];
            $month = $('#monthSelect').val();
            $year = $('#yearSelect').val();
            $url = cleanURL + '?mon=' + $month + '&year=' + $year;
            console.log($url);
            window.location.href = $url;
        })
    </script>
</body>

</html>
