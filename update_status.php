<?php
require_once 'functions.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $taskId = (int)$_GET['id'];
    $newStatus = $_GET['status'];

    $task = getTaskById($taskId);

    if ($task) {
        if (updateTask($taskId, $task['title'], $task['description'], $task['category_id'], $newStatus)) {
            header('Location: index.php');
            exit;
        } else {
            echo "Gagal memperbarui status tugas.";
        }
    } else {
        echo "Tugas tidak ditemukan.";
    }
} else {
    header('Location: index.php');
    exit;
}
?>