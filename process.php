<?php
require 'database.php';

// Agregar un registro
if (isset($_POST['action']) && $_POST['action'] === 'add') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("INSERT INTO records (name, description) VALUES (:name, :description)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->execute();

    header("Location: index.php");
    exit;
}
if (isset($_POST['action']) && $_POST['action'] === 'edit') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("UPDATE records SET name = :name, description = :description WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->execute();

    header("Location: index.php");
    exit;

// Eliminar un registro
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM records WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header("Location: index.php");
    exit;
}

// Buscar registros
$searchQuery = '';
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $stmt = $conn->prepare("SELECT * FROM records WHERE name LIKE :query");
    $stmt->bindValue(':query', "%$searchQuery%");
} else {
    $stmt = $conn->prepare("SELECT * FROM records");
}
$stmt->execute();
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
