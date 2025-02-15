<?php
/* // Email Submit
// Note: filter_var() requires PHP >= 5.2.0
if ( isset($_POST['email']) && isset($_POST['name']) && isset($_POST['subject']) && isset($_POST['message']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ) {
 
  // detect & prevent header injections
  $test = "/(content-type|bcc:|cc:|to:)/i";
  foreach ( $_POST as $key => $val ) {
    if ( preg_match( $test, $val ) ) {
      exit;
    }
  }

$headers = 'From: ' . $_POST["name"] . '<' . $_POST["email"] . '>' . "\r\n" .
    'Reply-To: ' . $_POST["email"] . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

  //
  mail( "khaitawng2014@gmail.com", $_POST['subject'], $_POST['message'], $headers );
 
  //      ^
  //  Replace with your email 
} */


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email'], $_POST['name'], $_POST['subject'], $_POST['message']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

        // Захист від ін'єкцій заголовків
        $test = "/(content-type|bcc:|cc:|to:)/i";
        foreach ($_POST as $key => $val) {
            if (preg_match($test, $val)) {
                exit;
            }
        }

        // Очищення введених даних
        $name = htmlspecialchars(strip_tags($_POST["name"]));
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $subject = htmlspecialchars(strip_tags($_POST["subject"]));
        $message = htmlspecialchars(strip_tags($_POST["message"]));

        // Формування заголовків
        $headers = "From: $name <$email>\r\n" .
                   "Reply-To: $email\r\n" .
                   "X-Mailer: PHP/" . phpversion();

        // Відправка email
        if (mail("khaitawng2014@gmail.com", $subject, $message, $headers)) {
            echo "success";
        } else {
            echo "error";
        }
        exit();
    }
}
?>

