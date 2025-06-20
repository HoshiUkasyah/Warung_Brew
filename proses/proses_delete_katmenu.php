<?php
include 'connect.php';
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$message = "";

if (!empty($_POST['submit_katmenu_validate'])) {
    // Check if this category is used in any menu items
    $check_menu = mysqli_query($conn, "SELECT * FROM tb_menu WHERE kategori='$id'");
    if (mysqli_num_rows($check_menu) > 0) {
        $message = '<script>alert("Kategori ini masih digunakan pada beberapa menu. Hapus atau ubah kategori menu tersebut terlebih dahulu.");
        window.location="../katmenu";</script>';
    } else {
        $query = mysqli_query($conn, "DELETE FROM tb_kategori_menu WHERE id_kat_menu='$id'");
        if ($query) {
            $message = '<script>alert("Data berhasil dihapus");
            window.location="../katmenu";</script>';
        } else {
            $message = '<script>alert("Data gagal dihapus");
            window.location="../katmenu";</script>';
        }
    }
}
echo $message;
?>
