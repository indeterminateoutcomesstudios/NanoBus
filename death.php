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
    renderHead();
    renderNav("none");
?>
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
<?php
    renderFooter($starttime);
    $conn = null; // Closes DB connection
?>
