<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip {{ date('F Y', strtotime('last month')) }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }

        h1 {
            color: blue;
        }

        p {
            font-size: 16px;
        }

        .footer {
            font-size: 12px;
            color: #777;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h1>Payslip for {{ date('F Y', strtotime('last month')) }}</h1>

    <p>Dear {{ $userName }},</p>

    <p>We have attached your Payslip for the month of {{ date('F Y', strtotime('last month')) }}. Please find the file attached to this email. If you have any questions or concerns, feel free to reach out to us.</p>

    <p>Best regards,</p>
    <p><strong>Hrjee</strong></p>

    <div class="footer">
        <p>&copy; {{ date('Y') }} Hrjee. All rights reserved.</p>
    </div>
</body>
</html>
