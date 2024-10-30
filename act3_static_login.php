<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/custom_logins.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login Form</title>
</head>
<body>

    <div class="container">
        <?php
            $showAlert = false; // Default value for invalid login
            $successAlert = false; // Default value for successful login
            $role = ''; // Default role

            // Check if the form was submitted
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = trim($_POST['username']);
                $password = trim($_POST['password']);
                $role = $_POST['userRole']; // Get the selected role

                // User credentials based on roles
                $validCredentials = [
                    'admin' => [
                        'admin' => 'Pass1234',
                        'renmark' => 'Pogi1234',
                    ],
                    'content-manager' => [
                        'pepito' => 'manaloto',
                        'bryan' => 'palabay',
                    ],
                    'system-user' => [
                        'pedro' => 'penduko', // Ensure this line is correct
                    ],
                ];


                // Check if the selected role and provided credentials are valid
                if (array_key_exists($role, $validCredentials) &&
                    array_key_exists($username, $validCredentials[$role]) &&
                    $validCredentials[$role][$username] === $password) {
                    $successAlert = true; // Set to true for successful login
                } else {
                    $showAlert = true; // Set to true to show the alert
                }
            }
        ?>

        <!-- Alert for invalid login -->
        <?php if ($showAlert): ?>
            <div class="alert alert-danger text-center position-relative" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 1.5rem;">
                    <span aria-hidden="true">&times;</span>
                </button>
                Invalid username or password.
            </div>
        <?php endif; ?>

        <!-- Alert for successful login -->
        <?php if ($successAlert): ?>
            <div class="alert alert-success text-center position-relative" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 1.5rem;">
                    <span aria-hidden="true">&times;</span>
                </button>
                Welcome to the System: <?= htmlspecialchars($username); ?>
            </div>
        <?php endif; ?>

        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="img/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>

            <!-- The form is now below the alert -->
            <form class="form-signin" method="POST" action="">
                <span id="reauth-email" class="reauth-email"></span>
                <div class="form-group">
                    <select id="userRole" name="userRole" class="form-control" required>
                        <option value="admin" selected>Admin</option>
                        <option value="content-manager">Content Manager</option>
                        <option value="system-user">System User</option>
                    </select>
                    <i class="fas fa-chevron-down dropdown-icon"></i>
                </div>
                <input type="text" id="txtText" name="username" class="form-control" placeholder="User Name" required autofocus>
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
