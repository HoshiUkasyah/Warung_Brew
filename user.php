<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
} ?>
<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman User
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambahUser">Tambah
                        User</button>
                </div>
            </div>
            <!-- Modal Tambah User-->
            <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_user.php"
                                method="post">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput" name="nama"
                                                placeholder="Nama" required>
                                            <label for="floatingInput">Nama</label>
                                            <div class="invalid-feedback">
                                                Masukan Nama
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="floatingInput" name="username"
                                                placeholder="name@example.com" required>
                                            <label for="floatingInput">Username</label>
                                            <div class="invalid-feedback">
                                                Masukan Username
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" aria-label="Default select example" name="level"
                                                required>
                                                <option selected value="">Pilih Level User</option>
                                                <option value="1">Owner/Admin</option>
                                                <option value="2">Kasir</option>
                                                <option value="3">Pelayan</option>
                                                <option value="4">Dapur</option>
                                            </select>
                                            <label for="floatingInput">Level User</label>
                                            <div class="invalid-feedback">
                                                Pilih Level User
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput" name="nohp"
                                                placeholder="08xxxxxxxx" required>
                                            <label for="floatingInput">No HP</label>
                                            <div class="invalid-feedback">
                                                Masukan No HP
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control" id="floatingInput"
                                                name="password" placeholder="Password" disabled value="12345" required>
                                            <label for="floatingPassword">Password</label>
                                            <div class="invalid-feedback">
                                                Masukan Password
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" name="alamat" id="" style="height:100px"
                                        required></textarea>
                                    <label for="floatingInput">Alamat</label>
                                    <div class="invalid-feedback">
                                        Masukan Alamat
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="submit_user_validate"
                                        value="1234">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end Modal Tambah User-->

            <?php foreach ($result as $row) { ?>
                <!-- Modal View-->
                <div class="modal fade" id="ModalView<?php echo $row['id'] ?>" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_input_user.php"
                                    method="post">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" name="nama"
                                                    placeholder="Nama" disabled value="<?php echo $row['Nama'] ?>">
                                                <label for="floatingInput">Nama</label>
                                                <div class="invalid-feedback">
                                                    Masukan Nama
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control" id="floatingInput" name="username"
                                                    placeholder="name@example.com" disabled
                                                    value="<?php echo $row['username'] ?>">
                                                <label for="floatingInput">Username</label>
                                                <div class="invalid-feedback">
                                                    Masukan Username
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" aria-label="Default select example" name="level"
                                                    disabled>
                                                    <?php
                                                    $data = array("Admin/Owner", "Kasir", "Pelayan", "Dapur");
                                                    foreach ($data as $key => $value) {
                                                        if ($row['level'] == $key + 1) {
                                                            echo '<option selected value="' . ($key + 1) . '">' . $value . '</option>';
                                                        } else {
                                                            echo '<option value="' . ($key + 1) . '">' . $value . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingInput">Level User</label>
                                                <div class="invalid-feedback">
                                                    Pilih Level User
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="floatingInput" name="nohp"
                                                    placeholder="08xxxxxxxx" disabled value="<?php echo $row['NoHP'] ?>">
                                                <label for="floatingInput">No HP</label>
                                                <div class="invalid-feedback">
                                                    Masukan No HP
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" id="floatingInput"
                                                    name="password" placeholder="Password" disabled
                                                    value="<?php echo $row['password'] ?>">
                                                <label for="floatingPassword">Password</label>
                                                <div class="invalid-feedback">
                                                    Masukan Password
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating">
                                        <textarea class="form-control" name="alamat" id="" style="height:100px"
                                            disabled><?php echo $row['alamat'] ?></textarea>
                                        <label for="floatingInput">Alamat</label>
                                        <div class="invalid-feedback">
                                            Masukan Alamat
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end Modal View -->

                <!-- Modal Edit-->
                <div class="modal fade" id="ModalEdit<?php echo $row['id'] ?>" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_edit_user.php"
                                    method="post">
                                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="floatingInput" name="nama"
                                                    placeholder="Nama" value="<?php echo $row['Nama'] ?>" required>
                                                <label for="floatingInput">Nama</label>
                                                <div class="invalid-feedback">
                                                    Masukan Nama
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input <?php echo ($row['username'] == $_SESSION['username_warung']) ? 'disabled' : ''; ?> type="email" class="form-control" id="floatingInput" name="username"
                                                    placeholder="name@example.com" value="<?php echo $row['username'] ?>" required>
                                                <label for="floatingInput">Username</label>
                                                <div class="invalid-feedback">
                                                    Masukan Username
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" aria-label="Default select example" name="level"
                                                    required>
                                                    <?php
                                                    $data = array("Admin/Owner", "Kasir", "Pelayan", "Dapur");
                                                    foreach ($data as $key => $value) {
                                                        if ($row['level'] == $key + 1) {
                                                            echo '<option selected value="' . ($key + 1) . '">' . $value . '</option>';
                                                        } else {
                                                            echo '<option value="' . ($key + 1) . '">' . $value . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <label for="floatingInput">Level User</label>
                                                <div class="invalid-feedback">
                                                    Pilih Level User
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="form-floating mb-3">
                                                <input type="number" class="form-control" id="floatingInput" name="nohp"
                                                    placeholder="08xxxxxxxx" value="<?php echo $row['NoHP'] ?>" required>
                                                <label for="floatingInput">No HP</label>
                                                <div class="invalid-feedback">
                                                    Masukan No HP
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-floating">
                                        <textarea class="form-control" name="alamat" id="" style="height:100px"
                                            required><?php echo $row['alamat'] ?></textarea>
                                        <label for="floatingInput">Alamat</label>
                                        <div class="invalid-feedback">
                                            Masukan Alamat
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="submit_user_validate"
                                            value="1234">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end Modal Edit -->

                <!-- Modal Delete-->
                <div class="modal fade" id="ModalDelete<?php echo $row['id'] ?>" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data User</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_delete_user.php"
                                    method="post">
                                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                    <div class="col-lg-12">
                                        <?php
                                        if ($row['username'] == $_SESSION['username_warung']) {
                                            echo "<div class='alert alert-danger'> Anda tidak dapat menghapus akun sendiri</div>";
                                        } else {
                                            echo " Apakah anda yakin ingin menghapus user <b> $row[username]</b>?";
                                        } ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger" name="submit_user_validate"
                                            value="1234" <?php echo ($row['username'] == $_SESSION['username_warung']) ? 'disabled'
                                                : ''; ?>>Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end Modal Delete -->

                <!-- Modal Reset-->
                <div class="modal fade" id="ModalResetPassword<?php echo $row['id'] ?>" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-md modal-fullscreen-md-down">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Reset Password</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="needs-validation" novalidate action="proses/proses_reset_password.php"
                                    method="post">
                                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                    <div class="col-lg-12">
                                        <?php
                                        if ($row['username'] == $_SESSION['username_warung']) {
                                            echo "<div class='alert alert-danger'> Anda tidak dapat mereset password sendiri</div>";
                                        } else {
                                            echo " Apakah anda yakin ingin mereset password <b> $row[username]</b> menjadi password bawaan sistem <b>password</b>?";
                                        } ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success" name="submit_user_validate"
                                            value="1234" <?php echo ($row['username'] == $_SESSION['username_warung']) ? 'disabled'
                                                : ''; ?>>Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end Modal Reset -->
                <?php
            }
            if (empty($result)) {

            } else {
                ?>
                <div class="table-responsive mt-2">
                    <table class="table table-hover" id="example">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Username</th>
                                <th scope="col">Level</th>
                                <th scope="col">No. HP</th>
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
                                    <td><?php echo $row['Nama'] ?></td>
                                    <td><?php echo $row['username'] ?></td>
                                    <td><?php
                                    if ($row['level'] == 1) {
                                        echo "Admin";
                                    } elseif ($row['level'] == 2) {
                                        echo "Kasir";
                                    } elseif ($row['level'] == 3) {
                                        echo "Pelayan";
                                    } elseif ($row['level'] == 4) {
                                        echo "Dapur";
                                    } ?></td>
                                    <td><?php echo $row['NoHP'] ?></td>
                                    <td class="d-flex">
                                        <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal"
                                            data-bs-target="#ModalView<?php echo $row['id'] ?>"><i
                                                class="bi bi-eye"></i></button>
                                        <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                                            data-bs-target="#ModalEdit<?php echo $row['id'] ?>"><i
                                                class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-danger btn-sm me-1" data-bs-toggle="modal"
                                            data-bs-target="#ModalDelete<?php echo $row['id'] ?>"><i
                                                class="bi bi-trash"></i></button>
                                        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#ModalResetPassword<?php echo $row['id'] ?>"><i
                                                class="bi bi-key"></i></button>
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