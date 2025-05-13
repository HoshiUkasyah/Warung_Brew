<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_list_order 
LEFT JOIN tb_order ON tb_order.id_order = tb_list_order.kode_order
LEFT JOIN tb_menu ON tb_menu.id = tb_list_order.menu
LEFT JOIN tb_bayar ON tb_bayar.id_bayar = tb_order.id_order 
ORDER BY waktu_order DESC");


while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
    //$kode = $_GET['order'];
    //$meja = $_GET['meja'];
    //$pelanggan = $_GET['pelanggan'];
}

$select_menu = mysqli_query($conn, "SELECT id,nama_menu FROM tb_menu");
?>

<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman Dapur
        </div>
        <div class="card-body">

            <?php
            if (empty($result)) {
                echo "Data menu tidak ada";
            } else {
                foreach ($result as $row) {
                    ?>

                    <!-- Modal Terima Dapur-->
                    <div class="modal fade" id="terima<?php echo $row['id_list_order'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Terima Order</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_terima_order.php"
                                        method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id_list_order" value="<?php echo $row['id_list_order']; ?>">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-floating mb-3">
                                                    <select disabled class="form-select" aria-label="Default select example"
                                                        name="menu" required>
                                                        <option selected hidden value="">Pilih Menu</option>
                                                        <?php
                                                        foreach ($select_menu as $value) {
                                                            if ($row['menu'] == $value['id']) {
                                                                echo "<option selected value=" . $value['id'] . ">$value[nama_menu]</option>";
                                                            } else {
                                                                echo "<option value=" . $value['id'] . ">$value[nama_menu]</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="menu">Menu makanan atau minuman</label>
                                                    <div class="invalid-feedback">
                                                        Pilih Menu makanan atau minuman
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input disabled type="number" class="form-control" id="floatingInput"
                                                        name="jumlah" placeholder="jumlah" required
                                                        value="<?php echo $row['jumlah'] ?>">
                                                    <label for="floatingInput">Jumlah</label>
                                                    <div class="invalid-feedback">
                                                        Masukan Jumlah Porsi
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" name="catatan"
                                                        placeholder="catatan" value="<?php echo $row['catatan'] ?>">
                                                    <label for="floatingPassword">Catatan</label>
                                                    <div class="invalid-feedback">
                                                        Masukan Catatan
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="terima_order_validate"
                                                value="1234">Terima</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end Modal Terima Dapur -->

                    <!-- Modal Siap Saji-->
                    <div class="modal fade" id="siapsaji<?php echo $row['id_list_order'] ?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-fullscreen-md-down">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Siap Saji</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" novalidate action="proses/proses_siap_saji.php" method="post"
                                        enctype="multipart/form-data">
                                        <input type="hidden" name="id_list_order" value="<?php echo $row['id_list_order']; ?>">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-floating mb-3">
                                                    <select disabled class="form-select" aria-label="Default select example"
                                                        name="menu" required>
                                                        <option selected hidden value="">Pilih Menu</option>
                                                        <?php
                                                        foreach ($select_menu as $value) {
                                                            if ($row['menu'] == $value['id']) {
                                                                echo "<option selected value=" . $value['id'] . ">$value[nama_menu]</option>";
                                                            } else {
                                                                echo "<option value=" . $value['id'] . ">$value[nama_menu]</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                    <label for="menu">Menu makanan atau minuman</label>
                                                    <div class="invalid-feedback">
                                                        Pilih Menu makanan atau minuman
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-floating mb-3">
                                                    <input disabled type="number" class="form-control" id="floatingInput"
                                                        name="jumlah" placeholder="jumlah" required
                                                        value="<?php echo $row['jumlah'] ?>">
                                                    <label for="floatingInput">Jumlah</label>
                                                    <div class="invalid-feedback">
                                                        Masukan Jumlah Porsi
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="floatingInput" name="catatan"
                                                        placeholder="catatan" value="<?php echo $row['catatan'] ?>">
                                                    <label for="floatingPassword">Catatan</label>
                                                    <div class="invalid-feedback">
                                                        Masukan Catatan
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" name="siap_saji_validate"
                                                value="1234">Siap Saji</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end Modal Siap Saji -->

                <?php } ?>

                <div class="table-responsive mt-2">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr class="text-nowra">
                                <th scope="col">No.</th>
                                <th scope="col">Kode Order</th>
                                <th scope="col">Waktu Order</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Catatan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($result as $row) {
                                if ($row['status'] != 2) {
                                    ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $row['kode_order'] ?></td>
                                        <td><?php echo $row['waktu_order'] ?></td>
                                        <td><?php echo $row['nama_menu'] ?></td>
                                        <td><?php echo $row['jumlah'] ?></td>
                                        <td><?php echo $row['catatan'] ?></td>
                                        <td><?php if ($row['status'] == 1) {
                                            echo "<span class='badge bg-warning'>Masuk ke dapur</span>";
                                        } elseif ($row['status'] == 2) {
                                            echo "<span class='badge bg-primary'>Siap Saji</span>";
                                        } ?></td>
                                        <td>
                                            <div class="d-flex">
                                                <button
                                                    class="<?php echo (!empty($row['status'])) ? "btn btn-secondary disabled" : "btn btn-primary me-1"; ?> btn-sm me-1"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#terima<?php echo $row['id_list_order'] ?>">Terima</button>
                                                <button
                                                    class="<?php echo (empty($row['id_bayar']) || $row['status'] != 1) ? "btn btn-secondary disabled me-1 text-nowrap disabled" : "btn btn-success me-1 
                                                    text-nowrap"; ?>"data-bs-toggle="modal"
                                                    data-bs-target="#siapsaji<?php echo $row['id_list_order'] ?>">Siap Saji</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </div>
    </div>
</div>