<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    require_once 'functions.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_category_name'])) {
        $newCategoryName = trim($_POST['new_category_name']);
        if (!empty($newCategoryName)) {
            if (addCategory($newCategoryName)) {
                header('Location: kategori.php');
                exit;
            } else {
                echo "<p class='error-message'>Gagal menambahkan kategori.</p>";
            }
        }
    }

    $categories = getAllCategories();
    ?>

    <div class="container">
        <h1>Kelola Kategori</h1>

        <h2>Daftar Kategori</h2>
        <div class="task-table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($categories)): ?>
                        <tr>
                            <td colspan="3">Belum ada kategori.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($category['category_id']); ?></td>
                                <td><?php echo htmlspecialchars($category['name']); ?></td>
                                <td class="action-buttons">
                                    <a href="edit_kategori.php?id=<?php echo $category['category_id']; ?>" class="edit-btn">Edit</a>
                                    <button class="delete-btn" onclick="confirmDeleteCategory(<?php echo $category['category_id']; ?>)">Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <h2>Tambah Kategori Baru</h2>
        <form method="POST" action="kategori.php">
            <div class="form-group">
                <label for="new_category_name">Nama Kategori</label>
                <input type="text" id="new_category_name" name="new_category_name" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="button primary">Simpan</button>
                <a href="index.php" class="button secondary">Kembali</a>
            </div>
        </form>
    </div>

    <script>
        function confirmDeleteCategory(categoryId) {
            if (confirm('Hapus kategori ini? Menghapus kategori akan membuat tugas yang terkait kehilangan kategorinya.')) {
                window.location.href = 'hapus_kategori.php?id=' + categoryId;
            }
        }
    </script>
</body>
</html>