<?php
include_once 'koneksi.php';

// Logika Tambah Data (Praktikum 14)
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    
    // Upload Gambar
    $gambar = $_FILES['gambar']['name'];
    if ($gambar != "") {
        move_uploaded_file($_FILES['gambar']['tmp_name'], "img/" . $gambar);
    }

    $sql = "INSERT INTO data_barang (nama, kategori, harga_jual, harga_beli, stok, gambar) 
            VALUES ('{$nama}', '{$kategori}', '{$harga_jual}', '{$harga_beli}', '{$stok}', '{$gambar}')";
    
    if (mysqli_query($conn, $sql)) {
        header("location: index.php");
    }
}

include_once 'header.php';
?>

<div class="main-card" style="max-width: 600px; margin: 40px auto;">
    <div style="border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 25px; padding-bottom: 10px;">
        <h2 style="margin: 0; color: var(--primary); font-size: 1.5rem;">Tambah Barang Baru</h2>
        <p style="color: #888; font-size: 0.9rem; margin-top: 5px;">Silakan isi formulir di bawah untuk menambah stok barang.</p>
    </div>

    <form method="post" enctype="multipart/form-data">
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Nama Barang</label>
            <input type="text" name="nama" class="search-box" style="width: 100%; box-sizing: border-box;" placeholder="Contoh: Busur Panah" required>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Kategori</label>
            <select name="kategori" class="search-box" style="width: 100%; box-sizing: border-box; cursor: pointer;">
                <option value="Panahan">Panahan</option>
                <option value="Alat Olahraga">Alat Olahraga</option>
                <option value="Aksesoris">Aksesoris</option>
            </select>
        </div>

        <div style="display: flex; gap: 20px; margin-bottom: 20px;">
            <div style="flex: 1;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Harga Jual (Rp)</label>
                <input type="number" name="harga_jual" class="search-box" style="width: 100%; box-sizing: border-box;" placeholder="0" required>
            </div>
            <div style="flex: 1;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Harga Beli (Rp)</label>
                <input type="number" name="harga_beli" class="search-box" style="width: 100%; box-sizing: border-box;" placeholder="0" required>
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Stok Barang</label>
            <input type="number" name="stok" class="search-box" style="width: 100%; box-sizing: border-box;" placeholder="0" required>
        </div>

        <div style="margin-bottom: 30px; background: rgba(255,255,255,0.03); padding: 15px; border-radius: 8px; border: 1px dashed #333;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Upload Gambar Produk</label>
            <input type="file" name="gambar" style="color: #888; font-size: 0.9rem;">
        </div>

        <div style="display: flex; gap: 15px; align-items: center;">
            <button type="submit" name="submit" class="btn btn-primary" style="flex: 2; padding: 12px; font-size: 1rem;">
                Simpan Data
            </button>
            <a href="index.php" style="flex: 1; text-align: center; color: #888; text-decoration: none; font-size: 0.9rem; border: 1px solid #333; padding: 10px; border-radius: 8px;">
                Batal
            </a>
        </div>
    </form>
</div>

<?php include_once 'footer.php'; ?>