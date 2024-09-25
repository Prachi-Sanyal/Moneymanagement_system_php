<?php include 'header.php'; ?>
<?php include 'connection.php'; ?>

<h2 class="text-center">Add Transaction</h2>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $transaction_date = $_POST['transaction_date'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO transactions (type, amount, category, description, transaction_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $type, $amount, $category, $description, $transaction_date);

    // Execute statement
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Transaction added successfully</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }

    // Close statement
    $stmt->close();
}
?>

<form method="POST" action="add_transaction.php">
    <div class="form-group">
        <label for="type">Type</label>
        <select class="form-control" id="type" name="type" required>
            <option value="income">Income</option>
            <option value="expense">Expense</option>
        </select>
    </div>
    <div class="form-group">
        <label for="amount">Amount</label>
        <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
    </div>
    <div class="form-group">
        <label for="category">Category</label>
        <input type="text" class="form-control" id="category" name="category" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description"></textarea>
    </div>
    <div class="form-group">
        <label for="transaction_date">Transaction Date</label>
        <input type="date" class="form-control" id="transaction_date" name="transaction_date" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Transaction</button>
</form>

<?php include 'footer.php'; ?>
