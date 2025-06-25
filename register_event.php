<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event = $_POST['event'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Send confirmation email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'manichandrika36@gmail.com';
        $mail->Password = 'hjajcshdsehasxdj';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('manichandrika36@gmail.com', 'SARO Club');
        $mail->addAddress($email, $name);

        $mail->isHTML(true);
        $mail->Subject = 'Event Registration Confirmation';
        $mail->Body    = "<p style='font-family: Poppins, sans-serif;'>Dear <strong>$name</strong>,</p>
                          <p style='font-family: Poppins, sans-serif;'>Thank you for registering for the event <strong>$event</strong>. We look forward to seeing you!</p>
                          <p style='font-family: Poppins, sans-serif;'>Best regards,<br>SARO Club</p>";

        $mail->send();
    } catch (Exception $e) {
        error_log("Mailer Error: {$mail->ErrorInfo}");
    }

    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Registration Successful</title>
        <link href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap' rel='stylesheet'>
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f0f8ff;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }

            .success-box {
                background-color: #ffffff;
                padding: 40px;
                border-radius: 15px;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
                text-align: center;
                max-width: 500px;
                width: 90%;
            }

            .success-box h1 {
                color: #28a745;
                font-size: 2rem;
                margin-bottom: 20px;
            }

            .success-message {
                font-size: 1.1rem;
                color: #333333;
                margin-bottom: 30px;
            }

            .home-link {
                display: inline-block;
                background-color: #007bff;
                color: #ffffff;
                padding: 12px 25px;
                border-radius: 8px;
                text-decoration: none;
                font-weight: 600;
                transition: background-color 0.3s ease;
            }

            .home-link:hover {
                background-color: #0056b3;
            }

            @media (max-width: 500px) {
                .success-box h1 {
                    font-size: 1.5rem;
                }

                .success-message {
                    font-size: 1rem;
                }
            }
        </style>
    </head>
    <body>
        <div class='success-box'>
            <h1>Registration Successful 🎉</h1>
            <p class='success-message'>Thank you, <strong>$name</strong>, for registering for <strong>$event</strong>.<br>A confirmation email has been sent to <strong>$email</strong>.</p>
            <a href='home.php' class='home-link'>Back to Home</a>
        </div>
    </body>
    </html>";
} else {
    header('Location: home.php');
    exit();
}
?>
