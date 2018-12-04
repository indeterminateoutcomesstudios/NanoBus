<?php
    $starttime = microtime(true); 
    include("config.php");
    include("functions.php");
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); // Initialises DB connection
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    renderHead();
    renderNav("patrons");
?>
<div class="container">
<div class="jumbotron ss13-ui-grey">
<h5 class="text-light">Patrons</h5>
<p class="text-light">These are the people that have donated to the server</p>
<table class="table table-striped table-hover table-borderless table-dark table-large">
  <thead class="thead-dark ss13-ui-grey text-center">
    <tr>
      <th scope="col">Patreon Name</th>
      <th scope="col">BYOND Key</th>
      <th scope="col">Tier</th>
    </tr>
  </thead>
  <tbody>
<?php
    $stmt = $conn->prepare("SELECT * FROM donators WHERE active=1 ORDER BY ckey ASC"); 
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll(); 
    foreach($result as $row) {
        echo "<tr>";
        echo "<td>" . $row['patreon_name'] . "</td>";
        echo "<td>" . $row['ckey'] . "</td>";
        echo "<td>" . tierToText($row['tier']) . "</td>";
        echo "</tr>";
    }
?>
</tbody>
</table>
</div>
</div>
<?php
    renderFooter($starttime);
    $conn = null; // Closes DB connection
?>