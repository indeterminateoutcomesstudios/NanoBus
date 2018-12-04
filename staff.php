<?php
    $starttime = microtime(true); 
    include("config.php");
    include("functions.php");
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); // Initialises DB connection
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
<li class="nav-item active">
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