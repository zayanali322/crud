<?php
include "db_conn.php";

if (isset($_POST['submit'])) {
    $first_name = mysqli_real_escape_string($conn, trim($_POST['first_name']));
    $last_name = mysqli_real_escape_string($conn, trim($_POST['last_name']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $gender = mysqli_real_escape_string($conn, trim($_POST['gender']));

    $sql = "INSERT INTO `crud`(`first_name`, `last_name`, `email`, `gender`) VALUES ('$first_name', '$last_name', '$email', '$gender')";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php?msg=User created successfully 🎉");
        exit();
    } else {
        $error = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User - Pro CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        :root {
            --primary: #6366f1; --primary-dark: #4f46e5;
            --success: #10b981; --danger: #ef4444;
            --light: #f8fafc; --dark: #1f2937;
        }
        body { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
            min-height: 100vh; 
            display: flex; align-items: center; 
        }
        .form-card { 
            background: rgba(255,255,255,0.95); 
            backdrop-filter: blur(20px); 
            border-radius: 25px; 
            box-shadow: 0 25px 50px rgba(0,0,0,0.15); 
            max-width: 500px; 
            margin: 0 auto; 
            padding: 3rem; 
        }
        .btn-primary-custom { 
            background: linear-gradient(45deg, var(--primary), var(--primary-dark)); 
            border: none; border-radius: 15px; 
            padding: 15px 30px; font-weight: 500; 
            transition: all 0.3s; 
        }
        .btn-primary-custom:hover { 
            transform: translateY(-3px); 
            box-shadow: 0 15px 30px rgba(99,102,241,0.4); 
        }
        .form-floating input, .form-floating select { border-radius: 12px; border: 2px solid #e2e8f0; }
        .form-floating input:focus, .form-floating select:focus { border-color: var(--primary); box-shadow: 0 0 0 0.2rem rgba(99,102,241,0.25); }
        .gender-group { background: #f8fafc; padding: 1.5rem; border-radius: 15px; border: 2px solid #e2e8f0; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="form-card">
            <div class="text-center mb-5">
                <i class="fas fa-user-plus fa-4x text-primary mb-4"></i>
                <h2 class="fw-bold mb-2">Add New User</h2>
                <p class="text-muted">Fill in the details to create a new user</p>
            </div>

            <?php if (isset($error)) { ?>
                <div class="alert alert-danger d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-2"></i><?php echo $error; ?>
                </div>
            <?php } ?>

            <form method="post">
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="firstName" name="first_name" required>
                            <label for="firstName"><i class="fas fa-user me-2"></i>First Name</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="lastName" name="last_name" required>
                            <label for="lastName"><i class="fas fa-user me-2"></i>Last Name</label>
                        </div>
                    </div>
                </div>

                <div class="form-floating mb-4">
                    <input type="email" class="form-control" id="email" name="email" required>
                    <label for="email"><i class="fas fa-envelope me-2"></i>Email Address</label>
                </div>

                <div class="gender-group mb-4">
                    <label class="form-label fw-bold mb-3 d-block"><i class="fas fa-venus-mars me-2"></i>Gender</label>
                    <div class="row text-center">
                        <div class="col-6">
                            <input type="radio" class="btn-check" name="gender" id="male" value="male" required>
                            <label class="btn btn-outline-primary w-100 p-3 rounded-3" for="male">
                                <i class="fas fa-mars fa-2x mb-2 d-block"></i>
                                <strong>Male</strong>
                            </label>
                        </div>
                        <div class="col-6">
                            <input type="radio" class="btn-check" name="gender" id="female" value="female" required>
                            <label class="btn btn-outline-danger w-100 p-3 rounded-3" for="female">
                                <i class="fas fa-venus fa-2x mb-2 d-block"></i>
                                <strong>Female</strong>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-3">
                    <button type="submit" name="submit" class="btn btn-primary-custom btn-lg">
                        <i class="fas fa-save me-2"></i>Create User
                    </button>
                    <a href="index.php" class="btn btn-outline-secondary btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>