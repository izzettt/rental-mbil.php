<?php
include './connection.php';

$id_pelanggan = $_GET['id_pelanggan'];
// echo $id_pelanggan;

// memberikan perintah SQL
$sql ="delete from pelanggan where id_pelanggan = '".$id_pelanggan."'" ;

$result = mysqli_query($connect,$sql);

if ($result) {
    header('Location:list-pelanggan.php');
} else {
    printf('Gagal ya'.mysqli_error($connect));
    exit();
}

?>