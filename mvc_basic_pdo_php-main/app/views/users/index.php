<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">Users</h1>
                
                <div class="mb-3">
                <div class="col-12 d-flex justify-content-between align-items-center">
            <a href="/logout" class="btn btn-danger">Logout</a>
        </div>
                    <a href="/create" class="btn btn-success">Add User</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['name']); ?></td>
                                <td><?= htmlspecialchars($user['email']); ?></td>
                                <td>
                                    <a href="/edit/<?= $user['id']; ?>" class="btn btn-sm btn-warning me-2">Edit</a>
                                    <form action="/delete/<?= $user['id']; ?>" method="POST" style="display:inline;" class="d-inline">
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Are you sure you want to delete this user?');">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional, but recommended for some components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>