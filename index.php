<?php

    include_once './function/function.php';

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Form Pemesanan Nasi Kotak</title>

    <!-- Icon Website -->
    <link rel="shortcut icon" href="./assets/img/favicon.ico" type="image/x-icon">
    <!-- Instruksi Kerja Nomor 5. -->
    <!-- Menghubungkan dengan library/berkas CSS. -->
    <link rel="stylesheet" href="./assets/css/bootstrap.css">

    <!-- Library: SweetAlert2 -->
    <script src="./assets/library/sweetalert2.all.min.js"></script>

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
    * {
        font-family: 'Poppins', sans-serif;
    }
    </style>
</head>

<body>
    <main class="container border w-75 p-4 my-5 rounded-4">
        <!-- Menampilkan judul halaman -->
        <h3 class="text-center">Form Pemesanan Nasi Kotak</h3>

        <!-- Instruksi Kerja Nomor 6. -->
        <!-- Menampilkan logo restoran -->
        <img src="./assets/img/logo.png" class="d-block mx-auto" alt="logo">

        <!-- Form untuk memasukkan data pemesanan. -->
        <form action="index.php" method="post" id="formPemesanan">
            <div class="container">
                <!-- Masukan pilihan lokasi cabang resto. -->
                <div class="my-2">
                    <label for="tipe">Cabang</label>
                    <select id="cabang" class="form-select" name="cabang">
                        <option value="">- Pilih Cabang -</option>
                        <?php for ($i = 0; $i < count($cabang); $i++) : ?>
                            <option value="<?= $cabang[$i] ?>"><?= $cabang[$i] ?></option>
                            <?php endfor; ?>
                        </select>
                </div>
                <div class="my-2">
                    <label for="namaPelanggan" class="form-label">Nama Pelanggan</label>
                    <input
                        type="text" 
                        id="namaPelanggan"
                        name="namaPelanggan"
                        class="form-control"
                        placeholder="Masukan Nama Pelanggan">
                </div>
                <div class="my-2">
                    <label for="noHP" class="form-label">No HP</label>
                    <input 
                        type="number" 
                        id="noHP" 
                        name="noHP" 
                        class="form-control" 
                        maxlength="13"
                        placeholder="Masukan Nomor HP">
                </div>
                <div class="my-2">
                    <label for="jumlahPesanan" class="form-label">Jumlah Kotak</label>
                    <input 
                        type="number" 
                        id="jumlahPesanan" 
                        name="jumlahPesanan" 
                        class="form-control" 
                        maxlength="4"
                        placeholder="Masukan Jumlah Pesanan">
                </div>
                <div class="mt-4 mb-2 d-flex justify-content-between">
                    <button 
                        class="btn btn-primary py-2" 
                        type="submit" 
                        form="formPemesanan" 
                        value="Pesan"
                        name="Pesan"
                    >
                        Pesan
                    </button>
                    <a 
                        href='./pages/dashboard.php' 
                        class="btn btn-primary py-2"
                        value="Pesan" 
                        name="Pesan"
                    >
                        Dashboard
                    </a>
                </div>
            </div>
        </form>
    </main>

    <script>
    <?php
        if (isset($_POST['Pesan'])) {
            //	Variabel $tagihanAwal berisi nilai tagihan awal (sebelum diskon) yang dihitung dengan menggunakan fungsi hitung_tagihan_awal().
            $tagihanAwal = hitung_tagihan_awal($_POST['jumlahPesanan'], $hargaSatuan);
            //	Menginisiasi variabel $diskon dengan nilai awal 0.
            $diskon = 0;

            //	Instruksi Kerja Nomor 10.
            if ($tagihanAwal >= 1000000) {
                //	Menghitung diskon.
                $diskon = (5 / 100) * $tagihanAwal;
                $tagihanAkhir = $tagihanAwal - $diskon;
            } else {
                $tagihanAkhir = $tagihanAwal;
            }

            //	Variabel $dataPesanan berisi data-data pemesanan dari form dalam bentuk array.
            $dataPesanan = array(
                'cabang' => $_POST['cabang'],
                'namaPelanggan' => $_POST['namaPelanggan'],
                'noHP' => $_POST['noHP'],
                'jumlahPesanan' => $_POST['jumlahPesanan'],
                'tagihanAwal' => $tagihanAwal,
                'diskon' => $diskon,
                'tagihanAkhir' => $tagihanAkhir
            );

            if (addData($dataPesanan) > 0) {
                echo "Swal.fire({
                        icon: 'success',
                        title: `BERHASIL`,
                        text: `Nasi Kotak Berhasil Dipesan`,
                        confirmButtonText: 'Oke',
                     }).then((result) => {
                        if (result.isConfirmed) {
                            document.location.href = './pages/dashboard.php';
                        }
                    });";
            } else {
                echo "Swal.fire(
                        'Gagal',
                        'Nasi Kotak Gagal Dipesan',
                        'error'
                    )";
            }
        }

        ?>
    </script>
    <script>
        const noHP = document.querySelector('#noHP');
        const jumlahPesanan = document.querySelector('#jumlahPesanan');

        // Validasi Nomor HP, Hanya Bisa Sampai 13 Digit
        noHP.addEventListener('click', () => {
            if (noHP.value.length == 13) {
                noHP.type = 'text'
            } else {
                noHP.type = 'number'
            }
        })

        jumlahPesanan.addEventListener('click', () => {
            if (jumlahPesanan.value.length == 4) {
                jumlahPesanan.type = 'text'
            } else {
                jumlahPesanan.type = 'number'
            }
        })
    </script>
    <script src="./assets/js/bootstrap.bundle.js"></script>
</body>
</html>