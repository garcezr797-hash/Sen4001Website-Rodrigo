<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>      
    <title>About us</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/index.css">
</head>

<body>

<main class="container">

    <!-- Navigation -->
    <ul class="nav-bar"> 
        <li><a href="index.php">back to Homepage</a></li>
    </ul>

    <!-- Header -->
    <header class="row">
        <div class="col-sm-12">                                            
            <div class="header-box">
                <h1>About Website and Eventify</h1>                               
            </div>
        </div>
    </header>

    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>

    <!-- Main Section -->
    <section class="row">

        <div class="col-sm-8">
            <article id="site_description">
                <p>This is Eventify and in this website you can add your own events</p>
                <p>In this website you can add events and edit your events or delete them</p>
                <p>You will be shown your events and their details in a seperate page and you edit them if you want to change something</p>
            </article>
            
            <article>
                <h3>About the creator</h3>
                <p>My name is Rodrigo and l am the creator of this webiste</p>
                <p>I created this website with the goal to allow people to be able to plan there plans better</p>
                <p>I worked diligently to ensure that this website will be able to useful to everyone that will use it  </p>
            </article>
        </div>

    
    </section>
 
   <img src="Group.jpg" alt="A cute dog" style="width:40%; height:auto;">

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
</style>

</body>    
</html>