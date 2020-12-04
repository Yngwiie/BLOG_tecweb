<?php
#validar captcha v2
$response_recaptcha = $_POST['captcha'];
if(!$response_recaptcha){
  echo "<div class='alert alert-danger' role='alert'>
  Debes completar el captcha!
</div>";
}
if(isset($response_recaptcha) && $response_recaptcha){
  $secret = "6LdAlOQZAAAAAEzTBlpzzgXB5UcAhu0jdtoALpue";
  $ip = $_SERVER['REMOTE_ADDR'];
  $validation_server = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$response_recaptcha);

  $arr = json_decode($validation_server, TRUE);

  if($arr['success'] ){
      // Check for empty fields
      if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        http_response_code(500);
        exit();
      }

      $name = strip_tags(htmlspecialchars($_POST['name']));
      $email = strip_tags(htmlspecialchars($_POST['email']));
      $phone = strip_tags(htmlspecialchars($_POST['phone']));
      $message = strip_tags(htmlspecialchars($_POST['message']));

      // Create the email and send the message
      $to = "ikillikii@gmail.com"; // Add your email address in between the "" replacing yourname@yourdomain.com - This is where the form will send a message to.
      $subject = "Website Contact Form:  $name";
      $body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email\n\nPhone: $phone\n\nMessage:\n$message";
      $header = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
      $header .= "Reply-To: $email";	

      if(!mail($to, $subject, $body, $header))
        http_response_code(500);
        }else{
          
        }
}

?>
