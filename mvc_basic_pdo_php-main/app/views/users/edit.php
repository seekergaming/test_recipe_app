<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form action="/update/<?= $user['id']; ?>" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?= htmlspecialchars($user['name']); ?>" required>
        <br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']); ?>" required>
        <br><br>
        <button type="submit">Update User</button>
    </form>
</body>
</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        <h2 class="text-center mb-0">Edit User</h2>
                    </div>
                    <div class="card-body">
                        <form action="/update/<?= $user['id']; ?>" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" 
                                       value="<?= htmlspecialchars($user['name']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" 
                                       value="<?= htmlspecialchars($user['email']); ?>" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-warning">Update User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional, but recommended for some components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>