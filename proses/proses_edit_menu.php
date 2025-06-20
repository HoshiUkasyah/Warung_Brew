<?php
include 'connect.php';
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$nama_menu = (isset($_POST['nama_menu'])) ? htmlentities($_POST['nama_menu']) : "";
$keterangan = (isset($_POST['keterangan'])) ? htmlentities($_POST['keterangan']) : "";
$kategori = (isset($_POST['kat_menu'])) ? htmlentities($_POST['kat_menu']) : "";
$harga = (isset($_POST['harga'])) ? htmlentities($_POST['harga']) : "";
$stok = (isset($_POST['stok'])) ? htmlentities($_POST['stok']) : "";

$kode_rand = rand(1000, 99999) . "-";
$target_dir = "../assets/img/" . $kode_rand;
$target_file = $target_dir . basename($_FILES["foto"]["name"]);
$imageType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (!empty($_POST['submit_menu_validate'])) {
    //cek format file
    $cek = getimagesize($_FILES['foto']['tmp_name']);
    if ($cek == false) {
        $message = "Ini bukan file gambar";
        $statusUpload = 0;
    } else {
        $statusUpload = 1;
        if (file_exists($target_file)) {
            $message = "Maaf, file yang dimasukan telah ada";
            $statusUpload = 0;
        } else {
            if ($_FILES['foto']['size'] > 500000) {
                $message = "File foto yang diupload terlalu besar";
                $statusUpload = 0;
            } else {
                if ($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg" && $imageType != "gif") {
                    $message = "Maaf, hanya diperbolehkan gambar dengan format JPG, JPEG, PNG, dan GIF";
                    $statusUpload = 0;
                }
            }
        }
    }
    if ($statusUpload == 0) {
        $message = '<script>alert("' . $message . ', gambar tidak dapat di upload");
            window.location="../menu"</script>';
    } else {
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
            $query = mysqli_query($conn, "UPDATE tb_menu SET foto = '" . $kode_rand . $_FILES['foto']['name'] . "',
                nama_menu = '$nama_menu', keterangan = '$keterangan', kategori = '$kategori', harga = '$harga', stok = '$stok' WHERE id = '$id'");
            if ($query) {
                $message = '<script>alert("Menu berhasil diubah");
                window.location="../menu"</script>';
            } else {
                $message = '<script>alert("Menu gagal diubah");
                window.location="../menu"</script>';
            }
        } else {
            $message = '<script>alert("Maaf, terjadi kesalahan file tidak dapat diupload");
                window.location="../menu"</script>';
        }

    }

    echo $message;
    exit();
}
?>
<!--keterangan,kategori,keterangan,harga,stok