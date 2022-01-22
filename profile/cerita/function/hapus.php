<?php  
include '../../../function.php';


$hapus = $func->hapus_cerita($_POST['id'], $_SESSION['users']['id_users']);
echo json_encode(['success' => 'Sukses']);

?>