<div class="container">
    <?php
    include_once '../class/koneksi.php';

    // Search query
    $q = "";
    $sql_where = "";
    if (isset($_GET['submit']) && !empty($_GET['q'])) {
        $q = $_GET['q'];
        $sql_where = " WHERE nama LIKE '{$q}%'";
    }


    // Pagination
    $sql = 'SELECT * FROM data_barang';

    $sql_count = "SELECT COUNT(*) FROM data_barang" . $sql_where;
    $result_count = mysqli_query($conn, $sql_count);

    $count = 0;

    if ($result_count) {
        $r_data = mysqli_fetch_row($result_count);
        $count = $r_data[0];
    }

    $per_page = 1;
    $num_page = ceil($count / $per_page);

    $limit = $per_page;

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        $offset = ($page - 1) * $per_page;
    } else {
        $offset = 0;
        $page = 1;
    }

    $sql .= $sql_where . " LIMIT {$offset}, {$limit}";
    $result = mysqli_query($conn, $sql);
    ?>

    <?php require_once('../template/header.php'); ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            <?= $title ?>
        </title>
        <link rel="stylesheet" href="../CSS/style.css">
        <style>
            .pagination {
                display: inline-block;
                padding: 0;
                margin: 0;
            }

            .pagination li {
                display: inline;
            }

            .pagination li a {
                color: black;
                float: left;
                padding: 8px 16px;
                text-decoration: none;
                transition: background-color .3s;
            }

            .pagination li a.active {
                background-color: #428bea;
                color: white;
            }

            .pagination li a:hover:not(.active) {
                background-color: #ddd;
            }

            .search {
                margin-bottom: 20px;
                display: flex;
                align-items: center;
                justify-content: flex-start;
                /* Align to the left */
            }

            .label-search {
                margin-right: 10px;
                font-weight: bold;
            }

            .input-q {
                padding: 8px;
                width: 200px;
                /* Adjust the width as needed */
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            .btn-primary {
                padding: 4px 8px;
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                margin-left: 10px;
                /* Add margin to separate from the input */
            }

            .btn-primary:hover {
                background-color: #0056b3;
            }
        </style>
    </head>

    <body>
        <h1>DATA BARANG</h1>

        <!-- Tambah Barang Link -->
        <?php echo '<a href="tambah_barang.php" class="btn btn-large">Tambah Barang</a>'; ?>

        <!-- Search Form -->
        <form action="" method="get" class="search">
            <label for="q" class="label-search">Cari data:</label>
            <input type="text" id="q" name="q" class="input-q" value="<?php echo $q ?>">
            <input type="submit" name="submit" value="Cari" class="btn btn-primary">
        </form>

        <div class="main">
            <!-- Table and data display -->
            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <table>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Harga Jual</th>
                        <th>Harga Beli</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_array($result)): ?>
                        <tr>
                            <td><img src="gambar/<?= $row['gambar']; ?>" alt="<?= $row['nama']; ?>"></td>
                            <td>
                                <?= $row['nama']; ?>
                            </td>
                            <td>
                                <?= $row['kategori']; ?>
                            </td>
                            <td>
                                <?= $row['harga_beli']; ?>
                            </td>
                            <td>
                                <?= $row['harga_jual']; ?>
                            </td>
                            <td>
                                <?= $row['stok']; ?>
                            </td>
                            <td>
                                <a class="ubah" href="ubah.php?id=<?= $row['id_barang']; ?>">Ubah</a>
                                <a class="hapus" href="hapus.php?id=<?= $row['id_barang']; ?>">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>Belum ada data</p>
            <?php endif; ?>

            <!-- Pagination -->
            <ul class="pagination">
                <li><a href="#">&laquo;</a></li>
                <?php for ($i = 1; $i <= $num_page; $i++) {
                    $link = "?page={$i}";
                    if (!empty($q))
                        $link .= "&q={$q}";
                    $class = ($page == $i ? 'active' : '');
                    echo "<li><a class=\"{$class}\" href=\"{$link}\">{$i}</a></li>";
                } ?>
                <li><a href="#">&raquo;</a></li>
            </ul>
        </div>

    </body>

    </html>

    <?php require_once('../template/footer.php'); ?>
</div>

<?php
if ($result):
    $q = " ";
    if (isset($_GET['submit']) && !empty($_GET['q'])) {
        $q = $_GET['q'];
        $sql_where = " WHERE nama LIKE '{$q}%'";
    }
    $title = 'Data Barang';
    include_once '../class/koneksi.php';
    $sql = 'SELECT * FROM data_barang';
    if (isset($sql_where))
        $sql .= $sql_where;
    $result = mysqli_query($conn, $sql);
?>
<?php endif; ?>