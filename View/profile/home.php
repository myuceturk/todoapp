<?php view('static/header') ?>
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" href="<?= url('logout') ?>">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <?php view('static/sidebar') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper p-5">

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Profiliniz</h3>
                            </div>
                            <!-- /.card-header -->
                            <?php echo  get_session('error') ?
                                '<div class="alert alert-' . $_SESSION['error']['type'] . '">' . $_SESSION['error']['message'] . '</div>'
                                : null ?>
                            <!-- form start -->
                            <form action="" method="POST" id="profile">
                                <div class="card-body">
                                    <div class=" form-group">
                                        <label for="name">İsim:</label>
                                        <input type="text" class="form-control" id="name" value="<?= get_session('name') ?>" placeholder="Adınızı Giriniz...">
                                    </div>
                                    <div class="form-group">
                                        <label for="surname">Soyisim:</label>
                                        <input type="text" class="form-control" id="surname" value="<?= get_session('surname') ?>" placeholder="Soyadınızı Giriniz...">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">E-Posta:</label>
                                        <input type="text" class="form-control" id="email" value="<?= get_session('email') ?>" placeholder="E-Posta Adresinizi Giriniz...">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Güncelle</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Şifrenizi Değiştirin</h3>
                            </div>
                            <!-- /.card-header -->
                            <?php echo  get_session('error') ?
                                '<div class="alert alert-' . $_SESSION['error']['type'] . '">' . $_SESSION['error']['message'] . '</div>'
                                : null ?>
                            <!-- form start -->
                            <form action="" method="POST" id="password_change">
                                <div class="card-body">
                                    <div class=" form-group">
                                        <label for="old_password">Geçerli Şifreniz:</label>
                                        <input type="password" class="form-control" id="old_password" placeholder="Eski Şifrenizi Giriniz...">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Yeni Şifreniz:</label>
                                        <input type="password" class="form-control" id="password" placeholder="Yeni Şifrenizi Giriniz...">
                                    </div>
                                    <div class="form-group">
                                        <label for="password_again">Tekrar Şifreniz:</label>
                                        <input type="password" class="form-control" id="password_again" placeholder="Yeni Şifrenizi Tekrar Giriniz...">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Güncelle</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php view('static/footer') ?>

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= assets('plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= assets('plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= assets('plugins/toastr/toastr.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= assets('js/adminlte.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const profile = document.getElementById('profile')
    const password_change = document.getElementById('password_change')

    profile.addEventListener('submit', (e) => {
        let name = document.getElementById('name').value
        let surname = document.getElementById('surname').value
        let email = document.getElementById('email').value

        let formData = new FormData();

        formData.append('name', name)
        formData.append('surname', surname)
        formData.append('email', email)

        axios.post('<?= url('api/profile') ?>', formData).then(res => {

            if (res.data.status == 'success') {

                toastr.success(res.data.message)
            } else {
                toastr.error(res.data.message)
            }

        }).catch(err => console.log(err))

        e.preventDefault();
    })

    password_change.addEventListener('submit', (e) => {
        let old_password = document.getElementById('old_password').value
        let password = document.getElementById('password').value
        let password_again = document.getElementById('password_again').value

        let formData = new FormData();

        formData.append('old_password', old_password)
        formData.append('password', password)
        formData.append('password_again', password_again)

        axios.post('<?= url('api/changepassword') ?>', formData).then(res => {

            if (res.data.status == 'success') {
                setTimeout(function() {
                    window.location.href = res.data.redirect
                }, 2000); //will call the function after 2 secs.
                toastr.success(res.data.message)
            } else {
                toastr.error(res.data.message)
            }

        }).catch(err => console.log(err))

        e.preventDefault();
    })
</script>

</body>

</html>