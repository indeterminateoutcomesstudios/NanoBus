<?php
// This file is for various functions that would take up too much space in other pages
// Render page head contents
function renderHead() {
    echo "<head>";
    echo "<script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js\" integrity=\"sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy\" crossorigin=\"anonymous\"></script>";
    echo "<script src=\"https://code.jquery.com/jquery-3.3.1.slim.min.js\" integrity=\"sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo\" crossorigin=\"anonymous\"></script>";
    echo "<script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js\" integrity=\"sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49\" crossorigin=\"anonymous\"></script>";
    echo "<link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css\" integrity=\"sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO\" crossorigin=\"anonymous\">";
    echo "<link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.5.0/css/all.css\">";;
    echo "<link rel=\"stylesheet\" href=\"files/style.css\">";
    echo "<title>NanoBus</title>";
    echo "</head>";
    echo "<body>";
    echo "<div class=\"layer1\"></div>";
    echo "<div class=\"layer2\"></div>";
    echo "<div class=\"layer3\"></div>";
}
// Render navbar with selected tab 
function renderNav($page) {
    echo "<nav class=\"navbar navbar-expand-md navbar-dark navbar-fixed-top ss13-ui-grey\">";
    echo "<div class=\"container\">";
    echo "<b><a class=\"navbar-brand\" href=\"index.php\">NanoBus</a></b>";
    echo "<div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">";
    echo "<ul class=\"navbar-nav mr-auto\">";
    if($page == "home") {echo "<li class=\"nav-item active\">";} else {echo "<li class=\"nav-item\">";}
    echo "<a class=\"nav-link\" href=\"index.php\"><i class=\"fas fa-home\"></i> Home</a>";
    echo "</li>";
    if($page == "staff") {echo "<li class=\"nav-item active\">";} else {echo "<li class=\"nav-item\">";}
    echo "<a class=\"nav-link\" href=\"staff.php\"><i class=\"fas fa-hammer\"></i> Staff</a>";
    echo "</li>";
    if($page == "deaths") {echo "<li class=\"nav-item active\">";} else {echo "<li class=\"nav-item\">";}
    echo "<a class=\"nav-link\" href=\"deaths.php?p=1\"><i class=\"fas fa-skull-crossbones\"></i> Deaths</a>";
    echo "</li>";
    if($page == "books") {echo "<li class=\"nav-item active\">";} else {echo "<li class=\"nav-item\">";}
    echo "<a class=\"nav-link\" href=\"books.php?p=1\"><i class=\"fas fa-book\"></i> Books</a>";
    echo "</li>";
    if($page == "patrons") {echo "<li class=\"nav-item active\">";} else {echo "<li class=\"nav-item\">";}
    echo "<a class=\"nav-link\" href=\"patrons.php\"><i class=\"fas fa-users\"></i> Patrons</a>";
    echo "</li>";
    if($page == "rounds") {echo "<li class=\"nav-item active\">";} else {echo "<li class=\"nav-item\">";}
    echo "<a class=\"nav-link\" href=\"rounds.php?p=1\"><i class=\"fas fa-arrow-circle-right\"></i> Rounds</a>";
    echo "</li>";
    echo "</ul>";
    echo "</div>";
    echo "</div>";
    echo "</nav><br><br>";
}
// Render footer with time
function renderFooter($starttime) {
    echo "<footer class=\"footer ss13-ui-grey\">";
    echo "<div class=\"container\">";
    echo "<br>";
    $endtime = microtime(true);
    $loadtime = $endtime - $starttime;
    $rounded = round($loadtime, 3);
    echo "<small><p class=\"text-light align-middle\">NanoBus © AffectedArc07 2018. All Rights Reserved - <a href=\"https://github.com/AffectedArc07/NanoBus\">GitHub</a> - <a href=\"https://github.com/AffectedArc07/NanoBus/issues/new\">Report Issue</a> - This page took ". $rounded . " seconds to load.</p></small>";
    echo "</div>";
    echo "</footer>";
    echo "</body>";
}
// Convert bit flags to admin permissions (For admins page)
function bitflagsToPermissions($bitflag) {
    $permissions = array();
    if ($bitflag & 1) {array_push($permissions, "<td class=\"text-center bg-success\"><i class=\"fas fa-check-circle\"></i></td>");} else {array_push($permissions, "<td class=\"text-center bg-danger\"><i class=\"fas fa-times-circle\"></i></td>");}
    if ($bitflag & 2) {array_push($permissions, "<td class=\"text-center bg-success\"><i class=\"fas fa-check-circle\"></i></td>");} else {array_push($permissions, "<td class=\"text-center bg-danger\"><i class=\"fas fa-times-circle\"></i></td>");}
    if ($bitflag & 4) {array_push($permissions, "<td class=\"text-center bg-success\"><i class=\"fas fa-check-circle\"></i></td>");} else {array_push($permissions, "<td class=\"text-center bg-danger\"><i class=\"fas fa-times-circle\"></i></td>");}
    if ($bitflag & 8) {array_push($permissions, "<td class=\"text-center bg-success\"><i class=\"fas fa-check-circle\"></i></td>");} else {array_push($permissions, "<td class=\"text-center bg-danger\"><i class=\"fas fa-times-circle\"></i></td>");}
    if ($bitflag & 16) {array_push($permissions, "<td class=\"text-center bg-success\"><i class=\"fas fa-check-circle\"></i></td>");} else {array_push($permissions, "<td class=\"text-center bg-danger\"><i class=\"fas fa-times-circle\"></i></td>");}
    if ($bitflag & 32) {array_push($permissions, "<td class=\"text-center bg-success\"><i class=\"fas fa-check-circle\"></i></td>");} else {array_push($permissions, "<td class=\"text-center bg-danger\"><i class=\"fas fa-times-circle\"></i></td>");}
    if ($bitflag & 64) {array_push($permissions, "<td class=\"text-center bg-success\"><i class=\"fas fa-check-circle\"></i></td>");} else {array_push($permissions, "<td class=\"text-center bg-danger\"><i class=\"fas fa-times-circle\"></i></td>");}
    if ($bitflag & 128) {array_push($permissions, "<td class=\"text-center bg-success\"><i class=\"fas fa-check-circle\"></i></td>");} else {array_push($permissions, "<td class=\"text-center bg-danger\"><i class=\"fas fa-times-circle\"></i></td>");}
    if ($bitflag & 256) {array_push($permissions, "<td class=\"text-center bg-success\"><i class=\"fas fa-check-circle\"></i></td>");} else {array_push($permissions, "<td class=\"text-center bg-danger\"><i class=\"fas fa-times-circle\"></i></td>");}
    if ($bitflag & 512) {array_push($permissions, "<td class=\"text-center bg-success\"><i class=\"fas fa-check-circle\"></i></td>");} else {array_push($permissions, "<td class=\"text-center bg-danger\"><i class=\"fas fa-times-circle\"></i></td>");}
    if ($bitflag & 1024) {array_push($permissions, "<td class=\"text-center bg-success\"><i class=\"fas fa-check-circle\"></i></td>");} else {array_push($permissions, "<td class=\"text-center bg-danger\"><i class=\"fas fa-times-circle\"></i></td>");}
    if ($bitflag & 2048) {array_push($permissions, "<td class=\"text-center bg-success\"><i class=\"fas fa-check-circle\"></i></td>");} else {array_push($permissions, "<td class=\"text-center bg-danger\"><i class=\"fas fa-times-circle\"></i></td>");}
    if ($bitflag & 4096) {array_push($permissions, "<td class=\"text-center bg-success\"><i class=\"fas fa-check-circle\"></i></td>");} else {array_push($permissions, "<td class=\"text-center bg-danger\"><i class=\"fas fa-times-circle\"></i></td>");}
    if ($bitflag & 8192) {array_push($permissions, "<td class=\"text-center bg-success\"><i class=\"fas fa-check-circle\"></i></td>");} else {array_push($permissions, "<td class=\"text-center bg-danger\"><i class=\"fas fa-times-circle\"></i></td>");}
    if ($bitflag & 16384) {array_push($permissions, "<td class=\"text-center bg-success\"><i class=\"fas fa-check-circle\"></i></td>");} else {array_push($permissions, "<td class=\"text-center bg-danger\"><i class=\"fas fa-times-circle\"></i></td>");}
    if ($bitflag & 32768) {array_push($permissions, "<td class=\"text-center bg-success\"><i class=\"fas fa-check-circle\"></i></td>");} else {array_push($permissions, "<td class=\"text-center bg-danger\"><i class=\"fas fa-times-circle\"></i></td>");}
    return $permissions;
}
// Add icon to rankname (For admins page)
function rankToIcon($rankname) {
    if($rankname == "Coder") {$icon = "<i class=\"fas fa-code\"></i>";}
    if($rankname == "Community Manager") {$icon = "<i class=\"fas fa-users\"></i>";}
    if($rankname == "Game Admin") {$icon = "<i class=\"fas fa-gavel\"></i>";}
    if($rankname == "Head of Staff") {$icon = "<i class=\"fas fa-star\"></i>";}
    if($rankname == "Hosting Provider") {$icon = "<i class=\"fas fa-server\"></i>";}
    if($rankname == "Maintainers") {$icon = "<i class=\"fas fa-wrench\"></i>";}
    if($rankname == "Trial Admin") {$icon = "<i class=\"fas fa-hammer\"></i>";}
    return $icon;
}
// Converts tier number to readable text (For patrons page)
function tierToText($tier) {
    if($tier == "5") {$text = "Patron OOC Tag";}
    if($tier == "10") {$text = "Patron Loadout";}
    if($tier == "15") {$text = "Patron Fluff Item";}
    return $text;
}
// Converts library categorys to row colors (For book list page)
function categoryToTR($category) {
    if($category == "Adult") {$tr = "<tr class=\"table-danger\">";}
    if($category == "Fiction") {$tr = "<tr class=\"table-success\">";}
    if($category == "Non-Fiction") {$tr = "<tr class=\"table-primary\">";}
    if($category == "Reference") {$tr = "<tr class=\"table-info\">";}
    if($category == "Religion") {$tr = "<tr class=\"table-warning\">";}
    return $tr;
}
// Adds icon to library categorys (For book list page)
function categoryToIcon($category) {
    if($category == "Adult") {$icon = "<i class=\"fas fa-book-dead\"></i> ";}
    if($category == "Fiction") {$icon = "<i class=\"fas fa-book\"></i> ";}
    if($category == "Non-Fiction") {$icon = "<i class=\"fas fa-torah\"></i> ";}
    if($category == "Reference") {$icon = "<i class=\"fas fa-atlas\"></i> ";}
    if($category == "Religion") {$icon = "<i class=\"fas fa-bible\"></i> ";}
    return $icon;
}
// Converts stored end text to an array of information
function endToData($shorttext) {
    $end_data = array(); // FORMAT: icon, table style, short text, full text
    // MISC ENDINGS
    if($shorttext == "PROPER") {array_push($end_data, "<i class=\"fas fa-check\"></i> " , "<tr class=\"table-light\">", "Proper Completion", "The round ended normally.");}
    if($shorttext == "STATION-NUKED") {array_push($end_data, "<i class=\"fas fa-bomb\"></i> " , "<tr class=\"table-danger\">", "Station Nuked", "Station destroyed by nuclear device.");}
    if($shorttext == "HARD-REBOOT") {array_push($end_data, "<i class=\"fas fa-server\"></i> " , "<tr class=\"table-info\">", "Hard Restarted", "The server was hard restarted.");}
    // BLOB
    if($shorttext == "BLOB-STATION-NUKED") {array_push($end_data, "<i class=\"fas fa-bomb\"></i> " , "<tr class=\"table-danger\">", "Station Nuked", "Station destroyed by nuclear device to contain blob.");}
    if($shorttext == "BLOB-BLOB-WIN") {array_push($end_data, "<i class=\"fas fa-check\"></i> " , "<tr class=\"table-success\">", "Blob Won", "The blob took over the station.");}
    if($shorttext == "BLOB-BLOS-LOSS") {array_push($end_data, "<i class=\"fas fa-times\"></i> " , "<tr class=\"table-danger\">", "Blob Lost", "The blob was eradicated from the station.");}
    // CULT
    if($shorttext == "CULT-CULT-WIN") {array_push($end_data, "<i class=\"fas fa-check\"></i> " , "<tr class=\"table-success\">", "Cult Won", "The cult managed to serve its dark masters.");}
    if($shorttext == "CULT-STAFF-WIN") {array_push($end_data, "<i class=\"fas fa-times\"></i> " , "<tr class=\"table-danger\">", "Cult Lost", "The staff managed to stop the cult.");}
    // NUKEOPS
    if($shorttext == "NUKEOPS-STATION-NUKED") {array_push($end_data, "<i class=\"fas fa-check\"></i> " , "<tr class=\"table-success\">", "Syndicate Major Victory", "The nuclear strike team destroyed the station.");}
    if($shorttext == "NUKEOPS-STATION-NUKED-NUKIES-DEAD") {array_push($end_data, "<i class=\"fas fa-skull-crossbones\"></i> " , "<tr class=\"table-warning\">", "Total Anhilation", "The nuclear strike team destroyed the station, but got caught in the blast.");}
    if($shorttext == "NUKEOPS-WRONG-STATION") {array_push($end_data, "<i class=\"fas fa-times\"></i> " , "<tr class=\"table-warning\">", "Crew Minor Victory", "The nuclear strike team destroyed the wrong station.");}
    if($shorttext == "NUKEOPS-WRONG-STATION-NUKIES-DIED") {array_push($end_data, "<i class=\"fas fa-skull-crossbones\"></i> " , "<tr class=\"table-warning\">", "Darwin Award", "The nuclear strike team destroyed the wrong station and got caught in the blast.");}
    if($shorttext == "NUKEOPS-CREW-MAJOR-OPSDEAD") {array_push($end_data, "<i class=\"fas fa-times\"></i> " , "<tr class=\"table-danger\">", "Crew Major Victory", "The nuclear strike team died while trying to secure the disk.");}
    if($shorttext == "NUKEOPS-CREW-MAJOR") {array_push($end_data, "<i class=\"fas fa-times\"></i> " , "<tr class=\"table-danger\">", "Crew Major Victory", "The nuclear strike team survived, but were unable to secure the disk..");}
    if($shorttext == "NUKEOPS-NONUKE") {array_push($end_data, "<i class=\"fas fa-check\"></i> " , "<tr class=\"table-success\">", "Syndicate Minor Victory", "The nuclear strike team set the bomb, but the detonation was averted.");}
    if($shorttext == "NUKEOPS-FUCK") {array_push($end_data, "<i class=\"fas fa-question-circle\"></i> " , "<tr class=\"table-warning\">", "Server Broke", "The server had an issue and the round force ended.");}
    // REV
    if($shorttext == "REV-COMMAND-DIED") {array_push($end_data, "<i class=\"fas fa-check\"></i> " , "<tr class=\"table-success\">", "Revs Won", "The command staff could not hold up to the revolution.");}
    if($shorttext == "REV-REVS-DIED") {array_push($end_data, "<i class=\"fas fa-times\"></i> " , "<tr class=\"table-danger\">", "Command Won", "The staff managed to stop the revolution.");}
    // SHADOWLING
    if($shorttext == "SLING-SLING-ASCEND") {array_push($end_data, "<i class=\"fas fa-check\"></i> " , "<tr class=\"table-success\">", "Shadowlings Ascended", "The shadowlings ascended and took over the station.");}
    if($shorttext == "SLING-SLING-DEAD") {array_push($end_data, "<i class=\"fas fa-times\"></i> " , "<tr class=\"table-danger\">", "Shadowlings Died", "The shadowlings were killed before they could ascend.");}
    if($shorttext == "SLING-CREW-ESCAPE") {array_push($end_data, "<i class=\"fas fa-times\"></i> " , "<tr class=\"table-danger\">", "Crew Escaped", "The shadowlings were killed before they could ascend.");}
    if($shorttext == "SLING-GENERIC-FAIL") {array_push($end_data, "<i class=\"fas fa-question-circle\"></i> " , "<tr class=\"table-warning\">", "Generic Failure", "Something went wrong and no end reason was provided.");}
    // RETURN
    return $end_data;
}
// Adds icon to gamemode names (For rounds page)
function gamemodeToIcon($gamemode) {
    if($gamemode == "blob") {$icon = "<i class=\"fas fa-flask\"></i> Blob";}
    if($gamemode == "changeling") {$icon = "<i class=\"fas fa-dna\"></i> Changeling";}
    if($gamemode == "cult") {$icon = "<i class=\"fas fa-book-dead\"></i> Cult";}
    if($gamemode == "extended") {$icon = "<i class=\"fas fa-clock\"></i> Extended";}
    if($gamemode == "extend-a-traitormongous") {$icon = "<i class=\"fas fa-skull\"></i> Auto-Traitor";}
    if($gamemode == "heist") {$icon = "<i class=\"fas fa-truck-loading\"></i> Vox Raiders";}
    if($gamemode == "meteor") {$icon = "<i class=\"fas fa-meteor\"></i> Meteor";}
    if($gamemode == "nations") {$icon = "<i class=\"fas fa-flag\"></i> Nations";}
    if($gamemode == "nuclear emergency") {$icon = "<i class=\"fas fa-bomb\"></i> Nuke Ops";}
    if($gamemode == "revolution") {$icon = "<i class=\"fas fa-fist-raised\"></i> Revolution";}
    if($gamemode == "sandbox") {$icon = "<i class=\"fas fa-clipboard-check\"></i> Sandbox";}
    if($gamemode == "shadowling") {$icon = "<i class=\"fas fa-lightbulb\"></i> Shadowlings";}
    if($gamemode == "traitor") {$icon = "<i class=\"fas fa-skull\"></i> Traitor";}
    if($gamemode == "vampire") {$icon = "<i class=\"fas fa-teeth-open\"></i> Vampire";}
    if($gamemode == "wizard") {$icon = "<i class=\"fas fa-hat-wizard\"></i> Wizard";}
    return $icon;
}
// Inserts a webmap (For deaths page)
function insertWebmap($name, $x, $y, $map) {
    $x = (32 * $x) - 16;
    $y = (32 * $y) - 16;
    if($map = "NSS Cyberiad") {
        $map = "https://affectedarc07.github.io/SS13WebMap/Paradise/Cyberiad/cyberiad-1.png";
    }
    echo "<div id=\"webmap\"></div>";
    echo "<script src=\"https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.4/leaflet.js\"></script>";
    echo "<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.4/leaflet.css\">";
	echo "<script>\n";
	echo "	var bounds = [[0, 0], [8160, 8160]];\n";
	echo "	var webmap = L.map('webmap', { crs: L.CRS.Simple });\n";
    echo "	webmap.fitBounds(bounds);\n";
    echo "  webmap.attributionControl.setPrefix('');\n";
	echo "	webmap.options.minZoom = -2;\n";
    echo "	webmap.options.maxZoom = 4;\n";
    echo "	var image = L.imageOverlay('" . $map . "', bounds).addTo(webmap);\n";
    echo "  var marker = L.marker([" . $y . ", " . $x . "]).addTo(webmap);\n";
    echo "  marker.bindPopup('" . $name . "').openPopup();\n";
    echo "</script>";
}
// Inserts a top of a webmap (For round info)
function insertWebmapTop($map) {
    if($map = "NSS Cyberiad") {
        $map = "https://affectedarc07.github.io/SS13WebMap/Paradise/Cyberiad/cyberiad-1.png";
    }
    echo "<div id=\"webmap\"></div>";
    echo "<script src=\"https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.4/leaflet.js\"></script>";
    echo "<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.3.4/leaflet.css\">";
	echo "<script>\n";
	echo "	var bounds = [[0, 0], [8160, 8160]];\n";
	echo "	var webmap = L.map('webmap', { crs: L.CRS.Simple });\n";
    echo "	webmap.fitBounds(bounds);\n";
    echo "  webmap.attributionControl.setPrefix('');\n";
	echo "	webmap.options.minZoom = -2;\n";
    echo "	webmap.options.maxZoom = 4;\n";
    echo "	var image = L.imageOverlay('" . $map . "', bounds).addTo(webmap);\n";
}
// Inserts one marker onto a webmap (For round info)
function insertWebmapMarker($x, $y, $name) {
    $id = rand(1,1000); // High value used so we have a low chance of missing a marker
    $x = (32 * $x) - 16;
    $y = (32 * $y) - 16;
    echo "  var marker_" . $id . " = L.marker([" . $y . ", " . $x . "]).addTo(webmap);\n";
    echo "  marker_" . $id . ".bindPopup('" . $name . "');\n";
}
// Inserts top half of webmap (For round info)
function insertWebmapBase() {
    echo "</script>"; // Arguably this doesnt need a function but it pleases my OCD
}
?>