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
    <title>HomePage</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/index.css">
</head>

<body>

<main class="container">

    <!-- Navigation -->
    <ul class="nav-bar"> 
        <li><a href="Register.php">Sign Up</a></li>
        <li><a href="Login.php">login</a></li>
        <li><a href="UsersEvents.php">Manage your Events</a></li>
        <li><a href="info.php">About us</a></li>
    </ul>

    <!-- Header -->
    <header class="row">
        <div class="col-sm-12">                                            
            <div class="header-box">
                <h1>Welcome to Eventify</h1>                               
            </div>
        </div>
    </header>

    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>

    <section class="row">
        <div class="col-sm-8">
            <article id="site_description">
                <p>This is the Eventify page.</p>
            </article>

            <article>
                <h3>Events</h3>

                <?php if (count($events) > 0): ?>
                <?php foreach ($events as $event): ?>
            <div class="event-box">
             <h3><?php echo htmlspecialchars($event['event_name']); ?></h3>

             <p><?php echo htmlspecialchars($event['event_description']); ?></p>

             <p><strong>Category:</strong> <?php echo htmlspecialchars($event['event_category']); ?></p>

             <p><strong>Dates:</strong> 
                <?php echo $event['start_date']; ?> → <?php echo $event['end_date']; ?>
             </p>

            <hr>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
           <p>No events yet.</p>
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
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #363535;
}

.nav-bar li {
    float: left;
}

.nav-bar li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

.nav-bar li a:hover {
    background-color: #111111;
}

.header-box {
    margin: auto;
    width: 100%;
    border: 1px dashed #ccc;
    padding: 10px;
    text-align: center;
}

.event-box {
    border: 1px solid #ccc;
    padding: 10px;
    margin-bottom: 15px;
    background-color: #f9f9f9;
}
</style>

</body>    
</html>