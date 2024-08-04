<?php
    require_once '../../../vendor/autoload.php';
    require_once '../dbconnect.php';

    use Dotenv\Dotenv;
    use PHPMailer\PHPMailer\PHPMailer;

    $dotenv = Dotenv::createImmutable('../../../');
    $dotenv->load();

    $env_email = $_ENV['EMPRESA_EMAIL'];
    $env_pass = $_ENV['EMPRESA_PASSWORD'];

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

    $encomenda = "SELECT * FROM Encomendas WHERE IDEncomenda = '$IDEncomenda'";
    $doEncomenda = mysqli_query($dbConnect,$encomenda);
    $drEncomenda = mysqli_fetch_assoc($doEncomenda);

    $IDFactura = $drEncomenda['IDFactura'];

    $produtos = "SELECT Produtos.Produto, Produtos.Referencia, Factura_Produtos.Quantidade, Factura_Produtos.Price FROM Factura_Produtos INNER JOIN Produtos ON Factura_Produtos.IDProduto = Produtos.IDProduto WHERE Factura_Produtos.IDFactura = '$IDFactura'";
    $doProdutos = mysqli_query($dbConnect,$produtos);

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
    $mail->addAddress($cliente_email);

    $mail->Subject = 'Encomenda em processamento';

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
                                    <td align="left" style="padding:1em;background-color:#f6f6f6"">
                                        <p style="margin-bottom:0.25em">Estimado(a) <b>'.$cliente_nome.'</b> ,</p>
                                        <p>A sua encomenda será enviada assim que esteja pronta para envio.</p>
                                        <p>Poderá verificar o estado da sua encomenda iniciando sessão na sua conta.</p>
                                        <p style="margin-top:1em;font-size:13pt"><b>STATUS:</b> Em processamento</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:1em;background-color:#f6f6f6">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;background-color:white">
                                            <tr>
                                                <td align="center" style="padding:1em 0.5em;background-color:#e5e5e5">
                                                    <b>Destinatário da encomenda</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="left" style="padding:1em 0.5em">
                                                    <p>Nome: '.$drEncomenda['Nome'].'</p>
                                                    <p>Rua: '.$drEncomenda['Morada'].'</p>
                                                    <p>Código-Postal: '.$drEncomenda['CodPostal'].'</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:1em;background-color:#f6f6f6">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;background-color:white">
                                            <tr>
                                                <td align="center" style="padding:1em 0.5em;background-color:#e5e5e5">
                                                    <b>Produtos nesta encomenda</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding:1em 0em">
                                                    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse">
                                                        <tr>
                                                            <td style="padding:0.5em">Produto</td>
                                                            <td align="center" style="padding:0.5em">Quantidade</td>
                                                            <td align="right" style="padding:0.5em">Preço</td>
                                                        </tr>';
                                                        while($product = mysqli_fetch_assoc($doProdutos)){
                                                            $body .= '<tr>
                                                                <td style="padding:0.5em">
                                                                    <p>'.$product['Produto'].'</p>
                                                                    <p>'.$product['Referencia'].'</p>
                                                                </td>
                                                                <td align="center" width="20%" style="padding:0.5em">
                                                                    <p>'.$product['Quantidade'].'</p>
                                                                </td>
                                                                <td align="right" width="20%" style="padding:0.5em">
                                                                    <p>'.$product['Price'].' €</p>
                                                                </td>
                                                            </tr>';
                                                        };
                                                    $body .= '</table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align="right" style="padding:1em 0.5em;border-top:5px solid #f1f1f1;">
                                                    <p><b>Total: '.$total.'€</b></p>
                                                </td>
                                            </tr>
                                        </table>
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
        $_SESSION['cart'] = null;
        header('Location: /');
    }
?>