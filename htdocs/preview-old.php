<?

include "../includes/structure.php";
include "../includes/mysql.php";
include "../includes/patTemplate.php";

// Read some database information about the current user... cookies anyone?
db_connect();
$sql = sprintf("SELECT * FROM users WHERE id=1 LIMIT 1");
$result = db_query($sql);
$user = mysql_fetch_assoc($result);

// Setup the template...
$template = new patTemplate();
$template->setBasedir ("templates");
$template->readTemplatesFromFile ("basic.tmpl.html");

// Add the default variables to the template (header section):
$variables = array();
foreach ( $user as $var => $val ) {
  $variables[strtoupper($var)] = $val;
  $template->addGlobalVar (strtoupper($var), $val);
}

$template->addGlobalVar ("FULLNAME", $user['fullname']);
//$template->addVars ("header", $variables);

if ( !empty($user['website']) ) $template->setAttributes ("websitev", array('visibility'=>'visible'));

$template->displayParsedTemplate();

?>