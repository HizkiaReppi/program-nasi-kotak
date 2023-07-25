<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Data</title>
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
<script>

    <?php
        require 'function.php';

        if (deleteData($_GET["id"]) > 0) {
            echo "Swal.fire({
                    icon: 'success',
                    title: `BERHASIL`,
                    text: `Data Berhasil Dihapus`,
                    confirmButtonText: 'Oke',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.location.href = '../pages/dashboard.php';
                    }
                })";
        } else {
            echo "Swal.fire(
                    'Gagal',
                    'Data Gagal Dihapus',
                    'error'
                )";
        }
    ?>
</script>

</body>
</html>
