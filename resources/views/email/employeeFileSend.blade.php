<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Details Export</title>
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
    <h1>Employee Details</h1>

    <p>Dear {{ $companyName }},</p>

    <p>We have attached the Employee Details file you requested. Please find the file attached to this email. If you
        have any questions, feel free to reach out to us.</p>

    <p>Best regards,</p>
    <p><strong>Hrjee</strong></p>

    <div class="footer">
        <p>&copy; {{ date('Y') }} Hrjee. All rights reserved.</p>
    </div>
</body>

</html>
