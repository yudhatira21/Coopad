<?php 

$aktivitas = 'Anda Berhasil Logout - '.$_SERVER['HTTP_USER_AGENT'];
$func->tambah_aktivitas($aktivitas, $_SESSION['users']['id_users']);

session_unset();
session_destroy();
echo("<script>location='login';</script>");

?>