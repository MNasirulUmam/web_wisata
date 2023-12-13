<?php
    ## Author : M. Nasirul Umam
    ## Tanggal : 25 juli 2023
    session_start();
    if ($_SESSION['username'] == false){ // pengecekan apabila username sama dengan salah maka kembali ke login
        header('Location:../../index.php');
    }
    require_once '../init.php'; // mengambil halaman include dari koneksi 
    if(isset($_POST["simpan"])){ 
        $kegiatan  = $_POST["kegiatan"];
        $waktu     = $_POST["waktu"];
        $deskripsi = $_POST["deskripsi"];
        $id        = $_POST["id"];

        if(empty($kegiatan) || empty($waktu) || empty($deskripsi)){
            $erros = "data harus di isi";
        }else{ 
            if(empty($id)){
                $insert ="INSERT INTO kegiatan(kegiatan, waktu, deskripsi) VALUES ('$kegiatan', '$waktu', '$deskripsi')";
                $query  = mysqli_query($koneksi,$insert);
                if($query){
                    $uploadOk = 1;
                    $hasil = "data successfully uploaded";
                }else{
                    $uploadOk = 0;
                    $hasil = "data fail uploaded";   
                }
            }

        }
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

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include '../../sidebar.php';?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <?php include '../../contentAdmin.php';?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                
                    <!-- Page Heading -->
                    <!-- end page heading -->
                    <!-- Content Row -->
                    <!-- end row -->
                    <!-- Froms Input -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tambah Kegiatan</h6>
                        </div>
                        <div class="card-body">
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
                            <form action="http://localhost/latihan/web_wisata/layouts/admin/kegiatanAdd.php" method="post">
                                <div class="mb-3 row">
                                    <div class="col-6 mb-2">
                                        <label class="form-label">Kegiatan</label>
                                        <input type="text" class="form-control" name="kegiatan" id="" value="">
                                    </div>
                                    <div class="col-6 mb-2">
                                        <label class="form-label">waktu</label>
                                        <input type="date" class="form-control" name="waktu" id="" value="">
                                    </div>
                                    <div class="col-12 mb-2">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea type="text" class="form-control" name="deskripsi" id=""></textarea>
                                    </div>
                                </div>
                                    <input type="hidden" name="id" value="">
                                    <input type="submit" name="simpan" class="btn btn-primary"></input>
                                    <a href="<?php $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary">Refresh</a>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php include '../../modallogout.php';?>

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../vendor/chart.js/Chart.min.js"></script>

</body>

</html>