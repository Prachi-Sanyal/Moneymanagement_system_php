session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $transaction_date = $_POST['transaction_date'];

    // Get the logged-in user's ID
    $user_id = $_SESSION['user_id'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO transactions (user_id, type, amount, category, description, transaction_date) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $user_id, $type, $amount, $category, $description, $transaction_date);

    // Execute statement
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Transaction added successfully</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }

    // Close statement
    $stmt->close();
}
