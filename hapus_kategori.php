<?php
require_once 'functions.php';

if (isset($_GET['id'])) {
    $categoryId = (int)$_GET['id'];

    if (deleteCategory($categoryId)) {
        header('Location: kategori.php');
        exit;
    } else {
        echo "Gagal menghapus kategori.";
    }
} else {
    header('Location: kategori.php');
    exit;
}
?>