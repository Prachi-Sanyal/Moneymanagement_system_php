<?php include 'header.php'; ?>
<?php include 'connection.php'; ?>

<h2 class="text-center">Dashboard</h2>

<?php
// Fetch all transactions
$sql = "SELECT * FROM transactions ORDER BY transaction_date DESC";
$result = $conn->query($sql);

// Calculate total income and expenses
$total_income = 0;
$total_expense = 0;
while ($row = $result->fetch_assoc()) {
    if ($row['type'] == 'income') {
        $total_income += $row['amount'];
    } else {
        $total_expense += $row['amount'];
    }
}
$balance = $total_income - $total_expense;
?>

<div class="row">
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Income</h5>
                <p class="card-text">$<?php echo number_format($total_income, 2); ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-danger mb-3">
            <div class="card-body">
                <h5 class="card-title">Total Expense</h5>
                <p class="card-text">$<?php echo number_format($total_expense, 2); ?></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-info mb-3">
            <div class="card-body">
                <h5 class="card-title">Current Balance</h5>
                <p class="card-text">$<?php echo number_format($balance, 2); ?></p>
            </div>
        </div>
    </div>
</div>

<h3 class="mt-4">Recent Transactions</h3>
<div class="container">
    <a href="add_transaction.php" class="btn btn-primary mb-3">Add Transaction</a>
    <a href="upload_transactions.php" class="btn btn-success mb-3">Upload CSV</a>
    <a href="multi_entry.php" class="btn btn-info mb-3">Multi-Entry Form</a>
    
    <?php
    // Re-run the query to get transactions for listing
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "<table class='table table-bordered'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . ucfirst($row['type']) . "</td>
                    <td>" . number_format($row['amount'], 2) . "</td>
                    <td>" . htmlspecialchars($row['category']) . "</td>
                    <td>" . htmlspecialchars($row['description']) . "</td>
                    <td>" . $row['transaction_date'] . "</td>
                    <td>
                        <a href='edit_transaction.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='delete_transaction.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                    </td>
                </tr>";
        }
        
        echo "  </tbody>
              </table>";
    } else {
        echo "<div class='alert alert-info'>No transactions found.</div>";
    }
    ?>
</div>

<?php include 'footer.php'; ?>
