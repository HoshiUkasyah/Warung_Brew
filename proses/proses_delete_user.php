<?php
include 'connect.php';
$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";

if (!empty($_POST['submit_user_validate'])) {
    $query = mysqli_query($conn, "DELETE FROM tb_user WHERE id='$id'");
    if ($query) {
        $message = '<script>alert("Data berhasil dihapus");
        window.location.href = "../user";</script>';
    } else {
        $message = '<script>alert("Data gagal dihapus");
        window.location.href = "../user";</script>';
    }
}
echo $message;
?>