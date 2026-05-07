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

// Fetch event
$stmt = $pdo->prepare("SELECT * FROM event_details WHERE event_id = ? AND user_id = ?");
$stmt->execute([$event_id, $user_id]);
$event = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$event) {
    echo "Event not found or access denied.";
    exit();
}

// Update event
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $stmt = $pdo->prepare("UPDATE event_details SET 
        event_name = ?, 
        event_description = ?, 
        event_category = ?, 
        keywords = ?, 
        video_url = ?, 
        image_url = ?, 
        start_date = ?, 
        end_date = ?
        WHERE event_id = ? AND user_id = ?");

    $stmt->execute([
        $_POST['event_name'],
        $_POST['event_description'],
        $_POST['event_category'],
        $_POST['keywords'],
        $_POST['video_url'],
        $_POST['image_url'],
        $_POST['start_date'],
        $_POST['end_date'],
        $event_id,
        $user_id
    ]);

    header("Location: UsersEvents.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Event</title>
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
                <h1>Edit Event</h1>
            </div>
        </div>
    </header>

    <section class="row">
        <div class="col-sm-8">

            <div class="form-box">

                <form method="POST">

                    <label>Event Name</label>
                    <input type="text" name="event_name" 
                        value="<?php echo htmlspecialchars($event['event_name']); ?>">

                    <label>Description</label>
                    <textarea name="event_description"><?php echo htmlspecialchars($event['event_description']); ?></textarea>

                    <label>Category</label>
                    <input type="text" name="event_category"
                        value="<?php echo htmlspecialchars($event['event_category']); ?>">

                    <label>Keywords</label>
                    <input type="text" name="keywords"
                        value="<?php echo htmlspecialchars($event['keywords']); ?>">

                    <label>Video URL</label>
                    <input type="text" name="video_url"
                        value="<?php echo htmlspecialchars($event['video_url']); ?>">

                    <label>Image URL</label>
                    <input type="text" name="image_url"
                        value="<?php echo htmlspecialchars($event['image_url']); ?>">

                    <label>Start Date</label>
                    <input type="date" name="start_date"
                        value="<?php echo $event['start_date']; ?>">

                    <label>End Date</label>
                    <input type="date" name="end_date"
                        value="<?php echo $event['end_date']; ?>">

                    <button type="submit">Update Event</button>

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

/* NAV BAR */
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

/* HEADER */
.header-box {
    border: 1px dashed #ccc;
    padding: 10px;
    text-align: center;
}

/* FORM */
.form-box {
    border: 1px solid #ccc;
    padding: 15px;
    background: #f9f9f9;
}

.form-box input,
.form-box textarea {
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
}

.form-box button:hover {
    background: #111;
}

</style>

</body>
</html>