<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
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
        <h2>Contact Us</h2>
    </div>

    <div class="content">
        <p>Hello Admin,</p>
        <p>You have received a new message via the Contact Us form.</p>
        <p><strong>Details:</strong></p>
        <ul>
            <li><strong>Name:</strong> {{$name}}</li>
            <li><strong>Email:</strong> {{$email}}</li>
            <li><strong>Subject:</strong> {{$usrSubject}}</li>
            <li><strong>Message:</strong> {{$usrMessage}}</li>
        </ul>
        <p>Please respond to the user at your earliest convenience.</p>

        <p>Regards,<br>
        HR Team</p>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} Your Company Name. All rights reserved.
    </div>
</body>
</html>
