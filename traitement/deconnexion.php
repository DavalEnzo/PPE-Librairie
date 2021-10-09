<?php
require_once '../modeles/modele.php';

if (isset($_POST['deco'])&&!empty($_POST['deco']))
{
    session_destroy();
    header("location:../membres/index.php");
}