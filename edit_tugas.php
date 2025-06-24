<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    require_once 'functions.php';

    $taskId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    $task = getTaskById($taskId);
    $categories = getAllCategories();

    if (!$task) {
        header('Location: index.php');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $categoryId = $_POST['category_id'];
        $status = $_POST['status'];

        if (updateTask($taskId, $title, $description, $categoryId, $status)) {
            header('Location: index.php');
            exit;
        } else {
            echo "<p class='error-message'>Gagal memperbarui tugas.</p>";
        }
    }
    ?>

    <div class="container">
        <h1>Edit Tugas</h1>

        <form method="POST" action="edit_tugas.php?id=<?php echo $taskId; ?>">
            <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea id="description" name="description" rows="4"><?php echo htmlspecialchars($task['description']); ?></textarea>
            </div>

            <div class="form-group">
                <label for="category">Kategori</label>
                <select id="category" name="category_id" required>
                    <?php if (empty($categories)): ?>
                        <option value="">Tidak ada kategori.</option>
                    <?php else: ?>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['category_id']; ?>"
                                <?php echo ($category['category_id'] == $task['category_id']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($category['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="pending" <?php echo ($task['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                    <option value="onprogress" <?php echo ($task['status'] == 'onprogress') ? 'selected' : ''; ?>>Sedang Dikerjakan</option>
                    <option value="completed" <?php echo ($task['status'] == 'completed') ? 'selected' : ''; ?>>Selesai</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="button primary">Simpan</button>
                <a href="index.php" class="button secondary">Kembali</a>
            </div>
        </form>
    </div>
</body>
</html>