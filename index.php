<?php
include_once 'koneksi.php';

// 1. Logika Pencarian (Praktikum 14)
$q = isset($_GET['q']) ? $_GET['q'] : "";
$sql_where = !empty($q) ? " WHERE nama LIKE '{$q}%'" : "";

// 2. Logika Pagination - Maksimal 3 Barang (Praktikum 13)
$per_page = 3; 
$sql_count = "SELECT COUNT(*) FROM data_barang" . $sql_where;
$result_count = mysqli_query($conn, $sql_count);
$r_data = mysqli_fetch_row($result_count);
$count = $r_data[0];

$num_page = ceil($count / $per_page);
$page = isset($_GET['page']) && (int)$_GET['page'] > 0 ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $per_page;

// 3. Query Utama
$sql = "SELECT * FROM data_barang" . $sql_where . " LIMIT {$offset}, {$per_page}";
$result = mysqli_query($conn, $sql);

include_once 'header.php';
?>

<div class="dashboard-grid">
    <div class="main-card" style="margin-top: 0;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="margin:0; color: var(--primary);">Product List</h2>
            <a href="tambah.php" class="btn btn-primary">+ Tambah Barang</a>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(mysqli_num_rows($result) > 0): ?>
                    <?php while($row = mysqli_fetch_array($result)): ?>
                    <tr>
                        <td>
                            <img src="img/<?php echo $row['gambar']; ?>" width="40" height="40" style="border-radius:5px; object-fit:cover;" onerror="this.src='https://via.placeholder.com/40?text=No+Img'">
                        </td>
                        <td>
                            <div style="font-weight:600;"><?php echo $row['nama']; ?></div>
                            <div style="font-size:0.75rem; color:#888;">Rp <?php echo number_format($row['harga_jual'],0,',','.'); ?></div>
                        </td>
                        <td><?php echo $row['stok']; ?></td>
                        <td style="text-align:center;">
                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn-edit" style="color: #ffc107; text-decoration: none; margin-right: 10px;">Edit</a>
                            <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn-delete" style="color: #ff4d4d; text-decoration: none;" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4" align="center" style="padding: 20px; color: #888;">Data tidak ditemukan.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="pagination" style="margin-top: 20px; display: flex; gap: 5px;">
            <?php for($i=1; $i<=$num_page; $i++): ?>
                <a href="?page=<?php echo $i; ?>&q=<?php echo $q; ?>" class="<?php echo ($page == $i ? 'active' : ''); ?>" style="padding: 8px 12px; border-radius: 4px; border: 1px solid #333; text-decoration: none; color: white; <?php echo ($page==$i ? 'background: var(--primary); color: black;' : ''); ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>
    </div>

    <div class="sidebar">
        <h3 style="color: var(--primary); margin-top: 0;">Pencarian</h3>
        <form action="" method="get" style="margin-bottom: 25px;">
            <input type="text" name="q" class="search-box" placeholder="Cari nama barang..." value="<?php echo htmlspecialchars($q); ?>" style="width:100%; margin-bottom:10px; padding: 10px; background: #0f3460; border: 1px solid #333; color: white; border-radius: 5px; box-sizing: border-box;">
            <button type="submit" name="submit" class="btn btn-primary" style="width:100%; cursor: pointer;">Cari</button>
        </form>

        <h3 style="color: var(--primary);">Ringkasan</h3>
        <div class="sidebar-list">
            <div class="sidebar-item" style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #333;">
                <span>Total Barang</span>
                <span class="count" style="font-weight: bold; color: var(--primary);"><?php echo $count; ?></span>
            </div>
            <div class="sidebar-item" style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #333;">
                <span>Halaman ke-</span>
                <span class="count" style="font-weight: bold; color: var(--primary);"><?php echo $page; ?> dari <?php echo $num_page; ?></span>
            </div>
        </div>
    </div>
</div>

<?php include_once 'footer.php'; ?>