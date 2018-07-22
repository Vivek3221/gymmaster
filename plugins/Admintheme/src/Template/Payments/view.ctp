<?php
    $getModPayment = $this->Common->getModPayment();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Athlete Monitoring Software,Fitness Testing,Athlete Management System</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <style type="text/css" media="screen">
            body {
                margin-left: auto;
                margin-right: auto;
                height: 942px;
                width: auto;
                font-size:12px;
                padding-right:auto !important;
                margin-right:auto !important;
            }
            .style2 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; text-decoration:none; }
        </style>
    </head>
    <body style="margin-left:45px;" onload="findHeights()">
        <div style="width:915px; margin:auto; border:1px solid #f5f5f5; padding: 10px;">
            <div>
                <table style="width:893px;">
                    <tr>
                        <td colspan="2" style="width:296px; padding-left:8px; vertical-align: top;">
                            <h1><?= $partnerDetails->name ?></h1>
                        </td> 
                    </tr>
                </table>
            </div>
            <hr style="margin:5px 0px;">
            <div>
                <h3 style="text-align:center;"><U><b>Payment Slip</b></U></h3>
            </div>
            <div>
                <table style=" width:893px;">
                    <tr style="border-top: 1px solid #d2d2d2;border-bottom: 1px solid #d2d2d2;">
                        <td colspan="2" style="width:250px;">
                            <b><?= $payment->user->name ?></b><br>
                            Ph- <?= $payment->user->mobile_no ?>, Email- <?= $payment->user->email ?>
                            <br>
                            <p style="border: 0px; background: #fff;">
                                <b><u>Plan Details</u></b><br>
                                Name:  <b><?= $payment->plan_subscriber->plan_name ?></b><br>
                                Total Fee:  <b>INR <?= $payment->plan_subscriber->fee ?></b><br>
                                Subscribed on:  <b><?= date('d M Y',strtotime($payment->plan_subscriber->created)) ?></b><br>
                                Payment Due Date:  <b><?= date('d M Y',strtotime($payment->plan_subscriber->payment_due_date)) ?></b><br>
                                Plan Expire Date:  <b><?= date('d M Y',strtotime($payment->plan_subscriber->plan_expire_date)) ?></b><br>
                            </p>
                        </td>
                        <td  colspan="2" style="width:250px; border-left: 1px solid #d2d2d2;">
                            <p style="border: 0px; background: #fff; margin-left: 10px;">
                                <b><u>Payment Detail</u></b><br>
                                Payment Date:  <b><?= date('d M Y',strtotime($payment->created)) ?></b><br>
                                Payment Mode:  <b><?= $getModPayment[$payment->mode_ofpay] ?></b><br>
                                Payment Amount:  <b>INR <?= $this->Number->format($payment->amount) ?></b><br>
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
            <hr style="margin:5px 0px;">
            <p style="text-align:center; margin-bottom:0px; font-size:11px;">
                Ph- <?= $partnerDetails->mobile_no ?>, Email- <?= $partnerDetails->email ?> <br>This is Computer Generated Payment Slip.
            </p>
            <script>
                function findHeights() {
                    var ttt = 1;
                    var ax = 381;
                    var ax = 381;
                    var ioo = 0;
                    for (io = 1; io <= ttt; io++) {

                        var tbl = document.getElementById('ik00p' + io).offsetHeight;
                        ioo = ioo + tbl;
                    }
                    h_tr = ax - ioo;
                    document.getElementById("kpoii").style.height = h_tr + "px";
                }
            </script>
            <table align="center" border="0" cellpadding="0" cellspacing="0" width="50%" class="width print_act" style="font-size:11px;">
                <tr>
                    <td class="style2" style="width:38%"><div align="center" class="style2"> <a class="style2 exclude" href="#" onclick="btn_show();">Print</a></div></td>
                </tr>
            </table>

        </div>
        <script>
            function btn_show()
            {
                $('.print_act').hide();
                $('div.wrapper').removeClass('slide-nav-toggle');
                window.print();
                $('.print_act').show();
                $('div.wrapper').addClass('slide-nav-toggle');
            }
        </script>
    </body>
</html>



