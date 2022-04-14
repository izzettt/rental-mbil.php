<?php
session_start();
# jika saat load halaman ini, pastikan telah login sbg petugas
if (!isset($_SESSION["usser"])) {
    header("location:login.php");
}
include "navbar.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form paket</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="card">
            <div class="card-header bg-dark mt-2">
                <h5 class="text-white">
                    Form paket
                </h5>
            </div>
            <div class="card-body">
                <?php
                if (isset($_GET["id_paket"])) {
                    # form utk edit
                    # mengakses data anggota dari id_paket yg dikirim
                    include "connection.php";
                    $id_paket = $_GET["id_paket"];//untung mgambil data dari id paket
                    $sql = "select * from paket 
                    where id_paket='$id_paket'";
                    # eksekusi perintah sql
                    $hasil = mysqli_query($connect, $sql);
                    # konversi hasil query ke bentuk array
                    $paket = mysqli_fetch_array($hasil);
                    ?>
                    <form action="process-paket.php" method="post"
                    enctype="multipart/form-data">
                        ID paket
                        <input type="number" name="id_paket"
                        class="form-control mb-2" required
                        value="<?=$paket["id_paket"] ?>" readonly>

                        jenis
                        <input type="text" name="jenis"
                        class="form-control mb-2" required
                        value="<?=$paket["jenis"] ?>">

                        harga
                        <input type="text" name="harga"
                        class="form-control mb-2" required
                        value="<?=$paket["harga"] ?>">

                        Jenis
                        <select name="jenis" class="form-control mb-2" required">
                            <option value="<?=$paket["jenis"] ?>">
                                <?=$paket["jenis"] ?>
                            </option>
                            <option value="kiloan">kiloan</option>
                            <option value="Selimut">Selimut</option>
                            <option value="bed_cover">bed cover</option>
                            <option value="kaos">kaos</option>
                        </select>

                        <button type="submit" class="btn btn-primary btn-block" name="edit_paket"
                        onclick="return confirm('Apakah anda yakin?')">
                            Save
                        </button>
                    </form>
                <?php
                } else {
                    #form utk insert ?>
                    <form action="process-paket.php" method="post"
                    enctype="multipart/form-data">
                        ID paket
                        <input type="text" name="id_paket"
                        class="form-control mb-2" required>

                        jenis
                        <input type="text" name="jenis"
                        class="form-control mb-2" required>

                        harga
                        <input type="text" name="harga"
                        class="form-control mb-2" required>

                        Jenis
                        <select name="jenis" class="form-control mb-2" required">
                        <option value="kiloan">kiloan</option>
                            <option value="Selimut">Selimut</option>
                            <option value="bed_cover">bed cover</option>
                            <option value="kaos">kaos</option>
                        </select>
                        
                        <!-- accept ='image/*' untuk menentukan tipe ekstensi file yang bisa di upload -->
                        <button type="submit" class="btn btn-primary btn-block" name="simpan_paket">
                            Save
                        </button>
                    </form>
                <?php    
                }
                ?>
                
            </div>
        </div>
    </div>
</body>
</html>