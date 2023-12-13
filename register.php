<?php

    include 'koneksi.php';

    if(isset($_POST["simpan"])) { 
        $username  = $_POST["username"];
        $password  = md5($_POST["password"]);
        $level     = $_POST["level"];
        $id_login  = $_POST["id_login"];
        $nama      = $_POST["nama"];
        $email     = $_POST["email"];
        $alamat    = $_POST["alamat"];
        $jenis_kelamin = $_POST["jenis_kelamin"];
        $id        = $_POST["id"];
        if(empty($username) || empty($password) || empty($level) || empty($nama) || empty($email) || empty($alamat) || empty($jenis_kelamin)) {
            $erros = "data harus di isi";
            // var_dump($erros);
        }else{
            if (!empty($level) && ($level == 'admin' )) {
                $uploadOk = 0;
                $hasil = "Anda Bukan admin";
            } else {
                if(empty($id)){
                    $insert ="INSERT INTO login(username, password, level) VALUES ('$username', '$password', '$level')";
                    $query  = mysqli_query($koneksi,$insert);
                    $id_login = "select max(id) from login";
                    $query1 = mysqli_query($koneksi,$id_login)->fetch_array(MYSQLI_NUM);
                    $inser1 = "INSERT INTO user(id_login, nama, email, alamat, jenis_kelamin) VALUES ('$query1[0]','$nama','$email','$alamat','$jenis_kelamin')";
                    $query2 = mysqli_query($koneksi,$inser1);

                    if($query2){
                        $uploadOk = 1;
                        $hasil = "Akun successfully uploaded";
                    }else{
                        $uploadOk = 0;
                        $hasil = "Akun fail uploaded";   
                    }
                }
            }
        }

        // var_dump($title);
        //$id      = $_SESSION['id'];
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo "Register"?></title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                            <?php if(isset($_POST["simpan"])){ ?>
                                <?php if(!empty($erros)){?>
                                    <div class="alert alert-danger" role="danger"> <?php echo $erros ?> </div>
                                <?php } else { ?>
                                    <?php if ($uploadOk == 1 || $uploadOk == 2) { ?>
                                        <div class="alert alert-success" role="alert"> <?php echo $hasil;?></div>
                                    <?php }else{ ?>
                                        <div class="alert alert-danger" role="danger"> <?php echo $hasil;?></div>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?> 
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Register</h1>
                                        <h2 class="h4 text-gray-900 mb-4">NGALAM KIPA</h2>
                                    </div>
                                    <form class="user" method="post" action ="register.php">
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" name="username" class="form-control form-control-user"  placeholder="Username">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" name="password" class="form-control form-control-user"  placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="level">
                                                <option value="">--Pilih--</option>
                                                <option value="admin">Admin</option>
                                                <option value="user">Users</option>
                                            </select>
                                        </div>
                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <input type="text" name="nama" class="form-control form-control-user"  placeholder="Nama Lengkap">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="email" name="email" class="form-control form-control-user"  placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <input type="text" name="alamat" class="form-control form-control-user"  placeholder="Alamat">
                                            </div>
                                            <div class="col-sm-6">
                                                <select class="form-control" name="jenis_kelamin">
                                                    <option value="">--Pilih--</option>
                                                    <option value="L">Laki-laki</option>
                                                    <option value="P">Perempuan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" value="">
                                        <input type="hidden" name="id_login" value="">
                                        <input type="submit" name="simpan" class="btn btn-primary btn-user btn-block" autofocus></input>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="login.php">Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>