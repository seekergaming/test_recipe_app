<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Application</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Main Container -->
    <div class="container mt-5">
        <!-- Page Title -->
        <div class="text-center mb-4">
            <h1 class="fw-bold">Loan Application</h1>
            <p class="text-muted">Complete the form below to apply for a loan</p>
        </div>

        <!-- Loan Application Form -->
        <form action="/loan" method="POST" enctype="multipart/form-data" class="p-4 border rounded shadow bg-white">
            <!-- Personal Details -->
            <h3 class="mb-3">Personal Details</h3>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter your full name" required>
                </div>
                <div class="col-md-6">
                    <label for="ic_number" class="form-label">IC Number</label>
                    <input type="text" name="ic_number" class="form-control" id="ic_number" placeholder="e.g. 040801-10" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="example@gmail.com" required>
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" id="phone" placeholder="e.g. 017-567-9202" required>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="postcode" class="form-label">Postcode</label>
                    <input type="text" name="postcode" class="form-control" id="postcode" placeholder="e.g. 77100" required>
                </div>
                <div class="col-md-6">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" class="form-control" id="address" rows="2" placeholder="Enter your address" required></textarea>
                </div>
            </div>

            <!-- Loan Details -->
            <h3 class="mb-3">Loan Details</h3>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="loan_type" class="form-label">Types of Loan</label>
                    <select name="loan_type" id="loan_type" class="form-select" required>
                        <option value="Al Bai Loan">Al Bai Loan</option>
                        <option value="Murabahah Loan">Murabahah Loan</option>
                        <option value="Ijarah Loan">Ijarah Loan</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="loan_amount" class="form-label">Loan Amount (RM)</label>
                    <input type="number" name="loan_amount" class="form-control" id="loan_amount" placeholder="e.g. 54000" required>
                </div>
                <div class="col-md-3">
                    <label for="loan_duration" class="form-label">Loan Duration (Years)</label>
                    <input type="number" name="loan_duration" class="form-control" id="loan_duration" placeholder="e.g. 9" required>
                </div>
            </div>

            <!-- File Upload Section -->
            <h5 class="mb-3">Please upload the following documents:</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="payslip_file" class="form-label">Payslip</label>
                    <input type="file" name="payslip_file" class="form-control" id="payslip_file" accept=".pdf,.jpg,.jpeg,.png" required>
                </div>
                <div class="col-md-6">
                    <label for="bank_statement_file" class="form-label">Bank Statement</label>
                    <input type="file" name="bank_statement_file" class="form-control" id="bank_statement_file" accept=".pdf,.jpg,.jpeg,.png" required>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary w-50">Submit Application</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
