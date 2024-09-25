<?php
include 'connection.php';

$id = $_GET['id'];

$sql = "DELETE FROM transactions WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
    exit();
} else {
    echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
}
?>
