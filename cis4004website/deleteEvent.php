<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$pdo = new PDO("mysql:host=localhost;dbname=registration", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$user_id = $_SESSION['user_id'];
$event_id = $_GET['id'] ?? null;

if (!$event_id) {
    header("Location: manage_events.php");
    exit();
}

// Get event (so we can show what is being deleted)
$stmt = $pdo->prepare("SELECT * FROM event_details WHERE event_id = ? AND user_id = ?");
$stmt->execute([$event_id, $user_id]);
$event = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$event) {
    echo "Event not found or you do not have permission.";
    exit();
}

// If confirmed delete
if (isset($_POST['confirm_delete'])) {

    $stmt = $pdo->prepare("DELETE FROM event_details WHERE event_id = ? AND user_id = ?");
    $stmt->execute([$event_id, $user_id]);

    header("Location: manage_events.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Delete Event</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/index.css">
</head>

<body>

<main class="container">

    <!-- Navigation -->
    <ul class="nav-bar"> 
        <li><a href="index.php">Home</a></li>
        <li><a href="UsersEvents.php">My Events</a></li>
    </ul>

    <!-- Header -->
    <header class="row">
        <div class="col-sm-12">
            <div class="header-box">
                <h1>Delete Event</h1>
            </div>
        </div>
    </header>

    <section class="row">
        <div class="col-sm-8">

            <div class="form-box">

                <h3>Are you sure you want to delete this event?</h3>

                <p><strong><?php echo htmlspecialchars($event['event_name']); ?></strong></p>
                <p><?php echo htmlspecialchars($event['event_description']); ?></p>

                <form method="POST">

                    <button type="submit" name="confirm_delete" class="delete-btn">
                        Yes, Delete
                    </button>

                    <button type="button" onclick="window.location.href='UsersEvents.php'">
                        Cancel
                    </button>

                </form>

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

.delete-btn {
    background: red;
    color: white;
    padding: 10px;
    border: none;
    cursor: pointer;
}

.delete-btn:hover {
    background: darkred;
}

button {
    padding: 10px;
    margin-top: 10px;
}

</style>

</body>
</html>