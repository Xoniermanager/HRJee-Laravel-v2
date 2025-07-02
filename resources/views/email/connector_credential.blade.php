<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connector Credential</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .content {
            padding: 20px;
        }

        .footer {
            margin-top: 30px;
            padding: 15px;
            font-size: 12px;
            color: #777;
            text-align: center;
            background-color: #f1f1f1;
        }

        h2 {
            margin: 0;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin: 10px 0;
        }

        .highlight {
            color: #007bff;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Your Credentials</h2>
        </div>

        <div class="content">
            <p>Hello {{ $name }},</p>
            <p>You have received a message via the Loan Gateway admin.</p>
            <p><strong>Your Login credentials</strong></p>
            <ul>
                <li><strong>Email:</strong> <span class="highlight">{{ $email }}</span></li>
                <li><strong>Password:</strong> <span class="highlight">{{ $password }}</span></li>
            </ul>
            <p>Please log in using the credentials provided above:</p>
            <p><a href="http://localhost:8000"
                    style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px; margin: 15px 0;">Login
                    Now</a></p>

            <p>Regards,<br>
                <strong>Team Loan Gateway</strong>
            </p>
        </div>

        <div class="footer">
            &copy; {{ date('Y') }} Your Company Name. All rights reserved.
        </div>
    </div>
</body>

</html>
