<?php
    $starttime = microtime(true); 
    include("config.php");
    include("functions.php");
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); // Initialises DB connection
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    renderHead();
    renderNav("staff");
?>
<div class="jumbotron ss13-ui-grey">
<h5 class="text-light">Admins</h5>
<p class="text-light">These are the people who strike fear into the greytide</p>
<table class="table table-striped table-hover table-borderless table-dark table-small">
  <thead class="thead-dark ss13-ui-grey text-center">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Rank</th>
      <th class="small-text" scope="col">Buildmode</th>
      <th class="small-text" scope="col">Admin</th>
      <th class="small-text" scope="col">Ban</th>
      <th class="small-text" scope="col">Event</th>
      <th class="small-text" scope="col">Server</th>
      <th class="small-text" scope="col">Debug</th>
      <th class="small-text" scope="col">Edit Permissions</th>
      <th class="small-text" scope="col">Possess</th>
      <th class="small-text" scope="col">Stealth</th>
      <th class="small-text" scope="col">Rejuvenate</th>
      <th class="small-text" scope="col">Varedit</th>
      <th class="small-text" scope="col">Sound</th>
      <th class="small-text" scope="col">Spawn</th>
      <th class="small-text" scope="col">Mod</th>
      <th class="small-text" scope="col">Mentor</th>
      <th class="small-text" scope="col">Proc-Call</th>
    </tr>
  </thead>
  <tbody>
<?php
    $stmt = $conn->prepare("SELECT * FROM admin WHERE rank!='mentor' ORDER BY ckey ASC"); 
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll(); 
    foreach($result as $row) {
        echo "<tr>";
        echo "<th scope=\"row\">" . $row['ckey'] . "</th>";
        echo "<td>" . rankToIcon($row['rank']) . " " . $row['rank'] . "</td>";
        $permissions = bitflagsToPermissions($row['flags']);
        echo $permissions['0'];
        echo $permissions['1'];
        echo $permissions['2'];
        echo $permissions['3'];
        echo $permissions['4'];
        echo $permissions['5'];
        echo $permissions['6'];
        echo $permissions['7'];
        echo $permissions['8'];
        echo $permissions['9'];
        echo $permissions['10'];
        echo $permissions['11'];
        echo $permissions['12'];
        echo $permissions['13'];
        echo $permissions['14'];
        echo $permissions['15'];
        echo "</tr>";
    }
?>
</tbody>
</table>
<h5 class="text-light">Mentors</h5>
<p class="text-light">These are the people that answer your questions</p>
<?php
    $stmt = $conn->prepare("SELECT * FROM admin WHERE rank='mentor' ORDER BY ckey ASC"); 
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll(); 
    $total = count($result);
    $count = 0;
    echo "<p class=\"text-light\">";
    foreach($result as $row) {
        $count = $count + 1;
        echo $row['ckey'];
        if($count < $total) {
            echo ", ";
        } else {
            echo ".";
        }
    }
    echo "</p>";
?>
</div>
</body>
<?php
    renderFooter($starttime);
    $conn = null; // Closes DB connection
?>