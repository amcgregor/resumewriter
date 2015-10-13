<? ob_start("ob_gzhandler"); ?>
<?

include "../includes/structure.php";

$userid = 1;

// Read some database information about the current user... cookies anyone?
db_connect();
$sql = sprintf("SELECT * FROM users WHERE id=%d LIMIT 1", $userid);
$result = db_query($sql);
$user = mysql_fetch_assoc($result);

// Get the list of main sections, and subsections of each... gah.
$sql = sprintf("SELECT * FROM sections WHERE user=%d AND subsection=0 ORDER BY `order`", $userid);
$sections = recurse_sections(db_query($sql));

$_body = " background=\"images/preview.png\"";

include "templates/template." . $user['template'] . ".php";

?>
