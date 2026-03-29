<?php
include "db_conn.php";
$sql = "SELECT * FROM `crud` ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Dashboard - Pro CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --dark: #1f2937;
            --light: #f8fafc;
        }
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; }
        .navbar-custom { background: rgba(255,255,255,0.95) !important; backdrop-filter: blur(20px); box-shadow: 0 8px 32px rgba(0,0,0,0.1); }
        .card-custom { background: rgba(255,255,255,0.95); backdrop-filter: blur(20px); border: none; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); }
        .btn-primary-custom { background: linear-gradient(45deg, var(--primary), var(--primary-dark)); border: none; border-radius: 12px; padding: 12px 24px; font-weight: 500; transition: all 0.3s; }
        .btn-primary-custom:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(99,102,241,0.4); }
        .btn-success-custom { background: linear-gradient(45deg, var(--success), #059669); border: none; border-radius: 12px; }
        .btn-danger-custom { background: linear-gradient(45deg, var(--danger), #dc2626); border: none; border-radius: 12px; }
        .table-custom th { background: linear-gradient(45deg, var(--primary), var(--primary-dark)); color: white; font-weight: 600; }
        .badge-gender { font-size: 0.85em; font-weight: 600; padding: 6px 12px; border-radius: 20px; }
        .user-card { transition: all 0.3s; border-radius: 15px; overflow: hidden; }
        .user-card:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,0.15); }
        .stats-card { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 20px; }
        @media (max-width: 768px) { .stats-card { margin-bottom: 1rem; } }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand fs-3 fw-bold text-primary" href="#">
                <i class="fas fa-users me-2"></i>Pro CRUD
            </a>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <!-- Stats Cards -->
        <div class="row mb-5">
            <div class="col-md-3">
                <div class="card stats-card p-4 text-center">
                    <i class="fas fa-users fa-3x mb-3 opacity-75"></i>
                    <h3 class="fw-bold"><?php echo mysqli_num_rows($result); ?></h3>
                    <p class="mb-0">Total Users</p>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card card-custom p-4">
                    <?php if (isset($_GET['msg'])) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i><?php echo htmlspecialchars($_GET['msg']); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php } ?>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="fw-bold mb-0"><i class="fas fa-list me-2 text-primary"></i>Users Management</h2>
                        <a href="add_new.php" class="btn btn-primary-custom btn-lg">
                            <i class="fas fa-plus me-2"></i>Add New User
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="card card-custom shadow-lg">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-custom mb-0">
                        <thead>
                            <tr>
                                <th class="text-center py-4"><i class="fas fa-hashtag"></i></th>
                                <th><i class="fas fa-user me-2"></i>Name</th>
                                <th><i class="fas fa-envelope me-2"></i>Email</th>
                                <th class="text-center"><i class="fas fa-venus-mars me-2"></i>Gender</th>
                                <th class="text-center"><i class="fas fa-cogs me-2"></i>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0) { ?>
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr class="user-card align-middle">
                                    <td class="text-center fw-bold fs-5 text-primary"><?php echo $row['id']; ?></td>
                                    <td>
                                        <div>
                                            <h6 class="fw-bold mb-1"><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></h6>
                                            <small class="text-muted">ID: <?php echo $row['id']; ?></small>
                                        </div>
                                    </td>
                                    <td>
                                        <i class="fas fa-envelope text-muted me-2"></i>
                                        <span class="fw-medium"><?php echo htmlspecialchars($row['email']); ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge-gender <?php echo $row['gender'] == 'male' ? 'bg-primary' : 'bg-danger'; ?>">
                                            <i class="fas <?php echo $row['gender'] == 'male' ? 'fa-mars' : 'fa-venus'; ?> me-1"></i>
                                            <?php echo ucfirst($row['gender']); ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary me-2">
                                            <i class="fas fa-pen-to-square"></i>
                                        </a>
                                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Delete <?php echo htmlspecialchars($row['first_name']); ?>?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <i class="fas fa-users fa-4x text-muted mb-4"></i>
                                        <h4 class="text-muted mb-3">No users found</h4>
                                        <a href="add_new.php" class="btn btn-primary-custom btn-lg">
                                            <i class="fas fa-plus me-2"></i>Add First User
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>