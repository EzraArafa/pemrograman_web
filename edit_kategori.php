<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    require_once 'functions.php';

    $categoryId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $category = getCategoryById($categoryId);

    if (!$category) {
        header('Location: kategori.php');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $newName = $_POST['name'];

        if (updateCategory($categoryId, $newName)) {
            header('Location: kategori.php');
            exit;
        } else {
            echo "<p class='error-message'>Gagal memperbarui kategori.</p>";
        }
    }
    ?>

    <div class="container">
        <h1>Edit Kategori</h1>

        <form method="POST" action="edit_kategori.php?id=<?php echo $categoryId; ?>">
            <div class="form-group">
                <label for="name">Nama Kategori</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($category['name']); ?>" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="button primary">Simpan</button>
                <a href="kategori.php" class="button secondary">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>