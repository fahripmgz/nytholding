<?php
include 'PHPMailerAutoload.php';
ini_set('smtp_port', 587);




//FOR MATERIAL REQUEST
function AddNewMR($txtnoMR,$datereqmr,$messagemr) {

$mail = new PHPMailer();

$mail->isSMTP();

$mail->SMTPDebug = 0;

$mail->Debugoutput = 'html';

$mail->Host = "mail.nyt.co.id"; //host smtp kalian

$mail->Port = 587; //Port smtp kalian
$mail->SMTPAuth = true;
$mail->SMTPSecure = false;
$mail->IsHTML(true); 
$mail->Username = 'no-reply@nyt.co.id';                // SMTP username
$mail->Password = 'Nyt2017';                  // SMTP password

$mail->setFrom('no-reply@nyt.co.id','No-Reply'); //Email pengirim
$mail->From = 'no-reply@nyt.co.id';
//$mail->addReplyTo($emailfrom,$namafrom); //Tujuan email balasan

$mail->addAddress('raisanirmala@gmail.com'); //Email tujuan

     // $mail->AddCC('imauhibi@gmail.com');
      // $mail->AddCC('alissa.ong@gmail.com');
     $mail->AddCC('harysatrio22@gmail.com');
      $mail->AddCC('fahrypamungkas@gmail.com');
       $mail->AddCC('budi.rachmat@audemars.co.id');
       $mail->AddCC('irwandi@audemars.co.id');
         $mail->AddCC('irvan.sandoval@audemars.co.id');
          $mail->AddCC('ardy_mardiansyah@audemars.co.id');
           $mail->AddCC('steffenc@gmail.com');

$mail->Subject = 'Material Request Notification /'.$txtnoMR;
  $mail->Body    = $messagemr;
  $mail->AltBody    = $body;

if(!$mail->Send())
{
echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
echo "<br><div class='alert alert-success'>
                                Email has been sent!
                            </div>";
}


}



//FOR PO
function AddNewPO($txtnoPO,$datereqPO,$messagePO) {

$mail = new PHPMailer();

$mail->isSMTP();

$mail->SMTPDebug = 0;

$mail->Debugoutput = 'html';

$mail->Host = "mail.nyt.co.id"; //host smtp kalian

$mail->Port = 587; //Port smtp kalian
$mail->SMTPAuth = true;
$mail->SMTPSecure = false;
$mail->IsHTML(true); 
$mail->Username = 'no-reply@nyt.co.id';                // SMTP username
$mail->Password = 'no-reply2017';                  // SMTP password

$mail->setFrom('no-reply@nyt.co.id','No-Reply'); //Email pengirim
$mail->From = 'no-reply@nyt.co.id';
//$mail->addReplyTo($emailfrom,$namafrom); //Tujuan email balasan

$mail->addAddress('alissa.ong@gmail.com'); //Email tujuan

       $mail->AddCC('fahrypamungkas@gmail.com');
     $mail->AddCC('harysatrio22@gmail.com');
      $mail->AddCC('raisanirmala@gmail.com');
        $mail->AddCC('charlesteo@gmail.com');
          $mail->AddCC('steffenc@gmail.com');
  

$mail->Subject = 'Material Request Notification /'.$txtnoPO;
  $mail->Body    = $messagePO;
  $mail->AltBody    = $body;

if(!$mail->Send())
{
echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
echo "<br><div class='alert alert-success'>
                                Email has been sent!
                            </div>";
}


}


?>