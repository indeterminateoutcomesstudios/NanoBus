<?php
    $starttime = microtime(true); 
    include("config.php");
    include("functions.php");
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); // Initialises DB connection
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $page = $_GET['p'];
    if(!$page) {
        header("Location: rounds.php?p=1"); // Makes sure we have a page selected
    }
    renderHead();
    renderNav("rounds");
?>
<div class="jumbotron ss13-ui-grey">
<h5 class="text-light">Rounds</h5>
<p class="text-light">This is a list of all the rounds that have been played</p>
<ul class="pagination">
<?php
    if($page > 1) {
        echo "<li class=\"page-item\"><a class=\"page-link\" href=\"./rounds.php?p=" . ($page - 1) . "\">Previous</a>";
        echo "<li class=\"page-item\"><a class=\"page-link\" href=\"./rounds.php?p=" . ($page - 1) . "\">" . ($page - 1) . "</a></li>";
    } else {
        echo "<li class=\"page-item\"><a class=\"page-link item-disabled\">Previous</a></li>";
    }
    echo "<li class=\"page-item active\"><a class=\"page-link\">" . $page . "</a></li>";
    echo "<li class=\"page-item\"><a class=\"page-link\" href=\"./rounds.php?p=" . ($page + 1) . "\">" . ($page + 1) . "</a></li>";
    echo "<li class=\"page-item\"><a class=\"page-link\" href=\"./rounds.php?p=" . ($page + 2) . "\">" . ($page + 2) . "</a></li>";
    echo "<li class=\"page-item\"><a class=\"page-link\" href=\"./rounds.php?p=" . ($page + 1) . "\">Next</a></li>";
?>
</ul>
<table class="table table-striped table-hover table-borderless table-large">
  <thead class="thead-dark ss13-ui-grey text-center">
    <tr>
      <th scope="col">Round ID</th>
      <th scope="col">Gamemode</th>
      <th scope="col">Result</th>
      <th scope="col">Started</th>
      <th scope="col">Ended</th>
      <th scope="col">Map</th>
    </tr>
  </thead>
  <tbody>
<?php
    $items_per_page = 50;
    $offset = ($items_per_page * $page) - $items_per_page;
    $stmt = $conn->prepare("SELECT * FROM round ORDER BY id DESC LIMIT ?, ?");
    $stmt->bindParam(1, $offset, PDO::PARAM_INT);
    $stmt->bindParam(2, $items_per_page, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll(); 
    foreach($result as $row) {
        $data = endToData($row['game_mode_result']);
        echo $data['1'];
        echo "<th scope=\"row\"><a href=\"./round.php?id=" . $row['id'] . "\"><i class=\"fas fa-arrow-circle-right\"></i> " . $row['id'] . "</a></th>";
        echo "<td>" . gamemodeToIcon($row['game_mode']) . "</td>";
        echo "<td>" . $data['0'] . $data['2'] . "</td>";
        echo "<td>" . $row['start_datetime'] . "</td>";
        echo "<td>" . $row['end_datetime'] . "</td>";
        echo "<td>" . $row['station_name'] . "</td>";
        echo "</tr>";
    }
?>
</tbody>
</table>
</div>
<?php
    renderFooter($starttime);
    $conn = null; // Closes DB connection
?>