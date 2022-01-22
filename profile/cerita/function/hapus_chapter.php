<?php  
include '../../../function.php';

$hapus = $func->hapus_chapter($_POST['id']);
echo json_encode(['success' => 'Sukses']);



?>