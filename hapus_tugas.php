<?php
require_once 'functions.php';

if (isset($_GET['id'])) {
    $taskId = (int)$_GET['id'];
    if (deleteTask($taskId)) {
        header('Location: index.php');
        exit;
    } else {
        echo "Gagal menghapus tugas.";
    }
} else {
    header('Location: index.php');
    exit;
}
?>