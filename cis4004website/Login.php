<?php
session_start();
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['Name'] ?? '';
    $password = $_POST['passWord'] ?? '';

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=registration", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Get user from database
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check password
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['user_id'];
            
            header("Location: index.php");
            exit();
        } else {
            $message = "Invalid login details";
        }

    } catch (PDOException $e) {
        $message = "Database error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/index.css">
</head>

<body>

<main class="container">
    <!-- Header -->
    <header class="row">
        <div class="col-sm-12">
            <div class="header-box">
                <h1>Login</h1>
            </div>
        </div>
    </header>

    <section class="row">
        <div class="col-sm-8">

            <?php if (!empty($message)): ?>
                <p class="error"><?php echo $message; ?></p>
            <?php endif; ?>

            <div class="form-box">

                <form method="POST">

                    <label>Username</label>
                    <input type="text" name="Name" required>

                    <label>Password</label>
                    <input type="password" name="passWord" required>

                    <button type="submit">Login</button>

                </form>

                <div class="btn-group">
                    <button onclick="window.location.href='Register.php'">
                        Sign Up
                    </button>

                    <button onclick="window.location.href='index.php'">
                        Back to Home
                    </button>
                </div>

            </div>

        </div>
    </section>

    <hr>

    <!-- Footer -->
    <footer class="row">
        <div class="col-sm-6">
            <p>Copyright &copy; little Wojtek</p>
        </div>
        <div class="col-sm-6 text-right">
            <p>Contact us: Wojtek@cardiffmet.ac.uk</p>
        </div>
    </footer>

</main>

<!-- Styles -->
<style>

.nav-bar {
    list-style: none;
    margin: 0;
    padding: 0;
    background-color: #363535;
    overflow: hidden;
}

.nav-bar li {
    float: left;
}

.nav-bar li a {
    display: block;
    color: white;
    padding: 14px 16px;
    text-decoration: none;
}

.nav-bar li a:hover {
    background-color: #111;
}

.header-box {
    border: 1px dashed #ccc;
    padding: 10px;
    text-align: center;
}

.form-box {
    border: 1px solid #ccc;
    padding: 15px;
    background: #f9f9f9;
}

.form-box input {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
}

.form-box button {
    background: #363535;
    color: white;
    padding: 10px;
    border: none;
    cursor: pointer;
    width: 100%;
    margin-bottom: 10px;
}

.form-box button:hover {
    background: #111;
}

.btn-group button {
    width: 48%;
    margin-right: 2%;
}

.error {
    color: red;
}

</style>

</body>
</html>