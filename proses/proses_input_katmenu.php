<?php
include 'connect.php';
$jenismenu = (isset($_POST['jenismenu'])) ? htmlentities($_POST['jenismenu']) : "";
$kategorimenu = (isset($_POST['kategorimenu'])) ? htmlentities($_POST['kategorimenu']) : "";

if (!empty($_POST['submit_katmenu_validate'])) {
    $select = mysqli_query($conn, "SELECT * FROM tb_kategori_menu WHERE kategori_menu = '$kategorimenu'");
    if (mysqli_num_rows($select) > 0) {
        $message = '<script>alert("Kategori yang dimasukan sudah digunakan");
                window.location="../katmenu"</script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_kategori_menu (jenis_menu,kategori_menu) 
    values ('$jenismenu','$kategorimenu')");
        if ($query) {
            $message = '<script>alert("Data berhasil dimasukan");
                window.location="../katmenu"</script>';
        } else {
            $message = '<script>alert("Data gagal dimasukan");
                window.location="../katmenu"</script>';
        }
    }
}
echo $message;
?>