<?php
include 'connection.php';

// Function to handle file upload and data import
function importCSV($file, $conn) {
    if (($handle = fopen($file, 'r')) !== FALSE) {
        // Skip the first row if it's a header
        fgetcsv($handle);
        
        while (($data = fgetcsv($handle)) !== FALSE) {
            // Extract data from CSV
            $transaction_date = $data[4]; // Adjusted index based on CSV structure
            $type = $data[1];
            $amount = $data[2];
            $category = $data[3];
            $description = $data[4];
            
            // Prepare and execute the SQL statement
            $sql = "INSERT INTO transactions (transaction_date, type, amount, category, description) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssss', $transaction_date, $type, $amount, $category, $description);
            $stmt->execute();
        }
        fclose($handle);
        return true;
    } else {
        return false;
    }
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['csv_file'])) {
    $fileTmpPath = $_FILES['csv_file']['tmp_name'];
    $fileName = $_FILES['csv_file']['name'];
    $fileSize = $_FILES['csv_file']['size'];
    $fileType = $_FILES['csv_file']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    
    // Validate file extension
    if ($fileExtension == 'csv') {
        if (importCSV($fileTmpPath, $conn)) {
            header("Location: index.php?upload=success");
        } else {
            header("Location: index.php?upload=error");
        }
    } else {
        header("Location: index.php?upload=invalid");
    }
    exit();
}

// Close the database connection
$conn->close();
?>
