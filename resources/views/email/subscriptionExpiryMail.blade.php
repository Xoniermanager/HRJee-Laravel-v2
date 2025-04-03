<!DOCTYPE html>
<html>
<head>
    <title>Subscription Expiry Notice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
        }
        h2 {
            color: #d9534f;
        }
        .button {
            display: inline-block;
            background-color: #28a745;
            color: #ffffff;
            padding: 12px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            margin-top: 15px;
        }
        .button:hover {
            background-color: #218838;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>⚠️ Your Subscription is Expiring Soon!</h2>
        <p>Hi {{ $userName }},</p>
        <p>Your subscription will expire on <strong>{{ $expiryDate }}</strong>. Renew today to continue enjoying our services without interruption.</p>
        <a href="https://hrjee.com/" class="button">Renew Now</a>
        <p class="footer">If you have already renewed, please ignore this message.</p>
    </div>
</body>
</html>
