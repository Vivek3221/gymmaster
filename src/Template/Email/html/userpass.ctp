<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta name="viewport" id="viewport" content="width=device-width, initial-scale=1.0" />
    </head>
    <body style="margin:0 auto; font-size: 14px; font-family: arial;">
        <table cellpadding="0" cellspacing="0" align="center" border="0" style="background-color: #f9f9f9;">
            <tr>
                <td width="100%">
                    <table cellspacing="0" width="600" cellpadding="0" height="80" style="background-color: #cd1214;">
                        <tr>	
                            <td style="padding-left: 15px; color: #fff; font-size: 24px; text-align: left; width: 600px;">Registration Success</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table cellpadding="0" cellspacing="0" align="center">
                        <tr>
                            <td align="center" style="text-align: justify; padding: 0px 15px;">
                                <p>
                                    Dear  <strong><?= $name ?></strong>
                                </p>
                                <p>
                                    Your Email :- <strong><?= $email ?></strong>
                                </p>
                                <p>
                                    Your Password :- <strong><?= $password ?></strong>
                                </p>
                                <p>
                                    Plan Name :- <strong><?= $planName ?></strong>
                                </p>
                                <p>
                                    Plan Fee :- <strong>INR <?= $totalFee ?></strong>
                                </p>
                                <p>
                                    Amount Paid :- <strong>INR <?= $paidAmount ?></strong>
                                </p>
                                <p>
                                    Plan Expire Date  :- <strong><?= $expireDate ?></strong>
                                </p>
                                <p style="line-height:10px;"> Congratulations! You have successfully registered as User </p>
                                <p align="center" style="margin-top:20px;">
                                    <a href="http://datamonitering.com/" target="_blank" style="width: 100%; height:50px; background-color:#cd1214; color:#fff; font-weight: normal; font-size: 14px; border: 0px; text-decoration: none; padding: 10px;">Click here to login</a>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size:12px; text-align:justify; padding: 0px 15px;">
                                <p style="line-height:25px; font-weight: bold; color: #6f6e6e;">
                                    <?= __('Regards,') ?><br>
                                    <?= __('Support Team,') ?><br>
                                    <?php if($users_type ==1)
                                    {
                                    echo 'Datamonitoring';
                                    } else {
                                       echo $users_name; 
                                    } ?>
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table style="background-color: #333;" align="center" hight="45">
                        <tr>
                            <td align="center" style="width: 600px">
                                <p style="font-size:11px; padding-left:15px; color: #fff;">You have recived this message from <a href="http://datamonitering.com/" style="color:#f3f3f3; text-decoration:none;">datamonitering.com</a></p>
                                <td align="center" style="width: 300px">
                            <a href="https://play.google.com/store/apps/details?id=com.datamonitor.com">
                                <img src="http://datamonitering.com/Admintheme/img/play-store.png" alt="Google App">
                            </a>
                        </td>
                         <td align="center" style="width: 300px">
                            <a href="https://itunes.apple.com/us/app/datamonitering/id1438079358?ls=1&mt=8">
                                <img src="http://datamonitering.com/Admintheme/img/app-store.png" alt="Apple App">
                            </a>
                        </td>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>