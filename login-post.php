<?php
session_start(); //untuk memulai
include "connection.php"; //menghubungkan dengan file conn yang menghubungkan data base
# session -> tmpt penyimpanan data di sisi server yg dpt
# diakses scr global pd halaman web yg membutuhkan

if (isset($_POST["login"])) { //isset untuk cek data yang di bawa falid atau tidak  
    # menampung data username dan password
    $username = $_POST["username"];
    $password = sha1($_POST["password"]); //sha 1 untuk melakukan enkripsi pada password 

    #ambil data karyawan sesuai username & passsword 
    $sql = "select * from karyawan where 
    username='$username' and password='$password'";
    $hasil = mysqli_query($connect, $sql);
//mysql_query eksekusi perintah sql
    # cek hasil query
    # mysqli_num_rows -> cek jumlah baris hasil query
    if (mysqli_num_rows($hasil) > 0) { //num row untuk mendetek jumlah baris, jika baris kosong maka akan menuju ke els
        # login berhasil
        # data disimpan dalam session
        $karyawan = mysqli_fetch_array($hasil);
        $_SESSION["karyawan"] = $karyawan;
        header("location:index.php"); //direct ke index.php
    } else {
        # login gagal
        header("location:login.php"); //jika gagal kembali ke login
    }
}
?>