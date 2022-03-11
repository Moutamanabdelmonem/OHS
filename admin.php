<?php


session_start();
if(!isset($_SESSION["utype"]) )
{
    include "ASignin.php";
}elseif ( $_SESSION["utype"]!="Admin") {
    header("location:signout.php");
}
elseif ( $_SESSION["utype"]="Admin") {
    include "admin_base.php";
}else {
    header("location:index.php");
}

?>
