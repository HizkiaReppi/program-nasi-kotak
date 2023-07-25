<?php

    $db = mysqli_connect('localhost', 'root', '', 'nasi_kotak');

    function addData($data)
    {
        global $db;

        $cabang = $data['cabang'];
        $namaPelanggan = $data['namaPelanggan'];
        $noHP = $data['noHP'];
        $jumlahPesanan = $data['jumlahPesanan'];
        $tagihanAwal = $data['tagihanAwal'];
        $diskon = $data['diskon'];
        $tagihanAkhir = $data['tagihanAkhir'];

        $query = "INSERT INTO pemesanan VALUES ('', '$cabang', '$namaPelanggan', '$noHP', '$jumlahPesanan', '$tagihanAwal', '$diskon', '$tagihanAkhir')";

        mysqli_query($db, $query);

        return mysqli_affected_rows($db);
    }

    function deleteData($id)
    {
    
        global $db;

        mysqli_query($db, "DELETE FROM pemesanan WHERE id = $id");

        return mysqli_affected_rows($db);
    }


    //	Instruksi Kerja Nomor 1.
    /*	Penjelasan Function
    	Fungsi hitung_tagihan_awal menerima 2 buah parameter, yaitu $harga dan $jumlah
    	Baris 10: Membuat variable $tagihanAwal lalu diisi dengan nilai perkalian dari nilai parameter $harga * $jumlah
    	Baris 11: Fungsi return, untuk mengembalikan nilai dari variable $tagihanAwal
    */
    function hitung_tagihan_awal($jumlah, $harga)
    {
        $tagihanAwal = $harga * $jumlah;
        return $tagihanAwal;
    }

    //	Instruksi Kerja Nomor 2.
    //	Variabel $cabang berisi data kota lokasi cabang restoran dalam bentuk array.
    $cabang = ["Harmoni", "Sarinah", "Grogol", "Senayan", "Pluit", "Cempaka"];

    //	Instruksi Kerja Nomor 3.
    //	Mengurutkan array $cabang sesuai abjad A-Z.
    sort($cabang);

    //	Instruksi Kerja Nomor 4.
    //	Variabel untuk menyimpan harga satuan nasi kotak.
    $hargaSatuan = 50000;

?>