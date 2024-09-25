<?php include 'header.php'; ?>
<?php include 'connection.php'; ?>

<h2 class="text-center">Edit Transaction</h2>

<?php
$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $transaction_date = $_POST['transaction_date'];

    $sql = "UPDATE transactions SET type='$type', amount='$amount', category='$category', 
            description='$description', transaction_date='$transaction_date' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Transaction updated successfully</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}

// Fetch the existing transaction data
$sql = "SELECT * FROM transactions WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<form method="POST" action="edit_transaction.php?id=<?php echo $id; ?>">
    <div class="form-group">
        <label for="type">Type</label>
        <select class="form-control" id="type" name="type" required>
            <option value="income" <?php if ($row['type'] == 'income') echo 'selected'; ?>>Income</option>
            <option value="expense" <?php if ($row['type'] == 'expense') echo 'selected'; ?>>Expense</option>
        </select>
    </div>
    <div class="form-group">
        <label for="amount">Amount</label>
        <input type="number" class="form-control" id="amount" name="amount" value="<?php echo $row['amount']; ?>" required>
    </div>
    <div class="form-group">
        <label for="category">Category</label>
        <input type="text" class="form-control" id="category" name="category" value="<?php echo $row['category']; ?>" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description"><?php echo $row['description']; ?></textarea>
    </div>
    <div class="form-group">
        <label for="transaction_date">Transaction Date</label>
        <input type="date" class="form-control" id="transaction_date" name="transaction_date" value="<?php echo $row['transaction_date']; ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Transaction</button>
</form>

<?php include 'footer.php'; ?>
