<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Attendance Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .header {
            background-color: #f5f5f5;
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        .content {
            padding: 20px;
        }
        .footer {
            margin-top: 30px;
            padding: 10px;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #eee;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Attendance Report</h2>
    </div>

    <div class="content">
        <p>Hello,</p>

        <p>Your attendance report for the period:</p>
        <p><strong>From:</strong> {{ $fromDate }}<br>
           <strong>To:</strong> {{ $toDate }}</p>

        <p>The report is attached with this email in Excel format. Please review it and let us know if you have any questions.</p>

        <p>Thank you,<br>
        HR Team</p>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} Your Company Name. All rights reserved.
    </div>
</body>
</html>
