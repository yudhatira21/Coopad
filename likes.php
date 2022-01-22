<?php  
include 'function.php';


if (isset($_POST['liked'])) {

    $id = $_POST['id'];
    echo $func->likes($id, $_SESSION['users']['id_users']);
}

if (isset($_POST['unliked'])) {

$id = $_POST['id'];
echo $func->unlikes($id, $_SESSION['users']['id_users']);
}