<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Welcome to Our Application</div>

                    <div class="card-body">
                        <p>OTP -  {{ $data['url'] }}</p>

                        <p>Welcome to our application! We are excited to have you on board.</p>

                        <p>Please click the link below to verify your email address:</p>


                        <p>If you did not create an account, no further action is required.</p>

                        <p>Thank you,<br> The Application Team</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>