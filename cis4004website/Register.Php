<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $forename = $_POST['forename'] ?? '';
    $surname  = $_POST['surname'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $age      = $_POST['age'] ?? '';
    $gender   = $_POST['gender'] ?? '';
    $email    = $_POST['email'] ?? '';

    try {
        // Connect to database
        $pdo = new PDO("mysql:host=localhost;dbname=registration", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Hash password (VERY IMPORTANT)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert into database
        $stmt = $pdo->prepare("INSERT INTO users 
            (forename, surname, username, password, age, gender, email)
            VALUES (?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute([
            $forename,
            $surname,
            $username,
            $hashedPassword,
            $age,
            $gender,
            $email
        ]);

        echo "<h3>User registered successfully!</h3>";

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration</title>
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
                <h1>Registration</h1>
            </div>
        </div>
    </header>

    <section class="row">
        <div class="col-sm-8">

            <?php if (!empty($success)): ?>
                <p class="success"><?php echo $success; ?></p>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>

            <div class="form-box">

                <form method="POST">

                    <label>Forename</label>
                    <input type="text" name="forename">

                    <label>Surname</label>
                    <input type="text" name="surname">

                    <label>Username</label>
                    <input type="text" name="username">

                    <label>Password</label>
                    <input type="password" name="password">

                    <label>Age</label>
                    <input type="text" name="age">

                    <label>Gender</label>
                    <select name="gender">
                        <option value="female">Female</option>
                        <option value="male">Male</option>
                    </select>

                    <label>Email</label>
                    <input type="text" name="email">

                    <button type="submit">Signup</button>
                </form>
                    <button type="button" onclick="window.location.href='index.php'">
                        Back to Homepage
                    </button>
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

.form-box input,
.form-box select {
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
}

.form-box button:hover {
    background: #111;
}

.success {
    color: green;
}

.error {
    color: red;
}

</style>

