<?php
    $starttime = microtime(true); 
    include("config.php");
    include("functions.php");
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); // Initialises DB connection
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $id = $_GET['id'];
    if(!$id) {
        header("Location: deaths.php?p=1"); // If no ID is provided, then we return to the list
    }
?>
<head>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
<link rel="stylesheet" href="files/style.css">
<title>NanoBus</title>
</head>
<body>
<div class="layer1"></div>
<div class="layer2"></div>
<div class="layer3"></div>
<nav class="navbar navbar-expand-md navbar-dark navbar-fixed-top ss13-ui-grey">
<div class="container">
<b><a class="navbar-brand" href="index.php">NanoBus</a></b>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navbar-nav mr-auto">
<li class="nav-item">
<a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a>
</li>
<li class="nav-item">
<a class="nav-link" href="staff.php"><i class="fas fa-hammer"></i> Staff</a>
</li>
<li class="nav-item">
<a class="nav-link" href="deaths.php"><i class="fas fa-skull-crossbones"></i> Deaths</a>
</li>
<li class="nav-item">
<a class="nav-link" href="books.php"><i class="fas fa-book"></i> Library</a>
</li>
<li class="nav-item">
<a class="nav-link" href="patrons.php"><i class="fas fa-users"></i> Patrons</a>
</li>
<li class="nav-item">
<a class="nav-link" href="rounds.php"><i class="fas fa-arrow-circle-right"></i> Rounds</a>
</li>
</ul>
</div>
</div>
</nav>
<br><br>
<div class="container">
<div class="jumbotron ss13-ui-grey">
<?php
    $stmt = $conn->prepare("SELECT * FROM death WHERE id=?");
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll(); 
    if(!$result) {
        echo "<h1 class=\"text-light\">Death With ID " . $id . " Not Found.</h1>";
        echo "<p class=\"text-light\">Please double check your entry and try again.</p>";
    } else {
        foreach($result as $row) {
            $row['pod'] = substr($row['pod'], 2); // Removes the wierd lettering at the start of the area
            echo "<h1 class=\"text-light\">Death ID: " . $row['id'] . "</h1>";
            echo "<p class=\"text-light\"><i>" . $row['name'] . " died at " . $row['tod'] . " in the " . $row['pod'] . "</i>";
            echo " <span class=\"badge badge-danger\">Brute: " . $row['bruteloss'] . "</span> ";
            echo " <span class=\"badge badge-warning\">Burn: " . $row['fireloss'] . "</span> ";
            echo " <span class=\"badge badge-primary\">Suffocation: " . $row['oxyloss'] . "</span> ";
            echo " <span class=\"badge badge-success\">Toxin: " . $row['brainloss'] . "</span></p>";
        }
    }
?>
<a href="deaths.php?p=1" class="btn btn-outline-light btn-lg ss13-blue"><i class="fas fa-arrow-circle-left"></i> Return</a>
</div>
</div>
<footer class="footer ss13-ui-grey">
<div class="container">
<br>
<?php 
    $endtime = microtime(true);
    $loadtime = $endtime - $starttime;
    $rounded = round($loadtime, 3);
    echo "<small><p class=\"text-light align-middle\">NanoBus © AffectedArc07 2018. All Rights Reserved. This page took ". $rounded . " seconds to load.</p></small>";
?>
</div>
</footer>
</body>
<?php
    $conn = null; // Closes DB connection
?>
