<?php
session_start(); // Needed if you're using login sessions

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ideally this comes from login session
    $user_id = $_SESSION['user_id'] ?? 1; // TEMP fallback (replace later)

    $event_name        = $_POST['event_name'] ?? '';
    $event_description = $_POST['event_description'] ?? '';
    $event_category    = $_POST['event_category'] ?? '';
    $keywords          = $_POST['keywords'] ?? '';
    $video_url         = $_POST['video_url'] ?? '';
    $image_url         = $_POST['image_url'] ?? '';
    $start_date        = $_POST['start_date'] ?? '';
    $end_date          = $_POST['end_date'] ?? '';

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=registration", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO event_details 
            (user_id, event_name, event_description, event_category, keywords, video_url, image_url, start_date, end_date)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->execute([
            $user_id,
            $event_name,
            $event_description,
            $event_category,
            $keywords,
            $video_url,
            $image_url,
            $start_date,
            $end_date
        ]);

        echo "<h3>Event created successfully!</h3>";

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Event</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>

<main class="container">

    <!-- Navigation -->
    <ul class="nav-bar"> 
        <li><a href="index.php">Home</a></li>
        <li><a href="UsersEvents.php">Manage Events</a></li>
    </ul>

    <!-- Header -->
    <header class="row">
        <div class="col-sm-12">                                            
            <div class="header-box">
                <h1>Create Event</h1>                               
            </div>
        </div>
    </header>

    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>

    <!-- Form Section -->
    <section class="row">
        <div class="col-sm-8">

            <div class="form-box">
                <form method="POST">

                    <label>Event Name</label>
                    <input type="text" name="event_name" required>

                    <label>Description</label>
                    <textarea name="event_description" required></textarea>

                    <label>Category</label>
                    <input type="text" name="event_category">

                    <label>Keywords</label>
                    <input type="text" name="keywords">

                    <label>Video URL</label>
                    <input type="text" name="video_url">

                    <label>Image URL</label>
                    <input type="text" name="image_url">

                    <label>Start Date</label>
                    <input type="date" name="start_date">

                    <label>End Date</label>
                    <input type="date" name="end_date">

                    <button type="submit">Create Event</button>

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


.form-box {
    border: 1px solid #ccc;
    padding: 15px;
    background-color: #f9f9f9;
}

.form-box input,
.form-box textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
}

.form-box button {
    background-color: #363535;
    color: white;
    padding: 10px;
    border: none;
    cursor: pointer;
}

.form-box button:hover {
    background-color: #111;
}

.success {
    color: green;
}

.error {
    color: red;
}

</style>

</body>
</html>