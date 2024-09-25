<?php include 'header.php'; ?>
<h2 class="text-center">Upload Transactions</h2>
<a href="template.csv" class="btn btn-info mb-3">Download CSV Template</a>

<p class="text-info">Use the provided CSV template to format your data correctly. Make sure the CSV file has the correct headers and data.</p>

<form action="process_upload.php" method="post" enctype="multipart/form-data" class="container">
    <div class="form-group">
        <label for="csv_file">Choose CSV File:</label>
        <input type="file" name="csv_file" id="csv_file" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Upload</button>
</form>

<?php include 'footer.php'; ?>
