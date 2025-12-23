<?php
include_once 'koneksi.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM data_barang WHERE id='$id'");
header('location: index.php');
?>