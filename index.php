<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tugas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    require_once 'functions.php';
    $tasks = getAllTasks();
    ?>

    <div class="container">
        <h1>Daftar Tugas</h1>

        <div class="header-buttons">
            <a href="tambah_tugas.php" class="button primary">Tambah Tugas</a>
            <a href="kategori.php" class="button secondary">Kelola Kategori</a>
        </div>

        <div class="task-table-container">
            <table>
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="task-list-body">
                    <?php if (empty($tasks)): ?>
                        <tr>
                            <td colspan="5" class="no-data-message">Tidak ada tugas</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($tasks as $task): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($task['title']); ?></td>
                                <td><?php echo htmlspecialchars($task['description']); ?></td>
                                <td><?php echo htmlspecialchars($task['category_name']); ?></td>
                                <td class="
                                    <?php
                                        if ($task['status'] == 'pending') {
                                            echo 'status-pending';
                                        } elseif ($task['status'] == 'onprogress') {
                                            echo 'status-onprogress';
                                        } elseif ($task['status'] == 'completed') {
                                            echo 'status-completed';
                                        }
                                    ?>
                                ">
                                    <?php
                                        echo htmlspecialchars(ucfirst(str_replace('onprogress', 'Sedang Dikerjakan', $task['status'])));
                                    ?>
                                </td>
                                <td class="action-buttons">
                                    <?php
                                    $edit_disabled = ($task['status'] == 'completed') ? 'disabled' : '';
                                    $edit_class = ($task['status'] == 'completed') ? 'button-disabled' : '';
                                    ?>
                                    <a href="edit_tugas.php?id=<?php echo $task['task_id']; ?>"
                                       class="edit-btn <?php echo $edit_class; ?>"
                                       <?php echo $edit_disabled; ?>
                                    >Edit</a>
                                    <button class="delete-btn" onclick="confirmDelete(<?php echo $task['task_id']; ?>)">Hapus</button>
                                    <a href="update_status.php?id=<?php echo $task['task_id']; ?>&status=completed" class="complete-btn">Selesai</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function confirmDelete(taskId) {
            if (confirm('Hapus tugas ini?')) {
                window.location.href = 'hapus_tugas.php?id=' + taskId;
            }
        }
    </script>
</body>
</html>