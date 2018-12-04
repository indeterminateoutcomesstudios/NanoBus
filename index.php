<?php
    $starttime = microtime(true); 
    include("config.php");
    include("functions.php");
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); // Initialises DB connection
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    renderHead();
    renderNav("home");
?>
<div class="container">
<div class="jumbotron ss13-ui-grey">
<h1 class="text-center text-light">Paradise Statistics Board</h1><br>
<div class="row">
<div class="col-sm">
<div class="card">
<div class="card-body">
<h5 class="card-title">Deaths</h5>
<?php
    $stmt = $conn->prepare("SELECT id FROM death"); 
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll(); 
    echo "<p class=\"card-text\">" . count($result) . " people have died.</p>";
    ?>
<a href="deaths.php?p=1" class="btn btn-outline-light btn-lg ss13-blue"><i class="fas fa-skull-crossbones"></i> View Deaths</a>
</div>
</div>
</div>
<div class="col-sm">
<div class="card">
<div class="card-body">
<h5 class="card-title">Library</h5>
<?php
    $stmt = $conn->prepare("SELECT id FROM library"); 
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll(); 
    echo "<p class=\"card-text\">" . count($result) . " books have been written.</p>";
    ?>
<a href="books.php?p=1" class="btn btn-outline-light btn-lg ss13-blue"><i class="fas fa-book"></i> View Books</a>
</div>
</div>
</div>
<div class="col-sm">
<div class="card">
<div class="card-body">
<h5 class="card-title">Rounds</h5>
<?php
    $stmt = $conn->prepare("SELECT id FROM round"); 
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll(); 
    echo "<p class=\"card-text\">" . count($result) . " rounds have been played.</p>";
?>
<a href="rounds.php?p=1" class="btn btn-outline-light btn-lg ss13-blue"><i class="fas fa-arrow-circle-right"></i> View Rounds</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
    renderFooter($starttime);
    $conn = null; // Closes DB connection
?>