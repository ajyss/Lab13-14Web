<?php
include_once 'koneksi.php';
$id = $_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM data_barang WHERE id='$id'");
$data = mysqli_fetch_array($res);

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $sql = "UPDATE data_barang SET nama='$nama' WHERE id='$id'";
    mysqli_query($conn, $sql);
    header('location: index.php');
}
include_once 'header.php';
?>
<div class="main">
    <h2>Edit Barang</h2>
    <form method="post">
        <div class="input-group"><label>Nama Barang</label><input type="text" name="nama" value="<?php echo $data['nama']; ?>"></div>
        <button type="submit" name="submit" class="btn-tambah">Update</button>
    </form>
</div>
<?php include_once 'footer.php'; ?>