<?php
if (isset($_COOKIE['SESIJA'])) {
    unset($_COOKIE['SESIJA']);
    setcookie('SESIJA', null, -1);
    header('Location: login.php');
}