<?php
include "proses/connect.php";
date_default_timezone_set('Asia/Jakarta');

$query_grafik = mysqli_query($conn, "SELECT nama_menu, tb_menu.id, SUM(tb_list_order.jumlah) AS total_jumlah 
FROM tb_menu 
LEFT JOIN tb_list_order ON tb_menu.id = tb_list_order.menu 
GROUP BY tb_menu.id 
ORDER BY tb_menu.id ASC 
LIMIT 6");

$result_grafik = array();
while ($record_grafik = mysqli_fetch_array($query_grafik)) {
    $result_grafik[] = $record_grafik;
}

$array_menu = array_column($result_grafik, 'nama_menu');
$array_menu_jumlah = array_map(function($nama) {
    return "'".$nama."'";
}, $array_menu);
$string_menu = implode(',', $array_menu_jumlah);

$array_jumlah_pesanan = array_column($result_grafik, 'total_jumlah');
$string_jumlah_pesanan = implode(',', $array_jumlah_pesanan);

$query = mysqli_query($conn, "SELECT tb_order.*,tb_bayar.*,Nama, SUM(harga*jumlah) AS total FROM tb_order 
LEFT JOIN tb_user ON tb_user.id = tb_order.pelayan
LEFT JOIN tb_list_order ON tb_list_order.kode_order = tb_order.id_order
LEFT JOIN tb_menu ON tb_menu.id = tb_list_order.menu
JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order
GROUP BY id_order ORDER BY id_order ASC");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}

//$select_kat_menu = mysqli_query($conn, "SELECT id_kat_menu, kategori_menu FROM tb_kategori_menu");
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman Report
        </div>
        <div class="card-body">
            <!-- Grafik -->
            <div class="card mb-4 border-0 bg-light">
                <div class="card-body text-center">
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
                    <script>
                        const ctx = document.getElementById('myChart');

                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: [<?php echo $string_menu; ?>],
                                datasets: [{
                                    label: 'Jumlah Porsi Terjual',
                                    data: [<?php echo $string_jumlah_pesanan; ?>],
                                    borderWidth: 1,
                                    backgroundColor: [
                                        'rgba(255, 0, 132, 0.7)',
                                        'rgba(255, 0, 0, 0.7)',
                                        'rgba(255, 226, 0, 0.7)',
                                        'rgba(0, 255, 189, 0.7)',
                                        'rgba(0, 0, 255, 0.7)',
                                        'rgba(255, 0, 255, 0.7)'
                                    ]
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>
                </div>
            </div>
            <!-- End Grafik -->
            
            <?php
            if (empty($result)) {
                echo "Data menu tidak ada";
            } else {
                foreach ($result as $row) {
                    ?>
                    
                <?php } ?>
                <div class="table-responsive mt-2">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr class="text-nowra">
                                <th scope="col">No.</th>
                                <th scope="col">Kode Order</th>
                                <th scope="col">Waktu Order</th>
                                <th scope="col">Waktu Bayar</th>
                                <th scope="col">Pelanggan</th>
                                <th scope="col">Meja</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Pelayan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $no++ ?></th>
                                    <td><?php echo $row['id_order'] ?></td>
                                    <td><?php echo $row['waktu_order'] ?></td>
                                    <td><?php echo $row['waktu_bayar'] ?></td>
                                    <td><?php echo $row['pelanggan'] ?></td>
                                    <td><?php echo $row['meja'] ?></td>
                                    <td><?php echo number_format($row['total'], 0, ',', '.') ?></td>
                                    <td><?php echo $row['Nama'] ?></td>
                                    <td>
                                        <div class="d-flex">
                                            <a class="btn btn-info btn-sm me-1" href="./?x=viewitem&order=<?php echo $row['id_order'] . '&meja='
                                                . $row['meja'] . '&pelanggan=' . $row['pelanggan'] ?>">
                                                <i class="bi bi-eye"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </div>
    </div>
</div>