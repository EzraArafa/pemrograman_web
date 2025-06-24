<?php
require_once 'config.php';

function getAllTasks() {
    global $conn;
    $sql = "SELECT
                t.task_id,
                t.title,
                t.description,
                c.name AS category_name,
                t.status
            FROM
                tasks AS t
            JOIN
                categories AS c ON t.category_id = c.category_id
            ORDER BY
                t.task_id DESC";
    $result = $conn->query($sql);
    $tasks = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
    }
    return $tasks;
}

function addTask($title, $description, $categoryId, $status) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO tasks (title, description, category_id, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $title, $description, $categoryId, $status);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function getTaskById($taskId) {
    global $conn;
    $stmt = $conn->prepare("SELECT task_id, title, description, category_id, status FROM tasks WHERE task_id = ?");
    $stmt->bind_param("i", $taskId);
    $stmt->execute();
    $result = $stmt->get_result();
    $task = $result->fetch_assoc();
    $stmt->close();
    return $task;
}

function updateTask($taskId, $title, $description, $categoryId, $status) {
    global $conn;
    $stmt = $conn->prepare("UPDATE tasks SET title = ?, description = ?, category_id = ?, status = ? WHERE task_id = ?");
    $stmt->bind_param("ssisi", $title, $description, $categoryId, $status, $taskId);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function deleteTask($taskId) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM tasks WHERE task_id = ?");
    $stmt->bind_param("i", $taskId);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function getAllCategories() {
    global $conn;
    $sql = "SELECT category_id, name FROM categories ORDER BY name ASC";
    $result = $conn->query($sql);
    $categories = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row;
        }
    }
    return $categories;
}

function getCategoryById($categoryId) {
    global $conn;
    $stmt = $conn->prepare("SELECT category_id, name FROM categories WHERE category_id = ?");
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    $result = $stmt->get_result();
    $category = $result->fetch_assoc();
    $stmt->close();
    return $category;
}

function addCategory($name) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->bind_param("s", $name);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function updateCategory($categoryId, $name) {
    global $conn;
    $stmt = $conn->prepare("UPDATE categories SET name = ? WHERE category_id = ?");
    $stmt->bind_param("si", $name, $categoryId);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

function deleteCategory($categoryId) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM categories WHERE category_id = ?");
    $stmt->bind_param("i", $categoryId);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}
?>