<?php
include 'proses/connect.php';
$query = mysqli_query($conn, "SELECT * FROM tb_menu");
while ($row = mysqli_fetch_assoc($query)) {
    $result[] = $row;
}

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
//echo $string_menu."<br>";

$array_jumlah_pesanan = array_column($result_grafik, 'total_jumlah');
$string_jumlah_pesanan = implode(',', $array_jumlah_pesanan);
//echo $string_jumlah_pesanan;
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="col-lg-9 mt-2">
    <!-- Carousel -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php
            $slide = 0;
            $firstSlideButton = true;
            foreach ($result as $dataTombol) {
                ($firstSlideButton) ? $aktif = 'active' : $aktif = '';
                $firstSlideButton = false;
                ?>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $slide ?>"
                    class="<?php echo $aktif ?>" aria-current="true" aria-label="Slide <?php echo $slide + 1 ?>"></button>
                <?php
                $slide++;
            }
            ?>
        </div>
        <div class="carousel-inner rounded">
            <?php
            $first_slide = true;
            foreach ($result as $data) {
                ($first_slide) ? $aktif = 'active' : $aktif = '';
                $first_slide = false;
                ?>
                <div class="carousel-item <?php echo $aktif ?>">
                    <img src="assets/img/<?php echo $data['foto'] ?>" class="img-fluid"
                        style="height: 250px; width: 1000px; object-fit: cover;" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5><?php echo $data['nama_menu'] ?></h5>
                        <p><?php echo $data['keterangan'] ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- end Carousel -->

    <!-- Judul -->
    <div class="card mt-4 border-0 bg-light">
        <div class="card-body text-center">
            <h5 class="card-title">WARUNG BREW - APLIKASI PEMESANAN MAKANAN DAN MINUMAN CAFE</h5>
            <p class="card-text">Aplikasi ini adalah aplikasi pemesanan makanan dan minuman cafe.Aplikasi ini dibuat
                untuk memudahkan pengguna dalam memesan makanan dan minuman cafe. Hanya dengan beberapa klik, pengguna
                dapat memesan makanan dan minuman cafe. Pesan, bayar, dan lacak pesanan lewat aplikasi.</p>
            <a href="order" class="btn btn-primary">Buat Order</a>
        </div>
    </div>
    <!-- End Judul -->

    <!-- Grafik -->
    <div class="card mt-4 border-0 bg-light">
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
</div>