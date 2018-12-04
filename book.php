<?php
    $starttime = microtime(true); 
    include("config.php");
    include("functions.php");
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); // Initialises DB connection
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $id = $_GET['id'];
    if(!$id) {
        header("Location: books.php?p=1"); // If no ID is provided, then we return to the list
    }
    renderHead();
    renderNav("none");
?>
<div class="container">
<div class="jumbotron ss13-ui-grey">
<?php
    $stmt = $conn->prepare("SELECT * FROM library WHERE id=?");
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll(); 
    if(!$result) {
        echo "<h1 class=\"text-light\">Book With ID " . $id . " Not Found.</h1>";
        echo "<p class=\"text-light\">Please double check your entry and try again.</p>";
    } else {
        foreach($result as $row) {
            echo "<div class=\"row\">";
            echo "<div class=\"col-sm\">";
            echo "<h1 class=\"text-light\">" . $row['title'] . "</h1>";
            echo "<p class=\"text-light\"><i>Written by " . $row['author'] . " | Category: " . $row['category'] . "</i></p>";
            echo "</div>";
            echo "<div class=\"col-sm\">";
            echo "<div class=\"jumbotron\">" . $row['content'] . "</div>";
            echo "</div>";
            echo "</div>";
        }
    }
?>
<a href="books.php?p=1" class="btn btn-outline-light btn-lg ss13-blue"><i class="fas fa-arrow-circle-left"></i> Return</a>
</div>
</div>
<?php
    renderFooter($starttime);
    $conn = null; // Closes DB connection
?>