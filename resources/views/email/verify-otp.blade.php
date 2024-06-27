<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


<body>

    <div
        style=" width: 27vw;
  min-width: 350px;
  margin: 6em auto;
  background-color: white;
  border-radius: 12px;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px,
    rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
  padding: 24px;">

        <div style="width:100%;text-align: center;">

            <img src="assets/media/logos/logo.png" style="height: 80px">



            <h2>Here is your One Time Password <br> to validate your email address</h2>
        </div>
        <div style="width:100%;text-align: center;">

            <img src="temp.png">
        </div>
<?php $otp=str_split($sentOtpDetails['otp_code']); ?>
        <div style="width:100%;text-align: center;">
            <div style="margin-top: 40px;">
                <span style="font-weight: 600; border: 1px solid #b7acac;
      padding: 3px 8px ;">{{$otp[0]}}</span>
                <span style="font-weight: 600; border: 1px solid #b7acac;
      padding: 3px 8px ;">{{$otp[1]}}</span>
                <span style="font-weight: 600; border: 1px solid #b7acac;
      padding: 3px 8px ;">{{$otp[2]}}</span>
                <span style="font-weight: 600; border: 1px solid #b7acac;
      padding: 3px 8px ;">{{$otp[3]}}</span>
      




            <div style="margin-top: 20px;">
                <p style=" color: #0c75ac;
    font-size: 15px;
    margin-top: 4px;">Valid for 2 minutes only
                </p>
            </div>
        </div>




    </div>


</body>

</html>
