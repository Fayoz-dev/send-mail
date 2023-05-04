<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class MailController extends Controller
{
    public function viewBlade(){
        return view("pages-login");
    }

    public function sendMail(){
        try {
            $mail = new PHPMailer(true);
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
            $mail->isSMTP();  //Send using SMTP
            $mail->Host       = env('MAIL_HOST');  //Set the SMTP server to send through
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                    'allow_self_signed' => TRUE
                )
            );
            $mail->SMTPAuth   = true;  //Enable SMTP authentication
            $mail->Username   = env('MAIL_USERNAME');  
            $mail->Password   = env('MAIL_PASSWORD');
            $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
            $mail->Port       = env('MAIL_PORT'); //TCP port to c
            $mail->setFrom(env('MAIL_USERNAME'), 'Fayoz');
            $mail->addAddress('frasulov988@gmail.com');     //Add a recipient
            $mail->isHTML(true);           //Set email format to HTML
            $mail->Subject = 'Salom';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

        //     $message = view("auth.mail", ["data" => $data])->render();
        // $mail->MsgHTML($message);
            return $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
