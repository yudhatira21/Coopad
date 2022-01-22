<?php  
include '../../function.php';


$hapus = $func->hapus_users($_POST['id']);
echo json_encode(['success' => 'Sukses']);



?>