<?php
include "connection.php";
// memanggil id sewa dan set waktu saat ini untuk pengembalian
$id_sewa = $_GET["id_sewa"]; // idsewa auto increment
date_default_timezone_set('Asia/Jakarta'); 
$tgl_kembali = date_create(date("Y-m-d H:i:s")); //menentukan
$tgl_kembali_fix = date("Y-m-d H:i:s"); //mengubah
// selisih hari = selisih tgl_pengembalian dan tgl_pinjam

// memanggil data penyewaan
$sql = "select * from sewa
where id_sewa='$id_sewa'";
$hasil = mysqli_query($connect, $sql);
$sewa = mysqli_fetch_array($hasil);
$tgl_sewa = date_create($sewa["tgl_sewa"]);

// menghitung selisih dua tanggal
$selisih = date_diff($tgl_kembali, $tgl_sewa);
// mengkonversi hasil selisih format jumlah hari
$selisih_hari = $selisih->format("%a");

// menghitung total_bayar
$id_sewa= $sewa["id_sewa"];
$sql = "select * from sewa
    inner join mobil on sewa.id_mobil = mobil.id_mobil
    where id_sewa = '$id_sewa'";

$hasil_mobil = mysqli_query($connect, $sql);
$mobil = mysqli_fetch_array($hasil_mobil);
$total_bayar = ($selisih_hari + 1) * $mobil["biaya_sewa_per_hari"];

// insert ke tabel kembali
$sql = "insert into kembali values 
('', '$id_sewa', '$tgl_kembali_fix', '$total_bayar')";
if (mysqli_query($connect, $sql)){
    header("location: list-sewa.php");
}else {
    echo mysqli_error($connect);
}
?>