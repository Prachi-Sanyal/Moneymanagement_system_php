<?php include 'header.php'; ?>
<h2 class="text-center">Add Multiple Transactions</h2>
<p class="text-info">Fill out the form below to add multiple transactions at once. Use the "Add More" button to include additional rows.</p>
<form action="process_multi_entry.php" method="post" class="container">
    <div id="transaction-forms">
        <div class="form-group">
            <label>Type:</label>
            <select name="type[]" class="form-control">
                <option value="income">Income</option>
                <option value="expense">Expense</option>
            </select>
        </div>
        <div class="form-group">
            <label>Amount:</label>
            <input type="number" name="amount[]" class="form-control" step="0.01" required>
        </div>
        <div class="form-group">
            <label>Category:</label>
            <input type="text" name="category[]" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Description:</label>
            <input type="text" name="description[]" class="form-control">
        </div>
        <div class="form-group">
            <label>Date:</label>
            <input type="date" name="transaction_date[]" class="form-control" required>
        </div>
        <button type="button" id="add-more" class="btn btn-secondary">Add More</button>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>
    document.getElementById('add-more').addEventListener('click', function() {
        const container = document.getElementById('transaction-forms');
        const newForm = container.children[0].cloneNode(true);
        Array.from(newForm.querySelectorAll('input, select')).forEach(input => input.value = '');
        container.appendChild(newForm);
    });
</script>

<?php include 'footer.php'; ?>
