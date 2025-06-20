<?php
include 'proses/connect.php'; 
$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$_SESSION[username_warung]'");
$record = mysqli_fetch_array($query);
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <div class="container-lg">
        <a class="navbar-brand" href="home"><i class="bi bi-cup-hot me-2"></i>Warung Brew</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <?php echo $record["username"]; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mt-2">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModalUbahProfile">
                                <i class="bi bi-person-square me-2"></i>Profile</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                data-bs-target="#ModalUbahPassword">
                                <i class="bi bi-key"></i>Ubah Password</a></li>
                        <li><a class="dropdown-item" href="logout"><i class="bi bi-box-arrow-left me-2"></i>Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Modal Ubah password-->
<div class="modal fade" id="ModalUbahPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_ubah_password.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" name="username"
                                    placeholder="name@example.com" value="<?php echo $_SESSION['username_warung'] ?>"
                                    required disabled>
                                <label for="floatingInput">Username</label>
                                <div class="invalid-feedback">
                                    Masukan Username
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" name="passwordlama"
                                    required>
                                <label for="floatingInput">Password Lama</label>
                                <div class="invalid-feedback">
                                    Masukan Password Lama
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" name="passwordbaru"
                                    required>
                                <label for="floatingInput">Password Baru</label>
                                <div class="invalid-feedback">
                                    Masukan Password Baru
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" name="repasswordbaru"
                                    required>
                                <label for="floatingInput">Ulangi Password Baru</label>
                                <div class="invalid-feedback">
                                    Masukan Password Baru
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="ubah_password_validate" value="1234">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end Modal Ubah password -->

<!-- Modal Ubah profile-->
<div class="modal fade" id="ModalUbahProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Profile</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_ubah_profile.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" name="username"
                                    placeholder="name@example.com" value="<?php echo $_SESSION['username_warung'] ?>"
                                    required disabled>
                                <label for="floatingInput">Username</label>
                                <div class="invalid-feedback">
                                    Masukan Username
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingPassword" name="nama" value="<?php echo $record['Nama'] ?>" required>
                                <label for="floatingInput">Nama</label>
                                <div class="invalid-feedback">
                                    Masukan Nama Anda
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingPassword" name="nohp" value="<?php echo $record['NoHP'] ?>" required>
                                <label for="floatingInput">No HP</label>
                                <div class="invalid-feedback">
                                    Masukan Nomor HP Anda
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="alamat" id="" style="height:100px"
                                    required><?php echo $record['alamat'] ?></textarea>
                                <label for="floatingInput">Alamat</label>
                                <div class="invalid-feedback">
                                    Masukan Alamat Anda
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="ubah_profile_validate" value="1234">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end Modal Ubah profile -->