<?php
    $starttime = microtime(true); 
    include("config.php");
    include("functions.php");
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); // Initialises DB connection
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $page = $_GET['p'];
    if(!$page) {
        header("Location: deaths.php?p=1"); // Makes sure we have a page selected
    }
    renderHead();
    renderNav("deaths");
?>
<div class="jumbotron ss13-ui-grey">
<h5 class="text-light">Deaths</h5>
<p class="text-light">This is a list of all the people who have died</p>
<ul class="pagination">
<?php
    if($page > 1) {
        echo "<li class=\"page-item\"><a class=\"page-link\" href=\"./deaths.php?p=" . ($page - 1) . "\">Previous</a>";
        echo "<li class=\"page-item\"><a class=\"page-link\" href=\"./deaths.php?p=" . ($page - 1) . "\">" . ($page - 1) . "</a></li>";
    } else {
        echo "<li class=\"page-item\"><a class=\"page-link item-disabled\">Previous</a></li>";
    }
    echo "<li class=\"page-item active\"><a class=\"page-link\">" . $page . "</a></li>";
    echo "<li class=\"page-item\"><a class=\"page-link\" href=\"./deaths.php?p=" . ($page + 1) . "\">" . ($page + 1) . "</a></li>";
    echo "<li class=\"page-item\"><a class=\"page-link\" href=\"./deaths.php?p=" . ($page + 2) . "\">" . ($page + 2) . "</a></li>";
    echo "<li class=\"page-item\"><a class=\"page-link\" href=\"./deaths.php?p=" . ($page + 1) . "\">Next</a></li>";
?>
</ul>
<table class="table table-dark table-striped table-hover table-borderless table-large">
  <thead class="thead-dark ss13-ui-grey text-center">
    <tr>
      <th scope="col">Death ID</th>
      <th scope="col">Round ID</th>
      <th scope="col">Name</th>
      <th scope="col">Location Of Death</th>
      <th scope="col">Job</th>
      <th scope="col">Species</th>
      <th scope="col"><span class="badge badge-danger">Brute</span></th>
      <th scope="col"><span class="badge badge-warning">Burn</span></th>
      <th scope="col"><span class="badge badge-primary">Suffocation</span></th>
      <th scope="col"><span class="badge badge-success">Toxin</span></th>
    </tr>
  </thead>
  <tbody>
<?php
    $items_per_page = 50;
    $offset = ($items_per_page * $page) - $items_per_page;
    // Checks for most recent round ID to ensure current round deaths arent displayed
    $stmt = $conn->prepare("SELECT id FROM round ORDER BY id DESC LIMIT 1");
    $stmt->bindParam(1, $offset, PDO::PARAM_INT);
    $stmt->bindParam(2, $items_per_page, PDO::PARAM_INT);
    $stmt->execute();
    $id_result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $id_result = $stmt->fetchAll(); 
    foreach($id_result as $row) {
        $id = $row['id'];
    }
    // ACTUAL PULL
    $stmt = $conn->prepare("SELECT * FROM death WHERE roundid <= ? ORDER BY id DESC LIMIT ?, ?");
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    $stmt->bindParam(2, $offset, PDO::PARAM_INT);
    $stmt->bindParam(3, $items_per_page, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll(); 
    foreach($result as $row) {
        if($row['pod'][1] =! "�") {
            $row['pod'] = substr($row['pod'], 2); // Removes the wierd lettering at the start of the area
        }
        if(!$row['species']) { // If no species is set
            $row['species'] = "Undefined"; // Set it to undefined
        }
        echo "<th scope=\"row\"><a href=\"./death.php?id=" . $row['id'] . "\"><i class=\"fas fa-skull-crossbones\"></i> " . $row['id'] . "</a></th>";
        echo "<th scope=\"row\"><a href=\"./round.php?id=" . $row['roundid'] . "\"><i class=\"fas fa-arrow-circle-right\"></i> " . $row['roundid'] . "</a></th>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['pod'] . "</td>";
        echo "<td>" . $row['job'] . "</td>";
        echo "<td>" . $row['species'] . "</td>";
        echo "<td class=\"text-center\"><span class=\"badge badge-danger\">" . $row['bruteloss'] . "</span></td>";
        echo "<td class=\"text-center\"><span class=\"badge badge-warning\">" . $row['fireloss'] . "</span></td>";
        echo "<td class=\"text-center\"><span class=\"badge badge-primary\">" . $row['oxyloss'] . "</span></td>";
        echo "<td class=\"text-center\"><span class=\"badge badge-success\">" . $row['brainloss'] . "</span></td>";
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