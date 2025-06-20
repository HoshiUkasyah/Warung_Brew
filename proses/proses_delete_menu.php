<?php
include 'connect.php';
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";
$foto = (isset($_POST['foto'])) ? htmlentities($_POST['foto']) : "";

if (!empty($_POST['submit_user_validate'])) {
    // Check if menu is used in any orders
    $check_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM tb_list_order WHERE menu = '$id'");
    $check_result = mysqli_fetch_assoc($check_query);
    
    if ($check_result['total'] > 0) {
        $message = '<script>alert("Menu tidak dapat dihapus karena masih digunakan dalam pesanan!");
        window.location.href = "../menu";</script>';
    } else {
        $query = mysqli_query($conn, "DELETE FROM tb_menu WHERE id='$id'");
        if ($query) {
            unlink("../assets/img/$foto");
            $message = '<script>alert("Data berhasil dihapus");
            window.location.href = "../menu";</script>';
        } else {
            $message = '<script>alert("Data gagal dihapus");
            window.location.href = "../menu";</script>';
        }
    }
}
echo $message;
?>