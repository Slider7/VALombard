<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        # FIX: Replace this email with recipient email
        $mail_to = "kemalsh771@gmail.com";
		$host = $_SERVER['HTTP_HOST'];
		$header = "Content-type: text/html\n";
		$header .= "From: <noreply@$host>\n";
			
        # Sender Data
        $subject = "Сообщение от посетителя сайта $host";
        $name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["name"])));
        $email = "noreply@$host";
		/*filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);*/
        $message = trim($_POST["message"]);
        
        if ( empty($name) OR empty($message)) {
            # Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Заполните форму и попробуйте отправить еще раз.";
            exit;
        }
        
        # Mail Content
		$content = "Имя: $name\n"."\nСообщение:\n$message\n";

        # Send the email.
          if (mail($mail_to, $subject, $content, $header)) {
              # Set a 200 (okay) response code.
              http_response_code(200);
              echo "Спасибо! Ваше сообщение успешно отправлено.";
          } else {
              # Set a 500 (internal server error) response code.
              http_response_code(500);
              echo "Ошибка! Что-то пошло не так. Ваше сообщение не отправлено.";
          };

        } else {
            # Not a POST request, set a 403 (forbidden) response code.
            http_response_code(403);
            echo "Ошибка при отправке, попробуйте еще раз.";
        };
?>
