<?php
    include 'koneksi.php'; // mengambil file konesksi database
    session_start(); // session authentication
    
    $username = $_POST['username']; // deklarasi variable username kirman dari post
    $password = md5($_POST['password']);

    $username = stripcslashes($username); //Menghapus karakter backslash (\) yang ada dalam string username.
    $password = stripcslashes($password); //Menghapus karakter backslash (\) yang ada dalam string password.
    $username = mysqli_real_escape_string($koneksi,$username); // Melakukan escaping terhadap string username menggunakan fungsi mysqli_real_escape_string().
    $password = mysqli_real_escape_string($koneksi,$password); // Melakukan escaping terhadap string password menggunakan fungsi mysqli_real_escape_string().

    $query = "SELECT username, password, level FROM login WHERE username = '$username' AND password = '$password'"; // qery mengambl usernam dan password pada tabel user
    $result = mysqli_query($koneksi, $query); // Menjalankan query menggunakan fungsi mysqli_query dengan menggunakan koneksi '$koneksi'.
    
    if (mysqli_num_rows($result) >0){ 
        $data = mysqli_fetch_assoc($result);
        if($data['level'] == 'admin'){
            $_SESSION["username"] = $username; // Mengatur variabel sesi 'name' dengan nilai dari $_POST['username'].
            $_SESSION["level"] = "admin";  // Mengatur variabel sesi 'username' menjadi bernilai true.
            header("Location: layouts/admin/home.php");  // Mengarahkan pengguna ke halaman home.php
            exit();
        }else if($data['level'] == 'user'){
            $_SESSION["username"] = $username; // Mengatur variabel sesi 'name' dengan nilai dari $_POST['username'].
            $_SESSION["level"] = "admin";  // Mengatur variabel sesi 'username' menjadi bernilai true.
            header("Location: layouts/user/home.php");  // Mengarahkan pengguna ke halaman home.php
            exit();
        }else{
            header("Location: index.php?pesan=gagal"); // Mengarahkan pengguna ke halaman login.php jika query tidak mengembalikan baris data.
        }
    }else{
        header("Location: login.php?pesan=gagal"); // Mengarahkan pengguna ke halaman login.php jika query tidak mengembalikan baris data.
    }  

?>
