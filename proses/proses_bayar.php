<?php
session_start();
include 'connect.php';
$kode_order = (isset($_POST['kode_order'])) ? htmlentities($_POST['kode_order']) : "";
$meja = (isset($_POST['meja'])) ? htmlentities($_POST['meja']) : "";
$pelanggan = (isset($_POST['pelanggan'])) ? htmlentities($_POST['pelanggan']) : "";
$catatan = (isset($_POST['catatan'])) ? htmlentities($_POST['catatan']) : "";
$menu = (isset($_POST['menu'])) ? htmlentities($_POST['menu']) : "";
$jumlah = (isset($_POST['jumlah'])) ? htmlentities($_POST['jumlah']) : "";
$total = (isset($_POST['total'])) ? htmlentities($_POST['total']) : "";
$uang = (isset($_POST['uang'])) ? htmlentities($_POST['uang']) : "";
$kembalian = $uang - $total;

if (!empty($_POST['bayar_validate'])) {
    if ($kembalian < 0) {
        $message = '<script>alert("NOMINAL UANG YANG ANDA MASUKAN KURANG");
        window.location="../?x=orderitem&order=' . $kode_order . '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"</script>';
    } else {
        $query = mysqli_query($conn, "INSERT INTO tb_bayar (id_bayar,total_bayar,nominal_uang)
        values ('$kode_order','$total','$uang')");
        if ($query) {
            $message = '<script>alert("Pembayaran berhasil \nUANG KEMBALIAN Rp. ' . number_format($kembalian, 0, ',', '.') . '");
                    window.location="../?x=orderitem&order=' . $kode_order . 
                    '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"</script>';
        } else {
            $message = '<script>alert("Pembayaran gagal");
                window.location="../?x=orderitem&order=' . $kode_order . 
                '&meja=' . $meja . '&pelanggan=' . $pelanggan . '"</script>';
        }
    }

}
echo $message;
?>