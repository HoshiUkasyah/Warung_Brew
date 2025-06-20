<?php
include 'connect.php';
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$jenismenu = (isset($_POST['jenismenu'])) ? htmlentities($_POST['jenismenu']) : "";
$kategorimenu = (isset($_POST['kategorimenu'])) ? htmlentities($_POST['kategorimenu']) : "";
$message = "";

if (!empty($_POST['submit_katmenu_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_kategori_menu WHERE kategori_menu = '$kategorimenu' AND id_kat_menu != '$id'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Kategori yang dimasukan sudah digunakan");
                window.location="../katmenu"</script>';
    } else {
        $query = mysqli_query($conn, "UPDATE tb_kategori_menu SET jenis_menu='$jenismenu', kategori_menu='$kategorimenu' 
        WHERE id_kat_menu='$id'");
        if ($query) {
            $message = '<script>alert("Data berhasil diperbarui");
                window.location="../katmenu"</script>';
        } else {
            $message = '<script>alert("Data gagal diperbarui");
                window.location="../katmenu"</script>';
        }
    }
}
echo $message;
?>