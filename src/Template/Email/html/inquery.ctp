<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?= __('Gym-Admin') ?></title>
</head>

<body style="margin:0px;">
<table style="width:600px; margin:0 auto; padding:0px; font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; border-left:1px solid #eee; border-right:1px solid #eee;" cellpadding="0" cellspacing="0">
    	<tr>
        	<td>
            	<a href="http://new.nimbuzz.com/in/"><img src="https://s3-eu-west-1.amazonaws.com/nimbuzz-new/NimbuzzNews/mailer/header.jpg" alt="header" style="border-image:0px;"></a>
            </td>
        </tr>
        <tr>
            <td>
                <table width="600" cellpadding="0" cellspacing="0">
                    <tr><td align="center" style="font-weight: bold; font-size: 18px; color:#ff6600; padding-top: 15px;">Registration Successful</td></tr>
                    <tr>
                        <td style="padding:20px; font-size:12px; width:300px; text-align:justify;">
                            <p>
                               <?= __('Hi') ?> <strong><?= $name ?></strong>
                            </p>
                           <br>
                              <p>
                               <?= __('Email') ?> <strong><?= $email ?></strong>
                            </p>

                           
                            
                            <p style="line-height:25px;"><?= __('Congratulations! You have successfully registered as User') ?> </p>
                            <p align="center" style="margin-top:20px;">
                            <a href="http://new.nimbuzz.com/in/login-user" target="_blank" style="width: 100%; height:50px; background-color:#da2128; color:#fff; font-weight: normal; font-size: 14px; border: 0px; text-decoration: none; padding: 10px;">Click here to login</a>
                            </p>
                            <p style="line-height:25px;"><?= __('For any query, complaint or Suggestion, Just shoot us an email! We’re always here to help you.') ?></p>
                            <p style="line-height:25px;">
                                <?= __('Regards,') ?><br>
                                <?= __('Support Team,') ?><br>
                                <?= __('Gym-Admin') ?>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>         
        <tr>
            <td>
                <table width="600" cellpadding="0" cellspacing="0" style="background-color:#fff;">
                    <tr><td align="center"><hr style="width: 90%; border: 0.5px solid #ff6600; text-align: center"/></td></tr>
                    <tr>
                        <td align="center"><p style="font-size:11px; padding-left:15px;"><?= __('You have recived this message from') ?> <a href="#" style="color:#ff6600; text-decoration:none;"><?= __('Gym-Admin') ?></a></p></td>
                    </tr>
                    <tr>
                        <td align="center"><img src="https://s3-eu-west-1.amazonaws.com/nimbuzz-new/NimbuzzNews/mailer/social-icon.png" alt="social" usemap="#Map">
                        </td>
                    </tr>
                </table>    
            </td>
        </tr>   
    </table>
<map name="Map">  
  <area shape="circle" coords="23,23,19" href="https://www.facebook.com/Nimbuzz" target="_blank" alt="facebook">
  <area shape="circle" coords="73,22,17" href="https://twitter.com/nimbuzz" target="_blank" alt="twitter">
</map>
</body>
</html>
