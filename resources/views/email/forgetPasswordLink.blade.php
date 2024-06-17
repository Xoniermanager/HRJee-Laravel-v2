<html>

<body>
    <div>
        <table border="0" cellpadding="0" cellspacing="0" width="100%"
            style="table-layout:fixed;background-color:#F9F9F9;">
            <tbody>
                <tr>
                    <td align="center" valign="top" style="padding-right:10px;padding-left:10px;">
                        <!-- Email Wrapper Body Open // -->
                        <table border="0" cellpadding="0" cellspacing="0" style="max-width:600px;" width="100%"
                            class="wrapperBody">
                            <tbody>
                                <tr>
                                    <td align="center" valign="top">
                                        <!-- Table Card Open // -->
                                        <table border="0" cellpadding="0" cellspacing="0"
                                            style="background-color:#FFFFFF;border-color:#E5E5E5; border-style:solid; border-width:0 1px 1px 1px;"
                                            width="100%" class="tableCard">
                                            <tbody>
                                                <tr>
                                                    <!-- Header Top Border // -->
                                                    <td height="3"
                                                        style="background-color:#003CE5;font-size:1px;line-height:3px;"
                                                        class="topBorder">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="center" valign="top"
                                                        style="padding-bottom: 20px;padding-top: 20px;">
                                                        <!-- Hero Image // -->
                                                        <a style="text-decoration:none;">
                                                            <img src="{{ url('assets/media/logos/logo.png') }}"
                                                                alt="" border="0"
                                                                style="width:250px; height:auto; display:block;">
                                                        </a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td align="center" valign="top"
                                                        style="padding-bottom: 5px; padding-left: 20px; padding-right: 20px;">
                                                        <!-- Main Title Text // -->
                                                        <h2 class="text"
                                                            style="color:#555; font-family:'Poppins', Helvetica, Arial, sans-serif; font-size:18px; text-align:center; margin:0">
                                                            Hi User !
                                                        </h2> <!-- Main Title Text // -->
                                                        <h2 class="text"
                                                            style="color:#555; font-family:'Poppins', Helvetica, Arial, sans-serif; font-size:16px; text-align:center; margin:0">
                                                            A password reset for your account was requested.

                                                        </h2>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center" valign="top" style="padding-bottom: 20px;">
                                                        <!-- Hero Image // -->

                                                        <img src="{{ url('assets/media/reset.png') }}" alt=""
                                                            border="0"
                                                            style="width:220px; height:auto; display:block;">

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center" valign="top"
                                                        style="padding-left:20px;padding-right:20px;"
                                                        class=" ui-sortable">

                                                        <table border="0" cellpadding="0" cellspacing="0"
                                                            width="100%" class="" style="">
                                                            <tbody>
                                                                <tr>
                                                                    <td align="center" valign="top"
                                                                        style="padding:0 0;">
                                                                        <!-- Description Text// -->
                                                                        <p
                                                                            style="font-family:'Poppins', Helvetica, Arial, sans-serif;">
                                                                            Please click the button below to change your
                                                                            password.
                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center" valign="top"
                                                                        style="padding:20px 0;">
                                                                        <!-- Description Text// -->
                                                                        <a href="{{ route('reset.password.get', $token) }}"
                                                                            style="font-family:'Poppins', Helvetica, Arial, sans-serif;margin-bottom:20px;    position: relative;
											overflow: hidden;
											display: inline-flex;
											justify-content: center;
											align-items: center;
											text-decoration: none !important; 
											border-radius: 0.25rem;
											border-bottom-left-radius: 1rem;
											border-top-right-radius: 1rem;
											padding: 0.75rem 2.25rem;
											font-size: 1.1rem;
											font-weight: 500; 
											cursor: pointer;
											color: #fff;
											background: linear-gradient(to right, #0528a5, #6193f6);
   											border: 2px solid #1035af;">Reset
                                                                            password</a>
                                                                    </td>
                                                                </tr>


                                                                <tr>
                                                                    <td align="center" valign="top"
                                                                        style="padding: 10px 10px;background:#eee;">
                                                                        <!-- Information of NewsLetter (Subscribe Info)// -->
                                                                        <p class="text"
                                                                            style="color:#000; font-family:'Poppins', Helvetica, Arial, sans-serif; font-size:12px; font-weight:400; font-style:normal; letter-spacing:normal; line-height:20px; text-transform:none; text-align:center; padding:0; margin:0;">
                                                                            Note: that this link is valid for 24 hours.
                                                                            After the time limit has expired, you will
                                                                            have to resubmit the request for a password
                                                                            reset.

                                                                        </p>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td height="20" style="font-size:1px;line-height:1px;">&nbsp;
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                        <!-- Table Card Close// -->

                                        <!-- Space -->
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                            class="space">
                                            <tbody>
                                                <tr>
                                                    <td height="30" style="font-size:1px;line-height:1px;">&nbsp;
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Email Wrapper Body Close // -->


                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
