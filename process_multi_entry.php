<?php
include 'connection.php';

$types = $_POST['type'];
$amounts = $_POST['amount'];
$categories = $_POST['category'];
$descriptions = $_POST['description'];
$dates = $_POST['transaction_date'];

$stmt = $conn->prepare("INSERT INTO transactions (type, amount, category, description, transaction_date) VALUES (?, ?, ?, ?, ?)");

for ($i = 0; $i < count($types); $i++) {
    $stmt->bind_param("sssss", $types[$i], $amounts[$i], $categories[$i], $descriptions[$i], $dates[$i]);
    $stmt->execute();
}

$stmt->close();
$conn->close();

echo "<div class='alert alert-success'>Transactions added successfully.</div>";
echo "<a href='index.php' class='btn btn-primary'>Go to Dashboard</a>";
?>
