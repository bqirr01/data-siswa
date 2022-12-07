<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "datasiswa";

$connect = mysqli_connect($host, $user, $pass, $db);
if (!$connect) {
    die("Not Connected To Database");
}

$nis = "";
$nama = "";
$alamat = "";
$kelas = "";
$error = "";

$sukses = "";

// Untuk Edit Data
if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id = $_GET['id'];
    $sql1 = "DELETE FROM siswa where id = '$id'";
    $q1 = mysqli_query($connect, $sql1);
    if ($q1) {
        $sukses = "Data Deleted";
    } else {
        $error = "Delete Failed";
    }
}

if ($op == 'edit') {
    $id = $_GET['id'];
    $crud1 = "SELECT * FROM siswa WHERE id = $id";
    $c1 = mysqli_query($connect, $crud1);
    $r1 = mysqli_fetch_array($c1);
    $nis = $r1['nis'];
    $nama = $r1['nama'];
    $alamat = $r1['alamat'];
    $kelas = $r1['kelas'];

    if ($nis == '') {
        $error = "Data Not Found";
    }
}

// Untuk Create Data
if (isset($_POST['simpan'])) {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $kelas = $_POST['kelas'];

    if ($nis && $nama && $alamat && $kelas) {
        if ($op == 'edit') {
            $crud1 = "update siswa set nis = '$nis',nama = '$nama', alamat = '$alamat',kelas = '$kelas' where id = $id";
            $cr1 = mysqli_query($connect, $crud1);
            if ($cr1) {
                $sukses = "Data Updated";
            } else {
                $error = "Update Failed";
            }
        } else {
            $crud1 = "insert into siswa(nis, nama, alamat, kelas) value ('$nis', '$nama', '$alamat', '$kelas')";
            $c1 = mysqli_query($connect, $crud1);
            if ($c1) {
                $sukses = "Data Added";
            } else {
                $error = "Data failed to upload";
            }
        }

    } else {
        $error = "Please Add Your Data!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Data siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<style>
    .mx-auto {
        width: 800px;
    }

    .card {
        margin-top: 20px;
    }
</style>

<body>
    <header id="header">
        <div class="wrapper">
            <div class="header">
                <section>
                    <h1>DATA SISWA</h1>
                    <p>Tambahkan data diri anda sebagai siswa</p>
                </section>
            </div>
        </div>
    </header>

    <style>
        #header {
            height: 200px;
            width: 100%;
            background: -webkit-linear-gradient(rgba(0, 0, 0, 0.5),
                    rgba(8, 6, 12, 0.5)),
                url("data:image/jpeg;base64,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");
            background-size: cover;
            position: relative;
            overflow: hidden;
        }

        .header {
            margin-top: 50px;
            color: #fff;
            text-align: center;

        }

        footer {
            margin-top: 50px;
            margin-bottom: 0;
            padding: 20px;
            color: white;
            background: -webkit-linear-gradient(rgba(0, 0, 0, 0.5), rgba(8, 6, 12, 0.5)),
                url("data:image/jpeg;base64,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");
            text-align: center;
            font-weight: normal;
            font-size: medium;
        }

    </style>

    <div class="mx-auto">

        <!--Untuk Create Data-->
        <div class="card">
            <div class="card-header">
                Tambah / Edit Data
            </div>
            <div class="card-body">

                <?php
                if ($error) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error ?>
                </div>
                <?php
                    header("refresh:3;url = index.php");
                }
                ?>

                <?php
                if ($sukses) {
                ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $sukses ?>
                </div>
                <?php
                    header("refresh:3;url = index.php");
                }
                ?>

                <form action="" method="post">
                    <div class="mb-3 row">
                        <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nis" name="nis" value="<?php echo $nis ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                value="<?php echo $alamat ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="kelas" name="kelas">
                                <option value="">--- Pilih Kelas ---</option>
                                <option value="kelas X" <?php if ($kelas=="kelas X") echo "selected" ?>>kelas X</option>
                                <option value="kelas XI" <?php if ($kelas=="kelas XI") echo "selected" ?>>kelas XI
                                </option>
                                <option value="kelas XII" <?php if ($kelas=="kelas XII") echo "selected" ?>>kelas XII
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
                    </div>

                </form>
            </div>
        </div>

        <!--Untuk Read Data-->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data siswa
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">NIS</th>
                            <th scope="col">NAMA</th>
                            <th scope="col">ALAMAT</th>
                            <th scope="col">KELAS</th>
                            <th scope="col">AKSI</th>
                        </tr>
                    <Tbody>
                        <?php
                        $crud2 = "SELECT * FROM siswa ORDER BY id";
                        $c2 = mysqli_query($connect, $crud2);
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($c2)) {
                            $id = $r2['id'];
                            $nis = $r2['nis'];
                            $nama = $r2['nama'];
                            $alamat = $r2['alamat'];
                            $kelas = $r2['kelas'];
                        ?>
                        <tr>
                            <th scope="row">
                                <?php echo $urut++ ?>
                            </th>
                            <td scope="row">
                                <?php echo $nis ?>
                            </td>
                            <td scope="row">
                                <?php echo $nama ?>
                            </td>
                            <td scope="row">
                                <?php echo $alamat ?>
                            </td>
                            <td scope="row">
                                <?php echo $kelas ?>
                            </td>
                            <td scope="row">
                                <a href="index.php?op=edit&id=<?php echo $id ?>">
                                    <button type="button" class="btn btn-warning">Edit</button>
                                </a>
                                <a href="index.php?op=delete&id=<?php echo $id ?>"
                                    onclick="return confirm('Are you sure want to delete?')">
                                    <button type="button" class="btn btn-danger">Delete</button>
                                </a>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>

                    </Tbody>
                    </thead>
                </table>

            </div>
        </div>

    </div>
</body>

<footer>
    <p>Made With Spirit🔥 by Muhammad Baqir Syafi'</p>
</footer>

</html>