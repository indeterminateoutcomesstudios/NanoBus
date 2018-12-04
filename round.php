<?php
    $starttime = microtime(true); 
    include("config.php");
    include("functions.php");
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); // Initialises DB connection
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $id = $_GET['id'];
    if(!$id) {
        header("Location: rounds.php?p=1"); // If no ID is provided, then we return to the list
    }
    renderHead();
    renderNav("none");
?>
<div class="container">
<div class="jumbotron ss13-ui-grey">
<?php
    $stmt = $conn->prepare("SELECT * FROM round WHERE id=?");
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll(); 
    if(!$result) {
        echo "<h1 class=\"text-light\">Round with ID " . $id . " Not Found.</h1>";
        echo "<p class=\"text-light\">Please double check your entry and try again.</p>";
    } else {
        foreach($result as $row) {
            $data = endToData($row['game_mode_result']);
            echo "<div class=\"row\">";
            echo "<div class=\"col-sm\">";
            echo "<h1 class=\"text-light\">Round ID: " . $row['id'] . "</h1>";
            echo "<h2 class=\"text-light\">Gamemode: " . gamemodeToIcon($row['game_mode']) . "</h2>";
            echo "<h3 class=\"text-light\">End State: " . $data[2] . "</h3>";
            echo "<p class=\"text-light\">Information: " . $data[3] . "</p>";
            echo "</div>";
            echo "<div class=\"col-sm\">";
            echo "<h1 class=\"text-light\">Round Deaths</h1>";
            $map = $row['station_name'];
            if($map != "NSS Cyberiad") {
                echo "<div class=\"jumbotron\">";
                echo "<h1>Error</h1>";
                echo "<p>This round was not played on the Cyberiad. Deaths will not be displayed.</p>";
                echo "</div>";
            } else {
                $stmt = $conn->prepare("SELECT * FROM death WHERE roundid=?");
                $stmt->bindParam(1, $id, PDO::PARAM_INT);
                $stmt->execute();
                $deathresult = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $deathresult = $stmt->fetchAll(); 
                $stmt = $conn->prepare("SELECT id FROM death WHERE roundid=?");
                $stmt->bindParam(1, $id, PDO::PARAM_INT);
                $stmt->execute();
                $deathcount = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $deathcount = $stmt->fetchAll(); 
                echo "<p class=\"text-light\"><i>" . count($deathcount) . " people died in the round</i></p>";
                echo insertWebmapTop($map);
                foreach($deathresult as $deathrow) {
                    $xyz = explode(', ', $deathrow['coord']);
                    $name = $deathrow['name'];
                    $x = $xyz[0]; // Needed so I can use it inside the IF statement
                    $y = $xyz[1]; // Needed so I can use it inside the IF statement
                    $z = $xyz[2]; // Needed so I can use it inside the IF statement
                    if($z == 1) {
                        echo insertWebmapMarker($x, $y, $name);
                    }
                }
                echo insertWebmapBase();
            }
            echo "</div>";
            echo "</div>";
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