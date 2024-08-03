<?php
    session_start();
    session_regenerate_id();
    $_SESSION['SESS_ID'] = $dr['IDCliente'];
    $_SESSION['SESS_Nome'] = $dr['Nome'];
    $_SESSION['SESS_Email'] = $dr['Email'];
    session_write_close();
?>