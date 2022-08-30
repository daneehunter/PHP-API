<?php
use PHPMailer\PHPMailer\PHPMailer;
date_default_timezone_set('Europe/Budapest');
$mailConf=parse_ini_file('C:\\Apache24\\ewert\\mail.ini',true);
require 'mailer/Exception.php';
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';

$mail = new PHPMailer;

$mail->isSMTP();
$mail->CharSet = 'utf-8';

$mail->SMTPDebug = 0;
$mail->Host=$mailConf['mail']['host'];

$mail->Port =$mailConf['mail']['port'];
$mail->SMTPAuth = false;


?>