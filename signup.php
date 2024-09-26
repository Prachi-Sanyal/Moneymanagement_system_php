<?php include 'header.php'; ?>
<?php include 'connection.php'; ?>

<h2 class="text-center">Sign Up</h2>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashing the password

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    // Execute statement
    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>User registered successfully</div>";
        header("Location: login.php"); // Redirect to login page
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
    }

    // Close statement
    $stmt->close();
}
?>

<form method="POST" action="signup.php">
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Sign Up</button>
</form>

<?php include 'footer.php'; ?>
