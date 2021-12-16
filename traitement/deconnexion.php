<?php
require_once '../modeles/modele.php';

if (isset($_POST['deco'])&&!empty($_POST['deco']))
{
    session_destroy();
    if (isset($_COOKIE['souvenir'])) {
        unset($_COOKIE['souvenir']);
        setcookie('souvenir', '', time() - 3600, '/');
    }
    header("location:../membres/index.php");
}