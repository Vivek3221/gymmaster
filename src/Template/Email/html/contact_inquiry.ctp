<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>New Contact Enquiry — MakeOver Star HIIT</title>
</head>
<body style="margin:0; padding:0; background-color:#0f0f0f; font-family:'Segoe UI',Arial,sans-serif;">

  <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color:#0f0f0f; padding:40px 20px;">
    <tr>
      <td align="center">
        <table role="presentation" width="600" cellspacing="0" cellpadding="0" border="0" style="max-width:600px; width:100%;">

          <!-- ====== HEADER ====== -->
          <tr>
            <td style="background: linear-gradient(135deg, #e8a000 0%, #ff6b00 100%); border-radius:16px 16px 0 0; padding:40px 40px 30px; text-align:center;">
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                <tr>
                  <td align="center" style="padding-bottom:16px;">
                    <!-- Icon Badge -->
                    <div style="display:inline-block; background:rgba(255,255,255,0.2); border-radius:50%; width:64px; height:64px; line-height:64px; text-align:center; font-size:28px;">
                      ✉️
                    </div>
                  </td>
                </tr>
                <tr>
                  <td align="center">
                    <h1 style="margin:0; color:#ffffff; font-size:26px; font-weight:700; letter-spacing:-0.5px;">New Contact Enquiry</h1>
                    <p style="margin:8px 0 0; color:rgba(255,255,255,0.85); font-size:14px; font-weight:400;">Someone reached out via the MakeOver Star HIIT website</p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- ====== BODY ====== -->
          <tr>
            <td style="background:#1a1a1a; padding:36px 40px;">

              <!-- Greeting -->
              <p style="margin:0 0 24px; color:#a0a0a0; font-size:14px; line-height:1.6;">
                Hi Team, you have received a new message from the contact form on your website. Here are the full details:
              </p>

              <!-- Detail Cards -->
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">

                <!-- Name -->
                <tr>
                  <td style="padding-bottom:12px;">
                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
                      style="background:#242424; border-radius:10px; border-left:4px solid #e8a000; overflow:hidden;">
                      <tr>
                        <td style="padding:16px 20px;">
                          <p style="margin:0 0 4px; color:#e8a000; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:1px;">Full Name</p>
                          <p style="margin:0; color:#ffffff; font-size:16px; font-weight:600;"><?= h($senderName) ?></p>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>

                <!-- Email -->
                <tr>
                  <td style="padding-bottom:12px;">
                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
                      style="background:#242424; border-radius:10px; border-left:4px solid #ff6b00; overflow:hidden;">
                      <tr>
                        <td style="padding:16px 20px;">
                          <p style="margin:0 0 4px; color:#ff6b00; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:1px;">Email Address</p>
                          <p style="margin:0;">
                            <a href="mailto:<?= h($senderEmail) ?>" style="color:#ffffff; font-size:16px; font-weight:600; text-decoration:none;">
                              <?= h($senderEmail) ?>
                            </a>
                          </p>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>

                <!-- Phone -->
                <?php if (!empty($senderPhone)): ?>
                <tr>
                  <td style="padding-bottom:12px;">
                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
                      style="background:#242424; border-radius:10px; border-left:4px solid #e8a000; overflow:hidden;">
                      <tr>
                        <td style="padding:16px 20px;">
                          <p style="margin:0 0 4px; color:#e8a000; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:1px;">Phone Number</p>
                          <p style="margin:0;">
                            <a href="tel:<?= h($senderPhone) ?>" style="color:#ffffff; font-size:16px; font-weight:600; text-decoration:none;">
                              <?= h($senderPhone) ?>
                            </a>
                          </p>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <?php endif; ?>

                <!-- Message -->
                <tr>
                  <td style="padding-bottom:0;">
                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0"
                      style="background:#242424; border-radius:10px; border-left:4px solid #ff6b00; overflow:hidden;">
                      <tr>
                        <td style="padding:16px 20px;">
                          <p style="margin:0 0 8px; color:#ff6b00; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:1px;">Message</p>
                          <p style="margin:0; color:#e0e0e0; font-size:15px; line-height:1.7; white-space:pre-wrap;"><?= h($senderMessage) ?></p>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>

              </table>

              <!-- Divider -->
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin:28px 0;">
                <tr>
                  <td style="border-top:1px solid #2e2e2e;">&nbsp;</td>
                </tr>
              </table>

              <!-- Timestamp -->
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                <tr>
                  <td style="background:#242424; border-radius:10px; padding:14px 20px;">
                    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0">
                      <tr>
                        <td style="width:20px; vertical-align:middle;">
                          <span style="font-size:16px;">🕐</span>
                        </td>
                        <td style="padding-left:10px; vertical-align:middle;">
                          <p style="margin:0; color:#a0a0a0; font-size:13px;">
                            Received on <strong style="color:#e0e0e0;"><?= date('d M Y, h:i A') ?></strong>
                          </p>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>

              <!-- CTA Button -->
              <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top:28px;">
                <tr>
                  <td align="center">
                    <a href="mailto:<?= h($senderEmail) ?>"
                      style="display:inline-block; background:linear-gradient(135deg,#e8a000,#ff6b00); color:#ffffff; font-size:15px; font-weight:700; text-decoration:none; padding:14px 36px; border-radius:50px; letter-spacing:0.5px;">
                      Reply to <?= h($senderName) ?> &rarr;
                    </a>
                  </td>
                </tr>
              </table>

            </td>
          </tr>

          <!-- ====== FOOTER ====== -->
          <tr>
            <td style="background:#111111; border-radius:0 0 16px 16px; padding:24px 40px; text-align:center;">
              <p style="margin:0 0 6px; color:#555555; font-size:12px;">
                This email was sent automatically from the contact form on
              </p>
              <p style="margin:0 0 12px;">
                <a href="http://makeover72.com" style="color:#e8a000; font-size:13px; font-weight:600; text-decoration:none;">MakeOver Star HIIT</a>
              </p>
              <p style="margin:0; color:#3a3a3a; font-size:11px;">
                MakeOver Fitness, Opp. Singla General Store, Mandi Gobindgarh, Punjab 147301
              </p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>

</body>
</html>
