<?php
$captcha;
if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
  $captcha = $_POST['g-recaptcha-response'];
  echo "Captcha is set!!";

  $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcXYE8UAAAAAJvzr8eiKd0Fvs_XcMQ7l4GhX5vk&response=" . $captcha);
  if (!$captcha || $response.success == false) {
      echo "Your CAPTCHA response was wrong.";
      exit;
  }
  if ($response.success == true) {
    echo "Response successy!";
    $con_name = $_POST['con_name'];
    $con_email = $_POST['con_email'];
    $con_message = $_POST['con_message'];

    $to = 'robfarb.dev@gmail.com';
    $subject = 'Portfolio Site Form Submission';

    $message = '<strong>Name : </strong>'.$con_name.'<br/><br/>';

    $message .= $con_message.'<br/>';

    $headers = 'From: '.$con_name.' '.$con_email . "\r\n" ;
    $headers .='Reply-To: '. $to . "\r\n" ;
    $headers .='X-Mailer: PHP/' . phpversion();
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    
    mail($to, $subject, $message, $headers);
    echo 1;
  }
}

