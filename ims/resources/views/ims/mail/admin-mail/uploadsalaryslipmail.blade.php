<!DOCTYPE html>
<html>

<head>
    <title>Leave Request</title>
    <style>
        section {
            margin-left: 50px;
            margin-right: 50px;
        }

        .logo {
            margin-top: 30px;
            display: flex;
            justify-content: center;
        }

        .logo img {
            width: 250px;
            height: 100px;
            margin-left: 10px;
        }
    </style>
</head>

<body>

    <section>
        <div class="logo">
            <img src="{{ asset('assets/images/logo/HMMBiz-Logo.png') }}">
        </div>
        <div style="margin-top: 50px;">
            <h3>hi <strong>{{ $data['name'] }}</strong>,</h3>
            <p><strong>{{ $data['uploadby'] }}</strong> has upload salary slip for
                <strong>{{ $data['date'] }}</strong> , you can check IMS.
            </p>

            <p>Your bank deatils :</p>
            <p>Bank Name :<strong> {{ $data['bank_name'] }} </strong></p>
            <p>Account Number :<strong> {{ $data['account_no'] }} </strong></p>
            <p>IFSC Code :<strong> {{ $data['ifsc'] }} </strong></p>

        </div>
        <div style="font-size: 20px;margin-top: 50px">
            <p>Thanks & Regards, <br>
                IMS HMMBiz </p>
        </div>
    </section>

</body>

</html>
