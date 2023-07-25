<?php

    include_once '../function/function.php';

    global $db;

    $data = mysqli_query($db, "SELECT * FROM pemesanan");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Pesanan</title>

    <!-- Icon Website -->
    <link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="../assets/css/bootstrap.css">

    <!-- Library: DataTables -->
    <link rel="stylesheet" href="./assets/library/dataTables.bootstrap5.min.css">

    <!-- Library: SweetAlert2 -->
    <script src="../assets/library/sweetalert2.all.min.js"></script>

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
    * {
        font-family: 'Poppins', sans-serif;
    }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="../assets/img/logo.png" alt="Logo" style="width: 35px;">
                    Terserah
                </a>
                <a class="navbar-brand" href="../index.php">Pesan</a>
            </div>
        </nav>
    </header>
    <main class="my-5">
        <section class="container">
            <table id="dataPesanan" class="table table-striped text-center" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Cabang</th>
                        <th>Nama Pelanggan</th>
                        <th>No. HP</th>
                        <th>Jumlah Pesanan</th>
                        <th>Tagihan Awal</th>
                        <th>Diskon (5%)</th>
                        <th>Tagihan Akhir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1; 
                        while ($row = mysqli_fetch_assoc($data)) : 
                    ?>
                    <tr>
                        <th scope="row"><?= $i ?></th>
                        <td><?= $row['cabang'] ?></td>
                        <td><?= $row['nama_pelanggan'] ?></td>
                        <td><?= $row['no_hp'] ?></td>
                        <td><?= $row['jumlah_pesanan'] ?></td>
                        <td>Rp. <?= $row['tagihan_awal'] ?></td>
                        <td>Rp. <?= $row['diskon'] ?></td>
                        <td>Rp. <?= $row['tagihan_akhir'] ?></td>
                        <td>
                            <button
                                
                                onclick="deleteData(this)";
                                class="btn btn-primary btnHapus"
                                data-id="<?= $row['id']; ?>"
                                data-nama="<?= $row['nama_pelanggan']; ?>"
                            >
                                Hapus
                            </button>
                        </td>
                    </tr>
                    <?php 
                        $i++;
                        endwhile;
                    ?>
                </tbody>
            </table>
        </section>
    </main>
    <footer class="position-absolute bottom-0 bg-primary w-100">
        <p class="text-center text-light">Copyright &copy; 2023 Hizkia Reppi</p>
    </footer>

    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/library/sweetalert2.all.min.js"></script>
    <script src="../assets/library/jquery-3.5.1.js"></script>
    <script src="../assets/library/jquery.dataTables.min.js"></script>
    <script src="../assets/library/dataTables.bootstrap5.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#dataPesanan').DataTable();
    });

    function deleteData(e) {
        const id = e.getAttribute('data-id');
        const nama = e.getAttribute('data-nama');

        Swal.fire({
            icon: 'question',
            title: `APAKAH ANDA YAKIN?`,
            text: `Pelanggan "${nama}" Akan Terhapus Dari List Pesanan`,
            showDenyButton: true,
            denyButtonText: 'Batal',
            confirmButtonText: 'Hapus Aja',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `../function/hapus.php?id=${id}`;
            } else {
                return;
            }
        });
    }
    </script>

</body>

</html>