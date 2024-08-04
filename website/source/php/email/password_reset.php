<?php
    require_once '../../../vendor/autoload.php';
    require_once '../dbconnect.php';

    use Dotenv\Dotenv;
    use PHPMailer\PHPMailer\PHPMailer;

    $dotenv = Dotenv::createImmutable('../../../');
    $dotenv->load();

    $mail_email = $_ENV['EMPRESA_EMAIL'];
    $mail_pass = $_ENV['EMPRESA_PASSWORD'];

    $empresa = "SELECT * FROM Empresa";
    $doEmpresa = mysqli_query($dbConnect, $empresa);
    
    if(mysqli_num_rows($doEmpresa) == 1){
        $drEmpresa = mysqli_fetch_assoc($doEmpresa);

        $empresa_nome = $drEmpresa['Empresa'];
        $empresa_email = $drEmpresa['Email'];
        $empresa_morada = $drEmpresa['Morada'];
        $empresa_localidade = $drEmpresa['Localidade'];
        $empresa_telemovel = $drEmpresa['Telemovel'];
    }

    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $env_email;
    $mail->Password = $env_pass;
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);

    $mail->setFrom($env_email);
    $mail->addAddress($request_email);

    $mail->Subject = 'Recuperação de palavra-passe';

    $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html"/>
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <meta charset="UTF-8"/>
    
            <style>
                *{box-sizing:border-box;font-family:Arial, Helvetica, sans-serif}
                p,h1,h2,h3,h4,h5,h6{margin:0}
            </style>
        </head>
        <body style="margin:0;padding:0">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color:#e9e9e9">
                <tr>
                    <td>
                        <table border="0" align="center" cellpadding="0" cellspacing="0" width="600" style="border-collapse:collapse">
                            <tbody>
                                <tr>
                                    <td align="center" style="background-color:white">
                                        <a style="display:block;width:fit-content" href="http://localhost/website">
                                            <img style="display:block" src="logotext.png">
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding:1em;background-color:white">
                                        <h3>Código de recuperação de palavra-passe.</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" style="padding:1em;padding-top:0em;background-color:white">
                                        <p>Clique no link abaixo para efectuar a recuperação de palavra-passe.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" style="font-size:12px;padding:1em;background-color:#f6f6f6">
                                        <p><a href="http://localhost/password_reset?token='.$token.'">http://localhost/password_reset?token='.$token.'</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="background-color:#202020;padding:1em 0.5em">
                                        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
                                            <tr>
                                                <td align="center" style="padding:1em 0em;color:lightgray">
                                                    <b>'.$empresa_nome.'</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="center">
                                                    <table border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;color:darkgray">
                                                        <tr>
                                                            <td align="center" style="padding:0.25em 0em"> 
                                                                <p>'.$empresa_morada.'</p>
                                                                <p>'.$empresa_localidade.'</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" style="padding:0.25em 0em">
                                                                <p>Email: <a href="mailto:'.$empresa_email.'" style="color:lightgray;text-decoration:underline">'.$empresa_email.'</a></p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center" style="padding:0.25em 0em">
                                                                <p>Tel. (+351) '.$empresa_telemovel.'</p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
    </html>';

    $mail->MsgHTML($body); 

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        header('Location: /');
    }
?>