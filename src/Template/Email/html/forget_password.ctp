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
                            <td style="padding-left: 15px; color: #fff; font-size: 24px; text-align: left; width: 600px;">Reset Password</td>
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
                                    Dear <strong><?= $name ?>,</strong>
                                </p>
                                <p>
                                    For reset your password click on the below given link
                                </p>
                                <p>
                                    <strong><a href="<?= $link ?>"><?= $link ?></a></strong>
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
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>