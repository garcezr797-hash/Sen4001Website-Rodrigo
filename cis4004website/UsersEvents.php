<?php
session_start();

 if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
 }

 try {
    $pdo = new PDO("mysql:host=localhost;dbname=registration", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get current user's ID
    $stmt = $pdo->prepare("SELECT user_id FROM users WHERE username = ?");
    $stmt->execute([$_SESSION['username']]);
    $user = $stmt->fetch();

    $user_id = $user['user_id'];

    // Get this user's events
    $stmt = $pdo->prepare("SELECT * FROM event_details WHERE user_id = ? ORDER BY start_date DESC");
    $stmt->execute([$user_id]);
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

 } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Events</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/index.css">
</head>

<body>

<main class="container">

    <!-- Navigation -->
    <ul class="nav-bar"> 
        <li><a href="index.php">Home</a></li>
        <li><a href="AddEvents.php">Add Event</a></li>
    </ul>

    <!-- Header -->
    <header class="row">
        <div class="col-sm-12">
            <div class="header-box">
                <h1>My Events</h1>
            </div>
        </div>
    </header>

    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
 
    <section class="row">
        <div class="col-sm-8">

            <article>

                <?php if (count($events) > 0): ?>

                    <?php foreach ($events as $event): ?>
                        <div class="event-box">

                            <h3><?php echo htmlspecialchars($event['event_name']); ?></h3>

                            <p><?php echo htmlspecialchars($event['event_description']); ?></p>

                            <p><strong>Category:</strong>
                                <?php echo htmlspecialchars($event['event_category']); ?>
                            </p>

                            <p><strong>Dates:</strong>
                                <?php echo $event['start_date']; ?> → <?php echo $event['end_date']; ?>
                            </p>

                            <p>
                                <a href="EditEvent.php?id=<?php echo $event['event_id']; ?>">Edit</a> |
                                <a href="deleteEvent.php?id=<?php echo $event['event_id']; ?>" 
                                   onclick="return confirm('Delete this event?');">
                                   Delete
                                </a>
                            </p>

                        </div>
                    <?php endforeach; ?>

                <?php else: ?>
                    <p>You haven't created any events yet.</p>
                <?php endif; ?>

            </article>

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

.event-box {
    border: 1px solid #ccc;
    padding: 15px;
    margin-bottom: 15px;
    background: #f9f9f9;
}

.event-box a {
    margin-right: 10px;
    color: blue;
    text-decoration: none;
}

.event-box a:hover {
    text-decoration: underline;
}

</style>

</body>
</html>