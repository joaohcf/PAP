<?php
    switch($_REQUEST['action']){
        case 'request':
            require '../dbconnect.php';

            $request_email = $_POST['email'];

            $check = "SELECT Email FROM Clientes WHERE Email = '$request_email'";
            $doCheck = mysqli_query($dbConnect,$check);

            if(mysqli_num_rows($doCheck) != 1){
                header("Location: /");
            }else{
                $cliente = mysqli_fetch_assoc($doCheck);

                $query = "DELETE FROM password_reset WHERE ResetEmail = '$request_email'";
                $doquery = mysqli_query($dbConnect,$query);

                $token = bin2hex(random_bytes(32));
                $expires = date('U') + 1800;

                $qry = "INSERT INTO password_reset(ResetEmail, ResetToken, ResetExpires) VALUES ('$request_email', '$token', '$expires')";
                $doqry = mysqli_query($dbConnect,$qry);

                require '../email/password_reset.php';
            }
        break;
        case 'passwordreset':
            $token = $_POST['token'];
            $password = md5($_POST['password']);
            $password2 = md5($_POST['passwordCheck']);
        
            if($password != $password2){
                header("Location: /");
                echo "<script type='text/javascript'> window.location.href='/'; alert('As palavras-passe têm de ser iguais.');</script>";
                exit;
            }

            $currentDate = date('U');

            require '../dbconnect.php';

            $check = "SELECT * FROM password_reset WHERE ResetToken = '$token' AND ResetExpires >= '$currentDate'";
            $doCheck = mysqli_query($dbConnect,$check);

            if(mysqli_num_rows($doCheck) == 1){
                $dr = mysqli_fetch_assoc($doCheck);
                $email_token = $dr['ResetEmail'];
                $query = "UPDATE Clientes SET Password = '$password' WHERE Email = '$email_token'";
                $doquery = mysqli_query($dbConnect,$query);

                echo "<script type='text/javascript'> window.location.href='/'; alert('A palavra-passe foi mudada com sucesso!');</script>";
            }else{
                echo "<script type='text/javascript'> window.location.href='/'; alert('O token expirou! Faça o pedido de recuperação de palavra-passe novamente.');</script>";
            }
        break;
    }
?>