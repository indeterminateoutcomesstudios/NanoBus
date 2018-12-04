<?php
    $starttime = microtime(true); 
    include("config.php");
    include("functions.php");
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); // Initialises DB connection
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $page = $_GET['p'];
    if(!$page) {
        header("Location: books.php?p=1"); // Makes sure we have a page selected
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
<li class="nav-item active">
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
<h5 class="text-light">Books</h5>
<p class="text-light">This is a list of all books that have been written on the server</p>
<ul class="pagination">
<?php
    if($page > 1) {
        echo "<li class=\"page-item\"><a class=\"page-link\" href=\"./books.php?p=" . ($page - 1) . "\">Previous</a>";
        echo "<li class=\"page-item\"><a class=\"page-link\" href=\"./books.php?p=" . ($page - 1) . "\">" . ($page - 1) . "</a></li>";
    } else {
        echo "<li class=\"page-item\"><a class=\"page-link item-disabled\">Previous</a></li>";
    }
    echo "<li class=\"page-item active\"><a class=\"page-link\">" . $page . "</a></li>";
    echo "<li class=\"page-item\"><a class=\"page-link\" href=\"./books.php?p=" . ($page + 1) . "\">" . ($page + 1) . "</a></li>";
    echo "<li class=\"page-item\"><a class=\"page-link\" href=\"./books.php?p=" . ($page + 2) . "\">" . ($page + 2) . "</a></li>";
    echo "<li class=\"page-item\"><a class=\"page-link\" href=\"./books.php?p=" . ($page + 1) . "\">Next</a></li>";
?>
</ul>
<table class="table table-striped table-hover table-borderless table-large">
  <thead class="thead-dark ss13-ui-grey text-center">
    <tr>
      <th scope="col">NTBN</th>
      <th scope="col">Title</th>
      <th scope="col">Author</th>
      <th scope="col">Category</th>
      <th scope="col">Read</th>
    </tr>
  </thead>
  <tbody>
<?php
    $items_per_page = 50;
    $offset = ($items_per_page * $page) - $items_per_page;
    $stmt = $conn->prepare("SELECT * FROM library WHERE flagged=0 ORDER BY id DESC LIMIT ?, ?");
    $stmt->bindParam(1, $offset, PDO::PARAM_INT);
    $stmt->bindParam(2, $items_per_page, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll(); 
    foreach($result as $row) {
        echo categoryToTR($row['category']);
        echo "<th scope=\"row\">" . $row['id'] . "</td>";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>" . $row['author'] . "</td>";
        echo "<td>" . categoryToIcon($row['category']) . $row['category'] . "</td>";
        echo "<td><a href=\"./book.php?id=" . $row['id'] . "\">Read Book</td>";
        echo "</tr>";
    }
?>
</tbody>
</table>
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