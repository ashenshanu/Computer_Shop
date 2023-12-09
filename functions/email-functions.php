<?php
include "./code-generate.php";
include "./email-configuration.php";

// https://drive.google.com/uc?id=1PgV43MSYVk4-qN4HSjq9i3aRsJh_DvPU
// https://drive.google.com/uc?id=1JI8gMeILy4Tt9BeuKbN7-ZeYJCnWVisT
function emailVerificationSend($toEmail){
    $genCode = generateCode();

    //var_dump($genCode);

    $to = $toEmail;
    $subject = "Email Verification Code from Sanakin.lk";
    $code = $genCode;
    $_SESSION['verifyingCode'] = $code;
    $arrayDigits = str_split($code);
    $body = "<!DOCTYPE html>
<html lang='en'>
<body style='width: 100%;'>
  <table style='width: 100%; margin: auto;'>
    <tr>
      <td>
        <table style='width: 600px;'>
          <tr>
            <td style='background-color: #FF9C00; height: 10px;'></td>
          </tr>
          <tr>
            <td style='text-align: center; font-family: 'Manrope', sans-serif;'>
              <table style='margin: auto;'>
                <tr>
                  <td style='text-align:center;'><img src='http://sanakin-lk.000webhostapp.com/assets/sanakin-logo.png' style='width: 200px; margin-top: 30px;' alt='sanakin.lk'></td>
                </tr>
                <tr>
                  <td style='text-align:center;font-size: 36px; font-weight: bold; color: #000000;'>Verify Your Email</td>
                </tr>
                <tr>
                  <td style='text-align:center;'><img src='http://sanakin-lk.000webhostapp.com/assets/icons/orange-shild.png' style='width: 165px; margin-top: 20px;' alt='verify code'></td>
                </tr>
                <tr style='margin-top: 30px;'>
                  <td style='width: 512px; font-size: 16px;font-weight: 500; text-align: left;'>
                    Thanks for registering an account with <a href='#' style='color: #FF9C00;text-decoration: none;'>Sanakin.lk!</a><br><br>
                    Find you’r email Verification code and verify your email within 5 minutes. if failure to verify your email within the time duration you have to get a new code and try again.
                  </td>
                </tr>
                <tr>
                  <td style='text-align: center;'>
                    <table style='display: inline-table;'>
                      <tr style='display: flex; gap: 10px; font-size: 36px;margin-top: 30px;'>
                        <td style='display: flex; justify-content: center; width: 55px; height: 72px; background-color: #F0F0F0; border: 0px soild transparent; border-radius: 5px; text-align: center;margin-right: 10px;'>
                          <p style='margin: auto;'>" . $arrayDigits[0] . "</p>
                        </td>
                        <td style='display: flex; justify-content: center; width: 55px; height: 72px; background-color: #F0F0F0; border: 0px soild transparent; border-radius: 5px; text-align: center;margin-right: 10px;'>
                          <p style='margin: auto;'>" . $arrayDigits[1] . "</p>
                        </td>
                        <td style='display: flex; justify-content: center; width: 55px; height: 72px; background-color: #F0F0F0; border: 0px soild transparent; border-radius: 5px; text-align: center;margin-right: 10px;'>
                          <p style='margin: auto;'>" . $arrayDigits[2] . "</p>
                        </td>
                        <td style='display: flex; justify-content: center; width: 55px; height: 72px; background-color: #F0F0F0; border: 0px soild transparent; border-radius: 5px; text-align: center;margin-right: 10px;'>
                          <p style='margin: auto;'>" . $arrayDigits[3] . "</p>
                        </td>
                        <td style='display: flex; justify-content: center; width: 55px; height: 72px; background-color: #F0F0F0; border: 0px soild transparent; border-radius: 5px; text-align: center;margin-right: 10px;'>
                          <p style='margin: auto;'>" . $arrayDigits[4] . "</p>
                        </td>
                        <td style='display: flex; justify-content: center; width: 55px; height: 72px; background-color: #F0F0F0; border: 0px soild transparent; border-radius: 5px; text-align: center;'>
                          <p style='margin: auto;'>" . $arrayDigits[5] . "</p>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td style='text-align: center;font-size: 16px; font-weight: 500;'>Verification Code</td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table style='width: 512px; margin: auto;'>
                <tr>
                  <td style='background-color: gray; height: 1px;'></td>
                </tr>
                <tr>
                  <td style='font-family: Manrope, sans-serif; font-size: 14px; text-align: center; color: gray;'>
                    You have received this mandatory service announcement to update you about important changes to <a href='#' style='color: #FF9C00; text-decoration: none;'>Sanakin.lk</a> or your account.
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>

";

    
    return send_email($to, $subject, $body);
  
    // send_email("shashishajanith1@gmail.com","testing subject" , "testing");
}





function fogetPasswordVerificationSend($toEmail,$resetLink){


  $to = $toEmail;
  $subject = "Reset Your Sanakin.lk Account Password";
  $body = "<!DOCTYPE html>
  <html lang='en'>
  <body style='width: 100%;'>
    <table style='width: 100%; margin: auto;'>
      <tr>
        <td>
          <table style='width: 600px;'>
            <tr>
              <td style='background-color: #FF9C00; height: 10px;'></td>
            </tr>
            <tr>
              <td style='text-align: center; font-family: 'Manrope', sans-serif;'>
                <table style='margin: auto;'>
                  <tr>
                    <td><img src='http://sanakin-lk.000webhostapp.com/assets/sanakin-logo.png' style='width: 200px; margin-top: 30px;' alt='sanakin.lk'></td>
                  </tr>
                  <tr>
                    <td style='font-size: 36px; font-weight: bold; color: #000000;'>Reset Password<br>Verification</td>
                  </tr>
                  <tr style='margin-top: 30px;'>
                    <td style='width: 512px; font-size: 16px;font-weight: 500; text-align: left;'>
                      Please use this link to reset the password for the <a href='#' style='color: #FF9C00;text-decoration: none;'>Sanakin.lk!</a> Account. 
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p>Click this link - <a id='resetPasswordLink' href='".$resetLink."'>".$resetLink."</a> </p>
                    </td>
                  </tr>
                  <tr style='margin-top: 40px;margin-bottom: 30px;'>
                    <td style='text-align: left;'>
                      Thanks,<br>The Sanakin.lk Team 
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
            <tr>
              <td>
                <table style='width: 512px; margin: auto;'>
                  <tr>
                    <td style='background-color: gray; height: 2px;'></td>
                  </tr>
                  <tr>
                    <td style='font-family: 'Manrope', sans-serif; font-size: 14px; text-align: center; color: gray;'>
                      You have received this mandatory service announcement to update you about important changes to <a href='#' style='color: #FF9C00; text-decoration: none;'>Sanakin.lk</a> or your account.
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </body>
  </html>
  
  ";



  
  return send_email($to, $subject, $body);
  
}


?>
